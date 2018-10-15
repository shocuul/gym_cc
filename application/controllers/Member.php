<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller
{
    public function index($offset = NULL){
        //admin check

        

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        
        $select = array(
            'usuarios.id',
            'usuarios.nombre',
            'usuarios.paterno',
            'usuarios.materno',
            'socios.edad',
            'socios.peso',
            'socios.estatura',
            'socios.genero'
        );
        $this->member_model->select($select);

        //pagination stuff
        $limit_per_page = 10;
        $total_record = $this->member_model->members()->num_rows();
        $this->member_model->limit($limit_per_page);
        $this->member_model->offset($offset);
        $this->data['members'] = $this->member_model->members()->result();
        $config['base_url'] = base_url() . 'index.php?/socios';
        $config['total_rows'] = $total_record;
        $config['per_page'] = $limit_per_page;
        $config['cur_tag_open'] = '<span class="page-numbers current" aria-current="page">';
        $config['cur_tag_close'] = '</span>';
        $config['next_link'] = 'Siguiente <i class="fa fa-angle-right"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left"></i> Anterior';
        $this->pagination->initialize($config);

        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->_render('members/index', $this->data);

    }
    public function ajax_members()
    {
        $output = '';
        $query = '';
        if($this->input->post('query'))
        {
            $query = $this->input->post('query');
            $this->member_model->search($query);
        }
        $members = $this->member_model->members()->result();
        if($this->member_model->num_rows() > 0)
        {
        $output .= '
        <table class="points-listing">
            <thead>
                <tr class="first">
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Genero</th>
                    <th>Peso</th>
                    <th>Estatura</th>
                    <th>Acciones</th>
                </tr>
            <thead>
            <tbody>';
        foreach($members as $member)
        {
            $output .= '
            <tr>
            <td>'. htmlspecialchars($member->id, ENT_QUOTES, 'UTF-8') .'</td>
            <td>'. htmlspecialchars($member->nombre .' '. $member->paterno .' '. $member->materno, ENT_QUOTES, 'UTF-8') .'</td>
            <td>'. htmlspecialchars($member->edad, ENT_QUOTES, 'UTF-8').'</td>
            <td>'. htmlspecialchars(ucfirst($member->genero), ENT_QUOTES, 'UTF-8').'</td>
            <td>'. htmlspecialchars($member->peso, ENT_QUOTES, 'UTF-8').'kg.</td>
            <td>'. htmlspecialchars($member->estatura, ENT_QUOTES, 'UTF-8').'m.</td>
            <td>
            <div class="pro-share" style="margin:0;">
                '. anchor("socio/detalles/". $member->id, '<i class="fa fa-user-circle"></i>').
                anchor("socios/editar_socio/" .$member->id,'<i class="fa fa-edit"></i>')
            .'
            <a data-toggle="modal" href="#deleteModal" onClick="fillModal(\''.$member->id.'\',\''.$member->nombre.' '.$member->paterno.' '.$member->materno.'\')"><i class="fa fa-trash"></i></a>
            </div>
            </td>
            </tr>
            ';
        }
        $output .= '
        <tbody></table>
        ';
    }else{  
        $output .= '
            <div class="alert alert-warning" role="alert">
                No se encontraron socios.
            </div>
        ';
    }
    $this->output->set_output($output);   
    }

    

    public function edit_member($id)
    {
        $member = $this->member_model->member($id)->row();

        $this->form_validation->set_rules('nombre','Nombre','trim|required');
        $this->form_validation->set_rules('paterno','Apellido Paterno','trim|required');
        $this->form_validation->set_rules('materno','Apellido Materno','trim|required');
        $this->form_validation->set_rules('email','Correo Electronico','trim|required|valid_email');
        $this->form_validation->set_rules('edad','Edad','trim|required');
        $this->form_validation->set_rules('genero','Genero','trim|required');
        $this->form_validation->set_rules('peso','Peso','trim|required');
        $this->form_validation->set_rules('usuario','Usuario','trim|required');
        $this->form_validation->set_rules('estatura','Estatura','trim|required');

        if(isset($_POST) && !empty($_POST))
        {
            if($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
            {
                show_error('Este formulario no pasó nuestras pruebas de seguridad.');
            }

            if($this->input->post('password'))
            {
                $this->form_validation->set_rules('password','Contraseña','required|min_length[8]|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm','Confirmar Contraseña','required');
            }

            if($this->form_validation->run() === TRUE)
            {
                $user_data = array(
                    'nombre' => $this->input->post('nombre'),
                    'paterno' => $this->input->post('paterno'),
                    'materno' => $this->input->post('materno'),
                    'email' => $this->input->post('email'),
                    'usuario' => $this->input->post('usuario')
                );
                
                $member_data = array(
                    'edad' => $this->input->post('edad'),
                    'genero' => $this->input->post('genero'),
                    'peso' => $this->input->post('peso'),
                    'estatura' => $this->input->post('estatura')
                );

                if($this->input->post('password'))
                {
                    $data['password'] = $this->input->post('password');
                }

                if($this->auth_model->update($member->id,$user_data) && $this->member_model->update($member->id, $member_data))
                {
                    $this->session->set_flashdata('message', $this->member_model->messages());
					$this->redirectUser();
                }
                else
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->member_model->errors());
					$this->redirectUser();
                }
            }
        }


        // preparacion de datos del formulario
        $this->data['csrf'] = $this->_get_csrf_nonce();

        $this->data['member'] = $member;

        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->member_model->errors() ? $this->member_model->errors() : $this->session->flashdata('message')));

        $this->data['edad'] = array(
            'name' => 'edad',
            'id' => 'edad',
            'type' => 'text',
            'value' => $this->form_validation->set_value('edad' , $member->edad),
            'class' => 'form-control'
            
            );

        $this->data['genero_data'] = array(
            'femenino' => 'Femenino',
            'masculino' => 'Masculino',
        );

        $this->data['genero'] = $this->form_validation->set_value('genero', $member->genero);

        $this->data['peso'] = array(
            'name' => 'peso',
            'id' => 'peso',
            'type' => 'text',
            'value' => $this->form_validation->set_value('materno', $member->peso),
            'class' => 'form-control'
        );

        $this->data['estatura'] = array(
            'name' => 'estatura',
            'id' => 'estatura',
            'type' => 'text',
            'value' => $this->form_validation->set_value('email' , $member->estatura),
            'class' => 'form-control'
        );

        $this->data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'class' => 'form-control'
        );

        $this->data['password_confirm'] = array(
            'name' => 'password_confirm',
			'id'   => 'password_confirm',
            'type' => 'password',
            'class' => 'form-control'
        );

        $this->data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre' , $member->nombre),
            'class' => 'form-control'
            
            );

        $this->data['paterno'] = array(
            'name' => 'paterno',
            'id' => 'paterno',
            'type' => 'text',
            'value' => $this->form_validation->set_value('paterno', $member->paterno),
            'class' => 'form-control'
        );

        $this->data['materno'] = array(
            'name' => 'materno',
            'id' => 'materno',
            'type' => 'text',
            'value' => $this->form_validation->set_value('materno', $member->materno),
            'class' => 'form-control'
        );

        $this->data['usuario'] = array(
            'name' => 'usuario',
            'id' => 'usuario',
            'type' => 'text',
            'value' => $this->form_validation->set_value('usuario', $member->usuario),
            'class' => 'form-control'
        );

        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'email',
            'value' => $this->form_validation->set_value('email' , $member->email),
            'class' => 'form-control'
        );


        
        $this->_render("members/edit_member",$this->data);




    }

    public function redirectUser(){
        redirect("socios", 'refresh');
    }

    public function create_member()
    {
        $this->form_validation->set_rules('nombre','Nombre','trim|required');
        $this->form_validation->set_rules('paterno','Apellido Paterno','trim|required');
        $this->form_validation->set_rules('materno','Apellido Materno','trim|required');
        $this->form_validation->set_rules('email','Correo Electronico','trim|required|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('edad','Edad','trim|required|numeric');
        $this->form_validation->set_rules('genero','Genero','trim|required');
        $this->form_validation->set_rules('peso','Peso','trim|required|numeric');
        $this->form_validation->set_rules('estatura','Estatura','trim|required|numeric');

        $this->form_validation->set_rules('mme','Masa Muscular Esquelética','trim|required|numeric');
        $this->form_validation->set_rules('mgc','Masa Grasa Corporal','trim|required|numeric');
        $this->form_validation->set_rules('act','Agua Corporal Total','trim|required|numeric');
        $this->form_validation->set_rules('imc','Índice de Masa Corporal','trim|required|numeric');
        $this->form_validation->set_rules('pmc','Porcentaje de Masa Corporal','trim|required|numeric');
        $this->form_validation->set_rules('rcc','Relación Cintura-Cadera','trim|required|numeric');
        $this->form_validation->set_rules('mb','Metabolismo Basal','trim|required|numeric');
        $this->form_validation->set_rules('password','Contraseña','required');
        $this->form_validation->set_rules('usuario','Usuario','trim|required');

        if($this->form_validation->run() === TRUE)
        {
            $password = $this->input->post('password');
            $user_info = array(
                'nombre' => $this->input->post('nombre'),
                'paterno' => $this->input->post('paterno'),
                'materno' => $this->input->post('materno'),
                'usuario' => $this->input->post('usuario'),
                'email' => $this->input->post('email')
            );

            $members_info = array(
                'edad' => $this->input->post('edad'),
                'genero' => $this->input->post('genero'),
                'estatura' => (float) $this->input->post('estatura'),
                'peso' => (float) $this->input->post('peso')
            );

            $reading_member = array(
                'mme' => (float) $this->input->post('mme'),
                'mgc' => (float) $this->input->post('mgc'),
                'act' => (float) $this->input->post('act'),
                'imc' => (float) $this->input->post('imc'),
                'pmc' => (float) $this->input->post('pmc'),
                'rcc' => (float) $this->input->post('rcc'),
                'mb' => (float) $this->input->post('mb'),
            );

        }
        if($this->form_validation->run() === TRUE && $this->member_model->add_member($password, $user_info, $members_info, $reading_member))
        {
            $this->session->set_flashdata('message', $this->member_model->messages());
            redirect("socios", 'refresh');
        }
        else
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
            
            $this->data['edad'] = array(
                'name' => 'edad',
                'id' => 'edad',
                'type' => 'text',
                'value' => $this->form_validation->set_value('edad'),
                'class' => 'form-control'
            );

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

    public function add_plan($member_id)
    {

        $plan_id = $this->input->post('plan');
        $this->member_model->subscribe_to_plan($plan_id, $member_id);
        redirect('socio/detalles/'.$member_id,'refresh');
    }

    public function add_metric($member_id, $current_id)
    {

        // $metric_data = array(
        //     'mme' => (float) $this->input->post('mme'),
        //     'mgc' => (float) $this->input->post('mgc'),
        //     'act' => (float) $this->input->post('act'),
        //     'imc' => (float) $this->input->post('imc'),
        //     'pmc' => (float) $this->input->post('pmc'),
        //     'rcc' => (float) $this->input->post('rcc'),
        //     'mb' => (float) $this->input->post('mb'),
        // );
        // foreach($metric_data as $metric){
        //     echo $metric;
        // }
        $this->form_validation->set_rules('mme','Masa Muscular Esquelética','trim|required');
        $this->form_validation->set_rules('mgc','Masa Grasa Corporal','trim|required');
        $this->form_validation->set_rules('act','Agua Corporal Total','trim|required');
        $this->form_validation->set_rules('imc','Índice de Masa Corporal','trim|required');
        $this->form_validation->set_rules('pmc','Porcentaje de Masa Corporal','trim|required');
        $this->form_validation->set_rules('rcc','Relación Cintura-Cadera','trim|required');
        $this->form_validation->set_rules('mb','Metabolismo Basal','trim|required');

        if($member_id != $this->input->post('member_id') && $current_id != $this->input->post('current_id'))
        {
            show_error('Este formulario no pasó nuestras pruebas de seguridad.');
        }

        if($this->form_validation->run() === TRUE)
        {
            //$user_id = $this->input->post('id');
            $image_path = realpath(APPPATH . '../images');
            $config['upload_path']          = $image_path;
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 3000;
            // $config['max_width']            = 2000;
            // $config['max_height']           = 768;
            $this->load->library('upload',$config);

            if(! $this->upload->do_upload('imagen')){
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect('socio/detalles/'.$member_id.'/plan/'.$current_id,'refresh');
            }
            else
            {
                $file_data = $this->upload->data();
                $imagen = $file_data['file_name'];
                $metric_data = array(
                    'mme' => (float) $this->input->post('mme'),
                    'mgc' => (float) $this->input->post('mgc'),
                    'act' => (float) $this->input->post('act'),
                    'imc' => (float) $this->input->post('imc'),
                    'pmc' => (float) $this->input->post('pmc'),
                    'rcc' => (float) $this->input->post('rcc'),
                    'mb' => (float) $this->input->post('mb'),
                );
            }
           
        }

        if($this->form_validation->run() === TRUE && $this->member_model->add_metric($member_id, $current_id , $metric_data, $imagen))
        {
            $this->session->set_flashdata('message', $this->member_model->messages());
            redirect('socio/detalles/'.$member_id.'/plan/'.$current_id,'refresh');
        }else
        {
            $this->session->set_flashdata('message',(validation_errors() ? validation_errors('<div class="alert alert-danger" role="alert">','</div>') : ($this->auth_model->errors() ? $this->auth_model->errors() : $this->session->flashdata('message'))));
            redirect('socio/detalles/'.$member_id.'/plan/'.$current_id,'refresh');
        }
        
    }

    public function profile($member_id)
    {

        $this->data['member'] = $this->member_model->member($member_id)->row();
        if(isset($_POST) && !empty($_POST))
        {
            $image_path = realpath(APPPATH . '../images');
            $config['upload_path']          = $image_path;
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 3000;
            $config['encrypt_name'] = TRUE;
            // $config['max_width']            = 2000;
            // $config['max_height']           = 768;
            $this->load->library('upload',$config);
            if(! $this->upload->do_upload('imagen')){
                $this->session->set_flashdata('message', $this->upload->display_errors('<div class="alert alert-danger" role="alert"><ul><li>','</li></ul></div>'));
                redirect(uri_string(),'refresh');
            }
            else{
                $file_data = $this->upload->data();
                $imagen = $file_data['file_name'];
                $data = array(
                    'path' => $imagen,
                    'avatar' => ($this->input->post('avatar')) ? 1 : 0
                );
                if($this->member_model->add_image($member_id, $data))
                {
                    $this->session->set_flashdata('message', $this->member_model->messages());
                    redirect(uri_string(),'refresh');
                }else
                {
                    $this->session->set_flashdata('message', $this->member_model->errors());
                    redirect(uri_string(),'refresh');
                }

            }
            

        }
        $this->data['csrf'] = $this->_get_csrf_nonce();
        //$this->member_model->routines($current_plan->id)->result();
        $this->data['subscribe_plans'] = $this->member_model->get_member_plans($member_id)->result();
        
        foreach($this->data['subscribe_plans'] as $k => $plan){
            $this->data['subscribe_plans'][$k]->current_routines = $this->member_model->routines($plan->id, FALSE)->result();
        }

        foreach($this->data['subscribe_plans'] as $k => $plan){
            $this->data['subscribe_plans'][$k]->completed_routines = $this->member_model->routines($plan->id, TRUE)->result();
        }

        $this->data['imagen'] = array(
            'name' => 'imagen',
            'id' => 'imagen',
            'class' => 'form-control-file'
        );

        $this->data['avatar'] = array(
            'name' => 'avatar',
            'id' => 'avatar',
            'value' => 'avatar',
            'checked' => FALSE,
            'class' => 'form-check-input'
        );

        $this->data['gallery'] = $this->member_model->gallery($member_id)->result();
        $this->data['assists'] = $this->db->get_where('asistencias',array('usuario_id'=>$member_id))->result();
        //echo $this->db->last_query();
        //var_dump($this->data['subscribe_plans']);
        $this->data['message'] = ($this->member_model->errors() ? $this->member_model->errors() : $this->session->flashdata('message'));
        $this->_render('members/profile', $this->data);

    }

    public function gallery($member_id)
    {

    }

    public function register_assists($member_id)
    {
        if($this->member_model->register_assists($member_id))
        {
            $this->session->set_flashdata('message', $this->member_model->messages());
            redirect('perfil/'.$member_id, 'refresh');
        }else
        {
            $this->session->set_flashdata('message', $this->member_model->errors());
            redirect('perfil/'.$member_id, 'refresh');
        }
    }

    public function routine_complete($member_id, $routine_id)
    {
        if($this->member_model->routine_completed($routine_id))
        {
            $this->session->set_flashdata('message', $this->member_model->messages());
            redirect('perfil/'.$member_id, 'refresh');
        }else
        {
            $this->session->set_flashdata('message', $this->member_model->errors());
            redirect('perfil/'.$member_id, 'refresh');
        }
    }

    public function manage_plan($member_id, $plan_id)
    {
        // echo $member_id;
        // echo $plan_id;
        $current_plan = $this->member_model->get_plan_users_id($member_id, $plan_id)->row();
        $this->form_validation->set_rules('instruccion','Instruccion','required');
        if(isset($_POST) && !empty($_POST))
        {
            if($this->_valid_csrf_nonce() === FALSE)
            {
                show_error('Este formulario no pasó nuestras pruebas de seguridad.');
            }
            if($this->form_validation->run() === TRUE)
            {
                $rutine_id = $this->input->post('rutine_id');
                $instruccion = $this->input->post('instruccion');

                if($this->member_model->add_routine($current_plan->id, $rutine_id, $instruccion))
                {
                    $this->session->set_flashdata('message', $this->member_model->messages());
                    redirect(uri_string(),'refresh');
                }else
                {
                    $this->session->set_flashdata('message', $this->member_model->errors());
                    redirect(uri_string(),'refresh');
                }
            }
            //echo $this->input->post('ejercicio');
            //var_dump($this->plan_model->routine($this->input->post('rutine_id'))->row());
            //echo $this->input->post('instruccion');
            //echo $this->input->post('rutine_id');
        }

        $this->data['current_plan'] = $current_plan;
        $this->data['member_id'] = $member_id;
        $this->data['routines'] = $this->plan_model->routines($plan_id)->result();
        $this->data['sub_rutines'] = $this->member_model->routines($current_plan->id)->result();
        $this->data['sub_rutines_completed'] = $this->member_model->routines($current_plan->id, TRUE)->result();
        $this->data['csrf'] = $this->_get_csrf_nonce();
        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->member_model->errors() ? $this->member_model->errors() : $this->session->flashdata('message')));
        $this->data['mme'] = array(
            'name' => 'mme',
            'id' => 'mme',
            'type' => 'text',
            'value' =>'',
            'class' => 'form-control'
        );

        $this->data['mgc'] = array(
            'name' => 'mgc',
            'id' => 'mgc',
            'type' => 'text',
            'value' => '',
            'class' => 'form-control'
        );

        $this->data['act'] = array(
            'name' => 'act',
            'id' => 'act',
            'type' => 'text',
            'value' => '',
            'class' => 'form-control'
        );

        $this->data['imc'] = array(
            'name' => 'imc',
            'id' => 'imc',
            'type' => 'text',
            'value' => '',
            'class' => 'form-control'
        );

        $this->data['pmc'] = array(
            'name' => 'pmc',
            'id' => 'pmc',
            'type' => 'text',
            'value' => '',
            'class' => 'form-control'
        );

        $this->data['rcc'] = array(
            'name' => 'rcc',
            'id' => 'rcc',
            'type' => 'text',
            'value' =>'',
            'class' => 'form-control'
        );

        $this->data['mb'] = array(
            'name' => 'mb',
            'id' => 'mb',
            'type' => 'text',
            'value' => '',
            'class' => 'form-control'
        );

        $this->data['imagen'] = array(
            'name' => 'imagen',
            'id' => 'imagen',
            'class' => 'form-control-file'
        );

        
        $this->_render('members/manage_plan', $this->data);
        
    }

    public function detail($id)
    {
        $this->data['member'] = $this->member_model->member($id)->row();

        $this->data['subscribe_plans'] = $this->member_model->get_member_plans($id)->result();

        //$this->data['avalible_plans'] = $this->plan_model->avalible_plans($this->data['subscribe_plans'])->result();

        $this->data['plan_data'] =  $this->plan_model->available_plans($this->data['subscribe_plans'])->has_dropdown('nombre');

        $this->data['csrf'] = $this->_get_csrf_nonce();

        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->member_model->errors() ? $this->member_model->errors() : $this->session->flashdata('message')));
       
        
        $this->data['mme'] = array(
            'name' => 'mme',
            'id' => 'mme',
            'type' => 'text',
            'value' =>'',
            'class' => 'form-control'
        );

        $this->data['mgc'] = array(
            'name' => 'mgc',
            'id' => 'mgc',
            'type' => 'text',
            'value' => '',
            'class' => 'form-control'
        );

        $this->data['act'] = array(
            'name' => 'act',
            'id' => 'act',
            'type' => 'text',
            'value' => '',
            'class' => 'form-control'
        );

        $this->data['imc'] = array(
            'name' => 'imc',
            'id' => 'imc',
            'type' => 'text',
            'value' => '',
            'class' => 'form-control'
        );

        $this->data['pmc'] = array(
            'name' => 'pmc',
            'id' => 'pmc',
            'type' => 'text',
            'value' => '',
            'class' => 'form-control'
        );

        $this->data['rcc'] = array(
            'name' => 'rcc',
            'id' => 'rcc',
            'type' => 'text',
            'value' =>'',
            'class' => 'form-control'
        );

        $this->data['mb'] = array(
            'name' => 'mb',
            'id' => 'mb',
            'type' => 'text',
            'value' => '',
            'class' => 'form-control'
        );

        

        $this->_render('members/details_member', $this->data);
    }

    public function delete_plan(){
        if($this->_valid_csrf_nonce() === FALSE)
        {
            show_error('Este formulario no pasó nuestras pruebas de seguridad.');
        }

        $current_id = $this->input->post('current_id');

        if($this->member_model->delete_subscribe($current_id))
        {
            $this->session->set_flashdata('message', $this->member_model->messages());
			$this->redirectUser();
        }
        else
        {
            $this->session->set_flashdata('message', $this->member_model->errors());
			$this->redirectUser();
        }
    }

    public function delete_member()
    {
        if($this->_valid_csrf_nonce() === FALSE)
        {
            show_error('Este formulario no pasó nuestras pruebas de seguridad.');
        }

        $user_id = $this->input->post('user_id');

        if($this->member_model->delete_user($user_id))
        {
            $this->session->set_flashdata('message', $this->member_model->messages());
			$this->redirectUser();
        }
        else
        {
            $this->session->set_flashdata('message', $this->member_model->errors());
			$this->redirectUser();
        }
    }

    public function generate_chart_data($id)
    {   
        $metrics = $this->member_model->get_user_metrics($id);
        $newData = array();
        $firstLine = TRUE;
        foreach($metrics as $metric)
        {
            if($firstLine)
            {
               $newData[] = array('Fecha','Masa Muscular Esquelética','Masa Grasa Corporal','Agua Corporal Total','Índice de Masa Corporal','Porcentaje de Masa Corporal','Relación Cintura-Cadera','Metabolismo Basal');
               $firstLine = FALSE; 
            }

            $newData[] = array($metric->fecha_creacion,(float) $metric->mme, (float) $metric->mgc, (float)$metric->act, (float)$metric->imc, (float) $metric->pmc,(float) $metric->rcc,(float) $metric->mb);
        }
        return $this->output
                    ->set_content_type('application/json')
                    ->set_output(json_encode($newData));
    }

    public function generate_login_info()
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