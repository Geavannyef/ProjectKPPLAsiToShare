<?php 

/**
* 
*/
class Timeline extends CI_Controller
{
	
	

	public function index(){
		$penawaran = $this->TimelineModel->getPenawaran();
		$permintaan = $this->TimelineModel->getPermintaan();

		if ($this->session->userdata('role') == "pendonor") {
		$this->load->view('rumah-body', array('project'=>$permintaan, 'kategori'=>'Permintaan'));
		}
		elseif ($this->session->userdata('role') == "penerima") {
		$this->load->view('rumah-body', array('project'=>$penawaran, 'kategori'=>'Penawaran'));
		}
		elseif ($this->session->userdata('role') == "admin"){
		echo "Maaf halaman admin belum ada";
		}
                else{
                    echo 'Please do login!';    
                }
	}
}

 ?>