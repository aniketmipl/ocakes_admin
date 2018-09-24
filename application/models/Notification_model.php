<?php

class Notification_model extends CI_Model{

	public function __construct()
    {
    	parent::__construct();
              
    }

    public function get_all(){

    	$result = $this->db->get('MstUsers');

        $total_records = count($result->result_array());
        
    	return $total_records ;
    }

    public function get_active_users(){

        $query = $this->db->select('*')
                            ->from('User_Session')
                            ->where('status',1)
                            ->get();

        return $query->num_rows();
    }

    public function get_total_group(){

        $query= $this->db->select('*')
                         ->from('MstGroup')
                         ->get();
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

    public function Send_notification_for_all($message){
        $query = $this->db->insert('Tbl_Notification', array('message' =>$message));
        return $query;
    }
}