<?php


function total_products($product_type=NULL)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('product');
	if($product_type!=NULL){ $ci->db->where('product_type', $product_type); }
	$query=$ci->db->get();
	return $query->num_rows();
}
function get_sku_code($product_id)
{
	$ci=get_instance();
	$ci->db->select('sku');
	$ci->db->from('product');
	$ci->db->where('product_id',$product_id);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$row = $query->row();
		return $row->sku;
	}
}
function getHomeProducts($data)
{
	$ci=get_instance();

	$product_type = 'general';// isset($data['product_type']) ? $data['product_type'] : null;
	$per_page = isset($data['per_page']) ? $data['per_page'] : null;
	$paged = isset($data['paged']) ? $data['paged'] : null;

	$ci->db->select('*');
	$ci->db->from('product');

	if($product_type!=NULL)
	{
		$ci->db->where('product_type', $product_type);
	}

	if($per_page && $paged)
	{
		$ci->db->limit($per_page, ($paged-1)*$per_page);
	}

	$ci->db->order_by('modified_time', 'DESC');

	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		return $query->result();
	}
}


function get_featured_products($order_status, $limit, $initial_limit=NULL)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('product');
	$ci->db->order_by('product_id', $order_status);
	
	if(!empty($initial_limit))
	{
		$ci->db->limit($initial_limit, $limit);
	}
	else
	{
		$ci->db->limit($limit);
	}
	
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		return $query->result();
	}
}
function get_products($product_type=NULL, $limit=NULL)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('product');

	if($product_type!=NULL){ $ci->db->where('product_type', $product_type); }
	if($limit!=NULL){ $ci->db->limit($limit); }
	
	$ci->db->order_by('product_id', 'DESC');
	
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		return $query->result();
	}
}
function get_product($product_id)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('product');
	$ci->db->where('product_id', $product_id);
		$ci->db->order_by('product_id', 'DESC');

	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		return $query->result();
	}
}

function get_product_pdf_picture($product_id)
{
	$media_id = get_product_meta($product_id, 'featured_image');

	$ci=get_instance();
	$ci->db->select('media_path');
	$ci->db->from('media');
	$ci->db->where('media_id', $media_id);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$result = $query->result();
		$media_path = $result[0]->media_path;

		if($size=='thumb')
		{
			//$image_info = getimagesize($media_path);
			//$extension = image_type_to_extension($image_info[2]);

			$base_url = base_url(str_replace(array('.jpg', '.jpeg', '.png', '.gif', '.JPG', '.JPEG', '.PNG', '.GIF'), array('_thumb.jpg', '_thumb.jpeg', '_thumb.png', '_thumb.gif', '_thumb.JPG', '_thumb.JPEG', '_thumb.PNG', '_thumb.GIF'), $media_path));

			$return = $base_url;
		}
		else
		{
			$return = base_url($media_path);
		}

		if(!file_exists($media_path))
		{
			$return = base_url().'images/noimage.jpg';
		}

		return $return;
	}
	else
	{
		return base_url().'images/noimage.jpg';
	}
}

function get_product_thumb($product_id, $size=NULL)
{
	$media_id = get_product_meta($product_id, 'featured_image');
	
	$ci=get_instance();
	$ci->db->select('media_path');
	$ci->db->from('media');
	$ci->db->where('media_id', $media_id);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$result = $query->result();
		$media_path = $result[0]->media_path;
		
		if($size=='thumb')
		{
			//$image_info = getimagesize($media_path);
			//$extension = image_type_to_extension($image_info[2]);
			
			$base_url = base_url(str_replace(array('.jpg', '.jpeg', '.png', '.gif', '.JPG', '.JPEG', '.PNG', '.GIF'), array('_thumb.jpg', '_thumb.jpeg', '_thumb.png', '_thumb.gif', '_thumb.JPG', '_thumb.JPEG', '_thumb.PNG', '_thumb.GIF'), $media_path));
			
			$return = $base_url;
		}
		else
		{
			$return = base_url($media_path);
		}
		
		if(!file_exists($media_path))
		{
			$return = base_url().'images/noimage.jpg';
		}
		
		return $return;
	}
	else
	{
		return base_url().'images/noimage.jpg';
	}
}
function get_product_title($product_id)
{
	$ci=get_instance();
	$ci->db->select('product_title');
	$ci->db->from('product');
	$ci->db->where('product_id', $product_id);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$row = $query->row();
		return $row->product_title;
	}
}


function get_product_delevery_price_in_dhaka($product_id)
{
	$ci=get_instance();
	$ci->db->select('delever_charge_in_dhaka');
	$ci->db->from('product');
	$ci->db->where('product_id', $product_id);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$row = $query->row();
		return $row->delever_charge_in_dhaka;
	}
}

