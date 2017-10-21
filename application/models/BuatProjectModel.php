<?php 
/**
* 
*/
class BuatProjectModel extends CI_Model
{
//	public function getIdProject()
//	{
//		$this->db->select('id_project');
//		$this->db->where('owner', $this->session->userdata('username'));
//		$this->db->from('project');
//		$query = $this->db->get();
//		return $query->result_array();	
//	}

	public function addProject($data){
		$this->db->insert('project', $data);
	}
        
        public function getTotalRow($nama_project, $tipe_project,$deskripsi_project,$jumlah_botol,$tanggal_akhir,$untuk_anak){
            $this->db->where('nama_project',$nama_project);
            $this->db->where('tipe_project', $tipe_project);
            $this->db->where('deskripsi_project', $deskripsi_project);
            $this->db->where('jumlah_susu', $jumlah_botol);
            $this->db->where('tanggal_akhir', $tanggal_akhir);
            $this->db->where('untuk_anak', $untuk_anak);
            $this->db->from('project');
            $query= $this->db->get();
            return $query->num_rows();
        }
        
        public function deleteRow($nama_project, $tipe_project,$deskripsi_project,$jumlah_botol,$tanggal_akhir){
            $this->db->where('nama_project',$nama_project);
            $this->db->where('tipe_project', $tipe_project);
            $this->db->where('deskripsi_project', $deskripsi_project);
            $this->db->where('jumlah_susu', $jumlah_botol);
            $this->db->where('tanggal_akhir', $tanggal_akhir);
            $query= $this->db->delete('project');
        }
}

 ?>