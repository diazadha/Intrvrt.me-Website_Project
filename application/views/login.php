<div class="main-wrap">
    <aside id="sidebar-wrapper" class="custom-scrollbar offcanvas-sidebar position-right">
        <button class="off-canvas-close"><i class="ti-close"></i></button>
    </aside>
    <div class="container">
        <div class="login-box">
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
                    <?php if ($this->session->flashdata('message2')) : ?>
                        <?php $message = $this->session->flashdata('message2'); ?>
                        <?= '<div class="alert alert-info">' . $message . '</div>'; ?>
                        <?php $this->session->unset_userdata('message2'); ?>
                    <?php endif; ?>
                    <div class="login-logo mb-4 text-center">
                        <a href="<?= base_url(); ?>"><b>INTRVRT</b>.ME</a>
                    </div>
                    <br>
                    <div class="container">
                        <form action="<?= base_url('home/login'); ?>" method="post">
                            <div class="input-group mb-4">
                                <input type="email" class="form-control" placeholder="Email" name="email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-4">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </form>

                        <p class="mb-1 text-center">
                            <a href="<?= base_url('home/lupa_password'); ?>">Lupa Password</a>
                        </p>
                        <p class="mb-0 text-center">
                            <a href="<?= base_url('home/registrasi') ?>" class="text-center">Daftar Akun</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>