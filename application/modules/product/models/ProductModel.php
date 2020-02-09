<?php
Class ProductModel extends CI_Model
{
	
	public function get_products($product_id=null, $stock_status=NULL)
	{
		if($product_id!=null)
		{
	        $this->db->select('*');
	        $this->db->from('product');
			$this->db->where('product_id', $product_id);
			$query = $this->db->get();
			return $query->row();
		}
		elseif($stock_status!=null)
		{
			if($stock_status=='limited_stock')
			{
		        /*$this->db->select('*, meta_value as stock_qty');
		        $this->db->from('product');
				$this->db->join('productmeta', 'product.product_id = productmeta.product_id');
				$this->db->where('productmeta.meta_key', 'stock_qty');
				$this->db->where('productmeta.meta_value <=', 3);
				$this->db->order_by("product.product_id", "DESC");
				$query = $this->db->get();
				return $query->result();*/
				$query="select  * , meta_value as stock_qty from product
join productmeta on productmeta.product_id=product.product_id
where productmeta.meta_key='stock_qty' and productmeta.meta_value <=10 order by product.product_id desc";
	$query = $this->db->query($query);
				return $query->result();
			}
			else
			{
		        $this->db->select('*, meta_value as stock_status');
		        $this->db->from('product');
				$this->db->join('productmeta', 'product.product_id = productmeta.product_id');
				$this->db->where('productmeta.meta_key', 'stock_status');
				$this->db->where('productmeta.meta_value', $stock_status);
				$this->db->order_by("product.product_id", "DESC");
				$query = $this->db->get();
				return $query->result();
			}
		}
		else
		{
	        $this->db->select('*');
	        $this->db->from('product');
			$this->db->order_by("product_id", "DESC");
			$query = $this->db->get();
			return $query->result();
		}
    }

	public function product_terms($product_id)
	{
        $this->db->select('*');
        $this->db->from('term_relation');
        $this->db->where('product_id', $product_id);
        $query = $this->db->get();
        return $query->result();
    }
	
	public function front_view($product_name){
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('product_name', $product_name);
        $result = $this->db->get();
        $prod_row = $result->row();
        return $prod_row;
    }
	
	public function quick_view($product_id){
        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('product_id', $product_id);
        $result = $this->db->get();
        $prod_row = $result->row();
        return $prod_row;
    }
	
	/*# term relations #*/
	public function add_new_term_relation($data)
	{
		return $this->db->insert('term_relation', $data);
	}
	public function delete_term_relation($product_id)
	{
		$this->db->where('term_relation.product_id', $product_id);
		return $this->db->delete('term_relation');
	}
	
	/*# media #*/
	public function add_new_media($data)
	{
		$this->db->insert('media', $data);
		return $this->db->insert_id();
	}
	public function update_product_size($data, $row_id){
		$this->db->where('product_size.product_size_id', $row_id);
		return $this->db->update('product_size', $data);
	}
}