<?php
function get_review($product_id)
{
	$ci = get_instance();
	$ci->db->select('*');
	$ci->db->from('review');
	$ci->db->where('product_id', $product_id);
	$ci->db->where('review_active', 1);

	$ci->db->order_by('review.review_id', 'DESC');
	$query = $ci->db->get();
	if ($query->num_rows() > 0) {
		return $query->result();
	}
}
function rating_counter($product_id,$rating){

	$ci = get_instance();

	//$ci->db->count('rating');
	$ci->db->select('count(review_id) as rating');
	$ci->db->from('review');
	$ci->db->where('product_id', $product_id);
	$ci->db->where('rating', $rating);
	$ci->db->where('review_active', 1);
	$query = $ci->db->get();
	if ($query->num_rows() > 0) {
		return $query->row();
	}
}

function get_total_review($product_id){

	$ci = get_instance();
	$ci->db->where('product_id', $product_id);
	$ci->db->where('review_active', 1);

	$ci->db->from("review");
	$result= $ci->db->count_all_results();
		return $result;

}


