<?php
/*### dashboard ###*/
### manage request message section globally ###
function get_req_message()
{
	if(isset($_GET["message"]) && !empty($_GET["message"]))
	{
		$req_message='<div class="message" id="message">';
			if(isset($_GET["purpose"]) && $_GET["message"]=="success")
			{
				$req_message.='<div class="success">'.ucwords($_GET["purpose"]).' Successfully!</div>';
			}
			elseif(isset($_GET["reason"]) && $_GET["message"]=="failed")
			{
				$req_message.='<div class="failed">'.ucwords($_GET["purpose"]).' Failed! for '.ucwords($_GET["reason"]).'</div>';
			}
			elseif(isset($_GET["purpose"]) && $_GET["message"]=="failed")
			{
				$req_message.='<div class="failed">'.ucwords($_GET["purpose"]).' Failed!</div>';
			}
		$req_message.='</div>';
		return $req_message;
	}
	elseif(isset($_GET['q'], $_GET['msg']))
	{
		if($_GET['q']=='false') $class='error'; else $class=NULL;
		$req_message='<div class="message '.$class.'" id="message">'.ucwords($_GET['msg']).'</div>';
		return $req_message;
	}
}


/*### get uri not found data ###*/
function get_uri_not_found_data($uri)
{
	$ci=get_instance();

	$ci->db->select('*');
	$ci->db->from('product');
	$ci->db->where('product_name', $uri);
	$query=$ci->db->get();

	if($query->num_rows()>0)
	{
		return $query->row();
	}
	else
	{
		$ci->db->select('*');
		$ci->db->from('post');
		$ci->db->where('post_name', $uri);	
		$query=$ci->db->get();

		if($query->num_rows()>0)
		{
			return $query->row();
		}
		else
		{
			$ci->db->select('*');
			$ci->db->from('category');
			$ci->db->where('category_name', $uri);	
			$query=$ci->db->get();
			return $query->row();
		}
	}
}


/*### custom methods ###*/
/*# nl2p #*/
function nl2p($string, $line_breaks = true, $xml = true)
{
    $string = str_replace(array('<p>', '</p>', '<br>', '<br />'), '', $string);
 
    if($line_breaks == true)
	{
        return '<p>'.preg_replace(array("/([\n]{2,})/i", "/([^>])\n([^<])/i"), array("</p>\n<p>", '<br'.($xml == true ? ' /' : '').'>'), trim($string)).'</p>';
	}
    else
	{
        return '<p>'.preg_replace("/([\n]{1,})/i", "</p>\n<p>", trim($string)).'</p>';
	}
}

/*# convert price to bn #*/
function convert_number($int)
{
	$eng_number = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
	$bng_number = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');

	$converted = str_replace($eng_number, $bng_number, $int);
	return $converted;
}

/*# formatted price #*/
function formatted_price($price, $currency_left=true, $seperate_currecy=false)
{
	if($seperate_currecy==true)
	{
		if($currency_left==false)
		{
			$return = number_format($price, 2).'<em> TK</em>';
		}
		else
		{
			$return = '<em>TK </em>'.number_format($price, 2);
		}
	}
	else
	{
		if($currency_left==false)
		{
			$return = number_format($price, 2).' TK';
		}
		else
		{
			$return = 'TK '.number_format($price, 2);
		}
	}

	return $return;
}


/*### query ###*/
# check duplicate entry
function is_duplicate($sql)
{
	$ci=get_instance();
	$query=$ci->db->query($sql);
	if($query->num_rows()>0){ return TRUE; }else{ return FALSE; }
}

# get table data
function get_result($sql)
{
	$ci=get_instance();
	$query=$ci->db->query($sql);
	if($query->num_rows()>0){ return $query->result(); }
}

# get row data of a table
function get_row($table, $field, $value)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from($table);
	$ci->db->where($field, $value);
	$query=$ci->db->get();
	return $query->result();
}

# create new row in a table
function insert($table, $data)
{
	$ci=get_instance();
	if($ci->db->insert($table, $data)){ return $ci->db->insert_id(); }
}


/*### table page ###*/
function is_page_link($page_link)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('page');
	$ci->db->where('page_link', $page_link);
	$query=$ci->db->get();
	if($query->num_rows()>0){ return TRUE; }
}

function get_page_link($page_id)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('page');
	$ci->db->where('page_id', $page_id);
	$query=$ci->db->get();
	if($query->num_rows()>0){ $page=$query->result(); return $page[0]->page_link; }
}

