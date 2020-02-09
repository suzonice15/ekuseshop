<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Attendance extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


public function attendanceDataDelete($date, $id)
{

$this->db->where('attendance_date', $date);
$this->db->where('classreg_section_id', $id);
$this->db->delete('attendances');

}
	public  function getAttendace($classreg_section_id,$student_id,$attendance_date)
	{
		$this->db->where(array('classreg_section_id'=>$classreg_section_id,'student_id'=>$student_id,'attendance_date'=>$attendance_date));
		$studentAttendace= $this->db->get('attendances')->row();
		return $studentAttendace;
	}


}



