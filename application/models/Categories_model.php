<?php

class Categories_model extends CI_Model{
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

    //Add category
    public function insert_category($data){
        $query = $this->db->insert('o-cakes_category', $data);
        echo $query;
    }

    public function get_category($id){
        $query = $this->db->select('*')
                         ->from('o-cakes_category')
                         ->where('cat_id',$id)
                         ->get()
                         ->result_array();
        return $query;
    }

    public function update_category($id,$data){
        $query = $this->db->where('cat_id', $id)
                          ->update('o-cakes_category', $data);
        echo $query;
    }

}