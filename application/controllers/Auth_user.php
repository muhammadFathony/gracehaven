<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_user extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		$this->load->model('M_privilege');
	}

	public function index()
	{

		if ($this->session->userdata('auth_on')==TRUE) {
			redirect('conten/Dashboard','refresh');
		} else {
			$csrf['csrf'] = array(
					'name' => $this->security->get_csrf_token_name(),
					'hash' => $this->security->get_csrf_hash()
			);
			$this->load->view('auth', $csrf, FALSE);
		}
	}

	function privilege()
	{
		$data = $this->M_privilege->privilege();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function check_auth()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('errorMessage', '<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong>'.validation_errors().'</strong><br> Please try again ! </div>');

			redirect('Auth_user','refresh');
		} else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
							
			$auth = $this->M_user->check_auth($email);
			
			if ($auth) {
				$hash_password = $auth->password;
				$hash = password_verify($password, $hash_password);
				if ($hash) {
					$userdata = array(
									'id_user' => $auth->id_user,
									'firstname' => $auth->firstname,
									'email' => $auth->email,
									'control' => $auth->control,
									'image' => $auth->image,
									'auth_on' => true
									);	
					$this->session->set_userdata($userdata);
					
					if ($this->session->userdata('control')== "administrator") {
						
						redirect('conten/Dashboard','refresh');
						
					} elseif ($this->session->userdata('control')=="inspector") {
						
						redirect('conten/Dashboard','refresh');
					
					} elseif ($this->session->userdata('control')=="student") {
						
						redirect('conten/Dashboard','refresh');
					
					} else {

						$data = array('firstname', 'lastname', 'control', 'email', 'auth_on');
						$this->session->unset_userdata($data);
						redirect('Auth_user','refresh');
					}
				} else {
					$this->session->set_flashdata('errorMessage', '<div class="alert alert-success alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>'.validation_errors().'</strong><br> Please try again ! </div>');

						redirect('Auth_user','refresh');
				}
			} else {

				$this->session->set_flashdata('errorMessage', '<div class="alert alert-warning alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<strong class="title"> Username / Password invalid ! </strong></div>');
					
				redirect('Auth_user','refresh');
				
			}
		}
	}

	function signout()
	{
		$data = array('firstname', 'control', 'email', 'auth_on');
		
		$this->session->unset_userdata($data);

		$this->session->set_flashdata('successMessage', '<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong class="title"> Signout Succedded ! </strong></div>');


		redirect('Auth_user','refresh');
	}

}

/* End of file Auth_user.php */
/* Location: ./application/controllers/Auth_user.php */