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
			$this->load->view('Sign_in', $csrf);
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
			$this->session->set_flashdata('msg','try_again');
			redirect('Auth_user','refresh');
		} else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
							
			$auth = $this->M_user->check_auth($email);
			$auth_student = $this->M_user->check_auth_student($email);
			if ($auth) {
				$hash_password = $auth->password;
				$hash = password_verify($password, $hash_password);
				if ($hash) {
					$userdata = array(
									'id_user' => $auth->id_user,
									'firstname' => $auth->firstname,
									'email' => $auth->email,
									'id_control' => $auth->id_control,
									'image' => $auth->image,
									'control' => $auth->control,
									'auth_on' => true
									);	
					$this->session->set_userdata($userdata);
					
					if ($this->session->userdata('id_control')== "1") {
						
						redirect('conten/Dashboard','refresh');
						
					} elseif ($this->session->userdata('id_control')=="2") {
						
						redirect('conten/Dashboard','refresh');
					
					} elseif ($this->session->userdata('id_control')=="3") {
						
						redirect('conten/Dashboard','refresh');
					
					} else {

						// $data = array('firstname', 'lastname', 'id_control', 'email', 'control','id_user', 'auth_on');
						// $this->session->unset_userdata($data);
						$this->session->set_flashdata('msg', 'not_found');
						redirect('Auth_user','refresh');
					}
				} else {
					$this->session->set_flashdata('errorMessage', '<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>'.validation_errors().'</strong><br>Password and username invalid !</div>');
					$this->session->set_flashdata('msg','invalid');
						redirect('Auth_user','refresh');
						//echo "cek";
				}
			} elseif ($auth_student) {
				$hash_password_student = $auth_student->password;
				$hash_student = password_verify($password, $hash_password_student);
				if ($hash_student) {
					$userdatastudent = array(
									'id_student' => $auth_student->id_student,
									'firstname' => $auth_student->firstname,
									'lastname' => $auth_student->lastname,
									'control' => $auth_student->control,
									'class' => $auth_student->class,
									'id_class' => $auth_student->id_class,
									'id_control' => $auth_student->id_control,
									'image' => $auth_student->image,
									'auth_on' => true
									);	
					$this->session->set_userdata($userdatastudent);

					if ($this->session->userdata('id_control')=='3') {
						redirect('conten/Dashboard','refresh');
					} else {
						$this->session->set_flashdata('errorMessage', '<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>'.validation_errors().'</strong><br>Some thing is wrong !</div>');
						$this->session->set_flashdata('msg','wrong');
						redirect('Auth_user','wrong');
					}
				} else {
					$this->session->set_flashdata('errorMessage', '<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>'.validation_errors().'</strong><br>Password and username invalid !</div>');
					$this->session->set_flashdata('msg','invalid');
						redirect('Auth_user','refresh');
				}
			}  else {

				$this->session->set_flashdata('errorMessage', '<div class="alert alert-warning alert-dismissible fade in" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					<strong class="title"> Account not found ! </strong></div>');
				$this->session->set_flashdata('msg','not_found');	
				redirect('Auth_user','refresh');
				
			}
		}
	}

	function signout()
	{
		$data = array('id_student',
					  'firstname',
					  'lastname',
					  'control',
					  'class',
					  'id_class',
					  'id_control',
					  'image',
					  'auth_on' );
		
		$this->session->unset_userdata($data);

		$this->session->set_flashdata('successMessage', '<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong class="title"> Signout Succedded ! </strong></div>');


		redirect('Auth_user','refresh');
	}

}

/* End of file Auth_user.php */
/* Location: ./application/controllers/Auth_user.php */