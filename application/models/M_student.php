<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Student extends CI_Model {

    function baru()
    {
    	$b =date("Ymd");
    	 $this->db->select('RIGHT(nis,4) as kode', FALSE);
		  $this->db->order_by('id_student','DESC');    
		  $this->db->limit(1);    
		  $query = $this->db->get('student');      //cek dulu apakah ada sudah ada kode di tabel.    
		  if($query->num_rows() <> 0){      
		   //jika kode ternyata sudah ada.      
		   $data = $query->row();      
		   $kode = intval($data->kode) + 1;    
		  }
		  else {      
		   //jika kode belum ada      
		   $kode = 1;    
		  }
		  $kodemax = str_pad($kode, 6, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
		  $kodejadi = "NIS-".$b."-".$kodemax;    // hasilnya ODJ-9921-0001 dst.
		  return $kodejadi;  
    }

	function add_new_student($data, $image)
	{
		$encrypt = password_hash($data['firstname'], PASSWORD_DEFAULT);

		$date=date('Y-m-d',strtotime($data['date_of_birth']));
		$db = array('nis' => $data['nis'],
					'firstname' => $data['firstname'],
					'lastname' => $data['lastname'],
					'date_of_birth' =>$date,
					'id_class' => $data['kelas'],
					'address' => $data['address'],
					'image'=> $image,
					'password' => $encrypt
					);
		$query = $this->db->insert('student', $db);
		if ($query) {
			return $query;
		} else {
			$this->output->set_content_type('application/json')->set_output(json_encode(array("error" => $query->result())));
		}
		
	}

	function update_student($object)
	{
		$date=date('Y-m-d',strtotime($object['date_of_birth']));
		if ($object['image'] == '') {
			$this->db->set('nis', $object['nis']);
			$this->db->set('firstname', $object['firstname']);
			$this->db->set('lastname', $object['lastname']);
			$this->db->set('id_class', $object['id_class']);
			$this->db->set('date_of_birth', $date);
			$this->db->set('address', $object['address']);
			$this->db->where('id_student', $object['id_student']);
			$query = $this->db->update('student');
		} else {
			$this->db->set('nis', $object['nis']);
			$this->db->set('firstname', $object['firstname']);
			$this->db->set('lastname', $object['lastname']);
			$this->db->set('id_class', $object['id_class']);
			$this->db->set('address', $object['address']);
			$this->db->set('image', $object['image']);
			$this->db->set('date_of_birth', $date);
			$this->db->where('id_student', $object['id_student']);
			$query = $this->db->update('student');
		}
		return $query;
	}

	function delete_student($id_student)
	{
		$this->db->where('id_student', $id_student);
		$query = $this->db->delete('student');

		return $query;
	}

	function list_student()
	{
		$this->db->select('*, DATE_FORMAT(date_of_birth, "%d-%m-%Y") as date_of_birth');
		//$this->db->select(DATE_FORMAT('date_of_birth','%d-%m-%Y'));
		$this->db->from('student');
		$this->db->join('control_access', 'student.id_control = control_access.id_control', 'inner');
		$this->db->join('class', 'student.id_class = class.id_class', 'inner');
		$query = $this->db->get();

		return $query->result();
	}

	function update_activity_student($id_schedule, $id_class, $b, $firstname, $id_student)
	{
		$a = array('id_student' => $id_student ,
				   'firstname'=> $firstname,
				   'id_schedule'=> $id_schedule,
				   'id_class'=> $id_class,
				   'status'=> 1,
				   'date' => $b 
				);
		if ($a['id_student'] == null) {
			echo json_encode(array('id_null'=> $a));
		} else {
			$ob = $this->db->insert('activity_student', $a);
			return $ob;
		}
	}

	function finished_activty($id_student)
	{
		$today = getdate();
		$this->db->select('*');
		$this->db->from('activity_student');
		$this->db->join('student', 'student.id_student = activity_student.id_student', 'inner');
		$this->db->join('schedule', 'schedule.id_schedule = activity_student.id_schedule', 'inner');
		$this->db->join('day', 'schedule.id_day = day.id_day', 'inner');
		$this->db->where('day.name_day', $today['weekday']);
		$this->db->where('student.id_student', $id_student);
		$this->db->order_by('hour(schedule.schedule_time)', 'asc');
		$query = $this->db->get();

		return $query->result();
	}

	function completed_activities($id_student)
	{
		if ($id_student) {
			$today = getdate();
			$this->db->select('*');
			$this->db->from('activity_student');
			$this->db->join('student', 'student.id_student = activity_student.id_student', 'inner');
			$this->db->join('schedule', 'schedule.id_schedule = activity_student.id_schedule', 'inner');
			$this->db->join('day', 'schedule.id_day = day.id_day', 'inner');
			$this->db->join('class', 'class.id_class = activity_student.id_class', 'join');
			$this->db->where('student.id_student', $id_student);
			$this->db->order_by('hour(activity_student.create_at)', 'desc');
			$query = $this->db->get();
		} else {
			$today = getdate();
			$this->db->select('*');
			$this->db->from('activity_student');
			$this->db->join('student', 'student.id_student = activity_student.id_student', 'inner');
			$this->db->join('schedule', 'schedule.id_schedule = activity_student.id_schedule', 'inner');
			$this->db->join('day', 'schedule.id_day = day.id_day', 'inner');
			$this->db->join('class', 'class.id_class = activity_student.id_class', 'join');
			$this->db->order_by('hour(activity_student.create_at)', 'desc');
			$query = $this->db->get();
		}

		return $query->result();
	}

	function update_completed_activities()
	{
		$this->db->select('*');
		$this->db->from('activity_student');
		$this->db->join('student', 'student.id_student = activity_student.id_student', 'inner');
		$this->db->join('schedule', 'schedule.id_schedule = activity_student.id_schedule', 'inner');
		$this->db->join('day', 'schedule.id_day = day.id_day', 'inner');
		//$this->db->order_by('hour(schedule.schedule_time)', 'asc');
		$this->db->order_by('activity_student.id_student', 'asc');
		$query = $this->db->get();

		return $query->result();

	}

}

/* End of file M_Student.php */
/* Location: ./application/models/M_Student.php */