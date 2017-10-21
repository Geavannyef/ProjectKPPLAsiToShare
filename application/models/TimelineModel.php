<?php 

/**
* 
*/
class TimelineModel extends CI_Model
{
	
	
	function getPermintaan(){
		$this->db->select('*');
		$this->db->where('tipe_project', 'permintaan');
		$this->db->from('project');
		$query = $this->db->get();
		return $query->result_array();
	}

	function getPenawaran(){
		$this->db->select('*');
		$this->db->where('tipe_project', 'penawaran');
		$this->db->from('project');
		$query = $this->db->get();
		return $query->result_array();
	}
}

 ?>