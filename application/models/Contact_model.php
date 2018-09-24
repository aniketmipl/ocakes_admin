<?php

class Contact_model extends CI_Model{
	public function __construct()
    {
    	parent::__construct();
    }


    public function edit_product($p_id,$p_name,$p_keywords,$p_alt_name){

        $query = $this->db->set('search_keywords ', $p_keywords)
                          ->set('alternatename ', $p_alt_name)
                          ->where('products_id',$p_id)
                          ->update('products_description');

        return $query;
    }

    public function insert_contact_details($data){
      
        // print_r($product_price); die;
        $contact = $this->db->insert('o-cakes_contact',$data);
        echo $contact;
      }

    public function update_contact_details($id,$data){

              $this->db->where('id', $id);
              $contact_details = $this->db->update('o-cakes_contact', $data);

      echo $contact_details;
    }

   public function get_contact_details($id){
    $query =$this->db->select('*')
                     ->from('o-cakes_contact')
                     ->where('id',$id)
                     ->get()
                     ->result_array();
    return $query;
    }

    public function get_all_flaours(){
      $query = $this->db->get('o-cakes_flavour_master')->result_array();
      return $query;
    }

    public function get_quantity_price($product_id){

      $query = $this->db->get_where('o-cakes_price_master', array('product_id' => $product_id))->result_array();

      // $query = $this->db->get('o-cakes_price_master')->result_array();
      return $query;
    }

}