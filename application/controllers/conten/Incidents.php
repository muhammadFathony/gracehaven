<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incidents extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		$this->load->model('M_incident');
		$this->load->helper('security');
	}

	public function index()
	{
		
	}

	function add_incident()
	{
		
	}

	function negative_behaviours(){
		$csrf['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$csrf['control'] = $this->M_user->all_control();
		$csrf['firstname'] = $this->session->userdata('firstname');
		$csrf['id_user'] = $this->session->userdata('id_user');
		$csrf['level'] = $this->M_incident->get_level();
		$this->template->load('layout','conten/v_list_negative_behaviours', $csrf);
	}

	function List_negative_behaviours(){
		$data = $this->M_incident->List_negative_behaviours();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function add_negative_behaviours()
	{
		$this->form_validation->set_rules('negativebehaviours', 'Name', 'trim|required');
		$this->form_validation->set_rules('level', 'level', 'trim|required');

		if ($this->form_validation->run() == FALSe) {
			$errors = validation_errors();
            echo json_encode(['eror' => $errors]);
		} else {
			$obj = array('name' => htmlentities($this->input->post('negativebehaviours', TRUE)),
						 'level' => htmlentities($this->input->post('level', TRUE))
						);
			$data = $this->security->xss_clean($obj);
			$data = $this->M_incident->add_negative_behaviours($obj);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	function update_negative_behaviours(){

		$this->form_validation->set_rules('edit_negativebehaviours', 'Name', 'trim|required');
		$this->form_validation->set_rules('edit_level', 'level', 'trim|required');

		if ($this->form_validation->run() == FALSe) {
			$errors = validation_errors();
            echo json_encode(['eror' => $errors]);
		} else {
			$obj = array('name' => htmlentities($this->input->post('edit_negativebehaviours', TRUE)),
						 'level' => htmlentities($this->input->post('edit_level', TRUE)),
						 'id' => htmlentities($this->input->post('nomer',TRUE))
						);
			$data = $this->security->xss_clean($obj);
			$data = $this->M_incident->update_negative_behaviours($obj);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	function delete_negative_behaviours(){

		$nomer = $this->input->post('nomer');
		$data = $this->M_incident->delete_negative_behaviours($nomer);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function incidentreport()
	{
		$csrf['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$csrf['control'] = $this->M_user->all_control();
		$csrf['firstname'] = $this->session->userdata('firstname');
		$csrf['id_user'] = $this->session->userdata('id_user');
		$csrf['level'] = $this->M_incident->get_level();
		$this->template->load('layout','conten/v_incident_report', $csrf);
	}

}

/* End of file Incidents.php */
/* Location: ./application/controllers/conten/Incidents.php */