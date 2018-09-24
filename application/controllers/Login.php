<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	 function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
		$this->load->library('session');
        // $this->load->helper('url','form');
    }
	public function index($msg = "")
	{
		$this->load->view('login/header');
		$data["msg"] = $msg;
		$this->load->view('login/login',$data);
	}
	public function validate()
	{
		$username = $this->input->post('username');
		$tmp_pass= $this->input->post('password');
		$password = md5($tmp_pass);
		$result = $this->Login_model->validate($username,$password);
		if(isset($result["error"])){
			$msg="<font color=red>Invalid username/password</font>";
			$this->load->view('login/header');
			$this->index($msg);
		}
		else
		{
			$this->session->set_userdata($result);
        	redirect(base_url().'index.php/Products'); 

		}
	}
	public function do_logout(){

		$this->session->sess_destroy();
		redirect(base_url().'index.php/Login'); 
	}
}
