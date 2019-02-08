<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		if (!$this->session->userdata('auth_on')) {
			$this->session->set_flashdata('errorMessage', '<div class="alert alert-success alert-dismissible fade in" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
			<strong class="title"> You must sign ! </strong></div>');

			redirect('Auth_user','refresh');
		}
	}
	public function index()
	{
		$csrf['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->template->load('layout','conten/v_list_user', $csrf);
	}

	function all_user()
	{
		$data = $this->M_user->all_user();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function edit_user()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('control', 'control', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('repeat', 'password', 'trim|required');

		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
            echo json_encode(['eror' => $errors]);
		} else {
			$object = array('id' => htmlentities($this->input->post('id', TRUE)),
							'first_name' => htmlentities($this->input->post('first_name', TRUE)),
							'last_name' => htmlentities($this->input->post('last_name', TRUE)),
							'email' => htmlentities($this->input->post('email', TRUE)),
							'control' => htmlentities($this->input->post('control', TRUE)),
							'password' => htmlentities($this->input->post('password', TRUE)),
							
			);	
			$data = $this->M_user->update_user($object);
			echo json_encode($data);
		}
	}

	function delete_user()
	{
		$id_user = $this->input->post('id_user');
		$data = $this->M_user->delete_user($id_user);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function view_create_user()
	{
		$csrf['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->template->load('layout','conten/v_create_user', $csrf);
	}

	function add_user()
	{
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('control', 'control', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('repeat_password', 'password', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
            echo json_encode(['eror' => $errors]);
		} else {


			$config['upload_path'] = "./assets/images";
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name']	= TRUE;

			$this->load->library('upload' , $config);

			$this->upload->do_upload("img_file");
			$data_upload = array('upload_data' => $this->upload->data());
			$image = $data_upload['upload_data']['file_name'];

			$object = array('id' => $this->input->post('id'),
							'first_name' => htmlentities($this->input->post('first_name')),
							'last_name' => htmlentities($this->input->post('last_name')),
							'email' => htmlentities($this->input->post('email')),
							'control' => htmlentities($this->input->post('control')),
							'password' => htmlentities($this->input->post('password')),
							'repeat_password' => htmlentities($this->input->post('repeat_password')),
							'csrf_test_name' => htmlentities($this->input->post('csrf_test_name'))
							
			);	

			$this->load->library('qrcode/Ciqrcode'); //pemanggilan library QR CODE
 
	        $config['cacheable']    = true; //boolean, the default is true
	        $config['cachedir']     = './assets/'; //string, the default is application/cache/
	        $config['errorlog']     = './assets/'; //string, the default is application/logs/
	        $config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
	        $config['quality']      = true; //boolean, the default is true
	        $config['size']         = '1024'; //interger, the default is 1024
	        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
	        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
	        $this->ciqrcode->initialize($config);
	 
	        $image_name=$object['password'].'.png'; //buat name dari qr code sesuai dengan nim
	 
	        $params['data'] = $object['password']; //data yang akan di jadikan QR CODE
	        $params['level'] = 'H'; //H=High
	        $params['size'] = 10;
	        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
	        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

			$ok = $this->security->xss_clean($object, TRUE);
			$this->db->where('email', $ok['email']);
			$check = $this->db->get('user_rule');
			if ($check->num_rows() > 0 ) {
				echo json_encode(array('account_already'=> $check->result()));
			} else {
			$data = $this->M_user->create($ok, $image, $image_name);
			echo json_encode($data);
			}
		}
	}

}

/* End of file User.php */
/* Location: ./application/controllers/conten/User.php */