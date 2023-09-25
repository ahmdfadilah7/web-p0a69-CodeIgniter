<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Edit Cabang</h5>
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
        <form action="<?= base_url('admin/cabang/update/'.$cabang->id) ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" value="<?= $cabang->nama ?>">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Foto</label><br>
                        <img src="<?= base_url($cabang->foto) ?>" width="100" class="mb-2">
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" id="editor"><?= $cabang->deskripsi ?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('admin/cabang') ?>" class="btn btn-warning">Kembali</a>
            </div>
        </form>
    </div>
</div>