<?php
if (!defined( 'BASEPATH')) exit('No direct script access allowed');
class Custom_hooks 
{
    protected $CI;
    public function __construct()
    {
        
        $this->CI =& get_instance();
        //!$this->CI->load->library('database') ? $this->ci->load->library('database') : FALSE;
        //!$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
        !$this->CI->load->helper('url') ? $this->ci->load->helper('url') : FALSE;
    }
    
    public function check_for_admin()
    {
        //echo 'Estoy en check for admin';   
        //echo $this->CI->db->count_all('usuarios');
        if($this->CI->db->count_all('usuarios') === 0 )
        
        {
            $adminData = array(
                'nombre' => 'Admin',
                'paterno' => 'Admin',
                'materno' => 'Admin',
                'email' => 'admin@admin.co',
                'clave' => password_hash("online", PASSWORD_DEFAULT),
                'usuario' => 'root',
                'grupo' => '9',
                'fecha_creacion' => time()
            );
            $this->CI->db->insert('usuarios', $adminData);
            //redirect(base_url(''));
        }
    }
    
    /*public function check_login()
    {
        if($this->ci->session->userdata('id') == FALSE)
        {
            redirect(base_url('login);
        }
    }*/
}