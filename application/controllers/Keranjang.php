<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keranjang extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata('status_pelanggan') != 'login'){
            $this->session->set_flashdata('warning', 'Anda harus login terlebih dahulu!!!');
            redirect(base_url('auth/login'));
        }
        $this->load->model('M_data');
        $this->load->library('upload');
    }

	public function index()
	{
		$data['view'] = 'keranjang/index';
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();
        $data['rekening'] = $this->M_data->selectDataWhere('*', 'rekening');
        $data['ongkir'] = $this->M_data->selectDataWhere('*', 'ongkir');

        $user_id = $this->session->userdata('id_pelanggan');
        $data['produk'] = $this->db->query(
                "SELECT 
                    produk.nama, 
                    produk.deskripsi, 
                    transaksi.id, 
                    transaksi.jumlah, 
                    transaksi.total, 
                    produk.harga,
                    produk.foto,
                    invoice.kode_invoice,
                    invoice.status
                FROM transaksi 
                INNER JOIN produk ON transaksi.produk_id=produk.id
                INNER JOIN invoice ON transaksi.invoice_id=invoice.id
                WHERE invoice.status = '0' AND invoice.user_id = '$user_id'
                "
            );        

        $this->load->view('layouts/app', $data);
	}

    public function pembayaran($id) 
    {
        $invoice_id = $this->M_data->selectDataWhere('*', 'invoice', 'kode_invoice', $id)->row();
        $transaksi = $this->M_data->selectDataWhere('*', 'transaksi', 'invoice_id', $invoice_id->id);
        foreach ($transaksi->result() as $row) {
            $total[] = $row->total;
        }

        $data = array(
            'invoice_id' => $invoice_id->id,
            'kode_invoice' => $id,
            'total' => array_sum($total)
        );

        echo json_encode($data);
    }

    public function pengiriman($id, $id2) 
    {
        $ongkir = $this->M_data->selectDataWhere('*', 'ongkir', 'id', $id)->row();
        $cek_data = $this->M_data->selectDataWhere('*', 'ongkir', 'id', $id)->num_rows();
        $transaksi = $this->M_data->selectDataWhere('*', 'transaksi', 'invoice_id', $id2);
        foreach ($transaksi->result() as $row) {
            $total[] = $row->total;
        }

        if ($cek_data > 0) {
            $ongkos = $ongkir->ongkos + array_sum($total);
        } else {
            $ongkos = array_sum($total);
        }

        $data = array(
            'total' => $ongkos
        );

        echo json_encode($data);
    }

    public function update_jumlah($id)
    {
        $insert['jumlah'] = $jumlah = $this->input->post('jumlah');
        $insert['total'] = $jumlah * $this->input->post('harga_produk');
        $this->M_data->updateData($insert, 'transaksi', 'id', $id);

        $this->session->set_flashdata('berhasil', 'Berhasil menambahkan jumlah.');
        redirect(base_url('keranjang'));
    }

    public function hapus_produk($id)
    {
        $where = array('id' => $id);
        $delete = $this->M_data->delete('transaksi', $where);
        if ($delete) {
            $this->session->set_flashdata('berhasil', 'Produk berhasil dihapus dari keranjang.');
            redirect(base_url('keranjang'));
        } else {
            $errors = array('Produk gagal dihapus dari keranjang!!');
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('keranjang'));
        }
    }

    public function proses_pembayaran()
    {        
        $this->form_validation->set_rules('pengiriman', 'Pengiriman', 'required');
        $this->form_validation->set_rules('metode_pembayaran', 'Metode Pembayaran', 'required');
        $this->form_validation->set_message('required', '{field} Wajib diisi!!');
        if ($this->form_validation->run()==FALSE) {
            $errors = $this->form_validation->error_array();
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('keranjang'));
        } elseif ($this->input->post('pengiriman') == 0) {
            $errors = array('1' => 'Pengiriman Wajib diisi!!');
            $this->session->set_flashdata('gagal', $errors);
            redirect(base_url('keranjang'));
        } else {
            $update['status'] = '1';
            $update['total'] = $this->input->post('total');
            $update['ongkir_id'] = $this->input->post('pengiriman');
            $update['metode_pembayaran'] = $this->input->post('metode_pembayaran');
            $this->M_data->updateData($update, 'invoice', 'id', $this->input->post('invoice_id'));
    
            if ($this->input->post('metode_pembayaran') <> 'COD' && $this->input->post('metode_pembayaran') <> '') {
                $insert['invoice_id'] = $this->input->post('invoice_id');
                $insert['tanggal'] = date('Y-m-d');
        
                $config['upload_path'] = "assets/images/";
                $config['overwrite'] = TRUE;            
                $config['allowed_types'] = 'svg|SVG|jpg|bmp|BMP|png|PNG|JPG|jpeg|JPEG|gif|GIF';
                $dname = explode(".", $_FILES['bukti_pembayaran']['name']);
                $ext = end($dname);
                $nama = 'Bukti-Pembayaran'."-".time().'-'.rand(100,999).".".$ext;
                $config['file_name'] = $nama;
                $config['remove_spaces'] = FALSE;
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('bukti_pembayaran')) {
                } else {
                    $upload_data = $this->upload->data();
        
                    $insert['bukti_pembayaran'] = 'assets/images/'.$nama;
                }
                
                $this->M_data->insert($insert, 'pembayaran');
            }
    
            $this->session->set_flashdata('berhasil', 'Berhasil melakukan pembayaran.');
            redirect(base_url('keranjang'));
        }
    }

    public function store()
    {
        $user_id = $this->session->userdata('id_pelanggan');
        $produk_id = $this->input->post('produk_id');
        $invoice = $this->db->query("SELECT * FROM invoice WHERE user_id = '$user_id' AND status = '0'");
        
        if ($invoice->num_rows() > 0) {
            $invoice_id = $invoice->row()->id;
            $transaksi = $this->db->query("SELECT * FROM transaksi WHERE produk_id = '$produk_id' AND invoice_id = '$invoice_id'");
            if ($transaksi->num_rows() > 0) {
                $updatetransaksi['jumlah'] = $jumlah = $transaksi->row()->jumlah + $this->input->post('jumlah');
                $updatetransaksi['total'] = $this->input->post('harga_produk') * $jumlah;
                $this->M_data->updateData($updatetransaksi, 'transaksi', 'id', $transaksi->row()->id);
            } else {
                $addtransaksi['invoice_id'] = $invoice_id;
                $addtransaksi['produk_id'] = $produk_id;
                $addtransaksi['jumlah'] = $this->input->post('jumlah');
                $addtransaksi['total'] = $this->input->post('total');
                $addtransaksi['tanggal'] = date('Y-m-d');
                
                $this->M_data->insert($addtransaksi, 'transaksi');
            }
        } else {
            $max_invoice = $this->M_data->selectDataWhere('max(kode_invoice) as max_invoice', 'invoice');
            if ($max_invoice->num_rows() > 0) {
                $urutan = (int) substr($max_invoice->row()->max_invoice, 11, 3);
                $urutan++;
                $insert['kode_invoice'] = 'INV'.date('dmY').sprintf('%03s', $urutan);
            } else {
                $insert['kode_invoice'] = 'INV'.date('dmY').'001';
            }
            $insert['user_id'] = $this->session->userdata('id_pelanggan');
            $insert['status'] = '0';
            $insert['tanggal'] = date('Y-m-d');
            $this->db->insert('invoice', $insert);
            $invoice_id = $this->db->insert_id();

            $addtransaksi['invoice_id'] = $invoice_id;
            $addtransaksi['produk_id'] = $produk_id;
            $addtransaksi['jumlah'] = $this->input->post('jumlah');
            $addtransaksi['total'] = $this->input->post('total');
            $addtransaksi['tanggal'] = date('Y-m-d');

            $this->M_data->insert($addtransaksi, 'transaksi');
        }

        $this->session->set_flashdata('berhasil', 'Berhasil menambahkan ke keranjang.');
        redirect(base_url('keranjang'));

    }
}
