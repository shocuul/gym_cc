<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller{


    public function index(){
    }

    public function login()
    {
        $this->form_validation->set_rules('usuario','Usuario','required');
        $this->form_validation->set_rules('password','Contraseña','required');

        if($this->form_validation->run() === TRUE)
        {
            if($this->auth_model->login($this->input->post('usuario'),$this->input->post('password')))
            {
                $this->session->set_flashdata('message', $this->auth_model->messages());
                redirect('/', 'refresh');
            }
            else
            {
                $this->session->set_flashdata('message', $this->auth_model->errors());
                redirect('iniciar_sesion', 'refresh');
            }
        }
        else
        {
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $this->data['usuario'] = array(
                'id' => 'usuario',
                'name' => 'usuario',
                'type' => 'text',
                'value' => $this->form_validation->set_value('usuario'),
                'class' => 'form-control',
                'placeholder' => 'Usuario'
            );

            $this->data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Contraseña'
            );

            $this->load->view('auth/login', $this->data);
        }
    }

    public function logout()
    {

        // log the user out
        $logout = $this->auth_model->logout();

        // redirect them to the login page
        $this->session->set_flashdata('message', $this->auth_model->messages());
        redirect('auth/login', 'refresh');
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

            // $this->data['rol_data'] = array(
            //     '9' => 'Administrador',
            //     '4' => 'Entrenador',
            //     '1' => 'Empleado');
            // $groups = $this->auth_model->groups()->result();
            // $groups_array = array();
            // foreach ($groups as $group) {
            //     $groups_array[$group->id] = $group->descripcion;
            // }
            //

            $this->data['rol_data'] = $this->auth_model->groups()->has_dropdown('descripcion');

            $this->data['rol'] = $this->form_validation->set_value('rol');

            $this->_render('auth/create_user', $this->data);
        }
        

        
    }

    public function users($offset = NULL){

        // if (!$this->auth_model->logged_in())
        // {
        //     // redirect them to the login page
        //     redirect('auth/login', 'refresh');
        // }else if (!$this->auth_model->is_admin()) // remove this elseif if you want to enable this for non-admins
        // {
        //     // redirect them to the home page because they must be an administrator to view this
        //     return show_error('You must be an administrator to view this page.');
        // }

        $limit_per_page = 10;
        //$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $total_record = $this->auth_model->get_total();
        $this->auth_model->limit($limit_per_page);
        $this->auth_model->offset($offset);
        $this->data['users'] = $this->auth_model->users()->result();
        $config['base_url'] = base_url() .'index.php?/usuarios';
        $config['total_rows'] = $total_record;
        $config['per_page'] =  $limit_per_page;
        $config['cur_tag_open'] = '<span class="page-numbers current" aria-current="page">';
        $config['cur_tag_close'] = '</span>';
        $config['next_link'] = 'Siguiente <i class="fa fa-angle-right"></i>';
        $config['prev_link'] = '<i class="fa fa-angle-left"></i> Anterior';
        $this->pagination->initialize($config);

        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        
        $this->data['csrf'] = $this->_get_csrf_nonce();
        foreach($this->data['users'] as $k => $user)
        {
            $this->data['users'][$k]->grupo = $this->auth_model->get_user_group($user->id)->row();
        }
        $this->_render('auth/users', $this->data);
    }

    public function ajax_users()
    {
        $output = '';
        $query = '';
        if($this->input->post('query'))
        {
            $query = $this->input->post('query');
            $this->auth_model->like('nombre',$query);
            $this->auth_model->like('paterno', $query);
            $this->auth_model->like('materno', $query);
            $this->auth_model->like('email', $query);
            $this->auth_model->like('usuario', $query);
            //$this->auth_model->order_by('id');
        }

        $users = $this->auth_model->users()->result();
        // return $this->output
        //             ->set_content_type('application/json')
        //             ->set_output(json_encode($users));
        foreach($users as $k => $user)
        {
            $users[$k]->grupo = $this->auth_model->get_user_group($user->id)->row();
        }
        if($this->auth_model->num_rows() > 0)
        {
            $output .= '
            <table class="points-listing">
                <thead>
                    <tr class="first">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>     
                    </tr>
                </thead>
                <tbody> ';
                foreach($users as $user)
                {
                    $output .= '
                       <tr> 
                       <td>'. htmlspecialchars($user->id, ENT_QUOTES, 'UTF-8') .'</td>
                       <td>'. htmlspecialchars($user->nombre .' '. $user->paterno .' '. $user->materno, ENT_QUOTES, 'UTF-8') .'</td>
                       <td>'. htmlspecialchars($user->usuario, ENT_QUOTES, 'UTF-8').'</td>
                       <td>'. htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8') .'</td>
                       <td>'. $user->grupo->descripcion .' </td>
                       <td><div class="pro-share" style="margin:0;">'.
                       anchor("usuarios/editar_usuario/". $user->id, '<i class="fa fa-edit"></i>').
                       '<button type="button" class="btn" data-toggle="modal" data-target="#deleteModal" onClick="fillModal(\''.$user->id.'\',\''.$user->nombre.' '.$user->paterno.' '.$user->materno.'\')"><i class="fa fa-trash"></i></button>
                            </div>
                        </td>
                        </tr>
                    ';
                }        
            $output .= '
            </tbody>
            </table>
            ';
        }else{
            $output .= '
            <div class="alert alert-warning" role="alert">
                No se encontraron usuarios.
            </div>
            ';
        }

        $this->output->set_output($output);
        //echo "Soy AJAX";
    }

    public function delete_user()
    {
        if($this->_valid_csrf_nonce() === FALSE)
        {
            show_error('Este formulario no pasó nuestras pruebas de seguridad.');
        }

        $user_id = $this->input->post('user_id');

        if($this->auth_model->delete_user($user_id))
        {
            $this->session->set_flashdata('message', $this->auth_model->messages());
			$this->redirectUser();
        }
        else
        {
            $this->session->set_flashdata('message', $this->auth_model->errors());
			$this->redirectUser();
        }
    }

    public function edit_user($id)
    {
        $user = $this->auth_model->user($id)->row();
        $group = $this->auth_model->get_user_group($user->id)->row();

        $this->form_validation->set_rules('nombre','Nombre','trim|required');
        $this->form_validation->set_rules('paterno','Apellido Paterno','trim|required');
        $this->form_validation->set_rules('materno','Apellido Materno','trim|required');
        $this->form_validation->set_rules('email','Correo Electronico','trim|required|valid_email');
        $this->form_validation->set_rules('rol','Seleccione el Rol','required');

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
                $data = array(
                    'nombre' => $this->input->post('nombre'),
                    'paterno' => $this->input->post('paterno'),
                    'materno' => $this->input->post('materno'),
                    'email' => $this->input->post('email')
                );

                if($this->input->post('password'))
                {
                    $data['password'] = $this->input->post('password');
                }

                $updateGroup = $this->input->post('rol');

                if($group->id != $updateGroup)
                {
                    //Se cambio de grupo
                    $this->auth_model->remove_from_group('', $id);

                    $this->auth_model->add_to_group($updateGroup, $id);
                }

                if($this->auth_model->update($user->id, $data))
                {
                    $this->session->set_flashdata('message', $this->auth_model->messages());
					$this->redirectUser();
                }
                else
                {
                    // redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->auth_model->errors());
					$this->redirectUser();
                }

            }
        } //Terminan las acciones si es POST


        //Preparacion de datos del formulario

        $this->data['csrf'] = $this->_get_csrf_nonce();

        $this->data['user'] = $user;

        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->auth_model->errors() ? $this->auth_model->errors() : $this->session->flashdata('message')));

        $this->data['nombre'] = array(
            'name' => 'nombre',
            'id' => 'nombre',
            'type' => 'text',
            'value' => $this->form_validation->set_value('nombre' , $user->nombre),
            'class' => 'form-control'
            
            );

        $this->data['paterno'] = array(
            'name' => 'paterno',
            'id' => 'paterno',
            'type' => 'text',
            'value' => $this->form_validation->set_value('paterno', $user->paterno),
            'class' => 'form-control'
        );

        $this->data['materno'] = array(
            'name' => 'materno',
            'id' => 'materno',
            'type' => 'text',
            'value' => $this->form_validation->set_value('materno', $user->materno),
            'class' => 'form-control'
        );

        $this->data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'email',
            'value' => $this->form_validation->set_value('email' , $user->email),
            'class' => 'form-control'
        );

        $this->data['rol_data'] = $this->auth_model->groups()->has_dropdown('descripcion');

        $this->data['rol'] = $this->form_validation->set_value('rol', $group->id);

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

        $this->_render('auth/edit_user', $this->data);
    }

    public function redirectUser(){
        redirect("usuarios", 'refresh');
    }

}