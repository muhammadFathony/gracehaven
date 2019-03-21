<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dailystudent extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_dialy');
		$this->load->model('M_student');
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
		$this->template->load('layout','conten/v_student_dialy', $csrf);

	}

	function activity_everyday()
	{
		$id_class = $this->session->userdata('id_class');
		if ($id_class) {
			$data = $this->M_dialy->activity_everyday($id_class);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('*');
			$this->db->from('schedule');
			$this->db->join('day', 'schedule.id_day = day.id_day', 'inner');
			$this->db->join('class', 'schedule.id_class = class.id_class', 'inner');
			$this->db->order_by('hour(schedule.schedule_time)', 'asc');
			$query = $this->db->get();
			$this->output->set_content_type('application/json')->set_output(json_encode($query->result()));
		}
	}

	function update_daily_student()
	{
		//update activity daily student
		$firstname = $this->session->userdata('firstname');
		$id_student = $this->session->userdata('id_student');
		$b =	date("Y-m-d");
		$id_schedule = $this->input->post('id_schedule', TRUE);
		$id_class = $this->input->post('id_class', TRUE);
		$this->db->where('id_student', $id_student);
		$this->db->where('id_schedule', $id_schedule);
		$this->db->where('date', $b);
		$data = $this->db->get('activity_student');
		if ($data->num_rows() > 0) {
			echo json_encode(array('already'=> $data->result()));
		} else {
			$data = $this->M_student->update_activity_student($id_schedule, $id_class, $b, $firstname, $id_student);
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	function co()
	{
		$b =  date("Y-m-d"); 
		$a = $this->db->query("SELECT * FROM `activity_student` JOIN schedule  ON activity_student.id_schedule = schedule.id_schedule WHERE activity_student.status= 1 AND activity_student.date = '$b' ");	
		$this->output->set_content_type('application/json')->set_output(json_encode($a->result()));

	}

	function View_finished_activity()
	{
		$csrf['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->template->load('layout','conten/v_activity_finished', $csrf);
	}

	function finished_activity()
	{
		$id_student = $this->session->userdata('id_student');
		$data = $this->M_student->finished_activty($id_student);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function view_completed_activities()
	{
		$csrf['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$csrf['day'] = $this->M_dialy->all_day();
		$csrf['class'] = $this->M_dialy->all_class();
		$this->template->load('layout','conten/v_completed_activities', $csrf);
	}

	function completed_activities()
	{
		$id_student = $this->session->userdata('id_student');
		if ($id_student) {
			$data = $this->M_student->completed_activities($id_student);
		} else {
			$data = $this->M_student->completed_activities($id_student);
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function deleted_completed_activities()
	{
		$id_student = $this->input->post('id_student');
		$id_schedule = $this->input->post('id_schedule');

		$data = $this->M_dialy->deleted_completed_activities($id_schedule, $id_student);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function update_completed_activities()
	{
		$data = $this->M_student->update_completed_activities();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}


	function rate_dinamis()
	{
		$id_class = $this->session->userdata('id_class');
		$today = getdate();
		$this->db->select('*');
		$this->db->from('schedule');
		$this->db->join('day', 'schedule.id_day = day.id_day', 'inner');
		$this->db->join('class', 'schedule.id_class = class.id_class', 'inner');
		$this->db->where('day.name_day', $today['weekday']);
		$this->db->where('schedule.id_class', $id_class);
		$this->db->order_by('hour(schedule.schedule_time)', 'asc');
		$query = $this->db->get()->num_rows();
		if ($query) {
			$id_student = $this->session->userdata('id_student');
			$b =  date("Y-m-d"); 
			$this->db->where('date', $b);
			$this->db->where('id_student', $id_student);
			$this->db->where('status', 1);
			$data = $this->db->get('activity_student')->num_rows();
			$hitung = ($data / $query) * 5;

			$this->output->set_content_type('application/json')->set_output(json_encode($hitung));
		}
	}

	//Daily Progame

	function Dailyprogamme()
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

/* End of file Dialystudent.php */
/* Location: ./application/controllers/student/Dialystudent.php */