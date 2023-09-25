<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$data['view'] = 'admin/dashboard/index';
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();
        $data['cabang'] = $this->M_data->selectDataWhere('*', 'cabang');
        $data['jumlah_transaksi'] = $this->M_data->selectDataWhere('*', 'invoice', 'status', '3');

        $this->load->view('admin/layouts/app', $data);
	}
}
