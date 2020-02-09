<?php
/*# get main categories #*/
function get_categories($sub='yes')
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('category');
	if($sub=='no'){$ci->db->where('parent_id', 0);}
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		return $query->result();
	}
}

/*# get sub categories #*/
function get_subcategories($category_id)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('category');
	$ci->db->where('parent_id', $category_id);
	$ci->db->where('status', 1);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		return $query->result();
	}
}

/*# get category_id by category_name #*/
function get_category_id($category_name)
{
	$ci=get_instance();
	$ci->db->select('category_id');
	$ci->db->from('category');
	$ci->db->where('category_name', $category_name);
	$query=$ci->db->get();
	if($query->num_rows() > 0)
	{
		$row=$query->result();
		return $row[0]->category_id;
	}
}
function get_sub_category_id($parent_id, $category_name)
{
	$ci=get_instance();
	$ci->db->select('category_id');
	$ci->db->from('category');
	$ci->db->where('category_name', $category_name);
	$ci->db->where('parent_id', $parent_id);
	$query=$ci->db->get();
	if($query->num_rows() > 0)
	{
		$row=$query->result();
		return $row[0]->category_id;
	}
}
function get_category_title($category_id)
{
	$ci=get_instance();
	$ci->db->select('category_title');
	$ci->db->from('category');
	$ci->db->where('category_id', $category_id);
	$query=$ci->db->get();
	if($query->num_rows() > 0)
	{
		$row=$query->row();
		return $row->category_title;
	}
}
function get_category_name($category_id)
{
	$ci=get_instance();
	$ci->db->select('category_name');
	$ci->db->from('category');
	$ci->db->where('category_id', $category_id);
	$query=$ci->db->get();
	if($query->num_rows() > 0)
	{
		$row=$query->row();
		return $row->category_name;
	}
}
function get_category_info($category_id)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('category');
	$ci->db->where('category_id', $category_id);
	$query=$ci->db->get();
	if($query->num_rows() > 0)
	{
		return $query->row();
	}
}

