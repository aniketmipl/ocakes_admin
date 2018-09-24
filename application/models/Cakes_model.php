<?php

class Cakes_model extends CI_Model{
	public function __construct()
    {
    	parent::__construct();
    }

    public function get_all_products(){
    	$query = $this->db->select('products_id,search_keywords,alternatename')
    					->from('products_description p')
    					->where('products_viewed >',0)
    					->get()
    					->result();
    	return $query;
    }

    public function get_token($id){
        $query = $this->db->select('token')
                         ->from('MstUsers')
                         ->where('UserID',$id)
                         ->get()
                         ->result();
        return $query;
    }

    public function edit_product($p_id,$p_name,$p_keywords,$p_alt_name){

        $query = $this->db->set('search_keywords ', $p_keywords)
                          ->set('alternatename ', $p_alt_name)
                          ->where('products_id',$p_id)
                          ->update('products_description');

        return $query;
    }

    public function get_cake_details($id){
       $query = $this->db->select('p_id,product_image,name,pastery_price,small_price,large_price')
                         ->from('o-cakes_products')
                         ->where('p_id',$id)
                         ->get()
                         ->result_array();
        return $query;
    }

    public function update_cake_details($id,$data){
        $query = $this->db->where('p_id', $id)
                            ->update('o-cakes_products', $data);
        echo $query;
    }

    public function insert_cake_details($data){
        $query = $this->db->insert('o-cakes_products', $data);
        echo $query;
    }



    public function get_delivery_charge(){
        $query = $this->db->select('delivery_charges')
                        ->from('o-cakes_delivery_charges')
                        ->where('id',1)
                        ->get()
                        ->result();
        return $query;
    }

    public function update_delivery_charges($update_array){
        $query = $this->db->where('id',1)
                            ->update('o-cakes_delivery_charges', $update_array);
        echo $query;
    }
}