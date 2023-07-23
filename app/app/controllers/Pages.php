<?php

class Pages extends Controller {

    public function __construct() {
        
    }

    public function index() {
        $data = [
            'title' => 'ShareProp',
            'description' => 'A property sharing network for all',
        ];

        $this->view('pages/index', $data);
    }

    public function about() {
        $data = [
            'title' => 'About Us',
            'description' => 'App to share properties with other users'
        ];
        
        $this->view('pages/about', $data);
    }
}
