<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pesanan extends CI_Controller {

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
		$data['view'] = 'pesanan/index';
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();
        $data['rekening'] = $this->M_data->selectDataWhere('*', 'rekening');

        $user_id = $this->session->userdata('id_pelanggan');
        $data['invoice'] = $this->db->query("SELECT * FROM invoice WHERE status != '0' AND user_id='$user_id' ORDER BY status ASC");

        $this->load->view('layouts/app', $data);
	}

    public function invoice($kode_invoice)
    {
        $data['view'] = 'pesanan/invoice';
        $data['settings'] = $settings = $this->M_data->selectDataWhere('*', 'setting')->row();
        $data['rekening'] = $this->M_data->selectDataWhere('*', 'rekening');

        $data['invoice'] = $invoice = $this->db->query("SELECT invoice.*, ongkir.kurir, ongkir.layanan, ongkir.ongkos, user.nama_user, user.no_telp, user.alamat FROM invoice JOIN ongkir ON invoice.ongkir_id=ongkir.id JOIN user ON invoice.user_id=user.id WHERE kode_invoice = '$kode_invoice'")->row();

        $this->load->view('pesanan/invoice', $data);
        
    }
    
    public function print($kode_invoice)
    {
        $settings = $this->M_data->selectDataWhere('*', 'setting')->row();
        $invoice = $this->db->query("SELECT invoice.*, ongkir.kurir, ongkir.layanan, ongkir.ongkos, user.nama_user, user.no_telp, user.alamat FROM invoice JOIN ongkir ON invoice.ongkir_id=ongkir.id JOIN user ON invoice.user_id=user.id WHERE kode_invoice = '$kode_invoice'")->row();
        require_once(APPPATH.'helpers/tcpdf/tcpdf.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setTitle('INVOICE '.$kode_invoice);
        // set default header data
        $pdf->SetHeaderData('', 0, $settings->nama_website, $settings->email);
        $pdf->AddPage();

        $html = '<table style="width: 100%;">
            <tr>
                <th style="width: 50%">Nama Pemesan: '.$invoice->nama_user.'</th>
                <th style="width: 50%; text-align: right;">'.$settings->nama_website.'</th>
            </tr>
            <tr>
                <th style="width: 50%">No. HP Pemesan: '.$invoice->no_telp.'</th>
                <th style="width: 50%; text-align: right;">'.$settings->no_telp.'</th>
            </tr>
            <tr>
                <th style="width: 50%">Alamat: '.$invoice->alamat.'</th>
                <th style="width: 50%; text-align: right;">'.$settings->alamat.'</th>
            </tr>
            <tr>
                <th style="width: 50%"></th>
                <th style="width: 50%; text-align: right;"></th>
            </tr>
            <tr>
                <th style="width: 50%">'.$invoice->kode_invoice.'</th>
                <th style="width: 50%; text-align: right;">'.date('d M Y', strtotime($invoice->tanggal)).'</th>
            </tr>
        </table>';
        $html .= '<table border="1px" cellpadding="6" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Cabang</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>';
        $transaksi = $this->db->query("SELECT transaksi.*, produk.nama, produk.harga, cabang.nama as cabang FROM transaksi JOIN produk ON transaksi.produk_id=produk.id JOIN cabang ON produk.cabang_id=cabang.id WHERE invoice_id = '$invoice->id'");        
        $no = 1;
        foreach ($transaksi->result() as $value) {
        $html .= '<tr>
            <td>'.$no.'</td>
            <td>'.$value->cabang.'</td>
            <td>'.$value->nama.'</td>
            <td>'.$value->jumlah.'</td>
            <td>'.rupiah($value->harga).'</td>
            <td>'.rupiah($value->total).'</td>
            </tr>';
        $no++;
        }
        $html .= '</tbody>
            </table>';
        $html .= '<table style="width: 100%;">
            <tr>
                <th style="width: 50%">Metode Pembayaran: '.$invoice->metode_pembayaran.'</th>
                <th style="width: 50%; text-align: right;">Ongkos Kirim:'.rupiah($invoice->ongkos).'</th>
            </tr>
            <tr>
                <th style="width: 50%">Jasa Pengiriman: '.$invoice->kurir.' - '.$invoice->layanan.'</th>
                <th style="width: 50%; text-align: right;">Total Pembayaran:'.rupiah($invoice->total).'</th>
            </tr>
        </table>';
        $pdf->writeHTML($html);
        $pdf->Output('Invoice-'.$kode_invoice.'-'.date('His').'.pdf');
    }
}
