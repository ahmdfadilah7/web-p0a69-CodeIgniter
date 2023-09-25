<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cabang extends CI_Controller {

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
		$data['view'] = 'admin/cabang/index';
        $data['cabang'] = $this->M_data->selectDataWhere('*', 'cabang');
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);
	}

    public function add() 
    {
        $data['view'] = 'admin/cabang/add';
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nama', 'Nama cabang', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_message('required', '{field} Wajib Diisi!!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/cabang/add'));
        } else {
            $insert['nama'] = $this->input->post('nama');
            $insert['deskripsi'] = $this->input->post('deskripsi');

            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF|ico';
            $dname = explode(".", $_FILES['foto']['name']);
            $ext = end($dname);
            $nama = 'cabang'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
            } else {
                $upload_data = $this->upload->data();

                $insert['foto'] = 'assets/images/'.$nama;
            }

            $this->M_data->insert($insert, 'cabang');

            $this->session->set_flashdata('berhasil', 'Berhasil menambahkan cabang.');
            redirect(base_url('admin/cabang'));
        }
    }

    public function edit($id) 
    {
        $data['view'] = 'admin/cabang/edit';
        $data['cabang'] = $this->M_data->selectDataWhere('*', 'cabang', 'id', $id)->row();
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);        
    }

    public function update($id) 
    {
        $this->form_validation->set_rules('nama', 'Nama cabang', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_message('required', '{field} Wajib Diisi!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/cabang/edit/'.$id));
        } else {
            $insert['nama'] = $this->input->post('nama');
            $insert['deskripsi'] = $this->input->post('deskripsi');

            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF|ico|webp';
            $dname = explode(".", $_FILES['foto']['name']);
            $ext = end($dname);
            $nama = 'Cabang'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
                echo $this->upload->display_errors();
            } else {
                $upload_data = $this->upload->data();

                $insert['foto'] = 'assets/images/'.$nama;
            }
            
            $this->M_data->updateData($insert, 'cabang', 'id', $id);

            $this->session->set_flashdata('berhasil', 'Berhasil mengedit cabang.');
            redirect(base_url('admin/cabang'));
        }
    }

    public function delete($id) 
    {
        $where = array('id' => $id);
        $delete = $this->M_data->delete('cabang', $where);
        if ($delete) {
            $this->session->set_flashdata('berhasil', 'cabang berhasil dihapus.');
            redirect(base_url('admin/cabang'));
        } else {
            $errors = array('cabang gagal dihapus!!');
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/cabang'));
        }
    }
}
