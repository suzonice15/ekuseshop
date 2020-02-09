<?php
Class OrderModel extends CI_Model
{
	
	function count_all()
 {
  $query = $this->db->get("media");
  return $query->num_rows();
 }



 function count_all_by_search($product)
 {

  $this->db->like('media_title',$product ,'both');
  $query = $this->db->get("media");
  return $query->num_rows();
 }


 function fetch_products($limit, $start)
 {
  date_default_timezone_set("Asia/Dhaka");

  $output = '';
  $this->db->select("*");
  $this->db->from("media");
  $this->db->order_by("media_id", "DESC");
  $this->db->limit($limit, $start);
  $products = $this->db->get()->result();
  $output .= '<table id="example1" class="table table-bordered table-striped">
										<thead>
										
				<th width="5%">Sl</th>
				<th width="5%"><input type="checkbox" id="checkAll"></th>
				<th width="5%">Picture</th>
				<th width="20%">Media Name </th>
				<th width="30%">Url </th>
				<th width="10%">Created Date </th>
			
										</thead>
										<tbody>';
  $i=0;
 $i= $start+$i;
  foreach ($products as $med) {
  $created_time=date('l-d-F -Y H:i:s',strtotime($med->created_time));

   //$featured_image = get_product_meta($prod->product_id, 'featured_image');
  // $featured_image = get_media_path($featured_image);
  $link = base_url().$med->media_path;


   $output .= '<tr>
		<td>'.++$i.'</td>
        <td><input type="checkbox" id="'.$med->media_id.'" class="checkAll" value="'.$med->media_id.'"></td>
        <td>
		<img src="'.$med->media_path.'" width="50" height="50"/>
		</td>
        <td>'. $med->media_title.'</td>
        <td> <input id="url_'.$med->media_id.'"  style="width: 300px;display: inherit; class="form-control" value="'.$link.'"/>
			<button style="margin-left: 7px;"  id="'.$med->media_id .'" class="btn btn-success selectAllUrl">Copy text</button>

		</td>
		<td>'. $created_time.'</td>

    </tr>';

  }

  $output .= '</tbody></table>';
  return $output;


 }



 function fetch_product_by_search($limit, $start,$product)
 {


  $output = '';
  $this->db->select("*");
  $this->db->like('media_title',$product ,'both');
  $this->db->from("media");
  $this->db->order_by("media_id", "DESC");
  $this->db->limit($limit, $start);
  $products = $this->db->get()->result();
  $output .= '<table id="example1" class="table table-bordered table-striped">
										<thead>
										
				<th width="5%">Sl</th>
				<th width="5%"><input type="checkbox" id="checkAll"></th>
				<th width="5%">Picture</th>
				<th width="20%">Media Name </th>
				<th width="30%">Url </th>
				<th width="10%">Created Date </th>
			
										</thead>
										<tbody>';
  $i=0;
  $i= $start+$i;
  foreach ($products as $med) {
   $created_time=date('l-d-F -Y H:i:s',strtotime($med->created_time));

   //$featured_image = get_product_meta($prod->product_id, 'featured_image');
   // $featured_image = get_media_path($featured_image);
//$link = base_url() . 'product/' . $prod->product_name;


   $output .= '<tr>
		<td>'.++$i.'</td>
        <td><input type="checkbox" id="'.$med->media_id.'" class="checkAll" value="'.$med->media_id.'"></td>
        <td>
		<img src="'.$med->media_path.'" width="50" height="50"/>
		</td>
        <td>'. $med->media_title.'</td>
        <td> <input id="url_'.$med->media_id.'"  style="width: 300px;display: inherit; class="form-control" value="'.base_url(). $med->media_path.'"/>
			<button style="margin-left: 7px;"  id="'.$med->media_id .'" class="btn btn-success selectAllUrl">Copy text</button>

		</td>
		<td>'. $created_time.'</td>

    </tr>';

  }

  $output .= '</tbody></table>';
  return $output;


 }




}