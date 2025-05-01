<?php 

class MY_Controller extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
        $this->load->library('session');
	}

	public function isLoggedIn()
	{
		if($this->session->userdata('logged_in') === true) {
			redirect('dashboard', 'refresh');
		}
	}	

	public function isNotLoggedIn()
	{
		if($this->session->userdata('logged_in') !== true) {
			redirect('login', 'refresh');
		}
	}

}