<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller 
{
		public function __construct()
	{
		parent::__construct();
		cek_login();
	}
	public function index()
	{
		$data['title']= 'My Profile';
		$data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		 
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/slidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer', $data);
		
	}

	public function edit()
	{
		$data['title']= 'Edit Profile';
		$data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		 
		$this->form_validation->set_rules('name', 'Name','required|trim');

		if($this->form_validation->run() == false)
		{
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer', $data);
		}
		else
		{
			$name=$this->input->post('name');
			$email=$this->input->post('email');

			//cek jika ada gambar
			$upload=$_FILES['image']['name'];
			
			if($upload)
			{
				$config['allowed_types'] = 'jpg|png';
				$config['max_size']     = '1024';
				// $config['max_width'] 	= '1024';
				// $config['max_height'] 	= '768';
				$config['upload_path'] = './assets/img/photo/';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image'))
				{
					$old_image=$data['user']['photo'];
					if ($old_image != 'default.png')
					{
						unlink(FCPATH . 'assets/img/photo/' . $old_image);
					}


					$new_image=$this->upload->data('file_name');
					$this->db->set('photo',$new_image);

				}
				// else
				// {
				// 	echo $this->upload->display_error();
				// }

			}



			$this->db->set('name', $name);
			$this->db->where('email', $email);
			$this->db->update('user');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated</div>');
                redirect('user');


        }

	}

	public function c_pass()
	{
		$data['title']= 'Change password';
		$data['user']= $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$this->form_validation->set_rules('last_password', 'Last password', 'required|trim');

		$this->form_validation->set_rules('new_password', 'New password', 'required|trim|min_length[6]|matches[con_password]');

		$this->form_validation->set_rules('con_password', 'Con password', 'required|trim|min_length[6]|matches[new_password]');



		if ($this->form_validation->run() == false) 
		{
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/slidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/c_pass', $data);
			$this->load->view('templates/footer', $data);
		}
		else
		{
			$last_password=$this->input->post('last_password');
			$new_password=$this->input->post('new_password');
			$con_password=$this->input->post('con_password');

			
			//password salah sama yg lama
			if (!password_verify($last_password, $data['user']['password'] ))
			{	
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong last password !</div>');
                redirect('user/c_pass');
			}
			else
			{	//password sama sama yg lama
				if ($last_password == $new_password)
				{
					$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Password cannot be the same as last password !</div>');
                redirect('user/c_pass');
				}
				else
				{
					//password ok
					$password_hash = password_hash(($new_password), PASSWORD_DEFAULT);
					
					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed !</div>');
                	redirect('user/c_pass');

				}
			}
			
		
		
		}
	
		
	

	}}
?>

