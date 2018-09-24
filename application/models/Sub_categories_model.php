<?php

class Sub_categories_model extends CI_Model{
	public function __construct()
    {
    	parent::__construct();
    }

   
    //Add category
    public function insert_subcategory($data){
        $query = $this->db->insert('o-cakes_sub_cat', $data);
        echo $query;
    }

    public function get_category(){
        $query = $this->db->select('*')
                         ->from('o-cakes_category')
                         ->get()
                         ->result_array();
        return $query;
    }

    public function get_subcat_details($id){
    $query = $this->db->select('*')
                     ->from('o-cakes_sub_cat')
                     ->where('sub_cat_id',$id)
                     ->get()
                     ->result_array();
    return $query;
    }


    public function update_subcategory($id,$data){
        $query = $this->db->where('sub_cat_id', $id)
                          ->update('o-cakes_sub_cat', $data);
        echo $query;
    }

}