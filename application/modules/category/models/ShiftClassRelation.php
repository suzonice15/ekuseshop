<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ShiftClassRelation extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function DataFromShiftRelation($query)
	{
		return $this->db->query($query)->result_array();
	}


}



