<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends MY_Controller{

    public function plans($offset = NULL)
    {
        if (!$this->auth_model->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }else if (!$this->has_permissions('plans')) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('No tienes permisos para ver esta pagina');
        }

        $limit_per_page = 10;
        $total_record = $this->plan_model->get_total();

        $this->plan_model->limit($limit_per_page);
        $this->plan_model->offset($offset);
        $this->data['plans'] = $this->plan_model->plans()->result();
        $config['base_url'] = base_url() .'index.php?/configuracion/planes';
        $config['total_rows'] = $total_record;
        $config['per_page'] =  $limit_per_page;
        $config['cur_tag_open'] = '<span class="page-numbers current" aria-current="page">';
        $config['cur_tag_close'] = '</span>';
        $config['next_link'] = 'Siguiente <i class="fa fa-angle-right"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left"></i> Anterior';
        $this->pagination->initialize($config);
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

    public function ajax_plans(){
        $output = '';
        $query = '';
        if($this->input->post('query'))
        {
            $query = $this->input->post('query');
            $this->plan_model->like('nombre',$query);
            $this->plan_model->like('descripcion', $query);
        }

        $plans = $this->plan_model->plans()->result();
        if($this->plan_model->num_rows() > 0)
        {
            $output .= '
            <table class="points-listing">
                <thead>
                    <tr class="first">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>     
                    </tr>
                </thead>
                <tbody> 
            ';
            foreach ($plans as $plan) {
                $output .= '
                
                ';
            }
        }
    }

    public function add_routine($id)
    {
        $this->form_validation->set_rules('ejercicio','Ejercicio','trim|required');
        $this->form_validation->set_rules('instruccion','Instruccion','trim|required');

        if($id != $this->input->post('id'))
        {
            show_error('Este formulario no pasó nuestras pruebas de seguridad.');
        }
        
        if($this->form_validation->run() === TRUE)
        {   
            $plan_id = $this->input->post('id');
            $routine_data = array(
                'imagen' => $this->input->post('imagen'),
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

    public function delete_rutine($id)
    {
        $routine_id = $this->input->post('delete_rutina_id');
        if($this->plan_model->delete_routine($routine_id))
        {
            $this->session->set_flashdata('message', $this->plan_model->messages());
            redirect('configuracion/plan/'.$id,'refresh');
        }
        else
        {
            $this->session->set_flashdata('message', (validation_errors() ? validation_errors('<div class="alert alert-danger" role="alert">','</div>') : ($this->plan_model->errors() ? $this->plan_model->errors() : $this->session->flashdata('message'))));
            redirect('configuracion/plan/'.$id,'refresh');
        }
    }

    public function plan($id)
    {
        if (!$this->auth_model->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }else if (!$this->has_permissions('plans')) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('No tienes permisos para ver esta pagina');
        }
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

    public function images(){
        $this->form_validation->set_rules('imagen','Imagen','required');
        if(isset($_POST) && !empty($_POST))
        {   
            if($this->input->post('action') === 'add_image'){
                if($this->form_validation->run() === TRUE)
                {
                $data = array(
                    'path' => $this->input->post('imagen'),
                    'tipo' => $this->input->post('tipo')
                );
                }
                if($this->plan_model->new_image($data))
                {
                    $this->session->set_flashdata('message', $this->plan_model->messages());
                    redirect(uri_string(),'refresh');
                }else
                {
                    $this->session->set_flashdata('message', $this->plan_model->messages());
                    redirect(uri_string(),'refresh');
                }
            }
            //END ADD IMAGES
            if($this->input->post('action') === 'delete_image')
            {
                if($this->plan_model->delete_image($this->input->post('imagen_id')))
                {
                    $this->session->set_flashdata('message', $this->plan_model->messages());
                    redirect(uri_string(),'refresh');
                }else{
                    $this->session->set_flashdata('message', $this->plan_model->messages());
                    redirect(uri_string(),'refresh');
                }
            }
            
        }

        $this->data['images'] = $this->db->get('imagenes_pagina')->result();
        $this->data['message'] = (validation_errors() ? validation_errors('<div class="alert alert-danger" role="alert">','</div>') : ($this->auth_model->errors() ? $this->auth_model->errors() : $this->session->flashdata('message')));
        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->_render('configuration/images',$this->data);
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
            $this->session->set_flashdata('message', $this->plan_model->messages());
            redirect('configuracion/planes','refresh');
        }
    }

    public function permissions()
    {
        if (!$this->auth_model->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }else if (!$this->has_permissions('config')) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('No tienes permisos para ver esta pagina');
        }
        $this->form_validation->set_rules('nombre','Nombre','trim|required');
        $groups = $this->auth_model->groups()->result();
        if(isset($_POST) && !empty($_POST))
        {
            if($this->input->post('action') === 'add_plan')
            {
                //Add new Group
                if($this->form_validation->run() === TRUE){
                    $permission_group = array();
                    $permission_group['users'] = ($this->input->post('users')) ? TRUE : FALSE;
                    $permission_group['members'] = ($this->input->post('members')) ? TRUE : FALSE;
                    $permission_group['plans'] = ($this->input->post('plans')) ? TRUE : FALSE;
                    $permission_group['stats'] = ($this->input->post('stats')) ? TRUE : FALSE;
                    $permission_group['config'] = ($this->input->post('config')) ? TRUE : FALSE;
                    
                    $data = array(
                        'nombre' => strtolower($this->input->post('nombre')),
                        'descripcion' => $this->input->post('nombre')
                    );
                    $this->db->insert('grupos',$data);
                    $this->update_permissions(strtolower($this->input->post('nombre')),$permission_group);
                    redirect(uri_string(),'refresh');
                }else{
                    $this->session->set_flashdata('message',(validation_errors() ? validation_errors('<div class="alert alert-danger" role="alert">','</div>') : ($this->auth_model->errors() ? $this->auth_model->errors() : $this->session->flashdata('message'))));
                    redirect(uri_string(),'refresh');
                }
            }
            if($this->input->post('action') === 'update_permission')
            {
                foreach($groups as $group)
                {
                    //skip admin group
                    if($group->nombre === 'admin')
                    {
                        continue;
                    }
                    $permission_array = $this->input->post($group->nombre);
                    $permission_group = array();
                    $permission_group['users'] = (in_array('usuarios',$permission_array)) ? TRUE : FALSE;
                    $permission_group['members'] = (in_array('socios',$permission_array)) ? TRUE : FALSE;
                    $permission_group['plans'] = (in_array('planes',$permission_array)) ? TRUE : FALSE;
                    $permission_group['stats'] = (in_array('estadisticas',$permission_array)) ? TRUE : FALSE;
                    $permission_group['config'] = (in_array('configuracion',$permission_array)) ? TRUE : FALSE;
                    $this->update_permissions($group->nombre,$permission_group);
                }
            }
            //var_dump($this->input->post());
        }


        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'type' => 'text',
            'class' => 'form-control'
        );
        $this->data['permissions'] = $this->_permissions;
        $this->data['groups'] = $groups;
        //var_dump($this->_permissions);
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->auth_model->errors() ? $this->auth_model->errors() : $this->session->flashdata('message')));
        $this->_render('configuration/permissions', $this->data);
        // $permissions = array(
        //     'admin' => array('users' => TRUE, 'members' => TRUE, 'plans' => TRUE, 'config' => TRUE),
        //     'member' => array('perfil' => TRUE)
        // );


        // if($this->has_permissions('admin','users'))
        // {
        //     echo "tengo permisios";
        // }else{
        //     echo "no tengo permisos";
        // }

        // $sections = array('users' => TRUE, 'profile' => TRUE, 'members' => FALSE, 'plans' => FALSE, 'config' => FALSE, 'stats' => FALSE);
        // $permissions['empleado'] = $sections;
        // //var_dump($permissions);
        // // $old = json_encode($sections);
        // // $new = json_decode($old, true);
        // $this->delete_permissions('empleado');
        //$data = array('users' => TRUE, 'profile' => FALSE, 'members' => TRUE, 'plans' => TRUE, 'config' => TRUE, 'stats' => TRUE);
        //$this->update_permissions('admin',$data);
        //var_dump($permissions);


        





    }

}