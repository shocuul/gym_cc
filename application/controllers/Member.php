<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller
{
    public function index(){

    }

    public function create_member()
    {
        $this->form_validation->set_rules('nombre','Nombre','trim|required');
        $this->form_validation->set_rules('paterno','Apellido Paterno','trim|required');
        $this->form_validation->set_rules('materno','Apellido Materno','trim|required');
        $this->form_validation->set_rules('email','Correo Electronico','trim|required|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('genero','Genero','trim|required');
        $this->form_validation->set_rules('peso','Peso','trim|required');
        $this->form_validation->set_rules('estatura','Estatura','trim|required');

        $this->form_validation->set_rules('mme','Masa Muscular Esquelética','trim|required');
        $this->form_validation->set_rules('mgc','Masa Grasa Corporal','trim|required');
        $this->form_validation->set_rules('act','Agua Corporal Total','trim|required');
        $this->form_validation->set_rules('imc','Índice de Masa Corporal','trim|required');
        $this->form_validation->set_rules('pmc','Porcentaje de Masa Corporal','trim|required');
        $this->form_validation->set_rules('rcc','Relación Cintura-Cadera','trim|required');
        $this->form_validation->set_rules('mb','Metabolismo Basal','trim|required');
        $this->form_validation->set_rules('password','Contraseña','required');
        $this->form_validation->set_rules('usuario','Usuario','trim|required');

        if($this->form_validation->run() === TRUE)
        {

        }else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->auth_model->errors() ? $this->auth_model->errors() : $this->session->flashdata('message')));
            
            $this->data['nombre'] = array(
                'name' => 'nombre',
                'id' => 'nombre',
                'type' => 'text',
                'value' => $this->form_validation->set_value('nombre'),
                'class' => 'form-control',
                'onblur' => 'check_for_userdata()'
            );
    
            $this->data['paterno'] = array(
                'name' => 'paterno',
                'id' => 'paterno',
                'type' => 'text',
                'value' => $this->form_validation->set_value('paterno'),
                'class' => 'form-control',
                'onblur' => 'check_for_userdata()'
            );
    
            $this->data['materno'] = array(
                'name' => 'materno',
                'id' => 'materno',
                'type' => 'text',
                'value' => $this->form_validation->set_value('materno'),
                'class' => 'form-control',
                'onblur' => 'check_for_userdata()'
            );

            $this->data['genero_data'] = array(
                'femenino' => 'Femenino',
                'masculino' => 'Masculino',
            );

            $this->data['genero'] = $this->form_validation->set_value('genero');
            
            $this->data['peso'] = array(
                'name' => 'peso',
                'id' => 'peso',
                'type' => 'text',
                'value' => $this->form_validation->set_value('peso'),
                'class' => 'form-control'
            );

            $this->data['estatura'] = array(
                'name' => 'estatura',
                'id' => 'estatura',
                'type' => 'text',
                'value' => $this->form_validation->set_value('estatura'),
                'class' => 'form-control'
            );

            $this->data['mme'] = array(
                'name' => 'mme',
                'id' => 'mme',
                'type' => 'text',
                'value' => $this->form_validation->set_value('mme'),
                'class' => 'form-control'
            );

            $this->data['mgc'] = array(
                'name' => 'mgc',
                'id' => 'mgc',
                'type' => 'text',
                'value' => $this->form_validation->set_value('mgc'),
                'class' => 'form-control'
            );

            $this->data['act'] = array(
                'name' => 'act',
                'id' => 'act',
                'type' => 'text',
                'value' => $this->form_validation->set_value('act'),
                'class' => 'form-control'
            );

            $this->data['imc'] = array(
                'name' => 'imc',
                'id' => 'imc',
                'type' => 'text',
                'value' => $this->form_validation->set_value('imc'),
                'class' => 'form-control'
            );

            $this->data['pmc'] = array(
                'name' => 'pmc',
                'id' => 'pmc',
                'type' => 'text',
                'value' => $this->form_validation->set_value('pmc'),
                'class' => 'form-control'
            );

            $this->data['rcc'] = array(
                'name' => 'rcc',
                'id' => 'rcc',
                'type' => 'text',
                'value' => $this->form_validation->set_value('rcc'),
                'class' => 'form-control'
            );

            $this->data['mb'] = array(
                'name' => 'mb',
                'id' => 'mb',
                'type' => 'text',
                'value' => $this->form_validation->set_value('mb'),
                'class' => 'form-control'
            );



            $this->data['usuario'] = array(
                'name' => 'usuario',
                'id' => 'usuario',
                'type' => 'text',
                'value' => $this->form_validation->set_value('usuario'),
                'class' => 'form-control',
                'disabled' => TRUE
            );


            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'text',
                'value' => $this->form_validation->set_value('password'),
                'class' => 'form-control',
                'disabled' => TRUE
            );

            
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'email',
                'value' => $this->form_validation->set_value('email'),
                'class' => 'form-control'
            );

            $this->_render('members/create_member', $this->data);

        }

    }

    function generate_login_info()
    {
        $nombre = $this->input->post('nombre');
        $materno = $this->input->post('materno');
        $paterno = $this->input->post('paterno');
        $usuario = $this->member_model->generate_username($nombre, $paterno, $materno);
        $password = $this->member_model->random_password();
        $response = array('usuario' => $usuario, 'password' => $password);

        return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($response));
    }
}