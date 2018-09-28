<?php



class My_Model extends CI_Model
{

    protected $messages;

    protected $errors;

    protected $db;

    protected $response = NULL;


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



    public function __construct()
    {
        parent::__construct();
        $CI =& get_instance();
        $this->db = $CI->db;

        $this->messages = array();

        $this->errors = array();
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

    public function result()
    {
        $result = $this->response->result();

        return $result;
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
        $_output = '';
        foreach($this->messages as $message)
        {
            $_output .= '<li>' . $message . '</li>';
        }
        return $_output;
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
        $_output = '';
        foreach($this->errors as $error)
        {
            $_output .= '<li>' . $error . '</li>';
        }
        return $_output;
    }

    public function clear_errors(){
        $this->errors = array();
        return TRUE;
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