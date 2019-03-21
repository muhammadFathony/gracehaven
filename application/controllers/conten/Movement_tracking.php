<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Movement_tracking extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_movement_tracking');
		$this->load->model('M_dialy');
		$this->load->model('M_user');
		$this->load->library('access_library');
		if ($this->access_library->priv()== FALSE) {
			$this->session->set_flashdata('msg','error');
			redirect('conten/Dashboard','refresh');
		}
	}

	public function index()
	{
		$csrf['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$csrf['day'] = $this->M_dialy->all_day();
		$csrf['control'] = $this->M_user->all_control();
		$csrf['firstname'] = $this->session->userdata('firstname');
		$csrf['id_user'] = $this->session->userdata('id_user');
		$this->template->load('layout','conten/v_list_classroom', $csrf);
	}

	function list_place()
	{
		$data =$this->M_movement_tracking->list_place();
		$this->output->set_content_type('application/json')
					 ->set_output(json_encode($data));
	}

	function add_place()
	{
		$this->form_validation->set_rules('class_room', 'Class Room', 'trim|required');
		$this->form_validation->set_rules('id_user', 'id_user', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
            echo json_encode(['eror' => $errors]);
		} else {
			$prm = array('class_room' => htmlentities($this->input->post('class_room', TRUE)),
						 'id_user' => htmlentities($this->input->post('id_user', TRUE))
						 );

			$this->load->library('qrcode/Ciqrcode'); //pemanggilan library QR CODE
 
	        $config['cacheable']    = true; //boolean, the default is true
	        $config['cachedir']     = './assets/'; //string, the default is application/cache/
	        $config['errorlog']     = './assets/'; //string, the default is application/logs/
	        $config['imagedir']     = './assets/images/qrcode/'; //direktori penyimpanan qr code
	        $config['quality']      = true; //boolean, the default is true
	        $config['size']         = '1024'; //interger, the default is 1024
	        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
	        $config['white']        = array(70,130,180);
	        $config['encrypt_name']	= TRUE; // array, default is array(0,0,0)
	        $this->ciqrcode->initialize($config);
	 
	        $qr_classroom=$prm['class_room'].'.png'; //buat name dari qr code sesuai dengan nim
	 
	        $params['data'] = $prm['class_room']; //data yang akan di jadikan QR CODE
	        $params['level'] = 'H'; //H=High
	        $params['size'] = 10;
	        $params['savename'] = FCPATH.$config['imagedir'].$qr_classroom; //simpan image QR CODE ke folder assets/images/

	        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

			$data = $this->M_movement_tracking->add_place($prm, $qr_classroom);
			$this->output->set_content_type('application/json')
			             ->set_output(json_encode(array('add_place'=>$data)));
		}
	}

	function update_place()
	{
		$this->form_validation->set_rules('edit_class_room', 'Class Room', 'trim|required');
		$this->form_validation->set_rules('edit_firstname', 'Firstname', 'trim|required');
		$this->form_validation->set_rules('id_location', 'ID Location', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
            echo json_encode(['eror' => $errors]);
		} else {
			$prm = array('class_room' => htmlentities($this->input->post('edit_class_room', TRUE)),
						 'firstname' => htmlentities($this->input->post('edit_firstname', TRUE)),
						 'id_location' => htmlentities($this->input->post('id_location', TRUE)),
						);
			$data = $this->M_movement_tracking->update_place($prm);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('update_place'=>$data)));
		}
	}

	function delete_place()
	{
		$id_location = $this->input->post('id_location');
		$data = $this->M_movement_tracking->delete_place($id_location);
		$this->output->set_content_type('application/json')
					 ->set_output(json_encode(array('delete_place'=> $data)));
	}

	function log_api()
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

}

/* End of file Movement_tracking.php */
/* Location: ./application/controllers/conten/Movement_tracking.php */
