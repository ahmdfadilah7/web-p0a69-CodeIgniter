<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status') != 'login'){
            redirect('auth/login');
        }
        $this->load->model('M_data');
        $this->load->library('upload');
    }

	public function index()
	{
		$data['view'] = 'admin/user/index';
        $data['user'] = $this->M_data->selectDataWhere('*', 'user');
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);
	}

    public function add() 
    {
        $data['view'] = 'admin/user/add';
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nama_user', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_message('required', '{field} Wajib Diisi!!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/user/add'));
        } else {
            $insert['nama_user'] = $this->input->post('nama_user');
            $insert['username'] = $this->input->post('username');
            $insert['password'] = md5($this->input->post('password'));
            $insert['role'] = 'Admin';

            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF|ico';
            $dname = explode(".", $_FILES['foto']['name']);
            $ext = end($dname);
            $nama = 'User'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
            } else {
                $upload_data = $this->upload->data();

                $insert['foto'] = 'assets/images/'.$nama;
            }

            $this->M_data->insert($insert, 'user');

            $this->session->set_flashdata('berhasil', 'Berhasil menambahkan user.');
            redirect(base_url('admin/user'));
        }
    }

    public function edit($id) 
    {
        $data['view'] = 'admin/user/edit';
        $data['user'] = $this->M_data->selectDataWhere('*', 'user', 'id', $id)->row();
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);        
    }

    public function update($id) 
    {
        $this->form_validation->set_rules('nama_user', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_message('required', '{field} Wajib Diisi!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/user/edit/'.$id));
        } else {
            $insert['nama_user'] = $this->input->post('nama_user');
            $insert['username'] = $this->input->post('username');
            
            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF|ico';
            $dname = explode(".", $_FILES['foto']['name']);
            $ext = end($dname);
            $nama = 'User'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
            } else {
                $upload_data = $this->upload->data();

                $insert['foto'] = 'assets/images/'.$nama;
            }

            if ($this->input->post('password') <> '') {
                $insert['password'] = md5($this->input->post('password'));
            }
            
            $this->M_data->updateData($insert, 'user', 'id', $id);

            $this->session->set_flashdata('berhasil', 'Berhasil mengedit user.');
            redirect(base_url('admin/user'));
        }
    }

    public function delete($id) 
    {
        $where = array('id' => $id);
        $delete = $this->M_data->delete('user', $where);
        if ($delete) {
            $this->session->set_flashdata('berhasil', 'User berhasil dihapus');
            redirect(base_url('admin/user'));
        } else {
            $errors = array('User gagal dihapus!!');
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/user'));
        }
    }
}
