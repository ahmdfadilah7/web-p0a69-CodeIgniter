<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h5 class="card-title fw-semibold mb-4">Pesanan</h5>
            <form action="<?= site_url('admin/pesanan/export') ?>" method="post" class="d-flex">
                <div class="form-group">
                    <label for="">Dari</label>
                    <input type="date" name="dari" class="form-control">
                </div>
                <div class="form-group" style="margin-left: 10px;">
                    <label for="">Sampai</label>
                    <input type="date" name="sampai" class="form-control">
                </div>
                <div class="form-group" style="margin-left: 10px;">
                    <label for="">Status</label>
                    <select name="status" class="form-select">
                        <option value="semua">Semua</option>
                        <?php
                            foreach ($status as $row) {
                                if ($row == '1') {
                                    $data = 'Diproses';
                                } elseif ($row == '2') {
                                    $data = 'Dikirim';
                                } elseif ($row == '3') {
                                    $data = 'Selesai';
                                }
                        ?>
                            <option value="<?= $row ?>"><?= $data ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group" style="margin-left: 10px;">
                    <button type="submit" class="btn btn-primary mt-4"><i class="ti ti-file-export"></i> Cetak</button>
                </div>
            </form>
        </div>
        <?php
            if ($this->session->flashdata('berhasil')) {
        ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p><?= $this->session->flashdata('berhasil') ?></p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            } elseif ($this->session->flashdata('gagal')) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php
                    foreach ($this->session->flashdata('gagal') as $row) {
                ?>
                    <p><?= $row ?></p>
                <?php
                    }
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
            }
        ?>

        <div class="table-responsive mt-4">
            <table class="table" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Invoice</th>
                        <th>Produk</th>
                        <th>Cabang</th>
                        <th>Subtotal</th>
                        <th>Ongkir</th>
                        <th>Total</th>
                        <th>Metode Pembayaran</th>
                        <th>Bukti Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
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
                                            produk.foto,
                                            cabang.nama as cabang
                                        FROM transaksi 
                                        INNER JOIN produk ON transaksi.produk_id=produk.id
                                        INNER JOIN cabang ON produk.cabang_id=cabang.id
                                        WHERE transaksi.invoice_id = '$row->id'
                                        "
                                    );
                                    foreach ($transaksi->result() as $key => $value) {
                                        $produk[$key] = $value->nama.' x'.$value->jumlah.' - '.rupiah($value->harga);
                                        echo $value->nama.' x'.$value->jumlah.'<br> '.rupiah($value->harga).'<br><br>';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    foreach ($transaksi->result() as $value) {
                                        echo $value->cabang.'<br><br><br>';
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
                            <td><?= rupiah($row->ongkos) ?></td>
                            <td>
                                <?= rupiah($row->total) ?>
                            </td>
                            <td><?= $row->metode_pembayaran ?></td>
                            <td>
                                <?php
                                    if ($row->metode_pembayaran <> 'COD') {
                                        $bukti = $this->db->query("SELECT * FROM pembayaran WHERE invoice_id = '$row->id'")->row();
                                ?>
                                <a href="<?= base_url($bukti->bukti_pembayaran) ?>" target="_blank">
                                    <img src="<?= base_url($bukti->bukti_pembayaran) ?>" width="60">
                                </a>
                                <?php
                                    }
                                ?>
                            </td>
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
                            <td>
                                <?php
                                    if ($row->status == '1') {
                                ?>
                                    <a href="<?= site_url('admin/pesanan/kirim/'.$row->kode_invoice) ?>" class="btn btn-warning btn-sm" title="Kirim"><i class="ti ti-send"></i></a>
                                <?php
                                    } elseif ($row->status == '2') {
                                ?>
                                    <a href="<?= site_url('admin/pesanan/selesai/'.$row->kode_invoice) ?>" class="btn btn-success btn-sm" title="Selesai"><i class="ti ti-check"></i></a>
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