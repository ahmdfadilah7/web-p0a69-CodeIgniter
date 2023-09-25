<section class="pesanan-container">
    <div class="pesanan-title">
        <h1>Pesanan</h1>
    </div>
    <div class="pesanan-content-container">
        <!-- Content will be dynamically added here -->
        <?php
            foreach ($invoice->result() as $value) {
        ?>
            <div class="pesanan-content-box">
                <a href="<?= site_url('pesanan/invoice/'.$value->kode_invoice) ?>" style="text-decoration:unset; color:black">                    
                    <div class="m-3 d-flex justify-content-between">
                        <h1>Kode Invoice : <?= $value->kode_invoice ?></h1>
                        <h1>Metode Pembayaran : <span class="badge text-bg-primary"><?= $value->metode_pembayaran ?></span></h1>
                    </div>
                    <?php
                        $produk = $this->db->query(
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
                            WHERE transaksi.invoice_id = '$value->id'
                            "
                        );
                        foreach ($produk->result() as $row) {
                    ?>                    
                        <div class="pesanan-content-box-list">
                            <div class="pesanan-content-box-item">
                                <img src="<?= base_url($row->foto) ?>" alt="">
                                <div class="pesanan-content-box-item-desc">
                                    <div>
                                        <h1><?= $row->nama ?></h1>
                                        <span>x <?= $row->jumlah ?></span>
                                    </div>
                                    <h1 class="price-pesanan"><?= rupiah($row->harga) ?></h1>
                                </div>
                            </div>
                            <div class="pesanan-content-box-item-side">
                                <div>
                                    <span>Subtotal</span>
                                    <span><?= rupiah($row->total) ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    <div class="d-flex justify-content-between">
                        <div class="pesanan-status">
                            <h1>Status Pesanan : </h1>
                            <?php
                                if ($value->status == '1') {
                            ?>
                                <span class="badge text-bg-primary">Diproses</span>
                            <?php
                                } elseif ($value->status == '2') {
                            ?>
                                <span class="badge text-bg-warning">Dikirim</span>
                            <?php
                                } elseif ($value->status == '3') {
                            ?>
                                <span class="badge text-bg-success">Selesai</span>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="pesanan-status">
                            <h1>Total Pesanan : </h1>
                            <span><?= rupiah($value->total) ?></span>
                        </div>
                    </div>
                </a>
            </div>    
        <?php
            }
        ?>    
    </div>
</section>