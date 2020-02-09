<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MarkSheet extends CI_Model {

   public function __construct() {
        parent::__construct();
    }

	function getMark($subject_id,$examSession_id,$student_id)
	{
		$this->db->where(array('subject_id'=>$subject_id,'exam_session_id'=>$examSession_id,'student_id'=>$student_id));
		$subjectMark= $this->db->get('marks')->row();
		return $subjectMark;
	}
	
	
}
	

   
