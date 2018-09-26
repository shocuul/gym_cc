<?php

class MY_Modelo extends CI_Model
{
    protected $nombre_tabla;
    
    protected $llave_primaria = 'id';
    
    protected $tipo_retorno = 'array';
    
    protected $tipo_retorno_temporal = NULL;
    
    
    public function __construct()
    {
        parent::__construct();
        
        $this->$tipo_retorno_temporal = $this->$tipo_retorno;
        
    }
    
    public function buscar($id)
    {
        $query = $this->where($this->llave_primaria, $id)
            ->get($this->nombre_tabla);
        
        $row = $this->tipo_retorno_temporal == 'array' ? 
            $query->row_array() : 
            $query->row(0, $this->tipo_retorno_temporal);
        
        $this->tipo_retorno_temporal = $this->tipo_retorno;
        
        return $row;
    }
    
    public function buscar_todos()
    {
        $query = $this->get($this->nombre_tabla);
        
        $rows = $this->tipo_retorno_temporal == 'array' ?
            $query->result_array() :
            $query->result($this->tipo_retorno_temporal);
        
        $this->tipo_retorno_temporal = $this->tipo_retorno;
        
        return $rows;
    }
    
    public function insertar(array $datos)
    {
        $result = $this->db->insert($this->nombre_tabla, $datos);
        return $result ? $this->db->insert_id() : FALSE;
    }
    
    public function actualizar($id, array $datos)
    {
        return $this->db->where($this->llave_primaria, $id)
            ->update($this->nombre_tabla, $datos);
    }
    
    
    public function borrar($id)
    {
        return $this->db->where($this->llave_primaria, $id)
            ->delete($this->nombre_tabla);
    }
    
    public function regresar_como($tipo)
    {
        $this->tipo_retorno = $tipo;
        
        return $this;
    }

    // permite la llamada de acceso ala db sin los methodos
    public function __call($name, array $arguments = NULL){
        if(method_exists($this->db, $name))
        {
            $result = call_user_func_array(array($this->db,$name),$arguments);

            if($result instanceof CI_DB_mysql_driver)
            {
                return $result;
            }

            return $this;
        }
    }
    
    
}