function get_product_delevery_price_out_dhaka($product_id)
{
	$ci=get_instance();
	$ci->db->select('delever_charge_out_dhaka');
	$ci->db->from('product');
	$ci->db->where('product_id', $product_id);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$row = $query->row();
		return $row->delever_charge_out_dhaka;
	}
}
function get_hotdeals($limit=null)
{
	date_default_timezone_set("Asia/Dhaka");

	$today = date('Y-m-d');

	$limit_sql = '';

	if($limit)
	{
		$limit_sql = "LIMIT $limit";
	}

	return $result = get_result("SELECT p.* FROM product as p 
	JOIN productmeta as pm1 ON p.product_id = pm1.product_id 
	JOIN productmeta as pm2 ON p.product_id = pm2.product_id 
	WHERE pm1.meta_key = 'discount_price' AND pm1.meta_value != 0 AND pm1.meta_value != '' 
	AND pm2.meta_key = 'discount_to' AND pm2.meta_value > '$today' 
	ORDER BY p.product_id DESC $limit_sql");
}

function get_live_products($limit=null)
{
	date_default_timezone_set("Asia/Dhaka");
	$today = date('Y-m-d');
	return $result = get_result("SELECT p.* FROM product as p 
	JOIN productmeta as pm1 ON p.product_id = pm1.product_id 
	JOIN productmeta as pm2 ON p.product_id = pm2.product_id 
	JOIN productmeta as pm3 ON p.product_id = pm3.product_id 
	WHERE pm1.meta_key = 'discount_price' AND pm1.meta_value != 0 AND pm1.meta_value != '' 
	AND pm2.meta_key = 'discount_from' AND pm2.meta_value = '$today' 
	AND pm3.meta_key = 'discount_to' AND pm3.meta_value = '$today' 
	ORDER BY p.product_id DESC");
}



function get_option_based_product($qty=false, $product_ids)
{
	if($qty==true)
	{
		$ci=get_instance();
		$ci->db->select('product.product_id, product.product_title,sku');
		$ci->db->from('product');
		$query=$ci->db->get();
		if($query->num_rows()>0)
		{
			$products=NULL;
			$result = $query->result();
			foreach($result as $row)
			{
				$sku=$row->sku;
				$products.='<option value="'.$row->product_id.'" '.(in_array($row->product_id, $product_ids) ? 'selected' : null).'>'.$row->product_title .'-'.$sku.'</option>';
			}
			
			return $products;
		}
	}
	else
	{
		$ci=get_instance();
		$ci->db->select('product_id, product_title,sku');
		$ci->db->from('product');	
		$query=$ci->db->get();
		if($query->num_rows()>0)
		{
			$products=NULL;
			$result = $query->result();
			foreach($result as $row)
			{
				$sku=$row->sku;

				$products.='<option value="'.$row->product_id.'">'.$row->product_title.'-'.$sku.'</option>';
			}
			
			return $products;
		}
	}
}

function get_json_encoded_product_title()
{
	$ci=get_instance();
	$ci->db->select('product_title');
	$ci->db->from('product');	
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$result = $query->result();
		foreach($result as $row)
		{
			$product_title[] = $row->product_title;
		}
		return json_encode($product_title);
	}
}

function update_product_discount()
{
	$ci=get_instance();
	$ci->db->where('product.discount_to <', date('Y-m-d'));
	$ci->db->update('product', array('product_discount' => ''));
}


/*# product meta #*/
function insert_product_meta($product_id, $meta_key, $meta_value)
{
	$ci=get_instance();
	$ci->db->select('meta_value');
	$ci->db->from('productmeta');
	$ci->db->where('product_id', $product_id);
	$ci->db->where('meta_key', $meta_key);
	$query=$ci->db->get();
	if($query->num_rows()==0)
	{
		$ci->db->insert('productmeta', array(
			'product_id'=>$product_id,
			'meta_key'=>$meta_key,
			'meta_value'=>$meta_value
		));
	}
}
function update_product_meta($product_id, $meta_key, $meta_value)
{
	$ci=get_instance();
	$ci->db->select('meta_value');
	$ci->db->from('productmeta');
	$ci->db->where('product_id', $product_id);
	$ci->db->where('meta_key', $meta_key);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$ci->db->where('product_id', $product_id);
		$ci->db->where('meta_key', $meta_key);
		$ci->db->update('productmeta', array('meta_value'=>$meta_value));
	}
	else
	{
		$ci->db->insert('productmeta', array(
			'product_id'=>$product_id,
			'meta_key'=>$meta_key,
			'meta_value'=>$meta_value
		));
	}
}
function get_product_meta($product_id, $meta_key)
{
	$ci=get_instance();
	$ci->db->select('meta_value');
	$ci->db->from('productmeta');
	$ci->db->where('product_id', $product_id);
	$ci->db->where('meta_key', $meta_key);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$row=$query->row();
		return $row->meta_value;
	}
}

function get_product_meta_data($product_id)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('product');
	$ci->db->where('product_id', $product_id);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		//$row=$query->row();
		return  $query->row();
	}
}
function get_related_products($product_id, $product_cats)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('product');
	$ci->db->join('term_relation', 'product.product_id = term_relation.product_id');
	$ci->db->join('productmeta', 'product.product_id = productmeta.product_id');
	$ci->db->where_in('term_relation.term_id', explode(',', $product_cats));
	$ci->db->where_not_in('product.product_id', $product_id);
	$ci->db->where('productmeta.meta_key', 'sell_price');
	$ci->db->group_by('product.product_id');
	$ci->db->order_by('product.product_id', 'DESC');
	$result = $ci->db->get();
	return $result->result();
}


function get_product_link($product_id)
{
	$ci=get_instance();
	$ci->db->select('product_name');
	$ci->db->from('product');
	$ci->db->where('product_id', $product_id);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$product = $query->row();
		$link=base_url().'product/'.$product->product_name;
		return $link;
	}
}
