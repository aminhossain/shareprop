<?php 
class Props extends Controller{

    public function __construct() {
        $this->propModel = $this->model('Prop');
    }

    public function list() {

        $props = $this->propModel->getProps();
        $data = [
            'props' => $props
        ];

        $this->view('prop/index', $data);
    }

    //add new prop
    public function add() {
        $this->view('prop/add');
    }

    public function store() {
        $data = $_POST;

        //data validation
        $errors = $this->dataValidation($_POST);
        if(!empty($errors)) {
            echo json_encode(['status' => false, 'data' => $errors]);
            return false;
        }

        //data sanitize
        $data['buyer_email'] = filter_var($data['buyer_email'], FILTER_SANITIZE_EMAIL);
        $data['receipt_id'] = htmlspecialchars(trim($data['receipt_id']));
        $data['city'] = htmlspecialchars(trim($data['city']));
        $data['note'] = trim($data['note']);
        $data['entry_at'] = date('Y-m-d');
        $data['hash_key'] = $this->getHash($data['receipt_id']);
        $data['buyer_ip'] = $_SERVER['REMOTE_ADDR'];
        $ip = str_replace('.', '_', $data['buyer_ip']);
       
        //data process
        if(!empty($_POST)) {
            setrawcookie("ip_{$ip}", 1, time()+86400, '/');
            if($this->propModel->addProp($data)) {
                echo json_encode(['status' => true, 'data' => "Data Added Successfully"]);
            } else {
                if(isset($_COOKIE["ip_{$ip}"])) {
                    echo json_encode(['status' => false, 'data' => "Sorry! you can add data once in 24 hours. Please try again later"]);
                } else {
                    return false;
                }
            }
        }
    }

    public function filter() {
        $date_from = $_POST['from'];
        $date_to = $_POST['to'];
        $sort = $_POST['sort'] == 1 ? 'DESC' : 'ASC';

        $props = $this->propModel->getFilterProps($date_from, $date_to, $sort);

        echo json_encode(['data' => $props]);
    }

    private function dataValidation($data) {
        $errors = [];

        if(!preg_match("/^[a-zA-Z0-9 ]*$/", $data['buyer_name'])) {
            $errors['buyer_name'] = "only letters, numbers and spaces are allowed";
        } else if(strlen($data['buyer_name']) > 20) {
            $errors['buyer_name'] = "at most 20 charachter are allowed";
        }
        if(!filter_var($data['buyer_email'], FILTER_VALIDATE_EMAIL)) {
            $errors['buyer_name'] = "please enter a valid email";
        }
        if(!preg_match("/^[a-zA-Z ]*$/", $data['receipt_id'])) {
            $errors['receipt_id'] = "only letters are allowed";
        }
        if(!preg_match("/^[a-zA-Z ]*$/", $data['city'])) {
            $errors['city'] = "only letters are allowed";
        }
        if(count(explode(" ", $data['note'])) > 30) {
            $errors['note'] = "Max 30 words are allowed";
        }

        return $errors;
    }

    private function getHash($salt) {
        $string = str_shuffle("^abscdefghij9klmnopqrst3uvwxyz#ABCDEFGHIJ_KLMNOP*QRST&UVWXYZ!1234567890!@#$%^&*()_-+");
        $hash = hash('sha512', $salt.$string);

        return $hash;
    }
}                            
                        