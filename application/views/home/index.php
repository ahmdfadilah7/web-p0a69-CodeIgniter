<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="cabang">
                <div class="cabang-detail">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <img src="<?= base_url($cabang->foto) ?>" alt="">
                        </div>
                        <div class="col-md-8 col-sm-12 text-left">
                            <h3 class="text-black"><?= $cabang->nama ?></h3>
                            <div class="text-black">
                                <?= $cabang->deskripsi ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="product-grid" id="productGrid">
                <!-- Product items will be dynamically added here -->
                <?php
                    foreach ($produk->result() as $row) {
                ?>
                <div class="product">
                    <a onclick="get_order(<?= $row->id ?>)">
                        <img src="<?= base_url($row->foto) ?>" alt="<?= $row->nama ?>">
                        <p>
                            <?= $row->cabang ?>
                        </p>
                        <h3 class="text-black"><?= $row->nama ?></h3>
                        <div class="text-black">
                            <?= $row->deskripsi ?>
                        </div>
                        <p class="price"><?= rupiah($row->harga) ?></p>
                    </a>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>
