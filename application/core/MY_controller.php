<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	public $_permissions = null;

	public $CI = NULL;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->model(array('auth_model','member_model','plan_model','stat_model'));
        $this->load->library(array('form_validation','pagination'));
        $this->CI = & get_instance();
        $query = $this->db->get_where('opciones',array('key' => 'permissions'),1)->row();
        if(!empty($query)){
        	$this->_permissions = json_decode($query->value, TRUE);
        }
        else
        {
        	$this->_permissions['admin'] = array('users' => TRUE, 'profile' => FALSE, 'members' => TRUE, 'plans' => TRUE, 'config' => TRUE, 'stats' => TRUE);
        	$this->_permissions['member'] = array('users' => FALSE, 'profile' => TRUE, 'members' => FALSE, 'plans' => FALSE, 'config' => FALSE, 'stats' => FALSE);
        	$data = array(
        		'key' => 'permissions',
        		'value' => json_encode($this->_permissions)
        	);
        	$this->db->insert('opciones', $data);
        }
        //var_dump($this->_permissions);
    }

    public function has_permissions($section, $group = NULL){

    	$group = isset($group) ? $group : $this->session->userdata('group_name');
    	if($group === NULL){
    		return FALSE;
    	}
    	return $this->_permissions[$group][$section];
    }

    public function delete_permissions($group)
    {
    	unset($this->_permissions[$group]);
    	$this->save_permissions();
    }

    public function save_permissions()
    {
    	$this->db->update('opciones', 
    				array('value'=>json_encode($this->_permissions))
    			   ,array('key' => 'permissions')
    			);
    }

    public function update_permissions($group, $sections)
    {	
    	$this->_permissions[$group] = $sections;
    	$this->save_permissions();
    	
    
   		// if(array_key_exists($group, $this->_permissions))
   		// {

   		// } 
   		//var_dump($this->_permissions);
    }
    	
    public function get_notices(){
    	return $this->db->get('comunicados')->result();
    }

    /**
	 * @return array A CSRF key-value pair
	 */
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	/**
	 * @return bool Whether the posted CSRF token matches
	 */
	public function _valid_csrf_nonce(){
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')){
			return TRUE;
		}
			return FALSE;
	}


    public function _render($view, $data = NULL )
    {

    	$data['notices'] = $this->get_notices();
        $this->load->view('template/header',$data);
        $this->load->view($view,$data);
        $this->load->view('template/footer');
    }
    
}