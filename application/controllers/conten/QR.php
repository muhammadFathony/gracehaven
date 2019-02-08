<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class QR extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('qrcode/Ciqrcode');		
	}
	public function index()
	{
		
	}

}

/* End of file QR.php */
/* Location: ./application/controllers/conten/QR.php */