<?php

class Prop {
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getProps(){
        $this->db->query('SELECT * FROM props ORDER BY id DESC');
        $result = $this->db->resultSet();

        return $result;
    }

    public function getFilterProps($date_from, $date_to, $sort) {
        if($date_from && $date_to) {
            $this->db->query("SELECT * FROM props WHERE entry_at >= '{$date_from}' AND entry_at <= '{$date_to}' ORDER BY entry_by {$sort}");
        } else {
            $this->db->query("SELECT * FROM props ORDER BY entry_by {$sort}");
        }

        $result = $this->db->resultSet();

        return $result;
    }

    public function addProp($data){
        
        $this->db->query('INSERT INTO props(amount, buyer, receipt_id, items, buyer_email, buyer_ip, note, city, phone, hash_key, entry_at, entry_by) VALUES (:amount, :buyer, :receipt_id, :items, :buyer_email, :buyer_ip, :note, :city, :phone, :hash_key, :entry_at, :entry_by)');
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':buyer', $data['buyer_name']);
        $this->db->bind(':receipt_id', $data['receipt_id']);
        $this->db->bind(':items', $data['items']);
        $this->db->bind(':buyer_email', $data['buyer_email']);
        $this->db->bind(':buyer_ip', $data['buyer_ip']);
        $this->db->bind(':note', $data['note']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':hash_key', $data['hash_key']);
        $this->db->bind(':entry_at', $data['entry_at']);
        $this->db->bind(':entry_by', $data['entry_by']);
        
        //execute
        $ip = str_replace('.', '_', $data['buyer_ip']);
       
        if(!isset($_COOKIE["ip_{$ip}"])) {
            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getPropById($id){
        $this->db->query('SELECT * FROM props WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }

    public function getPropByIp($ip){
        $this->db->query('SELECT * FROM props WHERE buyer_ip = :ip');
        $this->db->bind(':id', $ip);
        $row = $this->db->single();

        return $row;
    }

    public function updateProp($data){
        $this->db->query('UPDATE props SET amount = :amount, buyer = :buyer, receipt_id = :receipt_id, items = :items, buyer_email = :buyer_email, buyer_ip = :buyer_ip, note = :note, city = :city, phone = :phone, hash_key = :hash_key, entry_at = :entry_at, entry_by = :entry_by WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':buyer', $data['buyer_name']);
        $this->db->bind(':receipt_id', $data['receipt_id']);
        $this->db->bind(':items', $data['items']);
        $this->db->bind(':buyer_email', $data['buyer_email']);
        $this->db->bind(':buyer_ip', $data['buyer_ip']);
        $this->db->bind(':note', $data['note']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':hash_key', $data['hash_key']);
        $this->db->bind(':entry_at', $data['entry_at']);
        $this->db->bind(':entry_by', $data['entry_by']);
        
        //execute 
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    //delete a prop
    public function deleteProp($id){
        $this->db->query('DELETE FROM props WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}