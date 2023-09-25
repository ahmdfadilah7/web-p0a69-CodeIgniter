<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="product-grid" id="productGrid">
                <!-- Product items will be dynamically added here -->
                <?php
                    foreach ($cabang->result() as $row) {
                ?>
                <div class="product">
                    <a href="<?= site_url('home/produk/'.$row->id) ?>" style="text-decoration: none;">
                        <img src="<?= base_url($row->foto) ?>" alt="<?= $row->nama ?>">
                        <h3 class="text-black"><?= $row->nama ?></h3>
                        <div class="text-black">
                            <?php 
                                if (strlen($row->deskripsi) > 120) {
                                    echo substr($row->deskripsi, 0, 120).'....</p>';
                                } else {
                                    echo $row->deskripsi;
                                }
                            ?>
                        </div>
                    </a>
                    <a href="<?= site_url('home/produk/'.$row->id) ?>" class="btn btn-primary btn-sm mt-2">Lihat Selengkapnya</a>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>