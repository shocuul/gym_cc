<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        //$this->load->helper('url');
        $this->load->model('auth_model');

    }

    public function index(){

    }

    public function create_user(){
        $this->_render('auth/create_user');
    }

    public function users(){
        $this->data['users'] = $this->auth_model->users()->result();
        $this->_render('auth/users', $this->data);
    }
}