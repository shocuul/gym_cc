<?php



class My_Model extends CI_Model
{

    protected $messages;

    protected $errors;

    protected $db;

    protected $response = NULL;

    public $tables = array();

    public $join = array();


    // Table Where
    public $_where = array();
    
    //Table select
    public $_select = array();

    //Table like
    public $_like = array();

    //Table Limit
    public $_limit = NULL;

    //Table Limit
    public $_offset = NULL;

    //Table Order By
    public $_order_by = NULL;
    
    //Tanble Order aka DESC ASC RANDOM
    public $_order = NULL;


    public $member_group_id = NULL;


    public $admin_group_id = NULL;

    public $range = NULL;

    public function __construct()
    {
        parent::__construct();
        $CI =& get_instance();
        $this->db = $CI->db;

        $this->messages = array();

        $this->errors = array();

        $this->tables = array(
            'members' => 'socios',
            'users' => 'usuarios',
            'users_groups' => 'usuarios_grupos',
            'users_plans' => 'usuarios_planes',
            'groups' => 'grupos',
            'reading' => 'mediciones',
            'plans' => 'planes',
            'routines' => 'rutinas',
            'users_routines' => 'rutinas_usuario',
            'users_metrics' => 'medida',
            'assists' => 'asistencias',
            'images' => 'imagenes',
            'page_images' => 'imagenes_pagina'
        );

        $this->join = array(
            'users' => 'usuario_id',
            'groups' => 'grupo_id',
            'plans' => 'plan_id',
            'rutines' => 'rutinas_id',
            'users_plans' => 'usuarios_planes_id',
            'metrics' => 'mediciones_id'
        );


        //para tener en storage el ide del grupo de los miembros.
        $this->member_group_id = $this->db->get_where('grupos',array('nombre' => 'member'), 1)->row()->id;

        $this->admin_group_id = $this->db->get_where('grupos', array('nombre' => 'admin'), 1)->row()->id;

    }

