<?php
class LoginModel extends CI_Model {


	function login_authen($username, $password)
	{
		$this->db->select('*');
		$this->db->where('username', $username); //ngecel apakah usernamenya ada di database
		$this->db->where('password', $password); 
		$this->db->from('akun');
		$query = $this->db->get();
		return $query;
	}

	function addAcc($data){
		$this->db->insert('akun', $data);
	}

        function getTotalRowAcc($username, $password, $nama, $alamat, $email, $no_ktp, $no_hp, $role){
            $this->db->select('*');
            $this->db->where('username', $username);
            $this->db->where('password',$password);
            $this->db->where('nama' , $nama);
            $this->db->where('alamat',$alamat);
            $this->db->where('email', $email);
            $this->db->where( 'no_ktp',$no_ktp);
            $this->db->where('no_hp', $no_hp);
            $this->db->where('role',$role);
            $query = $this->db->get('akun');
            return $query->num_rows();
        }

}
?>
