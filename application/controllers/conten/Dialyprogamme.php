<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dialyprogamme extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('M_dialy');
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
		$csrf['class'] = $this->M_dialy->all_class();
		$this->template->load('layout','conten/v_dialy_progamme', $csrf);
	
	}

	function all_dialy()
	{
		$data = $this->M_dialy->all_dialy();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function create_dialy()
	{
		$this->form_validation->set_rules('schedule', 'Schedule', 'trim|required');
		$this->form_validation->set_rules('all_time1', 'Time Start', 'trim|required');
		$this->form_validation->set_rules('all_finish1', 'Time Finish', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			
			$errors = validation_errors();
            echo json_encode(['eror' => $errors]);
		
		} else {

		$obj = array('day' => $this->input->post('day', TRUE),
					 'schedule' => $this->input->post('schedule', TRUE),
					 'all_time1' => $this->input->post('all_time1', TRUE),
					 'all_finish1' => $this->input->post('all_finish1', TRUE),
					 'id_class' => $this->input->post('id_class', TRUE) 
					);
		$data = $this->M_dialy->create_dialy($obj);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));

		}
	}

	function update_dialy()
	{
		$this->form_validation->set_rules('schedule_name', 'Schedule Name', 'trim|required');
		$this->form_validation->set_rules('all_time', 'Time', 'trim|required');
		$this->form_validation->set_rules('schedule_name', 'Schedule Name', 'trim|required');
		$this->form_validation->set_rules('all_finish', 'Finish', 'trim|required');
		$this->form_validation->set_rules('id_classedit', 'Class', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
            echo json_encode(['eror' => $errors]);
		} else {
			$obj = array('id_day' => htmlentities($this->input->post('id_day', TRUE)),
						 'id_schedule' => htmlentities($this->input->post('id_schedule', TRUE)),
						 'schedule_name' => htmlentities($this->input->post('schedule_name', TRUE)),
						 'all_time' => htmlentities($this->input->post('all_time', TRUE)),
						 'all_finish' => htmlentities($this->input->post('all_finish', TRUE)),
						 'date1' => htmlentities($this->input->post('date1', TRUE)),
						 'id_classedit' => htmlentities($this->input->post('id_classedit', TRUE)),
						 );
			$data = $this->M_dialy->update_dialy($obj);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

	}

	function delete_dialy()
	{
		$id_schedule = $this->input->post('id_schedule');
		$data = $this->M_dialy->delete_dialy($id_schedule);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	

}

/* End of file Dialyprogamme.php */
/* Location: ./application/controllers/conten/Dialyprogamme.php */