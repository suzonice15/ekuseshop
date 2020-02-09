<?php
/*# product meta #*/
function insert_order_meta($order_id, $meta_key, $meta_value)
{
	$ci=get_instance();
	$ci->db->select('meta_value');
	$ci->db->from('ordermeta');
	$ci->db->where('order_id', $order_id);
	$ci->db->where('meta_key', $meta_key);
	$query=$ci->db->get();
	if($query->num_rows()==0)
	{
		$ci->db->insert('ordermeta', array(
			'order_id'=>$order_id,
			'meta_key'=>$meta_key,
			'meta_value'=>$meta_value
		));
	}
}
function update_order_meta($order_id, $meta_key, $meta_value)
{
	$ci=get_instance();
	$ci->db->select('meta_value');
	$ci->db->from('ordermeta');
	$ci->db->where('order_id', $order_id);
	$ci->db->where('meta_key', $meta_key);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$ci->db->where('order_id', $order_id);
		$ci->db->where('meta_key', $meta_key);
		$ci->db->update('ordermeta', array('meta_value'=>$meta_value));
	}
	else
	{
		$ci->db->insert('ordermeta', array(
			'order_id'=>$order_id,
			'meta_key'=>$meta_key,
			'meta_value'=>$meta_value
		));
	}
}
function get_order_meta($order_id, $meta_key)
{
	$ci=get_instance();
	$ci->db->select('meta_value');
	$ci->db->from('ordermeta');
	$ci->db->where('order_id', $order_id);
	$ci->db->where('meta_key', $meta_key);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$row=$query->row();
		return $row->meta_value;
	}
}


/*# get order total by order_id #*/
function get_order_total($order_id)
{
	$ci=get_instance();
	$ci->db->select('order_total');
	$ci->db->from('order');
	$ci->db->where('order_id', $order_id);
	$query=$ci->db->get();
	if($query->num_rows() > 0)
	{
		$row=$query->result();
		return $row[0]->order_total;
	}
}

/*# get product title from order #*/
function get_order_product_title($order_id, $formatted=FALSE)
{
	$ci=get_instance();
	$ci->db->select('product_id');
	$ci->db->from('order');
	$ci->db->where('order_id', $order_id);
	$query=$ci->db->get();
	if($query->num_rows() > 0)
	{
		$row=$query->result();
		$product_id = $row[0]->product_id;
		
		$ci->db->select('product_title, product_name');
		$ci->db->from('product');
		$ci->db->where('product_id', $product_id);
		$query=$ci->db->get();
		if($query->num_rows() > 0)
		{
			$row=$query->result();
			$product_title = $row[0]->product_title;
			
			if($formatted == TRUE)
			{
				return '<a href="'.base_url($row[0]->product_name).'">'.$product_title.'</a>';
			}
			else
			{
				return $product_title;
			}
		}
	}
}

/*# get product qty from order #*/
function get_order_product_qty($order_id)
{
	$ci=get_instance();
	$ci->db->select('product_qty');
	$ci->db->from('order');
	$ci->db->where('order_id', $order_id);
	$query=$ci->db->get();
	if($query->num_rows() > 0)
	{
		$row=$query->result();
		return $row[0]->product_qty;
	}
}

/*# get total orders by date #*/
function get_total_orders($date_from, $date_to, $staff_id=NULL)
{
	$ci=get_instance();
	$ci->db->select('order_total');
	$ci->db->from('order');
	$ci->db->where('created_time >=', $date_from);
	$ci->db->where('created_time <=', $date_to);
	if($staff_id){ $ci->db->where('staff_id', $staff_id); }
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$result=$query->result();
		foreach($result as $row)
		{
			$order_total[] = $row->order_total;
		}

		return array('no_of_order'=>$query->num_rows(), 'order_total'=>array_sum($order_total));
	}
}