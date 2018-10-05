<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends My_Model
{

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

		$this->db->from($this->tables['users']);
		$this->db->join($this->tables['members'], $this->tables['members'] . '.id = ' . $this->tables['users' . '.id']);

		$this->response = $this->db->get();

		return $this;
	}

	public function add_member($password, $user_info = array(), $members_info = array(), $reading_member = array())
	{
		$password = $this->hash_password($password);
		$data = array(
			'clave' => $password,
			'fecha_creacion' => time()
		);
		$user_data = array_merge($this->_filter_data($this->tables['users'], $user_info), $data);
		$this->db->insert($this->tables['users'], $user_data);
		$id = $this->db->insert_id('usuarios' . '_id_seq');

		$this->add_to_group($this->member_group_id, $id);

		$members_info[$this->join['users']] = $id;

		$this->db->insert($this->tables['members'], $this->_filter_data($this->tables['members'],$members_info));

		$reading_member[$this->join[users]] = $id;

		$this->db->insert($this->tables['reading'], $this->_filter_data($this->tables['reading'],$reading_member));

		$this->set_message('Socio' . $user_info['nombre'] . ' agregado con exito');


		return (isset($id)) ? $id : FALSE;

	}
	

	public function member($id)
	{

	}

	public function update_member($id, array $data)
	{

	}

	public function delete_member($id)
	{

	}

}