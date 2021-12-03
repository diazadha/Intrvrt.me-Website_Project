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

                    <form action="<?= base_url('home/reset_password_view'); ?>" method="post">
                        <?= form_error('password1', '<small class="text-danger pl-1">', '</small>'); ?>
                        <div class="input-group mb-4">
                            <input type="password" class="form-control" placeholder="Password Baru" name="password1">
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
                        <input type="hidden" value="<?= $user['id_user']; ?>" name="id_user">
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary btn-block">Reset</button>
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
</div>