/*# nested category tr #*/
function nested_category_tr($parent, $category)
{
	$html=null;
	
	if(isset($category['parent_cats'][$parent]))
	{
		foreach($category['parent_cats'][$parent] as $cat_id)
		{
			if(!isset($category['parent_cats'][$cat_id]))
			{
				$html.='<tr>
					<td>
						<input type="checkbox" name="checkbox[]" id="checkbox[]" class="checkbox1" value="'.$cat_id.'" />
					</td>
					<td>'.$category['categories'][$cat_id]->category_name.'</td>
					<td>'.$category['categories'][$cat_id]->category_title.'</td>
					<td class="action text-right">
						<a class="lnr lnr-eye" href="'.base_url().'admin/category/update/'.$cat_id.'">&nbsp;</a>
						<a class="lnr lnr-trash delete" href="javascript:void(0);" data-row_id="'.$cat_id.'" data-table="category">&nbsp;</a>
					</td>
				</tr>';
			}
			
			if(isset($category['parent_cats'][$cat_id]))
			{
				$html.='<tr>
					<td>
						<input type="checkbox" name="checkbox[]" id="checkbox[]" class="checkbox1" value="'.$cat_id.'" />
					</td>
					<td>'.$category['categories'][$cat_id]->category_title.'</td>
					<td>'.$category['categories'][$cat_id]->category_name.'</td>
					<td class="action text-right">
						<a class="lnr lnr-eye" href="'.base_url().'admin/category/update/'.$cat_id.'">&nbsp;</a>
						<a class="lnr lnr-trash delete" href="javascript:void(0);" data-row_id="'.$cat_id.'" data-table="category">&nbsp;</a>
					</td>
				</tr>';
				
				$html .= nested_category_tr2($cat_id, $category);
			}
			
		}
		
		return $html;
	}
	
}
function nested_category_tr2($parent, $category)
{
	$html=null;
	
	if(isset($category['parent_cats'][$parent]))
	{
		foreach($category['parent_cats'][$parent] as $cat_id)
		{
			if(!isset($category['parent_cats'][$cat_id]))
			{
				$html.='<tr>
					<td>
						<input type="checkbox" name="checkbox[]" id="checkbox[]" class="checkbox1" value="'.$cat_id.'" />
					</td>
					<td>&nbsp;- '.$category['categories'][$cat_id]->category_name.'</td>
					<td>'.$category['categories'][$cat_id]->category_title.'</td>
					<td class="action text-right">
						<a class="lnr lnr-eye" href="'.base_url().'admin/category/update/'.$cat_id.'">&nbsp;</a>
						<a class="lnr lnr-trash delete" href="javascript:void(0);" data-row_id="'.$cat_id.'" data-table="category">&nbsp;</a>
					</td>
				</tr>';
			}
			
			if(isset($category['parent_cats'][$cat_id]))
			{
				$html.='<tr>
					<td>
						<input type="checkbox" name="checkbox[]" id="checkbox[]" class="checkbox1" value="'.$cat_id.'" />
					</td>
					<td>&nbsp;- '.$category['categories'][$cat_id]->category_title.'</td>
					<td>'.$category['categories'][$cat_id]->category_name.'</td>
					<td class="action text-right">
						<a class="lnr lnr-eye" href="'.base_url().'admin/category/update/'.$cat_id.'">&nbsp;</a>
						<a class="lnr lnr-trash delete" href="javascript:void(0);" data-row_id="'.$cat_id.'" data-table="category">&nbsp;</a>
					</td>
				</tr>';
				
				$html .= nested_category_tr3($cat_id, $category);
			}
		}
		
		return $html;
	}
	
}
function nested_category_tr3($parent, $category)
{
	$html=null;
	
	if(isset($category['parent_cats'][$parent]))
	{
		foreach($category['parent_cats'][$parent] as $cat_id)
		{
			if(!isset($category['parent_cats'][$cat_id]))
			{
				$html.='<tr>
					<td>
						<input type="checkbox" name="checkbox[]" id="checkbox[]" class="checkbox1" value="'.$cat_id.'" />
					</td>
					<td>&nbsp;&nbsp;-- '.$category['categories'][$cat_id]->category_name.'</td>
					<td>'.$category['categories'][$cat_id]->category_title.'</td>
					<td class="action text-right">
						<a class="lnr lnr-eye" href="'.base_url().'admin/category/update/'.$cat_id.'">&nbsp;</a>
						<a class="lnr lnr-trash delete" href="javascript:void(0);" data-row_id="'.$cat_id.'" data-table="category">&nbsp;</a>
					</td>
				</tr>';
			}
			
			if(isset($category['parent_cats'][$cat_id]))
			{
				$html.='<tr>
					<td>
						<input type="checkbox" name="checkbox[]" id="checkbox[]" class="checkbox1" value="'.$cat_id.'" />
					</td>
					<td>&nbsp;&nbsp;-- '.$category['categories'][$cat_id]->category_title.'</td>
					<td>'.$category['categories'][$cat_id]->category_name.'</td>
					<td class="action text-right">
						<a class="lnr lnr-eye" href="'.base_url().'admin/category/update/'.$cat_id.'">&nbsp;</a>
						<a class="lnr lnr-trash delete" href="javascript:void(0);" data-row_id="'.$cat_id.'" data-table="category">&nbsp;</a>
					</td>
				</tr>';
				
				$html .= nested_category_tr4($cat_id, $category);
			}
		}
		
		return $html;
	}
	
}
function nested_category_tr4($parent, $category)
{
	$html=null;
	
	if(isset($category['parent_cats'][$parent]))
	{
		foreach($category['parent_cats'][$parent] as $cat_id)
		{
			if(!isset($category['parent_cats'][$cat_id]))
			{
				$html.='<tr>
					<td>
						<input type="checkbox" name="checkbox[]" id="checkbox[]" class="checkbox1" value="'.$cat_id.'" />
					</td>
					<td>&nbsp;&nbsp;&nbsp;--- '.$category['categories'][$cat_id]->category_name.'</td>
					<td>'.$category['categories'][$cat_id]->category_title.'</td>
					<td class="action text-right">
						<a class="lnr lnr-eye" href="'.base_url().'admin/category/update/'.$cat_id.'">&nbsp;</a>
						<a class="lnr lnr-trash delete" href="javascript:void(0);" data-row_id="'.$cat_id.'" data-table="category">&nbsp;</a>
					</td>
				</tr>';
			}
			
			if(isset($category['parent_cats'][$cat_id]))
			{
				$html.='<tr>
					<td>
						<input type="checkbox" name="checkbox[]" id="checkbox[]" class="checkbox1" value="'.$cat_id.'" />
					</td>
					<td>&nbsp;&nbsp;&nbsp;--- '.$category['categories'][$cat_id]->category_title.'</td>
					<td>'.$category['categories'][$cat_id]->category_name.'</td>
					<td class="action text-right">
						<a class="lnr lnr-eye" href="'.base_url().'admin/category/update/'.$cat_id.'">&nbsp;</a>
						<a class="lnr lnr-trash delete" href="javascript:void(0);" data-row_id="'.$cat_id.'" data-table="category">&nbsp;</a>
					</td>
				</tr>';
				
				$html .= nested_category_tr5($cat_id, $category);
			}
		}
		
		return $html;
	}
	
}
function nested_category_tr5($parent, $category)
{
	$html=null;
	
	if(isset($category['parent_cats'][$parent]))
	{
		foreach($category['parent_cats'][$parent] as $cat_id)
		{
			if(!isset($category['parent_cats'][$cat_id]))
			{
				$html.='<tr>
					<td>
						<input type="checkbox" name="checkbox[]" id="checkbox[]" class="checkbox1" value="'.$cat_id.'" />
					</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;---- '.$category['categories'][$cat_id]->category_name.'</td>
					<td>'.$category['categories'][$cat_id]->category_title.'</td>
					<td class="action text-right">
						<a class="lnr lnr-eye" href="'.base_url().'admin/category/update/'.$cat_id.'">&nbsp;</a>
						<a class="lnr lnr-trash delete" href="javascript:void(0);" data-row_id="'.$cat_id.'" data-table="category">&nbsp;</a>
					</td>
				</tr>';
			}
			
			if(isset($category['parent_cats'][$cat_id]))
			{
				$html.='<tr>
					<td>
						<input type="checkbox" name="checkbox[]" id="checkbox[]" class="checkbox1" value="'.$cat_id.'" />
					</td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;---- '.$category['categories'][$cat_id]->category_title.'</td>
					<td>'.$category['categories'][$cat_id]->category_name.'</td>
					<td class="action text-right">
						<a class="lnr lnr-eye" href="'.base_url().'admin/category/update/'.$cat_id.'">&nbsp;</a>
						<a class="lnr lnr-trash delete" href="javascript:void(0);" data-row_id="'.$cat_id.'" data-table="category">&nbsp;</a>
					</td>
				</tr>';
				
				$html .= nested_category_tr5($cat_id, $category);
			}
		}
		
		return $html;
	}
	
}

