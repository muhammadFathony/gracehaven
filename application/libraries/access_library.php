<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Access_library
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	function priv()
	{
		$direktori = $this->ci->uri->segment(1);
		$url = $this->ci->uri->segment(2);
		$id_control = $this->ci->session->userdata('id_control');
		$set = $this->ci->db->query("SELECT * FROM rbac JOIN control_access ON rbac.id_control = control_access.id_control JOIN sidebar ON rbac.id = sidebar.id WHERE rbac.id_control = '$id_control' AND sidebar.url='$direktori/$url'");
		$row = $set->num_rows();
		if (!empty($row)) {
			return true;
		} else {
			return false;
		}
	}

	

}

/* End of file access_library.php */
/* Location: ./application/libraries/access_library.php */
