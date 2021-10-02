<div class="container">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card mb-4 m-5 pb-5 mx-auto" style="width: 24rem;">
            <div class="card-body login-card-body">
                <div class="login-logo mb-4 text-center">
                    <a href="<?= base_url(); ?>"><b>INTRVRT</b>.ME</a>
                </div>
                <br>

                <div class="container">
                    <p class="login-box-msg">Lupa Password? Tulis email kamu dibawah ini untuk melakukan reset password</p>
                    <form action="<?= base_url('home/login'); ?>" method="post">
                        <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                        <div class="input-group mb-4">
                            <input type="email" class="form-control" placeholder="Email" name="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary btn-block">Minta Password Baru</button>
                        </div>
                    </form>

                    <p class="mb-1 text-center">
                        <a href="<?= base_url('home/login'); ?>">Login</a>
                    </p>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>