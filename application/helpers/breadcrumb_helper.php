<?php


function get_breadcrumb($id=null, $page='product', $title=null)
{
	$ci = get_instance();
	$res_html = $sub_category_title = NULL;
	
	if($page == 'product')
	{
		$category_title = $product_title = null;
		
		$ci->db->select('term_id');
		$ci->db->from('term_relation');
		$ci->db->where('product_id', $id);
		$query = $ci->db->get();
		if($query->num_rows()>0)
		{
			$categories = $query->result();
			foreach($categories as $cat)
			{
				$category[] = $cat->term_id;
			}
			
			$product_title = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<span itemprop="name">'.$title.'</span>
			</li>';
			
			$ci->db->select('category_title, category_name');
			$ci->db->from('category');
			$ci->db->where_in('category_id', $category);
			$ci->db->order_by('rank_order', 'ASC');
			$ci->db->order_by('category_id', 'ASC');
			$ci->db->limit(2);
			$query=$ci->db->get();
			if($query->num_rows()>0)
			{
				$result = $query->result();
				foreach($result as $row)
				{
					$category_title .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a href="'.base_url($row->category_name).'" itemprop="item">
							<span itemprop="name">'.$row->category_title.'</span>
						</a>
					</li>';
				}
			}
			
			$res_html = $category_title.$product_title;
		}
	}
	elseif($page == 'category')
	{
		$ci->db->select('category_title, parent_id');
		$ci->db->from('category');
		$ci->db->where('category_id', $id);
		$query = $ci->db->get();
		if($query->num_rows()>0)
		{
			$result = $query->result();
			$parent_category_title = '';
			$category_title = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<span itemprop="name">'.$result[0]->category_title.'</span>
			</li>';
			
			$parent_id = $result[0]->parent_id;
			
			if($parent_id != 0)
			{
				$ci->db->select('category_title, category_name');
				$ci->db->from('category');
				$ci->db->where('category_id', $parent_id);
				$query=$ci->db->get();
				if($query->num_rows()>0)
				{
					$result = $query->result();
					$parent_category_title = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
						<a href="'.base_url($result[0]->category_name).'" itemprop="item">
							<span itemprop="name">'.$result[0]->category_title.'</span>
						</a>
					</li>';
					
				}
			}
			
			$res_html = $parent_category_title.$category_title;
		}
	}
	elseif($page == 'news')
	{
		$res_html = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<a href="'.base_url('news').'" itemprop="item">
				<span itemprop="name">News</span>
			</a>
		</li>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<span itemprop="name">'.$title.'</span>
		</li>';
	}
	elseif($page == 'blog')
	{
		$res_html = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<a href="'.base_url('blog').'" itemprop="item">
				<span itemprop="name">Blog</span>
			</a>
		</li>
		<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<span itemprop="name">'.$title.'</span>
		</li>';
	}
	else
	{
		$res_html = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
			<span itemprop="name">'.$title.'</span>
		</li>';
	}
	
	$home = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		<a href="'.base_url().'" itemprop="item">
			<span itemprop="name">Home</span>
		</a>
	</li>';
	
	return '<ul class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">'.$home.$res_html.'</ul>';
}

function get_breadcrumb_data($id=null, $page='product', $title=null){


}


