<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_privilege extends CI_Model {

	function privilege()
	{
		$this->db->select('user_rule.firstname, user_rule.control, parent.parent, child.child');
		$this->db->from('page');
		$this->db->join('user_rule', 'page.id_user = user_rule.id_user', 'inner');
		$this->db->join('parent', 'page.id_parent = parent.id_parent', 'inner');
		$this->db->join('child', 'page.id_child = child.id_child', 'inner');
		$this->db->where('user_rule.email', "admin@gmail.com");
		$this->db->where('user_rule.firstname', "toni");
		$query = $this->db->get();
		return $query->result();
	}	

	function insert_role($ortu, $id_control)
	{
		$obj = array('id' => $ortu,
					 'id_control' => $id_control
					);
		$query = $this->db->insert('rbac', $obj);
		return $query;
	}

	function insert_child($id, $id_control)
	{
		$obj = array('id' => $id,
					 'id_control' => $id_control
					);
		$query = $this->db->insert('rbac', $obj);
		return $query;
	}

	function remove_role($ortu, $id_control)
	{
		$this->db->where('id', $ortu);
		$this->db->where('id_control', $id_control);
		$query = $this->db->delete('rbac');
		return $query;
	}

	function remove_child($id, $id_control)
	{
		$this->db->where('id', $id);
		$this->db->where('id_control', $id_control);
		$query = $this->db->delete('rbac');
		return $query;	
	}	

}

/* End of file M_privilege.php */
/* Location: ./application/models/M_privilege.php */