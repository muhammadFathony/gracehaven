<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		$this->load->model('M_dialy');
		$this->load->model('M_movement_tracking');
		
	}
	

	public function index()
	{
		//$this->load->helper('security');
		$config['csrf_protection'] = TRUE;
		$csrf['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
			);
		$csrf['class_room'] = $this->M_movement_tracking->select_all_classroom();
		$this->template->load('layout','conten/v_location', $csrf);
	}

	function get_class(){
		$class_room = $this->input->post('class_room');
		$data = $this->M_movement_tracking->get_room($class_room);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function login()
	{
		$sfsd = 'admin@gmail.com';
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$auth = $this->M_user->check_auth($email);
		if ($auth) {
			$hash_password = $auth->password;
			$hash = password_verify($password, $hash_password);
		
			if ($hash) {
				$id_location = $this->input->post('id_location');
				$data = $this->M_movement_tracking->get_room($id_location);
				$this->output->set_content_type('application/json')->set_output(json_encode($data));
			} 
		}

		// $this->load->helper('security');
		// $a = 'abcdefg';
		// $str = do_hash($a); // SHA1
		// $str = do_hash($str, 'md5'); // MD5
		// echo $str;
	}

}

/* End of file Location.php */
/* Location: ./application/controllers/conten/Location.php */
