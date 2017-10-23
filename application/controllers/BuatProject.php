<?php 


class BuatProject extends CI_Controller
{
	public function index(){
		
		if ($this->session->userdata('role') == "pendonor") {
		$this->load->view('membuatPenawaran');
		}
		elseif ($this->session->userdata('role') == "penerima") {
                $anaknya = $this->AnakModel->getAnak($this->session->userdata('username'));
                $this->load->view('membuatPermintaan', array('anaknya'=>$anaknya));
		}
		else{
                    echo 'Please do login!';
		}

	}

	function idProject(){
                $this->load->helper('string');
                return random_string('alnum',5);
	}

	public function addFotoDulu()
	{
		 		//$config['upload_path']          = './../img/';
		$config['upload_path']          = 'asset/img/';
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = 10000000;
                $config['max_width']            = 10000000;
                $config['max_height']           = 100000000;
                $config['overwrite']		= TRUE;
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('foto_project'))
                {
                    
                	$this->tambahProject();	
                }
                else
                {
                    $this->tambahProject();
                }
	}
        
        public function aksiPenawaran(){
		$this->form_validation->set_rules('nama_project','Judul Penawaran','required');
		$this->form_validation->set_rules('deskripsi_project','Deskripsi Penawaran','required|max_length[100]');
                $this->form_validation->set_rules('jumlah_botol','Banyak Botol yg Ditawarkan','required|numeric');
		$this->form_validation->set_rules('tanggal_akhir','Tanggal Kadaluarsa','required');
                  
 		if($this->form_validation->run() != false){
			$this->addFotoDulu();
		}else{
                        $this->load->view('error_membuatPenawaran', array('errornya'=>validation_errors()));
		}
	}

        public function aksiPermintaan(){
		$this->form_validation->set_rules('nama_project','Judul Permintaan','required');
		$this->form_validation->set_rules('deskripsi_project','Deskripsi Permintaan','required|max_length[100]');
                $this->form_validation->set_rules('jumlah_botol','Banyak Botol Yang Dibutuhkan','required|numeric');
                $this->form_validation->set_rules('tanggal_akhir','Tanggal Maksimal Butuh','required');
                  
 		if($this->form_validation->run() != false){
			$this->addFotoDulu();
		}else{
                        $this->load->view('error_membuatPermintaan', array('errornya'=>validation_errors()));
		}
	}
        
	public function tambahProject()
	{
                $anaknya = $this->input->post('untuk_anak');
		$foto_project = $this->upload->data();
		if ($foto_project['file_name']== NULL) {
                        if($anaknya!=NULL){
                            $inidiaanak = $this->AnakModel->getAnakById($anaknya);
                            $foto= $inidiaanak[0]['foto_anak'];
                        }
                        else {
                            $foto = 'default.jpg';
                        }
			
		}
		else{
			$foto = $foto_project['file_name'];
		}
                if($this->session->userdata('role')=='pendonor'){
                    $tipe_project = 'penawaran';
                }
                else{
                    $tipe_project = 'permintaan';
                }	
                $data = array(
			'owner' => $this->session->userdata('username'),
			'id_project' => $this->idProject(),
			'nama_project' => $this->input->post('nama_project'),
			'tipe_project' => $tipe_project,
			'deskripsi_project' => $this->input->post('deskripsi_project'),
			'jumlah_susu' => $this->input->post('jumlah_botol'),
                        'untuk_anak'=> $anaknya,
			'foto_project' => $foto,
			'tanggal_akhir' => date("Y-m-d", strtotime($this->input->post('tanggal_akhir'))),
			'tanggal_buat' => date("Y-m-d")
			);
		$this->BuatProjectModel->addProject($data);
		$this->index();
	}
}

 ?>