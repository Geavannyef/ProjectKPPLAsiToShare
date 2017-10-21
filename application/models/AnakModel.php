<?php 

/**
* 
*/
class AnakModel extends CI_Model
{
    public function getAnak($ortu){
        $this->db->select('*');
        $this->db->where('orangtua', $ortu);
        $this->db->from('anak');
	$query = $this->db->get();
	return $query->result_array();
    }
    
     public function getAnakById($id){
        $this->db->select('*');
        $this->db->where('id_anak', $id);
        $this->db->from('anak');
	$query = $this->db->get();
	return $query->result_array();
    }

}

 ?>

