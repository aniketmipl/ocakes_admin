<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategories extends CI_Controller {
	function __construct() {
	    parent::__construct();
	    $this->load->helper('url','form');
	    $this->load->model('Dashboard_model');
	    // $this->load->model('cakes_model');
        $this->load->model('sub_categories_model');
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
        $data['category'] = $this->get_category();

        // print_r($data['category']); die;
        $this->load->view('common/header',$data);
        $this->load->view('subcat/add');
        $this->load->view('common/footer');
    }

    //get all category
    public function get_category(){
        $result = $this->sub_categories_model->get_category();
        return $result;
    }

    //Edit page
	public function edit_sub_cat(){
		$data['menu_links'] =$this->get_menu_links();
		$id =  $this->uri->segment(3);
		$data['id'] = $this->uri->segment(3);
        $data['category'] = $this->get_category();
		$data['subcat_details'] = $this->get_subcat_details($id);
		$this->load->view('common/header',$data);
		$this->load->view('subcat/edit',$data);
		$this->load->view('common/footer');
	}

    public function get_subcat_details($id){
        $result = $this->sub_categories_model->get_subcat_details($id);  
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
            'cat_id'=>$postdata['cat_id'],
            'sub_cat_name' =>$postdata['sub_cat_name']
        );

        if(isset($postdata["sub_cat_id"])){
            $result = $this->sub_categories_model->update_subcategory($postdata['sub_cat_id'],$data_array);
            echo $result;
        }else{
            $result = $this->sub_categories_model->insert_subcategory($data_array);
            echo $result;
        }
    }
    
    public function get_menu_links(){
		$result = $this->Dashboard_model->get_categories();
		return $result;
	}
}
