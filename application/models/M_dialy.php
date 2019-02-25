<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dialy extends CI_Model {

	function all_dialy()
	{
		$this->db->select('*');
		$this->db->from('day');
		$this->db->join('schedule', 'day.id_day = schedule.id_day', 'inner');
		$this->db->join('class', 'class.id_class = schedule.id_class', 'inner');
		$this->db->order_by('schedule.id_day', 'asc');
		$query = $this->db->get();

		return $query->result();
	}

	function activity_everyday(){
		$today = getdate();
		$this->db->select('*');
		$this->db->from('schedule');
		$this->db->join('day', 'schedule.id_day = day.id_day', 'inner');
		$this->db->join('class', 'schedule.id_class = class.id_class', 'inner');
		$this->db->where('day.name_day', $today['weekday']);
		$this->db->order_by('hour(schedule.schedule_time)', 'asc');
		$query = $this->db->get();

		return $query->result();
	}	

	function all_day()
	{
		$this->db->select('*');
		$query = $this->db->get('day');
		return $query->result();
	}

	function all_class()
	{
		$this->db->select('*');
		$query = $this->db->get('class');
		return $query->result();
	}

	function create_dialy($obj)
	{
		$object = array('schedule_name' => $obj['schedule'],
						   'id_day' => $obj['day'],
						   'schedule_time' => $obj['all_time1'],
						   'schedule_finish' => $obj['all_finish1'],
						   'id_class' => $obj['id_class'],
						    );

		$query = $this->db->insert('schedule', $object);

		return $query;

	}

	function update_dialy($obj)
	{
		$this->db->set('id_day', $obj['id_day']);
		$this->db->set('schedule_name', $obj['schedule_name']);
		$this->db->set('schedule_time', $obj['all_time']);
		$this->db->set('schedule_finish', $obj['all_finish']);
		$this->db->set('id_class', $obj['id_classedit']);

		$this->db->where('id_schedule', $obj['id_schedule']);
		$query = $this->db->update('schedule');

		return $query;
	}

	function delete_dialy($id_schedule)
	{
		$this->db->where('id_schedule', $id_schedule);
		$query = $this->db->delete('schedule');

		return $query;
	}

	function update_daily_student($id_student)
	{
		$this->db->set('status', 1);
		$this->db->where('id_student', $id_student);
		$query = $this->db->update('student');

		return $query;
	}

	function deleted_completed_activities($id_schedule, $id_student)
	{
		$this->db->where('id_schedule', $id_schedule);
		$this->db->where('id_student', $id_student);
		$query = $this->db->delete('activity_student');

		return $query;
	}
}

/* End of file M_dialy.php */
/* Location: ./application/models/M_dialy.php */