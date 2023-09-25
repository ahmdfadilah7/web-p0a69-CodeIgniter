<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <title>INVOICE <?= $settings->nama_website ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicon -->
    <link href="<?= base_url($settings->favicon) ?>" rel="icon">
    <style type="text/css">
        body {
            margin-top: 20px;
            color: #484b51;
        }

        .text-secondary-d1 {
            color: #728299 !important;
        }

        .page-header {
            margin: 0 0 1rem;
            padding-bottom: 1rem;
            padding-top: .5rem;
            border-bottom: 1px dotted #e2e2e2;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-align: center;
            align-items: center;
        }

        .page-title {
            padding: 0;
            margin: 0;
            font-size: 1.75rem;
            font-weight: 300;
        }

        .brc-default-l1 {
            border-color: #dce9f0 !important;
        }

        .ml-n1,
        .mx-n1 {
            margin-left: -.25rem !important;
        }

        .mr-n1,
        .mx-n1 {
            margin-right: -.25rem !important;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, .1);
        }

        .text-grey-m2 {
            color: #888a8d !important;
        }

        .text-success-m2 {
            color: #86bd68 !important;
        }

        .font-bolder,
        .text-600 {
            font-weight: 600 !important;
        }

        .text-110 {
            font-size: 110% !important;
        }

        .text-blue {
            color: #478fcc !important;
        }

        .pb-25,
        .py-25 {
            padding-bottom: .75rem !important;
        }

        .pt-25,
        .py-25 {
            padding-top: .75rem !important;
        }

        .bgc-default-tp1 {
            background-color: rgba(121, 169, 197, .92) !important;
        }

        .bgc-default-l4,
        .bgc-h-default-l4:hover {
            background-color: #f3f8fa !important;
        }

        .page-header .page-tools {
            -ms-flex-item-align: end;
            align-self: flex-end;
        }

        .btn-light {
            color: #757984;
            background-color: #f5f6f9;
            border-color: #dddfe4;
        }

        .w-2 {
            width: 1rem;
        }

        .text-120 {
            font-size: 120% !important;
        }

        .text-primary-m1 {
            color: #4087d4 !important;
        }

        .text-danger-m1 {
            color: #dd4949 !important;
        }

        .text-blue-m2 {
            color: #68a3d5 !important;
        }

        .text-150 {
            font-size: 150% !important;
        }

        .text-60 {
            font-size: 60% !important;
        }

        .text-grey-m1 {
            color: #7b7d81 !important;
        }

        .align-bottom {
            vertical-align: bottom !important;
        }
    </style>
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <div class="page-content container">
        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="text-150">
                                <img src="<?= base_url($settings->logo) ?>" width="50">
                                <span class="text-default-d3"><?= $settings->nama_website ?></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-120 text-right">
                                <span class="text-default-d3">
                                    <?= $invoice->kode_invoice ?>
                                </span>
                            </div>
                            <div class="text-120 text-right">
                                <span class="text-default-d3">
                                    <?= date('d M Y', strtotime($invoice->tanggal)) ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                    <div class="row">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">Nama Pemesan:</span>
                                <span class="text-600 text-110 text-blue align-middle"><?= $invoice->nama_user ?></span>
                            </div>
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">No. HP Pemesan:</span>
                                <span class="text-600 text-110 text-blue align-middle"><?= $invoice->no_telp ?></span>
                            </div>
                            <div>
                                <span class="text-sm text-grey-m2 align-middle">Alamat Pemesan:</span>
                                <span class="text-600 text-110 text-blue align-middle"><?= $invoice->alamat ?></span>
                            </div>                            
                        </div>
                        <div class="col-sm-6 text-right">
                            <div>
                                <span class="text-600 text-110 text-blue align-middle"><?= $settings->nama_website ?></span>
                            </div>
                            <div>
                                <span class="text-600 text-110 text-blue align-middle"><?= $settings->no_telp ?></span>
                            </div>
                            <div>
                                <span class="text-600 text-110 text-blue align-middle"><?= $settings->alamat ?></span>
                            </div>                            
                        </div>

                    </div>
                    <div class="mt-4">
                        <div class="row text-600 text-white bgc-default-tp1 py-25">
                            <div class="d-none d-sm-block col-1">#</div>
                            <div class="col-3 col-sm-2">Cabang</div>
                            <div class="col-4 col-sm-3">Produk</div>
                            <div class="d-none d-sm-block col-3 col-sm-2">Jumlah</div>
                            <div class="d-none d-sm-block col-sm-2">Harga</div>
                            <div class="col-2">Total</div>
                        </div>
                        <div class="text-95 text-secondary-d3">
                            <?php                    
                                $transaksi = $this->db->query("SELECT transaksi.*, produk.nama, produk.harga, cabang.nama as cabang FROM transaksi JOIN produk ON transaksi.produk_id=produk.id JOIN cabang ON produk.cabang_id=cabang.id WHERE invoice_id = '$invoice->id'");        
                                $no = 1;
                                foreach ($transaksi->result() as $value) {
                            ?>
                            <div class="row mb-2 mb-sm-0 py-25">
                                <div class="d-none d-sm-block col-1"><?= $no ?></div>
                                <div class="col-3 col-sm-2"><?= $value->cabang ?></div>
                                <div class="col-4 col-sm-3"><?= $value->nama ?></div>
                                <div class="d-none d-sm-block col-2"><?= $value->jumlah ?></div>
                                <div class="d-none d-sm-block col-2 text-95">
                                    <?= rupiah($value->harga) ?>
                                </div>
                                <div class="col-2 text-secondary-d2"><?= rupiah($value->total) ?></div>
                            </div>

                            <?php
                                $no++; 
                                }
                            ?>                          
                        </div>
                        <div class="row border-b-2 brc-default-l2"></div>


                        <div class="row mt-3">
                            <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                <div>
                                    Metode Pembayaran
                                    <p><?= $invoice->metode_pembayaran ?></p>
                                </div>
                                <div>
                                    Jasa Pengiriman
                                    <p><?= $invoice->kurir.' - '.$invoice->layanan ?></p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">                                
                                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                    <div class="col-5 text-right">
                                        Ongkos Kirim
                                    </div>
                                    <div class="col-7">
                                        <span class="text-150 text-success-d3 opacity-2"><?= rupiah($invoice->ongkos) ?></span>
                                    </div>
                                    <div class="col-5 text-right">
                                        Total Pembayaran
                                    </div>
                                    <div class="col-7">
                                        <span class="text-150 text-success-d3 opacity-2"><?= rupiah($invoice->total) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="d-flex justify-content-between">
                            <span class="text-secondary-d1 text-105">Terimakasih sudah berbelanja di <?= $settings->nama_website ?></span>
                            <div class="d-flex">
                                <a href="<?= site_url('pesanan/print/'.$this->uri->segment(3)) ?>" class="btn btn-primary mr-2"><i class="fa fa-print"></i> Print</a>
                                <a href="<?= site_url('pesanan') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
