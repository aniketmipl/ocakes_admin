<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
	function __construct() {
	    parent::__construct();
	    $this->load->helper('url','form');
	    $this->load->model('Dashboard_model');
	    $this->load->model('cakes_model');
        $this->load->model('categories_model');
		$this->load->library('Datatables');

        //load form validation library
        $this->load->library('form_validation');
        
        //load file helper
        $this->load->helper('file');
        if(!$this->session->userdata('userid')){
            redirect(base_url().'index.php/login');
        }

	}

    //Add_new category page view
    public function Add_new(){
        $data['menu_links'] = $this->get_menu_links();
        $this->load->view('common/header',$data);
        $this->load->view('categories/add');
        $this->load->view('common/footer');
    }


	public function index(){
		$data['menu_links'] = $this->get_menu_links();
		$this->load->view('common/header',$data);
        $this->load->view('products/view');
		
        // $this->load->view('cakes/view');
		
        $this->load->view('common/footer');
	}

    //Add Page
    public function add(){
        $data['menu_links'] = $this->get_menu_links();
        $this->load->view('common/header',$data);
        $this->load->view('cakes/add');
        $this->load->view('common/footer');
    }

    //Edit page
	public function edit_cat(){
		$data['menu_links'] =$this->get_menu_links();
		$id =  $this->uri->segment(3);
		$data['id'] = $this->uri->segment(3);
		$data['cat_details'] = $this->get_cat_details($id);
        // print_r($data['cat_details']); die;
		$this->load->view('common/header',$data);
		$this->load->view('categories/edit',$data);
		$this->load->view('common/footer');
	}

    public function get_cat_details($id){
        $result = $this->categories_model->get_category($id);  
        return $result;     
    }


   
    //get product details
    public function get_product_details($id){
    	$result = $this->categories_model->get_cake_details($id);  
    	return $result;  	
    }

    public function AddEdit(){
    	$data = array();
        $postdata = $this->input->post();

        $data_array= array(
            'cat_name'=>$postdata['cat_name']
        );

        if(isset($postdata["id"])){
            $result = $this->categories_model->update_category($postdata['id'],$data_array);
            echo $result;
        }else{
            $result = $this->categories_model->insert_category($data_array);
            echo $result;
        }
    }
    
    public function get_menu_links(){
		$result = $this->Dashboard_model->get_categories();
		return $result;
	}
}
