<?php

class Login_model extends CI_Model{

	public function __construct()
    {
    	parent::__construct();
              
    }
    
    public function validate($username,$password){

    	$query = $this->db->get_where('o-cakes_admin',array('username' => $username,'password'=>$password));
    	if($query->num_rows() == 1)
    	{
    		$result =$query->result();
            $row = $query->row();

            // print_r($row); die;
      //       $this->db->select('menu.menu_id AS menuid,menu.url as url,menu.menu_name AS menu_caption,menu_permission.permission,menu_permission.group_name');
      //       $this->db->from('menu');
      //       $this->db->join('menu_permission','menu_permission.menu_id=menu.menu_id','left');
      //       $this->db->where('menu_permission.group_name',$row->group);
      //       $this->db->order_by('menu.menu_id');

      //       $query_menu = $this->db->get(); 
            
      //       $menu_data = $query_menu->result_array();
      //       $menu_param_cap = array();
      //       $menu_param = array();

      //       $base_arr_length= count($menu_data);

      //       for($i=0; $i<$base_arr_length ; $i++) 
      //       {
      //           $menu_param[$menu_data[$i]['menuid']] = $menu_data[$i]['permission'];
      //       }

      //       for($i=0; $i<$base_arr_length ; $i++) 
      //       {
      //           $menu_param_cap[$menu_data[$i]['menu_caption']] = $menu_data[$i]['permission'];
      //       } 
            $data = array(                    
                    'userid' => $row->id,
                    'username' => $row->username,
                    'validated' => true,
                    );
            return $data;
    	}
    	else{
    		
    		$result["error"]="Invalid user";
    		return $result;
    	}
    }
}