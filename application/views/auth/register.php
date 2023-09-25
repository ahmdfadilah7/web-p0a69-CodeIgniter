<div class="register-container d-flex" style="background-image: url(<?= base_url($settings->bg_register) ?>)">
    <section class="register-box">
        <form action="<?=base_url('auth/proses_register')?>" method="post" enctype="multipart/form-data">
            <div class="content-register">
                <h1>SIGN UP</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-4">
                                <label for="" class="form-label pb-1">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Lengkap"/>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-4">
                                <label for="" class="form-label pb-1">Email</label>
                                <input type="text" name="email" class="form-control" placeholder="Masukkan Email">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-4">
                                <label for="" class="form-label pb-1">No Telepon</label>
                                <input type="text" name="no_telp" class="form-control" placeholder="Masukkan No Telepon">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-4">
                                <label for="" class="form-label pb-1">Jenis Kelamin</label>
                                <select name="jns_kelamin" class="form-select">
                                    <option value="">- Pilih -</option>
                                    <option value="Laki-Laki">Laki - Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label for="" class="form-label pb-1">Foto</label>
                                <div class="input-group">
                                    <input type="file" name="foto" class="form-control" id="inputGroupFile02">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label for="" class="form-label pb-1">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="" class="form-label pb-1">Username</label>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
                            </div>
                            <div class="mb-4">
                                <label for="" class="form-label pb-1">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
                <p><a href="<?= site_url('auth/login') ?>">Sudah Punya Akun? Login</a></p>
            </div>
        </form>
    </section>
</div>