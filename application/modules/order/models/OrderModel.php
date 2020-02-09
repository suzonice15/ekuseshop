<?php
Class OrderModel extends CI_Model
{
	/*# add new order #*/
	public function place_order($data)
	{
		$this->db->insert('order', $data);
		return $this->db->insert_id();
	}

	/*# add new #*/
	public function add_new($data)
	{
		return $this->db->insert('order', $data);
	}

	/*# update #*/
	public function update_order($data, $row_id)
	{
		$this->db->where('order.order_id', $row_id);
		return $this->db->update('order', $data);
	}

	/*# order result by order_status #*/
	public function get_orders($order_status)
	{
		$this->db->select('*');
		$this->db->from('order');
		// $this->db->where('order_status', $order_status);
		$result = $this->db->get();
		return $result->row();
	}

	/*# single order result by order_id #*/
	public function order_view($order_id)
	{
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('order_id', $order_id);
		$result = $this->db->get();
		return $result->row();
	}

	function orderRows($params = array())
	{
		$this->db->select('*');
		$this->db->from('order_data');
		//filter data by searched keywords
		if (!empty($params['search']['keywords'])) {
			$this->db->like('customer_name', $params['search']['keywords']);
			$this->db->like('customer_phone', $params['search']['keywords']);

		}
		//sort data by ascending or desceding order
		if (!empty($params['search']['sortBy'])) {
			$this->db->order_by('order_id', $params['search']['sortBy']);
		} else {
			$this->db->order_by('order_id', 'desc');
		}
		//set start and limit
		if (array_key_exists("start", $params) && array_key_exists("limit", $params)) {
			$this->db->limit($params['limit'], $params['start']);
		} elseif (!array_key_exists("start", $params) && array_key_exists("limit", $params)) {
			$this->db->limit($params['limit']);
		}

		//get records
		//$this->db->where('order_status',$params['search']['order_status']);

		$query = $this->db->get();
		//return fetched data
		return $query->result();
	}


}
