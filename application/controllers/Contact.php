<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	function __construct() {
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->model('Dashboard_model');
        $this->load->model('sub_categories_model');
	    $this->load->model('cakes_model');
        $this->load->model('products_model');
        $this->load->model('Contact_model');
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
		$this->load->view('common/header',$data);		
        $this->load->view('contact/view');
        $this->load->view('common/footer');
	}

    //Add Page
    public function add(){
        $data['menu_links'] = $this->get_menu_links();
        $this->load->view('common/header',$data);
        $this->load->view('contact/add');
        $this->load->view('common/footer');
    }

       public function Add_new(){
        $data['menu_links'] = $this->get_menu_links();
        $data['category'] =$this->sub_categories_model->get_category();
        $data['all_flaours'] = $this->get_all_flaours();
        $this->load->view('common/header',$data);
        $this->load->view('products/add');
        $this->load->view('common/footer');
    }


    //Edit Contact page
	public function edit_contact(){
		$data['menu_links'] =$this->get_menu_links();
		$id =  $this->uri->segment(3);
        $data['contact_details'] = $this->get_contact_details($id);
        // print_r($data['get_quantity_price']); die;
		$this->load->view('common/header',$data);
		$this->load->view('contact/edit',$data);
		$this->load->view('common/footer');
	}

    //Get all contacts
	public function get_all_contacts(){

        $this->datatables->select('*');
        $this->datatables->from('o-cakes_contact');
        $result = $this->datatables->generate();
        echo $result;
    }

        //get Contact details
    public function get_contact_details($id){
        $result = $this->Contact_model->get_contact_details($id);  
        return $result;     
    }


    //Get all category
    public function get_category(){
        $this->datatables->select('cat_id,cat_name');
        $this->datatables->from('o-cakes_category');
        $this->datatables->where('cat_status',1);
        $result = $this->datatables->generate();
        echo $result;
    }
    //Get All sub category
    public function get_sub_category(){
        $this->datatables->select('s.cat_id,s.sub_cat_id,c.cat_name,s.sub_cat_name');
        $this->datatables->join( 'o-cakes_category c', 's.cat_id = c.cat_id', 'left' );
        $this->datatables->from('o-cakes_sub_cat s');
        $this->datatables->where('s.sub_cat_status',1);
        $result = $this->datatables->generate();
        echo $result;
    }

    //Get all products
    public function get_all_product(){
        $this->datatables->select('p.id,p.cat_id,p.sub_id,p.name,p.product_image,p.product_description,c.cat_name,s.sub_cat_name');
        $this->datatables->join('o-cakes_category c', 'p.cat_id = c.cat_id', 'left' );
        $this->datatables->join('o-cakes_sub_cat s', 'p.sub_id = s.sub_cat_id', 'left' );
        $this->datatables->from('o-cakes_products p');
        $this->datatables->where('p.status',1);
        $result = $this->datatables->generate();
        echo $result;
    }

    public function get_sub_cat_details(){
        $cat_id = $this->input->post('cat_id');
        $result = $this->products_model->get_all_sub_cat($cat_id);

        echo json_encode($result);
    }

    public function AddEdit(){
    	$data = array();
        $postdata = $this->input->post();
        $update_array= array(
            'area'=>$postdata['area'],
            'address'=>$postdata['address'],
            'phone'=>$postdata['phone_no']
        );
    
        if(isset($postdata["id"])){
            $result = $this->Contact_model->update_contact_details($postdata['id'],$update_array);
        }else{
            $result = $this->Contact_model->insert_contact_details($update_array);
        }
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
}
