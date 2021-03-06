<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	function __construct() {
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->model('Dashboard_model');
        $this->load->model('sub_categories_model');
	    $this->load->model('cakes_model');
        $this->load->model('products_model');
		$this->load->library('Datatables');
        if(!$this->session->userdata('userid')){
            redirect(base_url().'index.php/login');
        }
        //load form validation library
        $this->load->library('form_validation');
        
        //load file helper
        $this->load->helper('file');

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

       public function Add_new(){
        $data['menu_links'] = $this->get_menu_links();
        $data['category'] =$this->sub_categories_model->get_category();
        $data['all_flaours'] = $this->get_all_flaours();
        $this->load->view('common/header',$data);
        $this->load->view('products/add');
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

        // print_r($data['cake_details']); die;
		$this->load->view('common/header',$data);
		$this->load->view('products/edit',$data);
		$this->load->view('common/footer');
	}

    //Get all cakes
	public function get_all_cakes(){

        $this->datatables->select('id,product_image,name');
        $this->datatables->from('o-cakes_products');
        
        $result = $this->datatables->generate();
        echo $result;
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
        $this->datatables->select('p.id,p.cat_id,p.sub_id,p.name,p.product_image,p.product_description,c.cat_name,s.sub_cat_name,p.display_on_homepage');
        $this->datatables->join('o-cakes_category c', 'p.cat_id = c.cat_id', 'left' );
        $this->datatables->join('o-cakes_sub_cat s', 'p.sub_id = s.sub_cat_id', 'left' );
        $this->datatables->from('o-cakes_products p');
        $this->datatables->where('p.status',1);
        $result = $this->datatables->generate();
        echo $result;
    }
    //get product details
    public function get_product_details($id){
    	$result = $this->products_model->get_cake_details($id);  
    	return $result;  	
    }

    public function get_sub_cat_details(){
        $cat_id = $this->input->post('cat_id');
        $result = $this->products_model->get_all_sub_cat($cat_id);

        echo json_encode($result);
    }

    public function AddEdit(){
    	$data = array();
        $postdata = $this->input->post();

        // print_r($postdata['flavours']); die;
        $cnt = $postdata['cnt'];
        $quantity_array =array();

        for($i=1;$i<=$cnt;$i++){
            if(isset($postdata['quantity'.$i])){
                $quantity_array[$postdata['quantity'.$i]]=$postdata['price'.$i];
            }
        }
        // print_r($quantity_array); die;
        // echo "<br>"; die;
        // print_r($postdata); die;
        // print_r($_FILES);
        $flavours =implode(",", $postdata['flavours']);
        //data from the product page for add and edit
        $update_array= array(
            'cat_id'=>$postdata['cat_id'],
            'sub_cat_id'=>$postdata['sub_cat_id'],
            'cake_name'=>$postdata['cake_name'],
            'product_description'=>$postdata['product_description'],
            'flavours' =>$flavours
        );
        
        // print_r($update_array); die;

        if(($_FILES['product_image']['name']) != ""){
            $config['upload_path']   = "./assets/images/cakes/";
            $config['allowed_types'] = 'gif|jpg|png';
      //       $config['max_size']      = 1024;
      //       $config['max_width']     = '1024';
    		// $config['max_height']    = '768';
            $this->load->library('upload', $config);
            //upload file to directory
            if($this->upload->do_upload('product_image')){
                $uploadData = $this->upload->data();
                $uploadedFile = $uploadData['file_name'];
                $data['success_msg'] = 'File has been uploaded successfully.';
                $update_array['product_image']=$uploadData['file_name'];
                // print_r($data);
            }else{
                $data['file_error'] = $this->upload->display_errors();
                print_r($data);
            }

        }else{
            $update_array['product_image']=$postdata['prod_img'];
        }

        if(isset($postdata["id"])){
            $result = $this->products_model->update_cake_details($postdata['id'],$update_array,$quantity_array);
        }else{
            $result = $this->products_model->insert_cake_details($update_array,$quantity_array);
        }
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

    //display on homepage
      public function display_on_homepage(){
        $id= $this->input->post('id');
        $value= $this->input->post('value');
        $result = $this->products_model->display_on_homepage($id,$value);
        return $result;
    }

     public function get_all_flavours(){
        $this->datatables->select('*');        
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
        $update_array = array('flavour_name' => $postdata['flavour_name'],'large_price'=>$postdata['large_price'],'flavour_price'=>$postdata['flavour_price']);
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
