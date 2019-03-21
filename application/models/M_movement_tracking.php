<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_movement_tracking extends CI_Model {

	public function list_place()
	{
		$this->db->select('*, class_room.qrcode as qrroom, class_room.create_at as last_time');
		$this->db->from('class_room');
		$this->db->join('user_rule', 'user_rule.id_user = class_room.id_user', 'inner');
		$this->db->join('control_access', 'control_access.id_control = user_rule.id_control', 'inner');
		$query = $this->db->get();

		return $query->result();
	}	

	function add_place($prm, $qr_classroom)
	{
		$data = array('class_room' => $prm['class_room'],
					  'id_user' => $prm['id_user'],
					  'qrcode' => $qr_classroom 
					);
		$query = $this->db->insert('class_room', $data);

		return $query;
	}

	function update_place($prm)
	{
		$this->db->set('class_room', $prm['class_room']);
		$this->db->set('id_user', 14);
		$this->db->where('id_location', $prm['id_location']);
		$query = $this->db->update('class_room');

		return $query;
	}

	function delete_place($id_location)
	{
		$this->db->where('id_location', $id_location);
		$this->db->delete('class_room');
	}

	function select_all_classroom(){
		$data = $this->db->get('class_room');

		return $data->result();
	}

	function get_room($id_location)
	{
		$this->db->select('*');
		$this->db->where('id_location', $id_location);
		$data = $this->db->get('class_room');

		return $data->result();
	}

	function login($email){

		$this->db->where('email', $email);
		$query = $this->db->get('user_rule');

		return $query;
	}

}

/* End of file M_movement_tracking.php */
/* Location: ./application/models/M_movement_tracking.php */