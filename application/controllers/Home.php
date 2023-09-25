<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // if($this->session->userdata('status') != 'login'){
        //     redirect('auth/login');
        // }
        $this->load->model('M_data');
        $this->load->library('upload');
    }

    public function index()
	{
		$data['view'] = 'home/cabang';
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();
        $data['rekening'] = $this->M_data->selectDataWhere('*', 'rekening');
        $data['ongkir'] = $this->M_data->selectDataWhere('*', 'ongkir');
        $data['cabang'] = $this->M_data->selectDataWhere('*', 'cabang');

        $this->load->view('layouts/app', $data);
	}

	public function produk($id)
	{
		$data['view'] = 'home/index';
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();
        $data['rekening'] = $this->M_data->selectDataWhere('*', 'rekening');
        $data['ongkir'] = $this->M_data->selectDataWhere('*', 'ongkir');
        $data['cabang'] = $this->M_data->selectDataWhere('*', 'cabang', 'id', $id)->row();
        $data['produk'] = $this->db->query("SELECT produk.*, cabang.nama as cabang FROM produk JOIN cabang ON produk.cabang_id=cabang.id WHERE produk.cabang_id = '$id' ORDER BY produk.id DESC");

        $this->load->view('layouts/app', $data);
	}

    public function pencarian()
    {
        $data['view'] = 'home/pencarian';
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();
        $data['rekening'] = $this->M_data->selectDataWhere('*', 'rekening');
        $data['ongkir'] = $this->M_data->selectDataWhere('*', 'ongkir');

        $keyword = $this->input->get('keyword');
        $data['produk'] = $this->db->query("SELECT produk.*, cabang.nama as cabang FROM produk JOIN cabang ON produk.cabang_id=cabang.id WHERE produk.nama LIKE '%$keyword%' OR produk.deskripsi LIKE '%$keyword%' OR cabang.nama LIKE '%$keyword%' ORDER BY id DESC");

        $this->load->view('layouts/app', $data);
    }

    public function get_produk($id)
    {
        $paket = $this->db->query(
            "SELECT * FROM produk WHERE id = '$id'" 
        )->row();

        echo json_encode($paket);
    }
}
