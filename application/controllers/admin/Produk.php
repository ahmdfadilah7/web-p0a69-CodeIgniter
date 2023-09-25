<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

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
		$data['view'] = 'admin//produk/index';
        $data['produk'] = $this->db->query("SELECT produk.*, cabang.nama as cabang FROM produk JOIN cabang ON produk.cabang_id=cabang.id ORDER BY produk.id DESC");
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);
	}

    public function add() 
    {
        $data['view'] = 'admin/produk/add';
        $data['cabang'] = $this->M_data->selectDataWhere('*', 'cabang');
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nama', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga Produk', 'required');
        $this->form_validation->set_rules('cabang_id', 'Cabang', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_message('required', '{field} Wajib Diisi!!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/produk/add'));
        } else {
            $insert['nama'] = $this->input->post('nama');
            $insert['harga'] = $this->input->post('harga');
            $insert['deskripsi'] = $this->input->post('deskripsi');
            $insert['cabang_id'] = $this->input->post('cabang_id');

            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF|ico';
            $dname = explode(".", $_FILES['foto']['name']);
            $ext = end($dname);
            $nama = 'Produk'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
            } else {
                $upload_data = $this->upload->data();

                $insert['foto'] = 'assets/images/'.$nama;
            }

            $this->M_data->insert($insert, 'produk');

            $this->session->set_flashdata('berhasil', 'Berhasil menambahkan produk.');
            redirect(base_url('admin/produk'));
        }
    }

    public function edit($id) 
    {
        $data['view'] = 'admin/produk/edit';
        $data['cabang'] = $this->M_data->selectDataWhere('*', 'cabang');
        $data['produk'] = $this->M_data->selectDataWhere('*', 'produk', 'id', $id)->row();
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);        
    }

    public function update($id) 
    {
        $this->form_validation->set_rules('nama', 'Nama Produk', 'required');
        $this->form_validation->set_rules('harga', 'Harga Produk', 'required');
        $this->form_validation->set_rules('cabang_id', 'Cabang', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        $this->form_validation->set_message('required', '{field} Wajib Diisi!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/produk/edit/'.$id));
        } else {
            $insert['nama'] = $this->input->post('nama');
            $insert['harga'] = $this->input->post('harga');
            $insert['cabang_id'] = $this->input->post('cabang_id');
            $insert['deskripsi'] = $this->input->post('deskripsi');

            $config['upload_path'] = "assets/images/";
            $config['overwrite'] = TRUE;            
            $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF|ico';
            $dname = explode(".", $_FILES['foto']['name']);
            $ext = end($dname);
            $nama = 'Produk'."-".time().'-'.rand(100,999).".".$ext;
            $config['file_name'] = $nama;
            $config['remove_spaces'] = FALSE;
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto')) {
            } else {
                $upload_data = $this->upload->data();

                $insert['foto'] = 'assets/images/'.$nama;
            }
            
            $this->M_data->updateData($insert, 'produk', 'id', $id);

            $this->session->set_flashdata('berhasil', 'Berhasil mengedit produk.');
            redirect(base_url('admin/produk'));
        }
    }

    public function delete($id) 
    {
        $where = array('id' => $id);
        $delete = $this->M_data->delete('produk', $where);
        if ($delete) {
            $this->session->set_flashdata('berhasil', 'Produk berhasil dihapus.');
            redirect(base_url('admin/produk'));
        } else {
            $errors = array('Produk gagal dihapus!!');
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/produk'));
        }
    }
}
