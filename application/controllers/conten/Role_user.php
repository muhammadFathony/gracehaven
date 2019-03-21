<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_user extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_privilege');
		$this->load->model('M_user');
	}
	public function index()
	{
		$data = $this->M_user->role_user();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function insert_role()
	{
		$ortu = $this->input->post('ortu');
		$id_control = $this->input->post('id_control');
		$this->db->where('id_control', $id_control);
		$this->db->where('id', $ortu);
		$obj = $this->db->get('rbac');

		if ($obj->num_rows() > 0 ) {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('menu already'=> $obj->result())));
		} else {
			
				$data = $this->M_privilege->insert_role($ortu, $id_control);
				$this->output->set_content_type('application/json')->set_output(json_encode(array('success_role' => $data)));
		} 
	}


	function insert_child()
	{
		$id = $this->input->post('id');
		$id_control = $this->input->post('id_control');
		$this->db->where('id_control', $id_control);
		$this->db->where('id', $id);
		$anak = $this->db->get('rbac');

		if ($anak->num_rows() > 0 ) {
			$this->output->set_content_type('application/json')->set_output(json_encode(array('menu_already'=> $anak->result())));
		} else {
			$data = $this->M_privilege->insert_child($id, $id_control);
			$this->output->set_content_type('application/json')->set_output(json_encode(array('add_child'=>$data)));
		}
	}

	function remove_role()
	{
		$ortu = $this->input->post('ortu');
		$id_control = $this->input->post('id_control');

		$data = $this->M_privilege->remove_role($ortu, $id_control);
		$this->output->set_content_type('application/json')
					 ->set_output(json_encode(array('delete_ortu'=>$data)));
	}

	function remove_child()
	{
		$id = $this->input->post('id');
		$id_control = $this->input->post('id_control');

		$data = $this->M_privilege->remove_child($id, $id_control);
		$this->output->set_content_type('application/json')
					 ->set_output(json_encode(array('delete_child'=>$data)));
	}

}

/* End of file User_Role.php */
/* Location: ./application/controllers/conten/User_Role.php */