function get_page_data($page_field, $page_link, $page_id=FALSE)
{
	$ci=get_instance();
	$ci->db->select($page_field);
	$ci->db->from('page');
	if($page_id==TRUE){ $ci->db->where('page_id', $page_link); }
	else{ $ci->db->where('page_link', $page_link); }
	$query=$ci->db->get();
	if($query->num_rows()>0){ $page=$query->result(); return $page[0]->$page_field; }
}


/*### formatted date ###*/
function formatted_date($date)
{
	$strtotime=strtotime($date);
	$day=date("d",$strtotime);
	$month=date("F",$strtotime);
	$year=date("Y",$strtotime);
	echo $month.' '.$day.' '.$year;
}
function get_formatted_date($date)
{
	$strtotime=strtotime($date);
	$day=date("d",$strtotime);
	$month=date("F",$strtotime);
	$year=date("Y",$strtotime);
	return $month.' '.$day.' '.$year;
}


/*### front-end settings ###*/
function social_link($req)
{
	return '#';
}


/*### hitcounter ###*/
function create_hitcounter()
{
	date_default_timezone_set("Asia/Dhaka");
	$ci = get_instance();
	$data['client_ip'] = $_SERVER["REMOTE_ADDR"];
	$data['date'] = date("Y-m-d");
	
	$ci->db->select('hitcounter_id');
	$ci->db->from('hitcounter');
	$ci->db->where('client_ip', $data['client_ip']);
	$ci->db->where('date', $data['date']);
	$query = $ci->db->get();
	if($query->num_rows() <= 0)
	{
		$ci->db->insert('hitcounter', $data);
	}
}

function get_hitcounters($date)
{
	$ci = get_instance();
	$ci->db->select('*');
	$ci->db->from('hitcounter');
	$ci->db->where('date', $date);
	$query = $ci->db->get();
	return $query->result();
}


/*### pagination ###*/
function create_pagination($base_url, $total_rows, $per_page)
{
	$ci=get_instance();
	$ci->load->library('pagination');
	$config['base_url'] = $base_url;
	$config['total_rows'] = $total_rows;
	$config['per_page'] = $per_page;
	$config['use_page_numbers'] = TRUE;
	$config['full_tag_open'] = '<ul class="pagination pull-right">';
	$config['full_tag_close'] = '</ul>';
	$config['first_link'] = '&laquo; First';
	$config['first_tag_open'] = '<li class="prev page">';
	$config['first_tag_close'] = '</li>';
	$config['last_link'] = 'Last &raquo;';
	$config['last_tag_open'] = '<li class="next page">';
	$config['last_tag_close'] = '</li>';
	$config['next_link'] = 'Next &rarr;';
	$config['next_tag_open'] = '<li class="next page">';
	$config['next_tag_close'] = '</li>';
	$config['prev_link'] = '&larr; Previous';
	$config['prev_tag_open'] = '<li class="prev page">';
	$config['prev_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a href="">';
	$config['cur_tag_close'] = '</a></li>';
	$config['num_tag_open'] = '<li class="page">';
	$config['num_tag_close'] = '</li>';
	$ci->pagination->initialize($config);
	return $ci->pagination->create_links();
}


/*### options ###*/
function get_option($option_name)
{
	$ci=get_instance();
	$ci->db->select('option_value');
	$ci->db->from('options');
	$ci->db->where('option_name', $option_name);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$result = $query->result();
		return $result[0]->option_value;
	}
}

function update_option($option_name, $option_value)
{
	$ci=get_instance();
	$ci->db->select('option_name');
	$ci->db->from('options');
	$ci->db->where('option_name', $option_name);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$ci->db->where('option_name', $option_name);
		$ci->db->update('options', array('option_value'=>$option_value));
	}
	else
	{
		$ci->db->insert('options', array('option_name'=>$option_name, 'option_value'=>$option_value));
	}
}


/*### media ###*/
/*# get media path by media_path #*/
function get_media_id($media_path)
{
	$ci=get_instance();
	$ci->db->select('media_id');
	$ci->db->from('media');
	$ci->db->where('media_path', $media_path);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$row=$query->row();
		return $row->media_id;
	}
}

function get_media_path($media_id, $size=NULL)
{
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
}

function get_media_short_path($media_id)
{
	$ci=get_instance();
	$ci->db->select('media_path');
	$ci->db->from('media');
	$ci->db->where('media_id', $media_id);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$result = $query->result();
		return $result[0]->media_path;
	}
}

function get_adds($type='sidebar', $limit=NULL)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('adds');
	$ci->db->where('adds_type', $type);
	$ci->db->order_by('adds_id', 'DESC');
	
	if($limit){ $ci->db->limit($limit); }
	
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		return $query->result();
	}
}


/*### homeslider ###*/
function get_homeslider()
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('homeslider');	
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		return $query->result();
	}
}