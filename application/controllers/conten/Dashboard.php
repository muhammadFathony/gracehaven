<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('auth_on')) {
			$this->session->set_flashdata('errorMessage', '<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong class="title"> You must sign ! </strong></div>');
			$this->session->set_flashdata('msg', 'must_sign');
			redirect('Auth_user','refresh');
		}
	}

	public function index()
	{
		$csrf['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->template->load('layout','layout/content', $csrf);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/conten/Dashboard.php */