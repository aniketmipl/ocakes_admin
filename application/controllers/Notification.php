<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {
 function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Notification_model');
        if(!$this->session->userdata('userid')){
        	redirect(base_url().'index.php/login');
        }
    }

    public function index(){

    	$this->load->view('common/header');
    	$this->load->view('notification/view');
    	$this->load->view('common/footer');
    }


    public function get_all_users(){
    	$this->load->library('Datatables');
        $this->datatables->select('UserID,UserName,mobileno');
        $this->datatables->from('MstUsers');
        $this->datatables->where('token !=',' ');
        $result = $this->datatables->generate();
        echo $result;

    }

    public function send_notification(){

    	// print_r($_POST['select_users']); die;
    	$select_users = $_POST['select_users'];
    	$message = $_POST['message']; 

    	$total_selected = sizeof($select_users);

    	//-------FCP-------------//
        ob_start();

	    $url = "https://fcm.googleapis.com/fcm/send";
		$serverKey = 'AAAAYRR1rFc:APA91bEMU8kQh1Kc2ER0dC3RqnpkxOgNMjo_CLJ0UI1K9ufrevAa5Aet_Ur0ulXc7BMKbMZjudwfH9PhBVZaO5owypyoWnkmCJBSuDtiqL5FublO_69BAyRs67EuyzQJAZrbLa-3MJux';


		//------------FCP Ends --------//

		$count = 0;
    	for($i=0;$i<$total_selected;$i++){
    	$result = $this->Notification_model->get_token($select_users[$i]);

    	// print_r($result); 
    	$token = $result[0]->token;

    	$title = "Familla";
		$body = $message;
        $AnotherActivity=array('AnotherActivity'=>'feeds');
		$notification = array('title' =>$title , 'text' => $body, 'sound' => 'default', 'badge' => '1');
			$arrayToSend = array('to' => $token, 'notification' => $notification,'priority'=>'high','data'=>$AnotherActivity);
			$json = json_encode($arrayToSend);
			$headers = array();
			$headers[] = 'Content-Type: application/json';
			$headers[] = 'Authorization: key='. $serverKey;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);

			curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
			curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
			//Send the request
			$response = curl_exec($ch);
            // if(ob_get_length() > 0 ) {
            // ob_end_clean();
            // }
			//Close request
			if ($response === FALSE) {
			// die('FCM Send Error: ' . curl_error($ch));
   //              $count++;
			}
			else {
				    $count++;
				    // echo "send";
			}
			curl_close($ch);
    	}
        if($count >0){
           //$this->Notification_model->Send_notification_for_all($message);

    	   echo "Notification send to ".$count." users ";
        }
        else{
            echo "Notification Failed";
        }
    }

}