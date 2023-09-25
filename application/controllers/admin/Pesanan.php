<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Pesanan extends CI_Controller {

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
		$data['view'] = 'admin/pesanan/index';
        $data['invoice'] = $this->db->query("SELECT invoice.*, ongkir.ongkos FROM invoice JOIN ongkir ON invoice.ongkir_id=ongkir.id WHERE status != '0' ORDER BY status ASC");
        $data['settings'] = $this->M_data->selectDataWhere('*', 'setting')->row();
        $data['status'] = array('1', '2', '3');

        $this->load->view('admin/layouts/app', $data);
	}

    public function kirim($kode_invoice)
    {
        $update['status'] = '2';
        $this->M_data->updateData($update, 'invoice', 'kode_invoice', $kode_invoice);

        $this->session->set_flashdata('berhasil', 'Pesanan dikirim.');
        redirect(base_url('admin/pesanan'));
    }

    public function selesai($kode_invoice)
    {
        $update['status'] = '3';
        $this->M_data->updateData($update, 'invoice', 'kode_invoice', $kode_invoice);

        $this->session->set_flashdata('berhasil', 'Pesanan selesai.');
        redirect(base_url('admin/pesanan'));
    }

    public function export()
    {
        $dari = $this->input->post('dari');
        $sampai = $this->input->post('sampai');
        $status = $this->input->post('status');
        if ($status == 'semua') {
            $invoice = $this->db->query("SELECT invoice.*, user.nama_user, ongkir.ongkos, ongkir.kurir, ongkir.layanan FROM invoice JOIN user ON invoice.user_id=user.id JOIN ongkir ON invoice.ongkir_id=ongkir.id WHERE status != '0' AND tanggal BETWEEN '$dari' AND '$sampai' ORDER BY id DESC");
        } else {
            $invoice = $this->db->query("SELECT invoice.*, user.nama_user, ongkir.ongkos, ongkir.kurir, ongkir.layanan FROM invoice JOIN user ON invoice.user_id=user.id JOIN ongkir ON invoice.ongkir_id=ongkir.id WHERE status = '$status' AND tanggal BETWEEN '$dari' AND '$sampai' ORDER BY id DESC");
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan-Pesanan-'.date('his').'-'.$dari.'_'.$sampai.'.xls"');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Invoice');
        $sheet->setCellValue('C1', 'Nama Pelanggan');
        $sheet->setCellValue('D1', 'Cabang');
        $sheet->setCellValue('E1', 'Produk');
        $sheet->setCellValue('F1', 'Harga');
        $sheet->setCellValue('G1', 'Jumlah');
        $sheet->setCellValue('H1', 'Subtotal');
        $sheet->setCellValue('I1', 'Ongkir');
        $sheet->setCellValue('J1', 'Total');
        $sheet->setCellValue('K1', 'Pengiriman');
        $sheet->setCellValue('L1', 'Metode Pembayaran');
        $sheet->setCellValue('M1', 'Tanggal');
        $sheet->setCellValue('N1', 'Status');

        $i=2;
        $no=1;
        foreach ($invoice->result() as $row) {
            if ($row->status == '1') {
                $status = 'Diproses';
            } elseif ($row->status == '2') {
                $status = 'Dikirim';
            } elseif ($row->status == '3') {
                $status = 'Selesai';
            }

            $transaksi = $this->db->query(
                "SELECT 
                    produk.nama, 
                    produk.deskripsi, 
                    transaksi.id, 
                    transaksi.jumlah, 
                    transaksi.total, 
                    transaksi.invoice_id, 
                    produk.harga,
                    produk.foto,
                    cabang.nama as cabang
                FROM transaksi 
                INNER JOIN produk ON transaksi.produk_id=produk.id
                INNER JOIN cabang ON produk.cabang_id=cabang.id
                WHERE transaksi.invoice_id = '$row->id'
                "
            );
            foreach ($transaksi->result() as $key => $value) {
                $produk[$key] = $value->nama;
                $harga[$key] = rupiah($value->harga);
                $jumlah[$key] = $value->jumlah;
                $subtotal[$key] = rupiah($value->total);
                $cabang[$key] = $value->cabang;
            }
            if ($transaksi->num_rows() > 1) {
                $produkname = implode(', ', $produk);
                $harganame = implode(', ', $harga);
                $jumlahname = implode(', ', $jumlah);
                $subtotalname = implode(', ', $subtotal);
                $cabangname = implode(', ', $cabang);
            } else {
                $produkname = $produk[0];
                $harganame = $harga[0];
                $jumlahname = $jumlah[0];
                $subtotalname = $subtotal[0];
                $cabangname = $cabang[0];
            }

            $sheet->setCellValue('A'.$i, $no);
            $sheet->setCellValue('B'.$i, $row->kode_invoice);
            $sheet->setCellValue('C'.$i, $row->nama_user);
            $sheet->setCellValue('D'.$i, $cabangname);
            $sheet->setCellValue('E'.$i, $produkname);
            $sheet->setCellValue('F'.$i, $harganame);
            $sheet->setCellValue('G'.$i, $jumlahname);
            $sheet->setCellValue('H'.$i, $subtotalname);
            $sheet->setCellValue('I'.$i, rupiah($row->ongkos));
            $sheet->setCellValue('J'.$i, rupiah($row->total));
            $sheet->setCellValue('K'.$i, $row->kurir.' - '.$row->layanan);
            $sheet->setCellValue('L'.$i, $row->metode_pembayaran);
            $sheet->setCellValue('M'.$i, $row->tanggal);
            $sheet->setCellValue('N'.$i, $status);

            $i++;
            $no++;
        }

        $writer = new Xls($spreadsheet);
        $writer->save("php://output");
    }

}
