<div class="keranjang-container">
    <div class="keranjang-box-container">
        <div class="keranjang-box-left">
            <!-- Cart items will be populated here -->
            <?php
                foreach ($produk->result() as $row) {
            ?>
                <div class="keranjang-box-item">
                    <img src="<?= base_url($row->foto) ?>" alt="">
                    <div class="box-item-container mb-5 mt-3">
                        <div class="box-item-desc">
                            <h1><?= $row->nama ?></h1>
                        </div>
                        <div class="mb-2">
                            <?= $row->deskripsi ?>
                        </div>
                        <span><?= rupiah($row->harga) ?></span>
                        <div class="mt-3">
                            Dikirim dari
                            <?= $settings->alamat ?>
                        </div>
                        <div class="box-item-desc2">
                            <div class="box-item-actions">
                                <a href="<?= site_url('keranjang/hapus_produk/'.$row->id) ?>">
                                    <i class="fa-solid fa-xmark"></i>
                                </a>
                                <form action="<?= site_url('keranjang/update_jumlah/'.$row->id) ?>" method="post">
                                    <input type="hidden" name="harga_produk" value="<?= $row->harga ?>">
                                    <div class="input-group quantity mx-auto">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn-minus button-jumlah" >
                                                -
                                            </button>
                                        </div>
                                        <input type="text" name="jumlah" id="jumlah" class="border-0 text-center" value="<?= $row->jumlah ?>" readonly>
                                        <div class="input-group-btn">
                                            <button type="button" class="btn-plus button-jumlah">
                                                +
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
        <div class="keranjang-box-right">
            <div class="item-desc">
                <!-- Item details will be populated here -->
                <?php
                    $total = array();
                    $kode_invoice = '';
                    foreach ($produk->result() as $row) {
                        $kode_invoice = $row->kode_invoice;
                        $total[] = $row->total;
                ?>
                    <div class="selected-item">
                        <h3><?= $row->nama ?></h3>
                        <div>
                            <h1>Harga :</h1>
                            <span><?= rupiah($row->harga) ?></span>
                            <p>x <?= $row->jumlah ?></p>
                        </div>
                        <div>
                            <h1>Subtotal :</h1>
                            <span><?= rupiah($row->total) ?></span>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div class="box-total">
                <h1>Total :</h1>
                <span><?= rupiah(array_sum($total)) ?></span>
            </div>
            <div class="box-button">
                <button onclick="pembayaran('<?= $kode_invoice ?>')"><span>Beli Sekarang</span></button>
            </div>
        </div>
    </div>
    <div class="payment-container">
        <div class="payment-right">
            <div class="alamat-container">
                <div class="alamat-information">
                    <h1><?= $this->session->userdata('nama_pelanggan') ?></h1>
                    <?= $this->session->userdata('alamat_pelanggan') ?>
                    <span>No. HP : <?= $this->session->userdata('no_telp_pelanggan') ?></span>
                </div>
                <!-- <div class="alamat-actions">
                    <button>Edit</button>
                </div> -->
            </div>
        </div>
    </div>
</div>