/*# nested category list #*/
function nested_category_list($parent, $category)
{
	$html = "";
	
	if(isset($category['parent_cats'][$parent]))
	{
		foreach($category['parent_cats'][$parent] as $cat_id)
		{
			if(!isset($category['parent_cats'][$cat_id]))
			{
				$html .= '<li class="'.$category['categories'][$cat_id]->category_name.'">
					<a href="'.base_url($category['categories'][$cat_id]->category_name).'">
						'.$category['categories'][$cat_id]->category_title.'
					</a>
				</li>';
			}
			
			if(isset($category['parent_cats'][$cat_id]))
			{
				$html .= '<li class="'.$category['categories'][$cat_id]->category_name.' dropdown dropdown-submenu">
					<a href="'.base_url($category['categories'][$cat_id]->category_name).'">
						'.$category['categories'][$cat_id]->category_title.'
					</a>
					<ul class="dropdown-menu">';
						$html .= nested_category_list($cat_id, $category);
					$html .= '</ul>
				</li>';
			}
		}
	}
	
	return $html;
}
function get_dropdown($parent, $category)
{
	if(isset($category[$parent]))
	{
		$html = '<div class="dropdown-menu"><ul class="parentcat">';
		
		foreach($category[$parent] as $srow)
		{
			$html .= '<li class="'.$srow->category_name.'">
				<a href="'.base_url($srow->category_name).'">
					'.$srow->category_title.'
				</a>
				'.get_my_child_category($srow->category_id, $category).'
			</li>';
		}
		
		$html .= '</ul></div>';
		
		return $html;
	}
}
function get_my_child_category($parent, $category)
{
	if(isset($category[$parent]))
	{
		$html = '<ul class="childcat">';
		
		foreach($category[$parent] as $row)
		{
			$html .= '<li class="'.$row->category_name.'">
				<a href="'.base_url($row->category_name).'">
						'.$row->category_title.'
				</a>
				'.get_my_child_category($row->category_id, $category).'
			</li>';
        }
		
		$html .= "</ul>";
		
		return $html;
    }
}
function get_dropdown_for_topmenu($parent, $category)
{
	if(isset($category[$parent]))
	{
		$html = '<ul>';
		
		foreach($category[$parent] as $srow)
		{
			$html .= '<li class="level1 '.$srow->category_name.'">
				<a href="'.base_url($srow->category_name).'">
					'.$srow->category_title.'
				</a>
				'.get_my_child_category_for_topmenu($srow->category_id, $category).'
			</li>';
		}
		
		$html .= '</ul>';
		
		return $html;
	}
}
function get_my_child_category_for_topmenu($parent, $category)
{
	if(isset($category[$parent]))
	{
		$html = '<ul>';
		
		foreach($category[$parent] as $row)
		{
			$html .= '<li class="sub_category level2 '.$row->category_name.'">
				<a href="'.base_url($row->category_name).'">
						'.$row->category_title.'
				</a>
				'.get_my_child_category_for_topmenu($row->category_id, $category).'
			</li>';
        }
		
		$html .= "</ul>";
		
		return $html;
    }
}

