<?php

class Products_model extends CI_Model{
	public function __construct()
    {
    	parent::__construct();
    }

    public function get_all_sub_cat($id){
      $query = $this->db->select('sub_cat_id,sub_cat_name')
              ->from('o-cakes_sub_cat p')
              ->where('cat_id',$id)
              ->get()
              ->result_array();
      return $query;
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

    public function insert_cake_details($data,$quantity_array){
      $product_record = array(
            'cat_id'=>$data['cat_id'],
            'sub_id'=>$data['sub_cat_id'],
            'name'=>$data['cake_name'],
            'product_image'=>$data['product_image'],
            'product_description'=>$data['product_description'],
            'flavours'=>$data['flavours']
          );

      $product_record = $this->db->insert('o-cakes_products',$product_record);

      $product_id = $this->db->insert_id();

      foreach ($quantity_array as $weight => $price) {
        $product_price = array(
                        'product_id'=>$product_id,
                        'quantity'=>$weight,
                        'price'=>$price
                      );
        // print_r($product_price); die;
        $price_record = $this->db->insert('o-cakes_price_master',$product_price);
      }
      
      // print_r($product_id); die;
      // $product_price = array(
      //                   'product_id'=>$product_id,
      //                   'quantity'=>$data['quantity'],
      //                   'price'=>$data['price']
      //                 );
      // $price_record = $this->db->insert('o-cakes_price_master',$product_price);

      echo $product_record;
    }

    public function update_cake_details($id,$data,$quantity_array){
      // print_r($quantity_array);die;
      $product_record = array(
            'cat_id'=>$data['cat_id'],
            'sub_id'=>$data['sub_cat_id'],
            'name'=>$data['cake_name'],
            'product_image'=>$data['product_image'],
            'product_description'=>$data['product_description'],
            'flavours'=>$data['flavours']
          );
        

        $this->db->where('id', $id);
        $product_record = $this->db->update('o-cakes_products', $product_record);
        $get_quantity = $this->db->get_where('o-cakes_price_master', array('product_id' => $id))->result_array();
        $get_quantity_array = array();
        foreach ($get_quantity as $key => $value) {
          array_push($get_quantity_array, $value['quantity']);
        }
        // print_r($get_quantity_array);


        $this->db->delete('o-cakes_price_master', array('product_id' => $id)); 


        foreach ($quantity_array as $weight => $price) {

          $product_price = array(
                            'product_id'=>$id,
                            'quantity'=>$weight,
                            'price'=>$price
                          );
             $price = $this->db->insert('o-cakes_price_master', $product_price);
             

          // if (in_array($weight, $get_quantity_array))
          // {
          //     $product_price = array(
          //                   'product_id'=>$id,
          //                   'quantity'=>$weight,
          //                   'price'=>$price
          //                 );
          //     $price = $this->db->insert('o-cakes_price_master', $product_price);
          // }
          // else
          // {
          //    $product_price = array(
          //                   'product_id'=>$id,
          //                   'quantity'=>$weight,
          //                   'price'=>$price
          //                 );
          //    $price = $this->db->insert('o-cakes_price_master', $product_price);
          //   // echo "Match not found";
          // }
        }
      // echo  $this->db->affected_rows();
        // $num_rows = $this->db->affected_rows();
      // return $price->num_rows();
      echo $product_record;
    }

   public function get_cake_details($id){
    $query =$this->db->select('id,cat_id,sub_id,name,product_image,product_description,o-cakes_products.flavours,o-cakes_price_master.quantity,o-cakes_price_master.price,display_on_homepage')
                     ->from('o-cakes_products')
                     ->join('o-cakes_price_master','o-cakes_products.id=o-cakes_price_master.product_id','left')
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

    public function del_product($id){

      $data = array(
        'status' =>0
      );
      $this->db->where('id', $id);
      $status = $this->db->update('o-cakes_products', $data);
      return $status;
    }

    public function display_on_homepage($id,$value){

      $data = array(
        'display_on_homepage' =>$value
      );
      $this->db->where('id', $id);
      $status = $this->db->update('o-cakes_products', $data);
      return $status;
    }

    public function edit_flavour($id){
      $query = $this->db->get_where('o-cakes_flavour_master', array('id' => $id))->result_array();
      return $query;
    }

    public function edit_save_flavour($id,$data){

      $this->db->where('id', $id);
      $status = $this->db->update('o-cakes_flavour_master', $data);
      return $status;
    }

    public function insert_flavour($data){
      $flavour_record = $this->db->insert('o-cakes_flavour_master',$data);
      return $flavour_record;
    }

    //About us edit page

    public function edit_about_us($data){
      $this->db->where('id', 1);
      $status = $this->db->update('o-cakes_about', $data);
      return $status;
    }

    public function get_about(){
      $query = $this->db->get_where('o-cakes_about', array('id' => 1))->result_array();
      return $query;
    }

    public function get_terms(){
      $query = $this->db->get_where('o-cakes_terms', array('id' => 1))->result_array();
      return $query;
    }

    public function edit_terms($data){
      $this->db->where('id', 1);
      $status = $this->db->update('o-cakes_terms', $data);
      return $status;
    }

    //Pincode
    public function get_pincode_details($id){
      $query = $this->db->get_where('o-cakes_delivery_pincode', array('id' => $id))->result_array();
      return $query;
    }

    public function add_pincode_details($data){
       $pincode_record = $this->db->insert('o-cakes_delivery_pincode',$data);
      return $pincode_record;
    }

    public function edit_pincode_details($id,$data){
      $this->db->where('id', $id);
      $status = $this->db->update('o-cakes_delivery_pincode', $data);
      return $status;
    }
}