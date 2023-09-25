<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Tambah Produk</h5>
        <?php if ($this->session->flashdata('berhasil')) { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p><?= $this->session->flashdata('berhasil') ?></p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } elseif ($this->session->flashdata('gagal')) { ?>
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
        <?php } ?>
        <form action="<?= base_url('admin/produk/store') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Harga (RP)</label>
                        <input type="number" name="harga" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Foto</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Cabang</label>
                        <select name="cabang_id" class="form-select">
                            <option value="">- Pilih -</option>
                            <?php
                                foreach ($cabang->result() as $row) {
                            ?>
                                <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="editor"></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('admin/produk') ?>" class="btn btn-warning">Kembali</a>
            </div>
        </form>
    </div>
</div>