/*# nested category checkbox list #*/
function check_is_checked($cat_id, $terms)
{
	foreach($terms as $term)
	{
		if($term->term_id == $cat_id){ return 'checked'; }
	}
}

function nested_category_checkbox_list($parent, $category, $terms)
{
	$html = "";
	
	if(isset($category['parent_cats'][$parent]))
	{
		foreach($category['parent_cats'][$parent] as $cat_id)
		{
			$is_checked = check_is_checked($cat_id, $terms);
			
			if(!isset($category['parent_cats'][$cat_id]))
			{
				$html .= '<li><label><input type="checkbox" name="categories[]" value="'.$cat_id.'" '.$is_checked.'>'.$category['categories'][$cat_id]->category_title.'</label></li>';
			}
			
			if(isset($category['parent_cats'][$cat_id]))
			{
				$html .= '<li class="submenu"><label><input type="checkbox" name="categories[]" value="'.$cat_id.'" '.$is_checked.'>'.$category['categories'][$cat_id]->category_title.'</label><ul>';
					$html .= nested_category_checkbox_list($cat_id, $category, $terms);
				$html .= '</ul></li>';
			}
		}
	}
	
	return $html;
}


/*# get category products #*/
function get_category_products($category_id, $limit, $initial_limit=NULL)
{
	
	$ci=get_instance();
	$ci->db->select('product_name,product.product_id,product_title,product_price,discount_price,sku,product_stock,discount_type');
	$ci->db->from('product');
	$ci->db->join('term_relation', 'product.product_id = term_relation.product_id');
	$ci->db->where('term_relation.term_id', $category_id);
	$ci->db->where('product.product_type', 'home');
	$ci->db->order_by('product.modified_time', 'DESC');
	
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

/*# get category products #*/
function get_top_category_products($category_id, $limit, $initial_limit=NULL)
{

	$ci=get_instance();
	$ci->db->select('product_name,product.product_id,product_title,product_price,discount_price,sku,product_stock,discount_type');
	$ci->db->from('product');
	$ci->db->join('term_relation', 'product.product_id = term_relation.product_id');
	$ci->db->where('term_relation.term_id', $category_id);
	$ci->db->where('product.product_type', 'hotsell');

	$ci->db->order_by('product.modified_time', 'DESC');

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
