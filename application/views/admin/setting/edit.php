<div class="card">
    <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Edit Setting</h5>
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
        <form action="<?= base_url('admin/setting/update/'.$setting->id) ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Nama Website</label>
                        <input type="text" name="nama_website" class="form-control" value="<?= $setting->nama_website ?>">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= $setting->email ?>">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">No Telp</label>
                        <input type="number" name="no_telp" class="form-control" value="<?= $setting->no_telp ?>">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Google Map</label>
                        <input type="text" name="google_map" class="form-control" value="<?= $setting->google_map ?>">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Logo Website</label>
                        <input type="file" name="logo" class="form-control">
                        <img src="<?= base_url($setting->logo) ?>" width="70">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Favicon Website</label>
                        <input type="file" name="favicon" class="form-control">
                        <img src="<?= base_url($setting->favicon) ?>" width="70">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Background Login</label>
                        <input type="file" name="bg_login" class="form-control">
                        <img src="<?= base_url($setting->bg_login) ?>" width="70">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Background Register</label>
                        <input type="file" name="bg_register" class="form-control">
                        <img src="<?= base_url($setting->bg_register) ?>" width="70">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Facebook</label>
                        <input type="text" name="facebook" class="form-control" value=<?= $setting->facebook ?>>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Twitter</label>
                        <input type="text" name="twitter" class="form-control" value=<?= $setting->twitter ?>>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Instagram</label>
                        <input type="text" name="instagram" class="form-control" value=<?= $setting->instagram ?>>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Youtube</label>
                        <input type="text" name="youtube" class="form-control" value=<?= $setting->youtube ?>>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" id="editor"><?= $setting->alamat ?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="<?= site_url('admin/setting') ?>" class="btn btn-warning">Kembali</a>
            </div>
        </form>
    </div>
</div>