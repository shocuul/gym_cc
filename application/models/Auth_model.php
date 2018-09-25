<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Auth_model extends CI_Model
{

    protected $messages;


    protected $errors;


    protected $db;


    protected $response = NULL;




    public function __construct()
    {
        //Helpers pendientes

        $CI =& get_instance();
        $this->db = $CI->db;

        $this->messages = array();

        $this->errors = array();

        // Poner los delimitadores de errores xd



    }

    public function hash_password($password)
    {
        return password_hash($password,PASSWORD_DEFAULT);
    }

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

        if($query->num_row() !== 1)
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

    /* Function para registrar nuevos usuarios */
    public function register($password, $username, $email, $additional_data = array(), $group = NULL )
    {
        if(empty($group))
        {
            return FALSE;
        }
        $password = $this->hash_password($password);

        $data = array(
            'email' => $email,
            'clave' => $password,
            'usuario' => $username,
            'grupo' => $group,
            'fecha_creacion' => time()
        );

        $user_data = array_merge($this->_filter_data('usuarios', $additional_data), $data);

        $this->db->insert('usuarios', $user_data);

        $id = $this->db->insert_id('usuarios' . '_id_seq');

        return (isset($id)) ? $id : FALSE;
        
    }

    public function login($username, $password)
    {
        if(empty($username) || empty($password))
        {
            $this->set_error('Inicio de sesion fallado');
            return FALSE;
        }

        $query = $this->db->select('username, email, id, password')
                          ->where('username',$username)
                          ->limit(1)
                          ->order_by('id','desc')
                          ->get('usuarios');

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

    public function set_session($user)
    {
        $session_data = array(
            'usuario' => $user->usuario,
            'email' => $user-email,
            'user_id' => $user->id,
            'last_check' => time(),
        );

        $this->session->set_userdata($session_data);

        return TRUE;
    }

    public function users($filters = NULL, $group =NULL)
    {

        if(isset($filters)){
            $this->set_filters($filters);
        }

        $this->response = $this->db->get('usuarios');

        return this;
        
    }

    public function user($id = NULL)
    {
        $id = isset($id) ? $id : $this->session->userdata('user_id');
        $filters = array(
            'limit' => 1,
            'order_by' => 'usuarios.id',
            'direction' => 'desc',
            'where' => array(
                'id' => $id
            )
        );
        $this->users($filters);
        return $this;
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

    protected function set_filters($filters){

        if(array_key_exists('select',$filters))
        {
            $this->db->select($filters['select']);
        }

        if(array_key_exists('where', $filters)){
            foreach($filters['where'] as $key => $value){
                $this->db->where($key, $value);
            }
        }

        if(array_key_exists('like', $filters)){
            foreach($filters['like'] as %key => $value){
                $this->db->or_like($key, $value);
            }
        }

        if(array_key_exists('limit', $filters) && array_key_exists('offset')){
            $this->db->limit($filters['limit'], $filters['offset']);
        }

        if(array_key_exists('limit', $filters)){
            $this->db->limit($filters['limit']);
        }

        if(array_key_exists('order_by', $filters) && array_key_exists('direction')){
            $this->db->order_by($filters['order_by'],$filters['direction']);
        }
    }

    public function row()
    {
        $row = $this->response->row();
        return $row;
    }

    public function row_array()
    {
        $row = $this->response->row_array();

        return $row;
    }

    public function result()
    {
        $result = $this->response->result();

        return $result;
    }

    public function result_array()
    {
        $result = $this->response->result_array();

        return $result;
    }

    public function num_rows()
    {
        $result = $this->response->num_rows();

        return $result;
    }



    protected function _filter_data($table, $data)
    {
        $filtered_data = array();
        $columns = $this->db->list_fields($table);

        if(is_array($data))
        {
            foreach($columns as $column)
            {
                if(array_key_exists($column, $data))
                    $filtered_data[$column] = $data[$column];
            }
        }

        return $filtered_data;

    }

    protected function _regenerate_session()
    {
        $this->session->sess_regenerate(FALSE);
    }

}