<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends My_Model
{


	public function get_member_plans($id)
	{
		return $this->db->select($this->tables['users_plans'].'.id, '.$this->tables['plans'].'.id as plan_id, '.$this->tables['plans'].'.nombre')
				->where($this->tables['users_plans'].'.'.$this->join['users'],$id)
				->join($this->tables['plans'], $this->tables['users_plans'].'.'.$this->join['plans'].'='.$this->tables['plans'].'.id')
				->get($this->tables['users_plans']);
	}

	public function get_last_login($member_id){
		return $this->db->order_by('fecha','desc')
				 ->where($this->join['users'],$member_id)
				 ->get($this->tables['assists'],1);
		
	}
	

	public function add_routine($current, $rutina_id, $instruccion){
		$this->load->helper('date');
		$this->db->trans_begin();
		$data = array(
			'realizado' => 0,
			'fecha_realizacion' => NULL,
			'fecha_creacion' => mdate('%Y-%m-%d %H:%i:%s', now()),
			'instruccion' => $instruccion,
			$this->join['rutines'] => $rutina_id,
			$this->join['users_plans'] => $current
		);
		$this->db->insert($this->tables['users_routines'], $this->_filter_data($this->tables['users_routines'],$data));

		//echo $this->db->last_query();
		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->set_error('Error al registrar la rutina');
			return FALSE;
		}

		$this->db->trans_commit();

		$this->set_message('Rutina registrada con exito.');

        return TRUE;


	}
	public function get_plan_users_id($member_id, $plan_id){
		return $this->db->select($this->tables['users_plans'].'.id, '.$this->tables['users'].'.nombre, '.$this->tables['users'].'.paterno, '.$this->tables['users'].'.materno, '.$this->tables['plans'].'.nombre as nombre_plan')
					   ->where($this->join['users'],$member_id)
					   ->where($this->join['plans'],$plan_id)
					   ->join($this->tables['users'], $this->tables['users_plans'].'.'.$this->join['users'].'='.$this->tables['users'].'.id')
					   ->join($this->tables['plans'], $this->tables['users_plans'].'.'.$this->join['plans'].'='.$this->tables['plans'].'.id')
					   ->get($this->tables['users_plans']);
	}

	public function routines($current,$completed = FALSE)
	{
		return $this->db->select($this->tables['users_routines'].'.id, '.$this->tables['users_routines'].'.*, '.$this->tables['routines'].'.ejercicio, '.$this->tables['routines'].'.imagen')
						->where($this->join['users_plans'],$current)
						->where('realizado',($completed) ? 1 : 0)
						->join($this->tables['routines'],$this->tables['users_routines'].'.'.$this->join['rutines'].'='.$this->tables['routines'].'.id')
						->get($this->tables['users_routines']);
	}

	public function gallery($member_id){
		return $this->db->get_where($this->tables['images'], array($this->join['users'] => $member_id));
	}

	public function add_image($member_id, $data)
	{
		$this->db->trans_begin();
		$data[$this->join['users']] = $member_id;
		$data = $this->_filter_data($this->tables['images'], $data);
		$this->db->insert($this->tables['images'], $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$this->set_error('No se ha podido guardar la imagen');
            return FALSE;
		}
		$this->db->trans_commit();
		$this->set_message('Imagen guardada con exito.');
        return TRUE;
	}

	public function get_avatar($member_id)
	{	
		$this->db->order_by('id', 'DESC');
		return $this->db->get_where($this->tables['images'],array($this->join['users'] => $member_id,'avatar' => 1),1);

	}

	// public function register_assists($member_id)
	// {
	// 	$this->load->helper('date');
	// 	$this->db->trans_begin();
	// 	$data = array(
	// 		'fecha' => mdate('%Y-%m-%d', now()),
	// 		$this->join['users'] => $member_id
	// 	);

	// 	$data = $this->_filter_data($this->tables['assists'], $data);

	// 	$this->db->insert($this->tables['assists'], $data);

	// 	if($this->db->trans_status() === FALSE){
	// 		$this->db->trans_rollback();
	// 		$this->set_error('No se ha podido completar la rutina');
    //         return FALSE;
	// 	}
	// 	$this->db->trans_commit();
	// 	$this->set_message('Asistencia registrada con exito.');
    //     return TRUE;
        
	// }
	public function routine_completed($routine_id)
	{
		$this->load->helper('date');
		$this->db->trans_begin();

		$data = array(
			'fecha_realizacion' => mdate('%Y-%m-%d %H:%i:%s', now()),
			'realizado' => 1
		);

		$data = $this->_filter_data($this->tables['users_routines'], $data);

		$this->db->update($this->tables['users_routines'], $data, array('id' => $routine_id));

		if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();

            $this->set_error('No se ha podido completar la rutina');

            return FALSE;
        }

        $this->db->trans_commit();

        $this->set_message('Rutina completada con exito.');

        return TRUE;
	}

	public function members()
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
		
		// $this->db->from($this->tables['users']);
		// $this->db->join($this->tables['members'], $this->tables['members'] . '.usuario_id = ' . $this->tables['users'] . '.id');
		$this->db->from($this->tables['members']);
		$this->db->join($this->tables['users'], $this->tables['users'].'.id = ' . $this->tables['members'].'.'.$this->join['users']);


		$this->response = $this->db->get();

		return $this;
	}

	public function search($query)
	{
		$this->like($this->tables['users'].'.nombre',$query);
		$this->like($this->tables['users'].'.paterno',$query);
		$this->like($this->tables['users'].'.materno', $query);
		$this->like($this->tables['members'].'.edad', $query);
		$this->like($this->tables['members'].'.genero', $query);
		$this->like($this->tables['members'].'.peso', $query);
		$this->like($this->tables['members'].'.estatura', $query);
	}

	public function add_member($password, $user_info = array(), $members_info = array(), $reading_member = array())
	{
		$this->load->helper('date');
		$password = $this->hash_password($password);
		$data = array(
			'clave' => $password,
			'fecha_creacion' => mdate('%Y-%m-%d %H:%i:%s', now())
		);
		$user_data = array_merge($this->_filter_data($this->tables['users'], $user_info), $data);
		$this->db->insert($this->tables['users'], $user_data);
		$id = $this->db->insert_id('usuarios' . '_id_seq');

		$this->add_to_group($this->member_group_id, $id);

		$members_info[$this->join['users']] = $id;

		$this->db->insert($this->tables['members'], $this->_filter_data($this->tables['members'],$members_info));

		$reading_member[$this->join['users']] = $id;
		$reading_member['fecha_creacion'] = mdate('%Y-%m-%d %H:%i:%s', now());

		$this->db->insert($this->tables['reading'], $this->_filter_data($this->tables['reading'],$reading_member));

		$this->set_message('Socio' . $user_info['nombre'] . ' agregado con exito');


		return (isset($id)) ? $id : FALSE;

	}

	public function add_metric($user_id, $current_id, $metric_data, $imagen)
	{
		$this->load->helper('date');

		$this->db->trans_begin();
		$metric_data[$this->join['users']] = $user_id;
		$metric_data['fecha_creacion'] = mdate('%Y-%m-%d %H:%i:%s', now());
		$this->db->insert($this->tables['reading'], $this->_filter_data($this->tables['reading'],$metric_data));
		$metric_id = $this->db->insert_id($this->tables['reading'] . '_id_seq');
		$user_metric_data = array(
			'imagen' => $imagen,
			$this->join['users_plans'] => $current_id,
			$this->join['metrics'] => $metric_id
		);
		$this->db->insert($this->tables['users_metrics'],$this->_filter_data($this->tables['users_metrics'],$user_metric_data));
		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->set_error('No se ha podido actualizar la información del socio');
			return FALSE;
		}

		$this->db->trans_commit();

		$this->set_message('Mediciones agregadas con exito.');

        return TRUE;
	}
	

	public function member($id)
	{
		//$id = isset($id) ? $id : $this->session->userdata('user_id');

		$this->limit(1);
		$this->order_by($this->tables['members'].'.id','desc');
		$this->where($this->tables['users'].'.id', $id);

		$this->members();

		return $this;
	}

	public function update($id, array $data)
	{
		$this->db->trans_begin();

		$data = $this->_filter_data($this->tables['members'], $data);

		$this->db->update($this->tables['members'], $data, array('usuario_id' => $id));

		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();

            $this->set_error('No se ha podido actualizar la información del socio');

            return FALSE;
		}

		$this->db->trans_commit();

        $this->set_message('Información del socio actualizada con éxito');

        return TRUE;
	}

	public function get_user_metrics($id)
	{
		$id = isset($id) ? $id : $this->session->userdata('user_id');
		$this->db->order_by('fecha_creacion','DESC');
		return $this->db->get_where($this->tables['reading'],array($this->join['users'] => $id),'3')->result();
	}

	public function delete_subscribe($current){
		$this->db->trans_begin();
		$this->db->delete($this->tables['users_plans'], array('id' => $id));
		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
            $this->set_error('No se ha podido eliminar la subscripcion');
            return FALSE;
		}

		$this->db->trans_commit();

        $this->set_message('Subscripcion eliminada');

        return TRUE;
	}

	public function delete_member($id)
	{
		$this->db->trans_begin();

		$this->remove_from_group(NULL, $id);

		$this->db->delete($this->tables['users'], array('id' => $id));

		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
            $this->set_error('No se ha podido eliminar el socio');
            return FALSE;
		}

		$this->db->trans_commit();

        $this->set_message('Socio eliminado');

        return TRUE;

	}

}