<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {

	public function index()
	{
		
	}

	function register()
	{
		$response = array("error" => FALSE);

		$id_student = $this->input->post('id_student');
		$id_control = $this->input->post('id_control');
		$id_location = $this->input->post('id_location');

		$this->db->where('id_student', $id_student);
		$db = $this->db->get('log_class');

		if ($db->num_rows() > 0) {
			$response["error"] = TRUE;
			$response["message"] = "User already existed";
			$this->output->set_content_type('application/json')->set_output(json_encode($response));
		} else {
			  $obj = array('id_student' => $id_student,
			 			  'id_control' => $id_control,
			 			  'id_location' => $id_location
			 			);
			 $query = $this->db->insert('log_class', $obj);

			 if ($query) {
			 	$response["error"] = FALSE;
			 	$response["message"] = "Register Successfull";

			 	$this->output->set_content_type('application/json')->set_output(json_encode($response));
			 } else {
			 	$response["error"] = TRUE;
			 	$response["message"] = "Register Failure";

			 	$this->output->set_content_type('application/json')->set_output(json_encode($response));
			 }
		}		
	}

	function login_location()
	{
		$response = array("error" => FALSE);

		$qrcode = $this->input->post('qrcode');
		$id_control = $this->input->post('id_control');
		$id_location = $this->input->post('id_location');
		$id_student = $this->input->post('id_student');
		$nis = $this->input->post('nis');

		if (isset($nis) && isset($qrcode)) {
			$query = $this->db->query("SELECT * FROM `log_class` JOIN student ON student.id_student = log_class.id_student JOIN class_room ON class_room.id_location = log_class.id_location WHERE student.nis = '$nis' AND class_room.qrcode = '$qrcode'");
			
			if ($query->num_rows() > 0) {
				foreach ($query->result_array() as $key ) {
					$response["error"] = FALSE;
			    	$response["message"] = "Login Successfull";
			    	$response["data"]["nis"] = $key['nis'];
			    	$response["data"]["qrcode"] = $key['qrcode'];
				}
				$this->output->set_content_type('application/json')->set_output(json_encode($response));
			} else {
				$response["error"] = TRUE;
	    		$response["message"] = "Incorrect qrcode";

	    		$this->output->set_content_type('application/json')->set_output(json_encode($response));
			}
		} else {
			echo json_encode('validasi jalan');
		}

	}

	function API_Login(){

		 // Getting the received JSON into $json variable.
		$json = file_get_contents('php://input');
		 
		 // decoding the received JSON and store into $obj variable.
		$obj = json_decode($json,true);
		 
		// Populate User email from JSON $obj array and store into $email.
		$firstname = $obj['firstname'];
		 
		// Populate Password from JSON $obj array and store into $password.
		$lastname = $obj['lastname'];

		$this->db->where('firstname', $firstname);

		$this->db->where('lastname', $lastname);

		$ok = $this->db->get('student');

		// $ok = $this->db->query("SELECT * from student where firstname = '$firstname' AND lastname= '$lastname'");

		$check = $ok->result_array();

		if ($ok->num_rows() > 0 ) {
			
			$SuccessLoginMsg = 'Success';
 
			// Converting the message into JSON format.
			$SuccessLoginJson = $this->output->set_content_type('application/json')->set_output(json_encode($SuccessLoginMsg));
			 
			// Echo the message.
			 //echo $SuccessLoginJson ; 
		} else {

			// If the record inserted successfully then show the message.
			$InvalidMSG['invalid'] = 'Invalid Username or Password Please Try Again' ;
			 
			// Converting the message into JSON format.
			$InvalidMSGJSon = $this->output->set_content_type('application/json')->set_output(json_encode($InvalidMSG));
			 
			// Echo the message.
			// echo $InvalidMSGJSon ;
 
		}
	}

	function api_schedule(){
		$id_class = $this->session->userdata('id_class');
		if ($id_class) {
			$today = getdate();
			$this->db->select('*, SUBSTRING(schedule.schedule_time, 5, 3) as schedule_time');
			$this->db->from('schedule');
			$this->db->join('day', 'schedule.id_day = day.id_day', 'inner');
			$this->db->join('class', 'schedule.id_class = class.id_class', 'inner');
			$this->db->where('day.name_day', $today['weekday']);
			$this->db->where('schedule.id_class', $id_class);
			$this->db->order_by('hour(schedule.schedule_time)', 'asc');
			$data = $this->db->get();
			// $data = $this->M_dialy->activity_everyday($id_class);
			$api['schedule_array'] = $data;
			$this->output->set_content_type('application/json')->set_output(json_encode($api));
		} else {
			$today = getdate();
			$this->db->select('*, SUBSTRING(schedule.schedule_time, 11, 9) as schedule_time');
			$this->db->from('schedule');
			$this->db->join('day', 'schedule.id_day = day.id_day', 'inner');
			$this->db->join('class', 'schedule.id_class = class.id_class', 'inner');
			$this->db->where('day.name_day', $today['weekday']);
			$this->db->order_by('hour(schedule.schedule_time)', 'asc');
			$query = $this->db->get()->result();
			$api['schedule_array'] = $query;
			$this->output->set_content_type('application/json')->set_output(json_encode($api));
		}
	}
}

/* End of file API.php */
/* Location: ./application/controllers/API.php */