<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model('auth_model');
        $this->load->library('form_validation');

    }

    public function _render($view, $data = NULL )
    {
        $this->load->view('template/header');
        $this->load->view($view,$data);
        $this->load->view('template/footer');
    }
    
}