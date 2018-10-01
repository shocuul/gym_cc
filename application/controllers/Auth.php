<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller{


    public function index(){

    }

    public function create_user(){

        

        $config['base_url'] = '/usuarios/';
        $config['total_rows'] = 100;
        $config['per_page'] = 10;

        $this->pagination->initialize($config);



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
            $this->session->set_flashdata('message', $this->auth_model->messages());
            redirect("usuarios", 'refresh');
        }
        else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->auth_model->errors() ? $this->auth_model->errors() : $this->session->flashdata('message')));

            $this->data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre'),
            'class' => 'form-control'
            );

            $this->data['paterno'] = array(
                'name' => 'paterno',
                'id' => 'paterno',
                'type' => 'text',
                'value' => $this->form_validation->set_value('paterno'),
                'class' => 'form-control'
            );

            $this->data['materno'] = array(
                'name' => 'materno',
                'id' => 'materno',
                'type' => 'text',
                'value' => $this->form_validation->set_value('materno'),
                'class' => 'form-control'
            );

            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'email',
                'value' => $this->form_validation->set_value('email'),
                'class' => 'form-control'
            );

            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
                'class' => 'form-control'
            );

            $this->data['rol_data'] = array(
                '9' => 'Administrador',
                '4' => 'Entrenador',
                '1' => 'Empleado');

            $this->data['rol'] = $this->form_validation->set_value('rol');

            $this->_render('auth/create_user', $this->data);
        }
        

        
    }

    public function users(){
        $this->data['users'] = $this->auth_model->users()->result();
        $this->_render('auth/users', $this->data);
    }

}