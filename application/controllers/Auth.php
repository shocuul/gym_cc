<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller{


    public function index(){

    }

    public function create_user(){

        //validate form input 
        $this->form_validation->set_rules('nombre','Nombre','trim|required');
        $this->form_validation->set_rules('paterno','Apellido Paterno','trim|required');
        $this->form_validation->set_rules('materno','Apellido Materno','trim|required');
        $this->form_validation->set_rules('email','Correo Electronico','trim|required|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('password','Contraseña','required|min_length[8]');
        $this->form_validation->set_rules('rol','Seleccione el Rol','required');

        if($this->form_validation->run() === TRUE){
            $password = $this->input->post('password');
            $username = $this->auth_model->generate_username($this->input->post('nombre'),$this->input->post('paterno'),$this->input->post('materno'));
            $email = $this->input->post('email');
            $grupo = $this->input->post('rol');
            $additional_data = array(
                'nombre' => $this->input->post('nombre'),
                'paterno' => $this->input->post('paterno'),
                'materno' => $this->input->post('materno')
            );
        }
        if($this->form_validation->run() === TRUE && $this->auth_model->register($password, $username, $email, $additional_data, $grupo))
        {
            $this-session->set_flashdata('message', $this->auth_model->messages());
            redirect("usuarios", 'refresh');
        }
        else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_model->errors() ? $this->ion_model->errors() : $this->session->flashdata('message')));

            $this->data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre');
            );
            $this->_render('auth/create_user');
        }
        

        
    }

    public function users(){
        $this->data['users'] = $this->auth_model->users()->result();
        $this->_render('auth/users', $this->data);
    }

}