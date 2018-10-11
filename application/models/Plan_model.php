<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Plan_model extends My_Model
{

    public function create($data = array())
    {
        $this->db->insert($this->tables['plans'],$this->_filter_data($this->tables['plans'],$data));
        
        $this->set_message('Plan ' . $data['nombre'] . ' agregado con exito');

        $id = $this->db->insert_id('planes' . '_id_seq');

        return (isset($id)) ? $id : FALSE;
    }

    public function update($id, array $data)
    {
        $this->db->trans_begin();
        $data = $this->_filter_data($this->tables['plans'], $data);

        $this->db->update($this->tables['plans'], $data, array('id' => $id));

        if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();

            $this->set_error('No se ha podido actualizar la información del plan');

            return FALSE;
		}

		$this->db->trans_commit();

        $this->set_message('Información del plan actualizada con éxito');

        return TRUE;
    }

    public function delete($id)
    {
    	$this->db->trans_begin();
    	//puede haber configuraciones que se deben borrar
        //$this->remove_from_group(NULL, $id);

        $this->db->delete($this->tables['plans'],array('id' => $id));

        if($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->set_error('No se ha podido eliminar el plan');
            return FALSE;
        }

        $this->db->trans_commit();

        $this->set_message('Plan eliminado');

        return TRUE;
	}
	
	public function plan($id)
	{
		$this->limit(1);
		$this->order_by($this->tables['plans'].'.id','desc');
		$this->where($this->tables['plans'].'.id', $id);
		$this->plans();

		return $this;
	}

	protected function get_plan_order($plan_id)
	{
		$query = $this->db->select_max('orden')
				 	->where('plan_id',$plan_id)
					->get($this->tables['routines']);
		$order = $query->row();
		if($order->orden !== NULL){
			return ((int) $order->orden) + 1;
		}else
		{
			return 1;
		}
	}

	public function routines($plan_id)
    {
		
		$this->response = $this->db->get_where($this->tables['routines'], array($this->join['plans'] => $plan_id));

        return $this;
    }

	public function add_routine($plan_id, $routine_data)
	{
		$this->load->helper('date');
		$this->db->trans_begin();
		$routine_data[$this->join['plans']] = $plan_id;
		//$routine_data['orden'] = $this->get_plan_order($plan_id);
		$routine_data['fecha_creacion'] = mdate('%Y-%m-%d %H:%i:%s', now());
		$this->db->insert($this->tables['routines'], $this->_filter_data($this->tables['routines'], $routine_data));
		if($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->set_error('Error al insertar datos de la rutina');
			return FALSE;
		}

		$this->db->trans_commit();

		$this->set_message('Rutina agregada con exito.');

        return TRUE;
	}


    public function plans()
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
        
        $this->response = $this->db->get($this->tables['plans']);

        return $this;
    }
}