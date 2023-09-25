<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ongkir extends CI_Controller {

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
		$data['view'] = 'admin/ongkir/index';
        $data['ongkir'] = $this->M_data->selectDataWhere('*', 'ongkir');
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);
	}

    public function add() 
    {
        $data['view'] = 'admin/ongkir/add';
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('kurir', 'Kurir', 'required');
        $this->form_validation->set_rules('layanan', 'Layanan', 'required');
        $this->form_validation->set_rules('ongkos', 'Ongkos', 'required');
        $this->form_validation->set_message('required', '{field} Wajib Diisi!!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/ongkir/add'));
        } else {
            $insert['kurir'] = $this->input->post('kurir');
            $insert['layanan'] = $this->input->post('layanan');
            $insert['ongkos'] = $this->input->post('ongkos');

            $this->M_data->insert($insert, 'ongkir');

            $this->session->set_flashdata('berhasil', 'Berhasil menambahkan ongkir.');
            redirect(base_url('admin/ongkir'));
        }
    }

    public function edit($id) 
    {
        $data['view'] = 'admin/ongkir/edit';
        $data['ongkir'] = $this->M_data->selectDataWhere('*', 'ongkir', 'id', $id)->row();
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);        
    }

    public function update($id) 
    {
        $this->form_validation->set_rules('kurir', 'Kurir', 'required');
        $this->form_validation->set_rules('layanan', 'Layanan', 'required');
        $this->form_validation->set_rules('ongkos', 'Ongkos', 'required');
        $this->form_validation->set_message('required', '{field} Wajib Diisi!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/ongkir/edit/'.$id));
        } else {
            $insert['kurir'] = $this->input->post('kurir');
            $insert['layanan'] = $this->input->post('layanan');
            $insert['ongkos'] = $this->input->post('ongkos');
            
            $this->M_data->updateData($insert, 'ongkir', 'id', $id);

            $this->session->set_flashdata('berhasil', 'Berhasil mengedit ongkir.');
            redirect(base_url('admin/ongkir'));
        }
    }

    public function delete($id) 
    {
        $where = array('id' => $id);
        $delete = $this->M_data->delete('ongkir', $where);
        if ($delete) {
            $this->session->set_flashdata('berhasil', 'ongkir berhasil dihapus');
            redirect(base_url('admin/ongkir'));
        } else {
            $errors = array('ongkir gagal dihapus!!');
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/ongkir'));
        }
    }
}
