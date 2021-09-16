<div class="container">
    <div class="row mb-50">
        <div class="col-lg-2 d-none d-lg-block"></div>
        <div class="col-lg-8 col-md-12">
            <!--author box-->
            <br>
            <br>
            <h3 class="mb-30">Profil Kamu</h3>
            <form class="form-horizontal" action="<?= base_url('home/update_foto_profile') ?>" method="POST" enctype="multipart/form-data">
                <div class="author-bio border-radius-10 bg-white p-30 mb-40 mt-5">
                    <!-- <div class="author-image mb-30">
                    <a href="author.html"><img src="assets/imgs/authors/author.png" alt="" class="avatar"></a>
                </div> -->
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
                            <label for="inputPassword3" class="col-sm-2 col-form-label" style="font-weight: bold;">Foto Profil</label>
                            <?php if ($data_user['foto_user'] == 'default.jpg') : ?>
                                <div class="col-md-5 mb-4">
                                    <p>Belum Upload Foto</p>
                                </div>
                            <?php else : ?>
                                <div class="col-md-5 mb-4">
                                    <img src="<?= base_url('assets/uploads/user/') . $data_user['foto_user']; ?>" class="img-thumbnail img-fluid z-depth-2" alt="circular image and responsive" data-holder-rendered="true">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label" style="font-weight: bold;">Upload Foto</label>
                            <div class="col-sm-10">
                                <input type="file" name="foto">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id_user" value="<?= $data_user['id_user']; ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="button button-contactForm">Ubah Foto</button>
                </div>
            </form>
            <!--comment form-->
            <div class="comment-form">
                <form class="form-horizontal" action="<?= base_url('home/update_profile') ?>" method="POST" enctype="multipart/form-data">
                    <?= form_error('nama', '<small class="text-danger pl-1">', '</small>'); ?>
                    <div class="input-group mb-4">

                        <input type="nama" class="form-control" placeholder="Nama Lengkap" name="nama" value="<?= $data_user['nama_user']; ?>">
                        <div class="input-group-append">
                        </div>
                    </div>
                    <?= form_error('email', '<small class="text-danger pl-1">', '</small>'); ?>
                    <div class="input-group mb-4">

                        <input type="email" class="form-control" placeholder="Email" name="email" value="<?= $data_user['email']; ?>" readonly>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('password1', '<small class="text-danger pl-1">', '</small>'); ?>
                    <div class="input-group mb-4">
                        <input type="password" class="form-control" placeholder="Password Baru" name="password1">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <label class="ml-2 mb-3">Jenis Kelamin</label><br>
                    <?php if ($data_user['jenis_kelamin'] == 'L') : ?>
                        <?= form_error('jenis-kelamin', '<small class="text-danger pl-1">', '</small>'); ?>
                        <div class="form-check form-check-inline ml-2 mb-4">

                            <input class="form-check-input" type="radio" name="jenis-kelamin" id="inlineRadio1" value="L" checked>
                            <label class="form-check-label" for="inlineRadio1">Laki-laki</label>
                        </div>
                        <?= form_error('jenis-kelamin', '<small class="text-danger pl-1">', '</small>'); ?>
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
                        <?= form_error('jenis-kelamin', '<small class="text-danger pl-1">', '</small>'); ?>
                        <div class="form-check form-check-inline mb-4">

                            <input class="form-check-input" type="radio" name="jenis-kelamin" id="inlineRadio2" value="P" checked>
                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                        </div>
                    <?php endif; ?>
                    <br>
                    <label class="ml-2 mb-3">Tanggal Lahir</label><br>
                    <?= form_error('tanggal', '<small class="text-danger pl-1">', '</small>'); ?>
                    <div class="input-group mb-4">
                        <input type="date" class="form-control" name="tanggal" value="<?= $data_user['tanggal_lahir']; ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button button-contactForm">Ubah Biodata</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
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
</div>