<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function index()
	{
                if ($this->session->userdata('role') != NULL) {
                    redirect(base_url(Timeline));}
		else{
		$this->load->view('home');
		}
	}
    
   
      
}