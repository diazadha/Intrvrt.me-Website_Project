<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Register Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">HOME</a></li>
                        <li class="breadcrumb-item active">USERS</li>
                        <li class="breadcrumb-item active">REGISTER ADMIN</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Form Register
                            </h3>
                        </div>
                        <form class="form-horizontal" method="post" action="<?= base_url('admin/user/register_superadmin') ?>">
                            <div class="card-body">
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

                                <div class="form-group row">

                                    <label for="name" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                                        <input type="nama" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama">
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                                        <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <?= form_error('password1', '<small class="text-danger pl-1">', '</small>'); ?>
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="password1">
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <?= form_error('password2', '<small class="text-danger pl-1">', '</small>'); ?>
                                        <input type="password" class="form-control" id="password" placeholder="Konfirmasi Password" name="password2">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="date" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <?= form_error('jenis-kelamin', '<small class="text-danger pl-1">', '</small>'); ?>
                                        <div class="form-check form-check-inline ml-2 mb-4">
                                            <input class="form-check-input" type="radio" name="jenis-kelamin" id="inlineRadio1" value="L">
                                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline mb-4">
                                            <input class="form-check-input" type="radio" name="jenis-kelamin" id="inlineRadio2" value="P">
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label for="date" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-2">
                                        <?= form_error('tanggal', '<small class="text-danger pl-1">', '</small>'); ?>
                                        <input type="date" class="form-control" id="date" placeholder="Tanggal Lahir" name="tanggal">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Register</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>