<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_incident extends CI_Model {

	function add_negative_behaviours($obj){

		$data = array('negativebehaviours' =>  $obj['name'],
					  'id_level' => $obj['level'] 
					);

		$query = $this->db->insert('negative_behaviours', $data);

		return $query;
	}	

	function List_negative_behaviours(){

		$this->db->select('*');

		$this->db->from('negative_behaviours');
		$this->db->join('level_negativebehaviours', 'negative_behaviours.id_level = level_negativebehaviours.id_level', 'inner');

		$query = $this->db->get();

		return $query->result();
	}

	function update_negative_behaviours($obj){

		$this->db->set('negativebehaviours', $obj['name']);

		$this->db->set('id_level', $obj['level']);

		$this->db->where('nomer', $obj['id']);

		$query = $this->db->update('negative_behaviours');

		return $query;
	}

	function delete_negative_behaviours($nomer){

		$this->db->where('nomer', $nomer);
		
		$query = $this->db->delete('negative_behaviours');

		return $query;
	}

	function get_level()
	{
		$query = $this->db->get('level_negativebehaviours');

		return $query->result();
	}
}

/* End of file M_incident.php */
/* Location: ./application/models/M_incident.php */