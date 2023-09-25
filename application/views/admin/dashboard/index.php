<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold text-center">SELAMAT DATANG <?= strtoupper($this->session->userdata('nama')) ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold"><i class="ti ti-hand-finger"></i></h5>
                        <h5 class="card-title fw-semibold">Transaksi</h5>
                        <h6><?= $jumlah_transaksi->num_rows(); ?> Transaksi</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold"><i class="ti ti-currency-dollar"></i></h5>
                        <h5 class="card-title fw-semibold">Total Penjualan</h5>
                        <?php
                            $total = array();
                            foreach ($jumlah_transaksi->result() as $row) {
                                $total[] = $row->total;
                            }
                        ?>
                        <h6><?= rupiah(array_sum($total)) ?></h6>
                    </div>
                </div>
            </div>

            <?php
                foreach ($cabang->result() as $row) {
            ?>
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold"><i class="ti ti-hand-finger"></i></h5>
                        <h5 class="card-title fw-semibold">Transaksi <?= $row->nama ?></h5>
                        <?php
                            $transaksi = $this->db->query("SELECT * FROM transaksi JOIN invoice ON transaksi.invoice_id=invoice.id JOIN produk ON transaksi.produk_id=produk.id WHERE cabang_id = '$row->id' AND invoice.status != '0'")->num_rows();
                        ?>
                        <h6><?= $transaksi ?></h6>
                    </div>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Penjualan</h5>
                    </div>
                </div>
                <div id="chart"></div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Penjualan Cabang</h5>
                    </div>
                </div>
                <div id="chart1"></div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Riwayat Pesanan Selesai</h5>            

                <div class="table-responsive mt-4">
                    <table class="table table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Invoice</th>
                                <th>Produk</th>
                                <th>Subtotal</th>
                                <th>Total</th>
                                <th>Metode Pembayaran</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                $invoice = $this->db->query("SELECT * FROM invoice WHERE status = '3' ORDER BY id DESC LIMIT 5");
                                foreach ($invoice->result() as $row) {
                            ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $row->kode_invoice ?></td>
                                    <td>
                                        <?php
                                            $transaksi = $this->db->query(
                                                "SELECT 
                                                    produk.nama, 
                                                    produk.deskripsi, 
                                                    transaksi.id, 
                                                    transaksi.jumlah, 
                                                    transaksi.total, 
                                                    transaksi.invoice_id, 
                                                    produk.harga,
                                                    produk.foto
                                                FROM transaksi 
                                                INNER JOIN produk ON transaksi.produk_id=produk.id
                                                WHERE transaksi.invoice_id = '$row->id'
                                                "
                                            );
                                            foreach ($transaksi->result() as $value) {
                                                echo $value->nama.' x'.$value->jumlah.'<br> '.rupiah($value->harga).'<br><br>';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            foreach ($transaksi->result() as $value) {
                                                echo rupiah($value->total).'<br><br><br>';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?= rupiah($row->total) ?>
                                    </td>
                                    <td><?= $row->metode_pembayaran ?></td>
                                    
                                    <td><?= date('d M Y', strtotime($row->tanggal)) ?></td>
                                    <td>
                                        <?php
                                            if ($row->status == '1') {
                                        ?>
                                            <span class="badge bg-primary">Diproses</span>
                                        <?php
                                            } elseif ($row->status == '2') {
                                        ?>
                                            <span class="badge bg-warning">Dikirim</span>
                                        <?php
                                            } elseif ($row->status == '3') {
                                        ?>
                                            <span class="badge bg-success">Selesai</span>
                                        <?php
                                            }
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
