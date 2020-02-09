<?php
Class CategoryModel extends CI_Model
{
	/*# add new #*/
	public function add_new($data)
	{
		return $this->db->insert('category', $data);
	}
	
	/*# update #*/
	public function update($data, $row_id){
		$this->db->where('category.category_id', $row_id);
		return $this->db->update('category', $data);
	}
	
	public function category_result_by_id($category_id)
	{
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('category_id', $category_id);
        $result = $this->db->get();
        $cat_row = $result->row();
        return $cat_row;
    }
	
	/*# product result by category_id and sub_category_id for frontend archive view #*/
	//public function archive_product($category_id,$per_page,$page,$sortby,$price_from=null,$price_to=null)
	public function archive_product($category_id)
	{


		/*if($sortby=='rating_desc')
		{
			$this->db->select('*, AVG(review.rating) as rating_avg');
			$this->db->from('product');
			$this->db->join('term_relation', 'product.product_id = term_relation.product_id');
			$this->db->join('review', 'product.product_id = review.product_id');
			$this->db->where('term_relation.term_id', $category_id);
			$this->db->group_by('review.product_id');
			$this->db->order_by('rating_avg', 'DESC');
			$this->db->limit($per_page, ($page-1)*$per_page);
			$result = $this->db->get();
			return $result->result();
		}
		else
		{
		*/
			$this->db->select('*');
			$this->db->from('product');
			$this->db->join('term_relation', 'product.product_id = term_relation.product_id');
			//$this->db->join('productmeta', 'product.product_id = productmeta.product_id');
			$this->db->where('term_relation.term_id', $category_id);
			//$this->db->where('productmeta.meta_key', 'sell_price');
			/*
			if($sortby=='price_asc')
			{
				$product_price_array = array(
					'productmeta.meta_key' => 'sell_price',
					'productmeta.meta_value !=' => '',
					'productmeta.meta_value !=' => null,
					'productmeta.meta_value !=' => 0
				);
	
				$this->db->where($product_price_array);

				$this->db->order_by('product.modified_time', 'DESC');
				$this->db->order_by('product.product_id', 'DESC');
			}
			elseif($sortby=='price_desc')
			{
				$product_price_array = array(
					'productmeta.meta_key' => 'sell_price',
					'productmeta.meta_value !=' => '',
					'productmeta.meta_value !=' => null,
					'productmeta.meta_value !=' => 0
				);
	
				$this->db->where($product_price_array);

				$this->db->order_by('productmeta.meta_value', 'DESC');
			}
			elseif($sortby=='price_range')
			{
				$product_price_array = array(
					'productmeta.meta_key' => 'sell_price',
					'productmeta.meta_value !=' => '', 
					'productmeta.meta_value !=' => null, 
					'productmeta.meta_value !=' => 0, 
					'productmeta.meta_value >=' => $price_from, 
					'productmeta.meta_value <=' => $price_to
				);
				
				$this->db->where($product_price_array);
			}
			elseif($sortby=='name_asc')
			{
				$this->db->order_by('product.product_title', 'ASC');
			}
			elseif($sortby=='name_desc')
			{
				$this->db->order_by('product.product_title', 'DESC');
			}
			else
			{
				*/
				$this->db->order_by('product.modified_time', 'DESC');
			//}
			
			//$this->db->limit($per_page, ($page-1)*$per_page);
			$result = $this->db->get();
			return $result->result();
		}




		/*if($sortby=='rating_desc')
		{
			$this->db->select('*, AVG(review.rating) as rating_avg');
			$this->db->from('product');
			$this->db->join('term_relation', 'product.product_id = term_relation.product_id');
			$this->db->join('review', 'product.product_id = review.product_id');
			$this->db->where('term_relation.term_id', $category_id);
			$this->db->group_by('review.product_id');
			$this->db->order_by('rating_avg', 'DESC');
			$this->db->limit($per_page, ($page-1)*$per_page);
			$result = $this->db->get();
			return $result->result();
		}
		else
		{
			$this->db->select('*');
			$this->db->from('product');
			$this->db->join('term_relation', 'product.product_id = term_relation.product_id');
			$this->db->where('term_relation.term_id', $category_id);
			if($sortby=='price_asc'){ $this->db->order_by('product.product_price', 'ASC'); }
			elseif($sortby=='price_desc'){ $this->db->order_by('product.product_price', 'DESC'); }
			elseif($sortby=='name_asc'){ $this->db->order_by('product.product_title', 'ASC'); }
			elseif($sortby=='name_desc'){ $this->db->order_by('product.product_title', 'DESC'); }
			else{ $this->db->order_by('product.product_id', 'DESC'); }
			$this->db->limit($per_page, ($page-1)*$per_page);
			$result = $this->db->get();
			return $result->result();
		}*/
    //}
	
	/*# product result by category_id and sub_category_id for frontend archive view #*/
	public function total_rows($category_id)
	{
        $this->db->select('*');
        $this->db->from('product');
		$this->db->join('term_relation', 'product.product_id = term_relation.product_id');
		$this->db->where('term_relation.term_id', $category_id);
        $query=$this->db->get();
		return $query->num_rows();
    }
	
	/*# add new media #*/
	public function add_new_media($data)
	{
		$this->db->insert('media', $data);
		return $this->db->insert_id();
	}

	public function scroll_pagination_product($category_id,$start,$limit)
	{



		$this->db->select('product_name,product.product_id,product_title,product_price,discount_price,sku,product_stock,discount_type');
		$this->db->from('product');
		$this->db->join('term_relation', 'product.product_id = term_relation.product_id');
		$this->db->where('term_relation.term_id', $category_id);
		$this->db->order_by('product.modified_time', 'DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get();
		return $result->result();
	}


	

	public function scroll_home_product($start,$limit,$home)
	{



		$this->db->select('product_name,product.product_id,product_title,product_price,discount_price,sku,product_stock,discount_type');
		$this->db->from('product');
		$this->db->join('term_relation', 'product.product_id = term_relation.product_id');
		$this->db->order_by('modified_time', 'DESC');
		$this->db->where('product_type', $home);

		$this->db->limit($limit, $start);
		$result = $this->db->get();
		return $result->result();
	}

	public function scroll_related_product($category_id,$start,$limit)
	{



		$this->db->select('distinct(product_name),product.product_id,product_title,product_price,discount_price,sku,product_stock,discount_type');
		$this->db->from('product');
		$this->db->join('term_relation', 'product.product_id = term_relation.product_id');
		$this->db->where_in('term_relation.term_id', $category_id);
		$this->db->order_by('product.modified_time', 'DESC');
		$this->db->limit($limit, $start);
		$result = $this->db->get();
		return $result->result();
	}

}
