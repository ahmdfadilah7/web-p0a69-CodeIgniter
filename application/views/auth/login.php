<div class="login-container" style="background-image: url(<?=base_url($settings->bg_login)?>)">
    <section class="login-box">
        <form action="<?= base_url('auth/proses_login') ?>" method="post">
            <div class="content-login">
                <h1>LOGIN</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label for="" class="form-label pb-1">Username</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                                    <input type="text" name="username" class="form-control" placeholder="Masukkan Username" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label for="" class="form-label pb-1">Password</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <div class="have-account mb-4">
                    <p>
                        <a href="<?= site_url('auth/register') ?>">Don't have an account? Register</a>
                    </p>
                </div>
            </div>
        </form>
    </section>
</div>