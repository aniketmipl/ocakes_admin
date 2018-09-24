<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends CI_Controller {
	function __construct() {
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->model('Dashboard_model');
        $this->load->model('sub_categories_model');
	    $this->load->model('cakes_model');
        $this->load->model('products_model');
		$this->load->library('Datatables');

        //load form validation library
        $this->load->library('form_validation');
        
        //load file helper
        $this->load->helper('file');

        if(!$this->session->userdata('userid')){
            redirect(base_url().'index.php/login');
        }

	}
	public function index(){
		$data['menu_links'] = $this->get_menu_links();
        $data['terms'] =$this->products_model->get_terms();
		$this->load->view('common/header',$data);
        $this->load->view('terms/view');		
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
	public function edit(){
		$data['menu_links'] =$this->get_menu_links();
		$id =  $this->uri->segment(3);
		$data['id'] = $this->uri->segment(3);
        $data['category'] =$this->sub_categories_model->get_category();
		$data['cake_details'] = $this->get_product_details($id);
        $data['all_flaours'] = $this->get_all_flaours();
        $data['get_quantity_price'] = $this->get_quantity_price($id);

        // print_r($data['get_quantity_price']); die;
		$this->load->view('common/header',$data);
		$this->load->view('products/edit',$data);
		$this->load->view('common/footer');
	}
    public function AddEdit(){
    	$data = array();
        $postdata = $this->input->post();

        // print_r($postdata); die;
        $update_array= array(
            'terms_desc'=>$postdata['terms']
        );
        // print_r($update_array); die;
     
            $result = $this->products_model->edit_terms($update_array);
            echo $result;
     
    }

    public function get_all_flaours(){
        $result = $this->products_model->get_all_flaours();
        return $result;
    }
    
    public function get_menu_links(){
		$result = $this->Dashboard_model->get_categories();
		return $result;
	}

    public function get_quantity_price($id){
        $result = $this->products_model->get_quantity_price($id);
        return $result;
    }
    public function del_product(){
        $id= $this->input->post('id');
        $result = $this->products_model->del_product($id);
        return $result;
    }

     public function get_all_flavours(){
        $this->datatables->select('id,flavour_name');        
        $this->datatables->from('o-cakes_flavour_master');
        $result = $this->datatables->generate();
        echo $result;
    }

    public function edit_flavour(){
        $id =  $this->uri->segment(3);
        $data['menu_links'] = $this->get_menu_links();
        $data['flavours'] = $this->products_model->edit_flavour($id);

        $this->load->view('common/header',$data);
        $this->load->view('flavours/edit',$data);
        $this->load->view('common/footer');
        
    }

    public function delete_flavour(){
        $del_product = $this->uri->segment(3);
    }

    public function AddEdit_flavour(){

        $postdata = $this->input->post();
        $id = @$postdata['id'];
        $update_array = array('flavour_name' => $postdata['flavour_name']);
        if(isset($id)){
            $id = $postdata['id'];
            $flavour_name = $postdata['flavour_name'];
            $result = $this->products_model->edit_save_flavour($id,$update_array);
            echo $result;
        }else{
            $flavour_name = $postdata['flavour_name'];
            $result = $this->products_model->insert_flavour($update_array);
            echo $result;
        }

    }

    public function Add_new_flavours(){
        $data['menu_links'] = $this->get_menu_links();
        $this->load->view('common/header',$data);
        $this->load->view('flavours/add',$data);
        $this->load->view('common/footer');
    }


  
}
