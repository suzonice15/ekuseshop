<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class ClassRegSectionRelation extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	function DataFromClassRelation($query)
	{
		return $this->db->query($query)->result_array();
	}


}



