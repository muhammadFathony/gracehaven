<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	function check_auth($email){
		$this->db->where('email', $email);
		$this->db->from('user_rule');
		$data = $this->db->get();

		return $data->row();
	}

	function create($ok, $image, $image_name){

		$encrypt = password_hash($ok['password'], PASSWORD_DEFAULT);
		
		$data = array('firstname' => $ok['first_name'],
						'lastname' => $ok['last_name'],
						'image' => $image,
						'email' => $ok['email'],
						'control' => $ok['control'],
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
		$query = $this->db->get();

		return $query->result();
	}

	function update_user($object)
	{
		$encrypt = password_hash($object['password'], PASSWORD_DEFAULT);
		$this->db->set('firstname', $object['first_name']);
		$this->db->set('lastname', $object['last_name']);
		$this->db->set('email', $object['email']);
		$this->db->set('control', $object['control']);
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
		

}

/* End of file M_user_rule.php */
/* Location: ./application/models/M_user_rule.php */