<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends CI_Controller {

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
		$data['view'] = 'admin/rekening/index';
        $data['rekening'] = $this->M_data->selectDataWhere('*', 'rekening');
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);
	}

    public function add() 
    {
        $data['view'] = 'admin/rekening/add';
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);
    }

    public function store()
    {
        $this->form_validation->set_rules('nama_rekening', 'Nama Rekening', 'required');
        $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required');
        $this->form_validation->set_rules('bank', 'Bank', 'required');
        $this->form_validation->set_message('required', '{field} Wajib Diisi!!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/rekening/add'));
        } else {
            $insert['nama_rekening'] = $this->input->post('nama_rekening');
            $insert['no_rekening'] = $this->input->post('no_rekening');
            $insert['bank'] = $this->input->post('bank');

            $this->M_data->insert($insert, 'rekening');

            $this->session->set_flashdata('berhasil', 'Berhasil menambahkan rekening.');
            redirect(base_url('admin/rekening'));
        }
    }

    public function edit($id) 
    {
        $data['view'] = 'admin/rekening/edit';
        $data['rekening'] = $this->M_data->selectDataWhere('*', 'rekening', 'id', $id)->row();
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();

        $this->load->view('admin/layouts/app', $data);        
    }

    public function update($id) 
    {
        $this->form_validation->set_rules('nama_rekening', 'Nama Rekening', 'required');
        $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required');
        $this->form_validation->set_rules('bank', 'Bank', 'required');
        $this->form_validation->set_message('required', '{field} Wajib Diisi!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/rekening/edit/'.$id));
        } else {
            $insert['nama_rekening'] = $this->input->post('nama_rekening');
            $insert['no_rekening'] = $this->input->post('no_rekening');
            $insert['bank'] = $this->input->post('bank');
            
            $this->M_data->updateData($insert, 'rekening', 'id', $id);

            $this->session->set_flashdata('berhasil', 'Berhasil mengedit rekening.');
            redirect(base_url('admin/rekening'));
        }
    }

    public function delete($id) 
    {
        $where = array('id' => $id);
        $delete = $this->M_data->delete('rekening', $where);
        if ($delete) {
            $this->session->set_flashdata('berhasil', 'Rekening berhasil dihapus');
            redirect(base_url('admin/rekening'));
        } else {
            $errors = array('Rekening gagal dihapus!!');
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('admin/rekening'));
        }
    }
}
