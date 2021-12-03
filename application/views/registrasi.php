<div class="main-wrap">
    <aside id="sidebar-wrapper" class="custom-scrollbar offcanvas-sidebar position-right">
        <button class="off-canvas-close"><i class="ti-close"></i></button>
    </aside>
    <div class="container">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card mb-4 m-5 pb-5 mx-auto" style="width: 24rem;">
                <div class="card-body login-card-body">
                    <?php if ($this->session->flashdata('message1')) : ?>
                        <?php $message = $this->session->flashdata('message1'); ?>
                        <?= '<div class="alert alert-success">' . $message . '</div>'; ?>
                        <?php $this->session->unset_userdata('message1'); ?>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('message')) : ?>
                        <?php $message = $this->session->flashdata('message'); ?>
                        <?= '<div class="alert alert-danger">' . $message . '</div>'; ?>
                        <?php $this->session->unset_userdata('message'); ?>
                    <?php endif; ?>
                    <div class="login-logo mb-4 text-center">
                        <a href="<?= base_url(); ?>"><b>INTRVRT</b>.ME</a>
                    </div>

                    <form action="<?= base_url('home/registrasi'); ?>" method="post">
                        <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                        <div class="input-group mb-4">

                            <input type="nama" class="form-control" placeholder="Nama Lengkap" name="nama">
                            <div class="input-group-append">
                            </div>
                        </div>
                        <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                        <div class="input-group mb-4">

                            <input type="email" class="form-control" placeholder="Email" name="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <?= form_error('password1', '<small class="text-danger pl-1">', '</small>'); ?>
                        <div class="input-group mb-4">
                            <input type="password" class="form-control" placeholder="Password" name="password1">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <?= form_error('password2', '<small class="text-danger pl-1">', '</small>'); ?>
                        <div class="input-group mb-4">

                            <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password2">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <label class="ml-2 mb-3">Jenis Kelamin</label><br>
                        <?= form_error('jenis-kelamin', '<small class="text-danger pl-1">', '</small>'); ?>
                        <div class="form-check form-check-inline ml-2 mb-4">

                            <input class="form-check-input" type="radio" name="jenis-kelamin" id="inlineRadio1" value="L">
                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                        </div>
                        <?= form_error('jenis-kelamin', '<small class="text-danger pl-1">', '</small>'); ?>
                        <div class="form-check form-check-inline mb-4">

                            <input class="form-check-input" type="radio" name="jenis-kelamin" id="inlineRadio2" value="P">
                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                        </div>
                        <br>
                        <label class="ml-2 mb-3">Tanggal Lahir</label><br>
                        <?= form_error('tanggal', '<small class="text-danger pl-1">', '</small>'); ?>
                        <div class="input-group mb-4">
                            <input type="date" class="form-control" name="tanggal">
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary btn-block">Registrasi</button>
                        </div>
                    </form>

                    <p class="mb-0 text-center">
                        <a href="<?= base_url('home/login') ?>" class="text-center">Sudah punya akun? Login</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
</div>