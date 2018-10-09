<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends MY_Controller{

    public function plans()
    {
        $this->data['members'] = $this->member_model->members()->result();
        $this->form_validation->set_rules('nombre','Nombre','trim|required');
        $this->form_validation->set_rules('descripcion','Descripcion','trim|required');
        if(isset($_POST) && !empty($_POST))
        {
            if($this->_valid_csrf_nonce() === FALSE)
            {
                show_error('Este formulario no pasó nuestras pruebas de seguridad.');
            }

            if($this->form_validation->run() === TRUE)
            {
                $plan_data = array(
                    'nombre' => $this->input->post('nombre'),
                    'descripcion' => $this->input->post('descripcion')
                );

                if($this->plan_model->create($plan_data)){
                    $this->session->set_flashdata('message', $this->plan_model->messages());
                    //redirect('configuracion/planes','refresh');
                }else
                {
                    $this->session->set_flashdata('message',(validation_errors() ? validation_errors('<div class="alert alert-danger" role="alert">','</div>') : ($this->plan_model->errors() ? $this->plan_model->errors() : $this->session->flashdata('message'))));
                    //redirect('configuracion/planes','refresh');
                }
            }
   
        }
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['plans'] = $this->plan_model->plans()->result();
        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'type' => 'text',
            'class' => 'form-control'
        );

        $this->data['descripcion'] = array(
            'name' => 'descripcion',
            'id' => 'descripcion',
            'class' => 'form-control',
        );

        $this->_render('configuration/plans',$this->data);
    }


    public function add_routine($id)
    {
        $this->form_validation->set_rules('ejercicio','Ejercicio','trim|required');
        $this->form_validation->set_rules('instruccion','Ejercicio','trim|required');

        if($id != $this->input->post('id'))
        {
            show_error('Este formulario no pasó nuestras pruebas de seguridad.');
        }

        $image_path = realpath(APPPATH . '../images');
        $config['upload_path']          = $image_path;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 3000;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $this->load->library('upload',$config);
        if ( ! $this->upload->do_upload('imagen'))
        {
            $this->session->set_flashdata('message', $this->upload->display_errors());

            redirect('configuracion/plan/'.$id,'refresh');
        }
        else
        {
            $file_data = $this->upload->data();
            if($this->form_validation->run() === TRUE)
            {   
                $plan_id = $this->input->post('id');
                $routine_data = array(
                    'imagen' => $file_data['file_name'],
                    'ejercicio' => $this->input->post('ejercicio'),
                    'instruccion' => $this->input->post('instruccion')
                );
            }

            if($this->form_validation->run() === TRUE && $this->plan_model->add_routine($plan_id, $routine_data))
            {
                $this->session->set_flashdata('message', $this->plan_model->messages());
                redirect('configuracion/plan/'.$id,'refresh');
            }else
            {
                $this->session->set_flashdata('message', (validation_errors() ? validation_errors('<div class="alert alert-danger" role="alert">','</div>') : ($this->plan_model->errors() ? $this->plan_model->errors() : $this->session->flashdata('message'))));
                redirect('configuracion/plan/'.$id,'refresh');
            }

            //$this->load->view('upload_success', $data);
        }
        
    }

    public function plan($id)
    {
        $this->data['plan'] = $this->plan_model->plan($id)->row();
        $this->data['routines'] = $this->plan_model->routines($id)->result();
        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->plan_model->errors() ? $this->plan_model->errors() : $this->session->flashdata('message')));
        $this->data['ejercicio'] = array(
            'name' => 'ejercicio',
            'id' => 'ejercicio',
            'type' => 'text',
            'class' => 'form-control'
        );

        $this->data['instruccion'] = array(
            'name' => 'instruccion',
            'id' => 'instruccion',
            'class' => 'form-control',
            'rows' => '5'
        );

        $this->data['imagen'] = array(
            'name' => 'imagen',
            'id' => 'imagen',
            'class' => 'form-control-file'
        );

        $this->_render('configuration/plan', $this->data);
    }


    public function edit_plan()
    {
        $this->form_validation->set_rules('edit_nombre','Nombre','trim|required');
        $this->form_validation->set_rules('edit_descripcion','Descripcion','trim|required');
        if($this->_valid_csrf_nonce() === FALSE)
        {
            show_error('Este formulario no pasó nuestras pruebas de seguridad.');
        }
        if($this->form_validation->run() === TRUE)
        {
            $plan_id = $this->input->post('plan_id');
            $data = array(
                'nombre' => $this->input->post('edit_nombre'),
                'descripcion' => $this->input->post('edit_descripcion')
            );
        }
        if($this->form_validation->run() === TRUE && $this->plan_model->update($plan_id, $data))
        {
            $this->session->set_flashdata('message', $this->plan_model->messages());
            redirect('configuracion/planes','refresh');
        }
        else
        {
            $this->session->set_flashdata('message',(validation_errors() ? validation_errors('<div class="alert alert-danger" role="alert">','</div>') : ($this->plan_model->errors() ? $this->plan_model->errors() : $this->session->flashdata('message'))));
            redirect('configuracion/planes','refresh');
        }

    }

    public function delete_plan() {
        if($this->_valid_csrf_nonce() === FALSE)
        {
            show_error('Este formulario no pasó nuestras pruebas de seguridad.');
        }

        $plan_id = $this->input->post('delete_plan_id');

        if($this->plan_model->delete($plan_id))
        {
            $this->session->set_flashdata('message', $this->plan_model->messages());
            redirect('configuracion/planes','refresh');
        }else
        {
            $this->session->set_flashdata('message', $this->auth_model->messages());
            redirect('configuracion/planes','refresh');
        }
    }

}