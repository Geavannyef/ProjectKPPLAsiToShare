<?php 
class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('LoginModel');
                $this->load->library('form_validation');
	}
	
	function index() {
		$this->load->view('login-body', array('statuslogin'=>'active', 
                                                      'statusregister'=>''));
	}
        
        function indexregister(){
                $this->load->view('login-body', array('statuslogin'=>'', 
                                                      'statusregister'=>'active'));
        }
                
        function uploadKtp(){
            $config['upload_path']          = 'asset/img/';
                $config['allowed_types']        = 'jpg|png|jpeg';
                $config['max_size']             = 10000000;
                $config['max_width']            = 10000000;
                $config['max_height']           = 100000000;
                $config['overwrite']			= TRUE;
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('foto_ktp'))
                {
                    echo 'Silahkan masukkan foto ktp terlebih dahulu';
                }
                else
                {
                   $this->register();	
                }
        }
        
    /*    function aksi(){
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
                $this->form_validation->set_rules('no_hp','Nomer Hp','required');
		$this->form_validation->set_rules('no_ktp','Nomer KTP','required');
                $this->form_validation->set_rules('foto_ktp','Upload KTP','required');
                $this->form_validation->set_rules('role','Berperan Sebagai','required');
                  
 
		if($this->form_validation->run() != false){
			echo "Form validation oke";
		}else{
			$this->load->view('login_body');
		}
	}*/
        
	function register(){
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
                        'no_ktp' => $this->input->post('no_ktp'),
                        'no_hp' => $this->input->post('no_hp'),
			'role' => $this->input->post('role'),
			'foto_ktp' => $this->upload->data()['file_name']
		);
		$this->LoginModel->addAcc($data);
                redirect(base_url('Home'));   }
	
	function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('pass');
		$data = $this->LoginModel->getData($username, $password);
		
		$isLogin = $this->LoginModel->login_authen($username, $password);
		$iyalogin = $isLogin->result_array();

		if ($isLogin->num_rows() > 0 && $iyalogin[0]['role']==2) {
			$data_session = array(
							'username' => $username,
							'role' => "pendonor");
			$this->session->set_userdata($data_session);
			redirect(base_url("Timeline")); }
		elseif ($isLogin->num_rows() > 0 && $iyalogin[0]['role']==3) {
			$data_session = array(
							'username' => $username,
							'role' => "penerima");
			$this->session->set_userdata($data_session);
			redirect(base_url('Timeline'));}
                elseif ($isLogin->num_rows() > 0 && $iyalogin[0]['role']==1) {
                    $data_session = array(
							'username' => $username,
							'role' => "admin");
			$this->session->set_userdata($data_session);
                echo "ini admin";
		}
		else{
			echo "username dan password salah";
		}
	}

	function logout(){
                $this->session->unset_userdata('username');
                $this->session->unset_userdata('role');
                 $this->session->unset_userdata('password');
		$this->session->sess_destroy();
		redirect(base_url('Home'));}

}
?>