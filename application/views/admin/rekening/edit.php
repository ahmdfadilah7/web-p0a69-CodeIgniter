<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Edit Rekening</h5>
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
        <form action="<?= base_url('admin/rekening/update/'.$rekening->id) ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Nama Rekening</label>
                        <input type="text" name="nama_rekening" class="form-control" value="<?= $rekening->nama_rekening ?>">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">No Rekening</label>
                        <input type="number" name="no_rekening" class="form-control" value="<?= $rekening->no_rekening ?>">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Bank</label>
                        <input type="text" name="bank" class="form-control" value="<?= $rekening->bank ?>">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?= site_url('admin/rekening') ?>" class="btn btn-warning">Kembali</a>
            </div>
        </form>
    </div>
</div>