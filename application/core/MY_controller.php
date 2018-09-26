<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('auth_model');

    }

    public function _render($view, $data = NULL )
    {
        $this->load->view('template/header');
        $this->load->view($view,$data);
        $this->load->view('template/footer');
    }
    
}