    protected function _filter_data($table, $data)
    {
        $filtered_data = array();
        $columns = $this->db->list_fields($table);
        //var_dump($columns);

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

    function random_password( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }

    public function generate_username($nombre, $paterno, $materno){ 

        $name = strtolower(substr($nombre, 0, 2));
        $paterno = strtolower(substr($paterno, 0, 2));
        $materno = strtolower(substr($materno, 0, 2));
        $nrRand = rand(100, 1000);
        return $name . $paterno . $materno . $nrRand;

    }

    public function hash_password($password)
    {
        return password_hash($password,PASSWORD_DEFAULT);
    }

    public function limit($limit)
    {
        $this->_limit = $limit;

        return $this;
    }

    public function offset($offset)
    {
        $this->_offset = $offset;
        return $this;
    }


    public function where($where, $value = NULL)
    {
        if (!is_array($where))
        {
            $where = array($where => $value);
        }

        array_push($this->_where, $where);

        return $this;
    }


    public function like($like, $value = NULL, $position = 'both')
    {
        array_push($this->_like, array(
            'like'    => $like,
            'value'   => $value,
            'position'=> $position
        ));

        return $this;
    }

    public function select($select)
    {
        $this->_select[] = $select;
        return $this;
    }

    public function order_by($by, $order='desc')
    {
        $this->_order_by = $by;
        $this->_order    = $order;

        return $this;
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

    public function has_dropdown($dropdown_text)
    {
        // $groups = $this->auth_model->groups()->result();
        $groups_array = array();
        foreach ($this->result_array() as $group) {
            $groups_array[$group['id']] = $group[$dropdown_text];
        }
        return $groups_array;
    }
    public function num_rows()
    {
        $result = $this->response->num_rows();

        return $result;
    }

    public function set_message($message)
    {
        $this->messages[] = $message;
        return $message;
    }

    public function messages()
    {
        if(!empty($this->messages))
        {
            $_output = '<div class="alert alert-success" role="alert"><ul>';
            foreach($this->messages as $message)
            {
                $_output .= '<li>' . $message . '</li>';
            }
            $_output .= '</ul></div>';
            return $_output;
        }
        else
        {
            return '';
        }        
        

    }

    public function clear_messages()
    {
        $this->messages = array();
        return TRUE;
    }

    public function set_error($error)
    {
        $this->errors[] = $error;
        return $error;
    }

    public function errors()
    {
        if(!empty($this->errors))
        {
            $_output = '<div class="alert alert-danger" role="alert"><ul>';
            foreach($this->errors as $error)
            {
                $_output .= '<li>' . $error . '</li>';
            }
            $_output .= '</ul></div>';
            return $_output;
        }else
        {
            return '';
        }
    }

    public function clear_errors(){
        $this->errors = array();
        return TRUE;
    }

    public function subscribe_to_plan($plan_id, $member_id)
    {
        $this->load->helper('date');
        
        return $this->db->insert($this->tables['users_plans'],
                                array(
                                    $this->join['users'] => (float) $member_id,
                                    $this->join['plans'] => (float) $plan_id,
                                    'fecha_inicio' => mdate('%Y-%m-%d %H:%i:%s', now())
                                ));

    }

    public function add_to_group($group_id, $user_id = FALSE)
    {
        $user_id || $user_id = $this->session->userdata('user_id');

        return $this->db->insert($this->tables['users_groups'],
                                 array(
                                    $this->join['users'] => (float) $user_id,
                                    $this->join['groups'] => (float) $group_id
                                ));
    }

    public function remove_from_group($group_id = FALSE, $user_id = FALSE)
    {
        if(empty($user_id))
        {
            return FALSE;
        }

        if(!empty($group_id))
        {
            $this->db->delete($this->tables['users_groups'],
                                array($this->join['groups'] => (float) $user_id,
                                      $this->join['users'] => (float) $group_id
                              ));
            $return = TRUE;
        }else
        {
            $return = $this->db->delete($this->tables['users_groups'], array(
                                        $this->join['users'] => (float) $user_id
            ));
        }

        return $return;
    }



}
// class MY_Modelo extends CI_Model
// {
//     protected $nombre_tabla;
    
//     protected $llave_primaria = 'id';
    
//     protected $tipo_retorno = 'array';
    
//     protected $tipo_retorno_temporal = NULL;
    
    
//     public function __construct()
//     {
//         parent::__construct();
        
//         $this->$tipo_retorno_temporal = $this->$tipo_retorno;
        
//     }
    
//     public function buscar($id)
//     {
//         $query = $this->where($this->llave_primaria, $id)
//             ->get($this->nombre_tabla);
        
//         $row = $this->tipo_retorno_temporal == 'array' ? 
//             $query->row_array() : 
//             $query->row(0, $this->tipo_retorno_temporal);
        
//         $this->tipo_retorno_temporal = $this->tipo_retorno;
        
//         return $row;
//     }
    
//     public function buscar_todos()
//     {
//         $query = $this->get($this->nombre_tabla);
        
//         $rows = $this->tipo_retorno_temporal == 'array' ?
//             $query->result_array() :
//             $query->result($this->tipo_retorno_temporal);
        
//         $this->tipo_retorno_temporal = $this->tipo_retorno;
        
//         return $rows;
//     }
    
//     public function insertar(array $datos)
//     {
//         $result = $this->db->insert($this->nombre_tabla, $datos);
//         return $result ? $this->db->insert_id() : FALSE;
//     }
    
//     public function actualizar($id, array $datos)
//     {
//         return $this->db->where($this->llave_primaria, $id)
//             ->update($this->nombre_tabla, $datos);
//     }
    
    
//     public function borrar($id)
//     {
//         return $this->db->where($this->llave_primaria, $id)
//             ->delete($this->nombre_tabla);
//     }
    
//     public function regresar_como($tipo)
//     {
//         $this->tipo_retorno = $tipo;
        
//         return $this;
//     }

//     // permite la llamada de acceso ala db sin los methodos
//     public function __call($name, array $arguments = NULL){
//         if(method_exists($this->db, $name))
//         {
//             $result = call_user_func_array(array($this->db,$name),$arguments);

//             if($result instanceof CI_DB_mysql_driver)
//             {
//                 return $result;
//             }

//             return $this;
//         }
//     }
    
    
// }