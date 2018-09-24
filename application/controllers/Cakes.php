<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cakes extends CI_Controller {
	function __construct() {
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->model('Dashboard_model');
	    $this->load->model('cakes_model');
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
		$this->load->view('cakes/view');
		$this->load->view('common/footer');
	}

    public function add(){
        $data['menu_links'] = $this->get_menu_links();
        $this->load->view('common/header',$data);
        $this->load->view('cakes/add');
        $this->load->view('common/footer');
    }


	public function edit(){
		$data['menu_links'] =$this->get_menu_links();
		$id =  $this->uri->segment(3);
		$data['id'] = $this->uri->segment(3);
		$data['cake_details'] = $this->get_product_details($id);
		$this->load->view('common/header',$data);
		$this->load->view('cakes/edit',$data);
		$this->load->view('common/footer');
	}
	public function get_all_cakes(){

        $this->datatables->select('p_id,product_image,name,pastery_price,small_price,large_price');
        $this->datatables->from('o-cakes_products');
        $this->datatables->where('cat_id',1);
        $result = $this->datatables->generate();
        echo $result;
    }
    public function get_product_details($id){
    	$result = $this->cakes_model->get_cake_details($id);  
    	return $result;  	
    }

    public function edit_save(){
    	$data = array();
        $postdata = $this->input->post();
        // print_r($postdata);
        //upload configuration
          $update_array= array(
            'name'=>$postdata['name'],
            'pastery_price'=>$postdata['pastry_price'],
            'small_price'=>$postdata['small_price'],
            'large_price'=>$postdata['large_price']
        );

        if(isset($_FILES['file'])){
            $config['upload_path']   = "./assets/images/cakes/";
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = 1024;
            $config['max_width']     = '1024';
    		$config['max_height']    = '768';
            $this->load->library('upload', $config);
            //upload file to directory
            if($this->upload->do_upload('file')){
                $uploadData = $this->upload->data();
                $uploadedFile = $uploadData['file_name'];
                $data['success_msg'] = 'File has been uploaded successfully.';
                $update_array['product_image']="assets/images/cakes/".$uploadData['file_name'];
                // print_r($data);
            }else{
                $data['file_error'] = $this->upload->display_errors();
                print_r($data);
            }

        }
        if($postdata["action"]=="edit"){
            $result = $this->cakes_model->update_cake_details($postdata['id'],$update_array);
        }else{
            $update_array['cat_id']=1;
            $update_array['sub_id']=1;
            $result = $this->cakes_model->insert_cake_details($update_array);
        }
    }


    public function delivery_charges(){
        $data['menu_links'] = $this->get_menu_links();
        $data['delivery_charges'] = $this->get_delivery_charge();

        $this->load->view('common/header',$data);
        $this->load->view('cakes/delivery_charges',$data);
        $this->load->view('common/footer');
    }
    public function get_delivery_charge(){
        $result = $this->cakes_model->get_delivery_charge();  
        return $result;     
    }

        public function edit_delivery_charge(){
        $data = array();
        $postdata = $this->input->post();
        //upload configuration
          $update_array= array(
            'delivery_charges'=>$postdata['charges']
        );
            $result = $this->cakes_model->update_delivery_charges($update_array);
    }
    
    public function get_menu_links(){
		$result = $this->Dashboard_model->get_categories();
		return $result;
	}
}
