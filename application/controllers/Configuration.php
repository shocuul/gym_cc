<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends MY_Controller{

    public function plans()
    {
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
                    redirect('configuracion/planes','refresh');
                }else
                {
                    $this->session->set_flashdata('message',(validation_errors() ? validation_errors('<div class="alert alert-danger" role="alert">','</div>') : ($this->plan_model->errors() ? $this->plan_model->errors() : $this->session->flashdata('message'))));
                    redirect('configuracion/planes','refresh');
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
            'class' => 'form-control'
        );

        $this->_render('configuration/plans',$this->data);
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

        $plan_id = $this->input->post('plan_id');
    }

}