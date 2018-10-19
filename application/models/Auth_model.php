<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Auth_model extends MY_Model
{

    public function verify_password_db($id, $password){
        if(empty($id) || empty($password))
        {
            return FALSE;
        }

        $query = $this->db->select('clave')
                          ->where('id',$id)
                          ->limit(1)
                          ->order_by('id','desc')
                          ->get('usuarios');

        $hash_password_db = $query->row();

        if($query->num_rows() !== 1)
        {
            //No encontro nungun resultado
            return FALSE;
        }

        if(password_verify($password, $hash_password_db->clave))
        {
            return TRUE;
        }else
        {
            return FALSE;
        }
    }

    /* 
    Function para cambiar password
     */
    public function change_password($username, $old, $new)
    {
        $query = $this->db->select('id','password')
                          ->where('usuario',$username)
                          ->limit(1)
                          ->order_by('id','desc')
                          ->get('usuarios');

        if($query->num_rows() !== 1)
        {
            $this->set_error('No se pudo cambiar la contrasena');
            return FALSE;
        }

        $user = $query->row();

        $old_password_matches = $this->verify_password_db($user->id, $old);

        if($old_password_matches === TRUE)
        {
            $hashed_new_password = $this->hash_password($new);

            $data = array(
                'clave' => $hashed_new_password
            );
            $successfully_changed_password_in_db = $this->db->update('usuarios', $data, array('usuario' => $username));
            if($successfully_changed_password_in_db)
            {
                $this->set_message('Se cambio la contrasena correctamente');
            }else{
                $this->set_error('No se pudo cambiar la contrasena');
            }

            return $successfully_changed_password_in_db;

            $this->set_error('No se pudo cambiar la contrasena');
        }
        return FALSE;
    }

    /* Function para checar que no haya nombre de usuarios duplicados */
    public function username_check($username = '')
    {
        if(empty($username))
        {
            return FALSE;
        }

        return $this->db->where('usuario',$username)
                        ->limit(1)
                        ->count_all_results('usuarios') > 0;
    }

    public function email_check($email = '')
    {
        if(empty($email))
        {
            return FALSE;
        }

        return $this->db->where('email',$email)
                        ->limit(1)
                        ->count_all_results('usuarios') > 0;
    }

    public function group_check($group_name, $user_id = FALSE)
    {
        
        $user_id || $user_id = $this->session->userdata('user_id');
        $group_id = $this->db->get_where('grupos', array('nombre' => $group_name), 1)->row()->id;
        return $this->db->where($this->join['users'],$user_id)
                        ->where($this->join['groups'],$group_id)
                        ->limit(1)
                        ->count_all_results($this->tables['users_groups']) > 0;
    }
    /* Function para registrar nuevos usuarios */
    public function register($password, $username, $email, $additional_data = array(), $group = NULL )
    {
        $this->load->helper('date');
        if(empty($group))
        {
            return FALSE;
        }

        $password = $this->hash_password($password);

        $data = array(
            'email' => $email,
            'clave' => $password,
            'usuario' => $username,
            'fecha_creacion' => mdate('%Y-%m-%d %H:%i:%s', now())
        );

        $user_data = array_merge($this->_filter_data($this->tables['users'], $additional_data), $data);

        $this->db->insert('usuarios', $user_data);

        $id = $this->db->insert_id('usuarios' . '_id_seq');

        $this->add_to_group($group, $id);

        $this->set_message('Usuario ' . $username . ' agregado con exito');

        return (isset($id)) ? $id : FALSE;
        
    }

    public function delete_user($id)
    {
        $this->db->trans_begin();

        $this->remove_from_group(NULL, $id);

        $this->db->delete($this->tables['users'],array('id' => $id));

        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->set_error('No se ha podido eliminar el usuario');
            return FALSE;
        }

        $this->db->trans_commit();

        $this->set_message('Usuario eliminado');

        return TRUE;
    }

    

    public function get_user_group($id = FALSE)
    {
        $id || $id = $this->session-userdata('user_id');
        return $this->db->select($this->tables['groups'].'.id, ' . $this->tables['groups'].'.nombre, '.$this->tables['groups'].'.descripcion')
            ->where($this->tables['users_groups'].'.'.$this->join['users'],$id)
            ->join($this->tables['groups'], $this->tables['users_groups'].'.'.$this->join['groups'].'='.$this->tables['groups'].'.id')
            ->get($this->tables['users_groups']);
    }

    public function groups($skip_members = TRUE)
    {
        if(isset($this->_where) && !empty($this->_where))
        {
            foreach($this->_where as $where)
            {
                $this->db->where($where);
            }
            $this->_where = array();
        }
        if($skip_members){
            $this->db->not_like('nombre','member');
        }

        $this->response = $this->db->get($this->tables['groups']);

        return $this;
    }

    public function login($username, $password)
    {
        if(empty($username) || empty($password))
        {
            $this->set_error('Inicio de sesion fallado');
            return FALSE;
        }

        $query = $this->db->select('usuario, email, id, clave')
                          ->where('usuario',$username)
                          ->limit(1)
                          ->order_by('id','desc')
                          ->get($this->tables['users']);

        if($query->num_rows() === 1)
        {
            $user = $query->row();

            $password = $this->verify_password_db($user->id, $password);

            if($password === TRUE)
            {
                $this->set_session($user);
                $this->_regenerate_sessions();
                $this->set_message('Inicio de sesion exitoso');
                return TRUE;
            }
        }

        $this->set_error('Inicio de sesion fallido');

        return FALSE;
        
    }

    protected function _regenerate_sessions()
    {
        $this->session->sess_regenerate(FALSE);
    }


    public function is_admin($id = FALSE)
    {
        $admin_group = 'admin';

        return $this->group_check($admin_group, $id);
    }

    public function register_assists($member_id)
	{
		$this->load->helper('date');
		$this->db->trans_begin();
		$data = array(
			'fecha' => mdate('%Y-%m-%d', now()),
			$this->join['users'] => $member_id
		);

		$data = $this->_filter_data($this->tables['assists'], $data);

		$this->db->insert($this->tables['assists'], $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->set_error('No se ha podido completar la rutina');
            return FALSE;
		}
		$this->db->trans_commit();
		$this->set_message('Asistencia registrada con exito.');
        return TRUE;
        
	}

    public function set_session($user)
    {
        $group = $this->get_user_group($user->id)->row();
        $session_data = array(
            'usuario' => $user->usuario,
            'email' => $user->email,
            'user_id' => $user->id,
            'group_name' => $group->nombre,
            'last_check' => time(),
        );

        if($group->nombre === 'member'){
            $this->register_assists($user->id);
        }

        $this->session->set_userdata($session_data);

        return TRUE;
    }

    public function logged_in()
    {
        return (bool) $this->session->userdata('usuario');
    }

    public function logout()
    {
        $this->session->unset_userdata(array('usuario','id','user_id'));
        $this->session->sess_destroy();
        if (version_compare(PHP_VERSION, '7.0.0') >= 0)
        {
            session_start();
        }
        $this->session->sess_regenerate(TRUE);
        $this->set_message('Sesión finalizada con éxito');
        return TRUE;
    }

    public function users($group = NULL)
    {

        if(isset($this->_select) && !empty($this->_select))
		{
			foreach($this->_select as $select)
			{
				$this->db->select($select);
			}

			$this->_select = array();
		}

		if(isset($this->_where) && !empty($this->_where))
		{
			foreach($this->_where as $where)
			{
				$this->db->where($where);
			}

			$this->_where = array();
		}

		if(isset($this->_like) && !empty($this->_like))
		{
			foreach ($this->_like as $like) {
				$this->db->or_like($like['like'], $like['value'], $like['position']);
			}

			$this->_like = array();
		}

		if(isset($this->_limit) && isset($this->_offset))
		{
			$this->db->limit($this->_limit, $this->_offset);
			$this->_limit = NULL;
			$this->_offset = NULL;
		}
		else if(isset($this->_limit))
		{
			$this->db->limit($this->_limit);
			$this->_limit = NULL;
		}

		if(isset($this->_order_by) && isset($this->_order))
		{
			$this->db->order_by($this->_order_by, $this->_order);

			$this->_order_by = NULL;
			$this->_order = NULL;
        }
        
        $this->response = $this->db->get($this->tables['users']);

        return $this;
        
    }

    public function user($id = NULL)
    {
        $id = isset($id) ? $id : $this->session->userdata('user_id');
        $this->limit(1);
        $this->order_by($this->tables['users'].'.id', 'desc');
        $this->where($this->tables['users'].'.id', $id);

        $this->users();

        return $this;
    }

    public function update($id, array $data)
    {
        $user = $this->user($id)->row();

        $this->db->trans_begin();

        if(array_key_exists('email',$data) && $this->email_check($data['email']) && $user->email !== $data['email'])
        {
            //Email Duplicado inicia el rollback
            $this->db->trans_rollback();
            $this->set_error('Email en uso o inválido');
            $this->set_error('No se ha podido actualizar la información de la cuenta');

            return FALSE;

        }

        $data = $this->_filter_data($this->tables['users'], $data);

        if(array_key_exists('password', $data))
        {
            if(! empty($data['password']))
            {
                $data['password'] = $this->hash_password($data['password']);
            }
            else
            {
                unset($data['password']);
            }
        }

        $this->db->update($this->tables['users'], $data, array('id' => $user->id));

        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();

            $this->set_error('No se ha podido actualizar la información de la cuenta');

            return FALSE;
        }

        $this->db->trans_commit();

        $this->set_message('Información de la cuenta actualizada con éxito');

        return TRUE;
        
        
    }

    public function get_total()
    {
        return $this->db->count_all($this->tables['users']);
    }

    // // $filters = array(
    // //     'select' => 'title, content, date',
    //         'where' => array(
    //             'name' => 'Jose David',
    //             ),
    //         'like' => array(
    //             'name' => $s),
    //         'limit' => 20, 
    //         'offset' => 23,
    //         'order_by' => 'name'
    //         'direction' => 'DESC'
    // // )

    // protected function set_filters($filters){

    //     if(array_key_exists('select',$filters))
    //     {
    //         $this->db->select($filters['select']);
    //     }

    //     if(array_key_exists('where', $filters)){
    //         foreach($filters['where'] as $key => $value){
    //             $this->db->where($key, $value);
    //         }
    //     }

    //     if(array_key_exists('like', $filters)){
    //         foreach($filters['like'] as $key => $value){
    //             $this->db->or_like($key, $value);
    //         }
    //     }

    //     if(array_key_exists('limit', $filters) && array_key_exists('offset')){
    //         $this->db->limit($filters['limit'], $filters['offset']);
    //     }

    //     if(array_key_exists('limit', $filters)){
    //         $this->db->limit($filters['limit']);
    //     }

    //     if(array_key_exists('order_by', $filters) && array_key_exists('direction')){
    //         $this->db->order_by($filters['order_by'],$filters['direction']);
    //     }
    // }


    




    

}