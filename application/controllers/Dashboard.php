<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
 function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Dashboard_model');
        if(!$this->session->userdata('userid')){
        	redirect(base_url().'index.php/login');
        }
    }
	public function index()
	{
		// $data['active_users'] = $this->get_active_users();
		// $data['total_users'] =$this->get_db_details();
		// $data['total_groups'] =$this->get_total_group();
		$data['menu_links'] =$this->get_menu_links();

		$this->load->view('common/header',$data);
		// $this->load->view('dashboard/view',$data);
		$this->load->view('common/footer');
	}


	public function get_db_details(){
		$result = $this->Dashboard_model->get_all();
		return $result;
	}

	public function get_active_users(){
		$result = $this->Dashboard_model->get_active_users();
		echo $result ;
		return $result;
		// print_r($result);
	}

	public function get_total_group(){
		$result = $this->Dashboard_model->get_total_group();
		$total_group = $result->num_rows();
		return $total_group;
	}

	public function get_menu_links(){
		$result = $this->Dashboard_model->get_categories();
		return $result;
	}
}
