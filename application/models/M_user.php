<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	function check_auth($email){
		$this->db->join('control_access', 'control_access.id_control = user_rule.id_control', 'inner');
		$this->db->where('email', $email);
		$this->db->from('user_rule');
		$data = $this->db->get();

		return $data->row();
	}

	function check_auth_student($email)
	{
		$this->db->join('class', 'class.id_class = student.id_class', 'inner');
		$this->db->join('control_access', 'control_access.id_control = student.id_control', 'inner');
		$this->db->where('student.nis', $email);
		$this->db->from('student');
		$student = $this->db->get();

		return $student->row();
	}

	function create($ok, $image, $image_name){

		$encrypt = password_hash($ok['password'], PASSWORD_DEFAULT);
		
		$data = array('firstname' => $ok['first_name'],
						'lastname' => $ok['last_name'],
						'image' => $image,
						'email' => $ok['email'],
						'id_control' => $ok['control'],
						'qrcode' => $image_name,
						'password' => $encrypt 
					);
		
		$query = $this->db->insert('user_rule', $data);
		return $query;
	}

	function all_user()
	{
		$this->db->select('*');
		$this->db->from('user_rule');
		$this->db->join('control_access', 'user_rule.id_control =control_access.id_control', 'inner');
		$query = $this->db->get();

		return $query->result();
	}

	function all_control()
	{
		$this->db->select('*');
		$this->db->from('control_access');
		$query = $this->db->get();

		return $query->result();
	}

	function update_user($object)
	{
		$encrypt = password_hash($object['password'], PASSWORD_DEFAULT);
		$this->db->set('firstname', $object['first_name']);
		$this->db->set('lastname', $object['last_name']);
		$this->db->set('email', $object['email']);
		$this->db->set('id_control', $object['control']);
		$this->db->set('password', $encrypt);

		$this->db->where('id_user',$object['id']);

		$query = $this->db->update('user_rule');

		return $query;
	}

	function delete_user($id_user)
	{
		$this->db->where('id_user', $id_user);
		$query = $this->db->delete('user_rule');

		return $query;
	}

	function role_user()
	{
		$data = $this->db->query('SELECT * FROM `rbac` INNER JOIN sidebar on rbac.id = sidebar.id INNER JOIN user_rule ON user_rule.id_user = rbac.id_user WHERE rbac.id_user = 2');
		return $data->result();
	}

	function test_user()
	{
		$direktori = $this->uri->segment(1);
		$url = $this->uri->segment(2);
		$id_control = $this->session->userdata('id_control');
		$set = $this->db->query("SELECT * FROM rbac JOIN control_access ON rbac.id_control = control_access.id_control JOIN sidebar ON rbac.id = sidebar.id WHERE rbac.id_control = '$id_control' AND sidebar.url='$direktori/$url'");
		$row = $set->result_array();
		return $row;
	}
}

/* End of file M_user_rule.php */
/* Location: ./application/models/M_user_rule.php */