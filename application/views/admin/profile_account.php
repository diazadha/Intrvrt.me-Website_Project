<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Profile Admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">HOME</a></li>
                        <li class="breadcrumb-item active">USERS</li>
                        <li class="breadcrumb-item active">EDIT PROFILE</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Foto Profile Admin
                            </h3>
                        </div>
                        <form class="form-horizontal" action="<?= base_url('admin/account/update_foto_profile') ?>" method="POST" enctype="multipart/form-data">

                            <div class="card-body">
                                <?php if ($this->session->flashdata('message3')) : ?>
                                    <?php $message = $this->session->flashdata('message3'); ?>
                                    <?= '<div class="alert alert-success">' . $message . '</div>'; ?>
                                    <?php $this->session->unset_userdata('message3'); ?>
                                <?php endif; ?>
                                <?php if ($this->session->flashdata('message4')) : ?>
                                    <?php $message = $this->session->flashdata('message4'); ?>
                                    <?= '<div class="alert alert-danger">' . $message . '</div>'; ?>
                                    <?php $this->session->unset_userdata('message4'); ?>
                                <?php endif; ?>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Foto Profil</label>
                                    <?php if ($data_user['foto_user'] == 'default.jpg') : ?>

                                        <div class="col-md-2 mb-4">
                                            <img src="<?= base_url('assets/uploads/user/user_1.png') ?>" class="img-fluid img-thumbnail rounded-circle" alt="Responsive image">
                                        </div>

                                    <?php else : ?>

                                        <div class="col-md-2 mb-2">
                                            <img src="<?= base_url('assets/uploads/user/') . $data_user['foto_user']; ?>" class="rounded-circle img-fluid z-depth-2" alt="circular image and responsive" data-holder-rendered="true">
                                        </div>

                                    <?php endif; ?>

                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Upload Foto</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="foto">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_user" value="<?= $data_user['id_user']; ?>">
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Update Foto Profile</button>
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                Edit Profile Admin
                            </h3>
                        </div>
                        <form class="form-horizontal" action="<?= base_url('admin/account/update_profile') ?>" method="POST" enctype="multipart/form-data">
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
                                        <input type="nama" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama" value="<?= $data_user['nama_user']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $data_user['email']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password Baru</label>
                                    <div class="col-sm-10">
                                        <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-10">
                                        <?= form_error('jenis-kelamin', '<small class="text-danger pl-1">', '</small>'); ?>
                                        <?php if ($data_user['jenis_kelamin'] == 'L') : ?>
                                            <div class="form-check form-check-inline ml-2 mb-4">
                                                <input class="form-check-input" type="radio" name="jenis-kelamin" id="inlineRadio1" value="L" checked>
                                                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input class="form-check-input" type="radio" name="jenis-kelamin" id="inlineRadio2" value="P">
                                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                            </div>
                                        <?php else : ?>
                                            <?= form_error('jenis-kelamin', '<small class="text-danger pl-1">', '</small>'); ?>
                                            <div class="form-check form-check-inline ml-2 mb-4">
                                                <input class="form-check-input" type="radio" name="jenis-kelamin" id="inlineRadio1" value="L">
                                                <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                                            </div>
                                            <div class="form-check form-check-inline mb-4">
                                                <input class="form-check-input" type="radio" name="jenis-kelamin" id="inlineRadio2" value="P" checked>
                                                <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="date" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-4">
                                        <?= form_error('tanggal', '<small class="text-danger pl-1">', '</small>'); ?>
                                        <input type="date" class="form-control" id="date" placeholder="Tanggal Lahir" name="tanggal" value="<?= $data_user['tanggal_lahir']; ?>">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id_user" value="<?= $data_user['id_user']; ?>">
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Update Profile</button>
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