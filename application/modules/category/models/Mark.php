<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mark extends CI_Model {

   public function __construct() {
        parent::__construct();
    }

	function markDelete($subject_id,$examSession_id)
	{
		$this->db->where(array('subject_id'=>$subject_id,'exam_session_id'=>$examSession_id));
		 $this->db->delete('marks');
		 if($this->db->affected_rows()>0){
		 	return true;
		 }
		 else{
		 	return false;
		 }
	}
	
	
}
	

   
