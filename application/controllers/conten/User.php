<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
//OVERALL HAS DONE
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user');
		$this->load->model('M_dialy');
		$this->load->model('M_student');
		$this->load->library('access_library');
		if ($this->access_library->priv()== FALSE) {
			$this->session->set_flashdata('msg','error');
			redirect('conten/Dashboard','refresh');
		}
	
	}
	public function index()
	{
		$csrf['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$csrf['control'] = $this->M_user->all_control();
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
		$csrf['control'] = $this->M_user->all_control();
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


			$config['upload_path'] = "./assets/images/user";
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
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
	        $config['imagedir']     = './assets/images/qrcode/'; //direktori penyimpanan qr code
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

	function view_create_new_student()
	{
		$csrf['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$csrf['class'] = $this->M_dialy->all_class();
		$csrf['getcode'] = $this->M_student->baru();
		$this->template->load('layout','conten/v_create_newstudent', $csrf);
	}

	function add_new_student()
	{
		$config['upload_path'] = "./assets/images/student";
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['encrypt_name']	= TRUE;

		$this->load->library('upload' , $config);

		$this->upload->do_upload("img_file");
		$data_upload = array('upload_data' => $this->upload->data());
		$image = $data_upload['upload_data']['file_name'];

		$data = array('nis' => htmlentities($this->input->post('nis', TRUE)),
					  'firstname' => htmlentities($this->input->post('first_name', TRUE)),
					  'lastname' =>htmlentities($this->input->post('last_name', TRUE)),
					  'kelas' => htmlentities($this->input->post('kelas', TRUE)),
					  'date_of_birth' => htmlentities($this->input->post('date_of_birth', TRUE)),
					  'address' => htmlentities($this->input->post('address', TRUE)) 
					);
		$this->db->where('nis', $data['nis']);
		$this->db->where('firstname', $data['firstname']);
		$check = $this->db->get('student');
		
		if ($check->num_rows() > 0 ) {
			
			echo json_encode(array('data_already'=> $check->result()));
		} else {
		
		$obj = $this->M_student->add_new_student($data, $image);
		$this->output->set_content_type('application/json')->set_output(json_encode($obj));
		
		}
	}

	function update_student()
	{
		$this->form_validation->set_rules('nis', 'NIS', 'trim|required');
		$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
		$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'trim|required');
		$this->form_validation->set_rules('id_class', 'Class', 'trim|required');
		$this->form_validation->set_rules('address', 'Address', 'trim|required');


		if ($this->form_validation->run() == FALSE) {
			$errors = validation_errors();
            echo json_encode(['eror' => $errors]);
		} else {
			$config['upload_path'] = "./assets/images/student";
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['encrypt_name']	= TRUE;

			$this->load->library('upload' , $config);

			$this->upload->do_upload("image");
			$data_upload = array('upload_data' => $this->upload->data());
			$image = $data_upload['upload_data']['file_name'];

			$object = array('id_student' => htmlentities($this->input->post('id_student', TRUE)),
							'nis' => htmlentities($this->input->post('nis', TRUE)),
							'firstname' => htmlentities($this->input->post('firstname', TRUE)),
							'lastname' => htmlentities($this->input->post('lastname', TRUE)),
							'id_class' => htmlentities($this->input->post('id_class', TRUE)),
							'date_of_birth' => htmlentities($this->input->post('date_of_birth', TRUE)),
							'address' => htmlentities($this->input->post('address', TRUE)),
							'image' => $image							
			);	
			$data = $this->M_student->update_student($object);
			echo json_encode($data);
		}
	}

	function delete_student()
	{
		$id_student = $this->input->post('id_student');
		$data = $this->M_student->delete_student($id_student);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function view_list_student()
	{
		$csrf['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$csrf['class'] = $this->M_dialy->all_class();
		$this->template->load('layout','conten/v_list_student', $csrf);
	}

	function list_student()
	{
		$data = $this->M_student->list_student();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function View_role_user()
	{
		$csrf['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$csrf['control'] = $this->M_user->all_control();
		$csrf['student'] = $this->M_student->list_student();
		
		$this->template->load('layout','conten/v_role_admin', $csrf);
	}

	function search_role_user()	
	{
		$csrf['csrf'] = array(
			'name' => $this->security->get_csrf_token_name(),
			'hash' => $this->security->get_csrf_hash()
		);
		$csrf['id_user'] = $this->input->get('id_user');
		$csrf['firstname'] = $this->input->get('firstname');
		$csrf['id_control'] = $this->input->get('id_control');
		$csrf['control'] = $this->input->get('control');
		$this->template->load('layout','conten/v_role_user', $csrf);
		// $this->db->where('firstname', $firstname);
		// $p = $this->db->get('student')->result();
		// $this->output->set_content_type('application/json')->set_output(json_encode($p));

	}
}

/* End of file User.php */
/* Location: ./application/controllers/conten/User.php */
