 <!-- Main Wrap Start -->

 <main class="position-relative">
     <div class="cart-page">
         <div class="container">
             <!-- main content -->
             <div class="row justify-content-md-center">
                 <div class="col-12 col-sm-12">
                     <div class="card card-primary card-outline card-tabs">
                         <div class="card-header p-0 pt-1 border-bottom-0">
                             <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                 <li class="nav-item">
                                     <a class="nav-link active" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Riwayat Pemesanan</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Profil</a>
                                 </li>
                             </ul>
                         </div>
                         <div class="card-body">
                             <div class="tab-content" id="custom-tabs-three-tabContent">
                                 <div class="tab-pane fade tab-pane fade show active" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                                     <div class="row">
                                         <div class="col-2">
                                             <div class="list-group" id="list-tab" role="tablist">
                                                 <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Merchandise</a>
                                                 <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Event</a>
                                             </div>
                                         </div>
                                         <div class="col-10">
                                             <div class="tab-content" id="nav-tabContent">
                                                 <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
                                                     <div class="card">
                                                         <div class="card-header">
                                                             <h3 class="card-title">Riwayat Pemesanan Merchandise</h3>
                                                         </div>
                                                         <!-- /.card-header -->
                                                         <div class="card-body">
                                                             <table id="table_merchandise" class="table table-bordered table-striped">
                                                                 <thead class="text-center">
                                                                     <tr>
                                                                         <th>No</th>
                                                                         <th>Nama Pemesan</th>
                                                                         <th>Tanggal Pemesanan</th>
                                                                         <th>Aksi</th>
                                                                     </tr>
                                                                 </thead>
                                                                 <tbody>
                                                                     <?php $no = 1;
                                                                        foreach ($riwayat_pesanan as $r) : ?>
                                                                         <tr>
                                                                             <td class="text-center"><?= $no; ?></td>
                                                                             <td><?= $r['nama_user']; ?>
                                                                             </td>
                                                                             <td class="text-center"><?= date('d F Y | H:i:s', strtotime($r['tgl_pesan'])); ?></td>
                                                                             <td class="text-center"> <a class="btn btn-primary" href="<?= base_url('home/detail_riwayat_merchandise/') . $r['id_pesanan']; ?>" role="button">Detail</a></td>
                                                                             <?php $no++; ?>
                                                                         </tr>
                                                                     <?php endforeach; ?>
                                                                 </tbody>
                                                             </table>
                                                         </div>
                                                         <!-- /.card-body -->
                                                     </div>
                                                     <!-- /.card -->
                                                 </div>
                                                 <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                                                     <div class="card">
                                                         <div class="card-header">
                                                             <h3 class="card-title">Riwayat Pemesanan Event</h3>
                                                         </div>
                                                         <!-- /.card-header -->
                                                         <div class="card-body">
                                                             <table id="table_event" class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>ID</th>
                                                                        <th>Tgl Pemesanan</th>
                                                                        <th>Pemesan</th>
                                                                        <th>Event</th>
                                                                        <th>Tagihan</th>
                                                                        <th>Status</th>
                                                                        <th width="5%">Detail</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php foreach ($riwayat_event as $b): ?>
                                                                    <tr>
                                                                        <td width="5%"><?= $b->id?></td>
                                                                        <td><?= $b->tgl_pesan ?> </td>
                                                                        <td><?= $b->name ?></td>
                                                                        <td>
                                                                        <?php 
                                                                        $field=""; 
                                                                        foreach($this->PesananModel->get_event($b->id)->result() as $e){
                                                                            $field.= $e->nama_event.',';
                                                                        }
                                                                        echo rtrim($field, ',');
                                                                        ?>
                                                                        </td>
                                                                        <td>Rp <?= number_format($b->expected_amount) ?></td>
                                                                        <td><?php if($b->status == 3){echo '<span class="text-success"> LUNAS </span>';}else{echo '<span class="text-danger">BELUM BAYAR</span>';}?></td>
                                                                        <td><a class='btn btn-info btn-sm' href='<?php echo base_url('home/detail_riwayat_event/').$b->id ?>'><span class='fas fa-info-circle'></span></a></td>
                                                                    </tr>
                                                                    <?php endforeach; ?>
                                                                </tbody>
                                                             </table>
                                                         </div>
                                                         <!-- /.card-body -->
                                                     </div>
                                                     <!-- /.card -->
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                     <div class="container">
                                         <div class="row mb-50">
                                             <div class="col-lg-2 d-none d-lg-block"></div>
                                             <div class="col-lg-12 col-md-12">
                                                 <!--author box-->
                                                 <br>
                                                 <br>
                                                 <h3 class="mb-30">Profil Kamu</h3>
                                                 <form class="form-horizontal" action="<?= base_url('home/update_foto_profile'); ?>" method="POST" enctype="multipart/form-data">
                                                     <div class="author-bio border-radius-10 bg-white p-30 mb-40 mt-5">
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
                                                                         <img src="<?= base_url('assets/uploads/user/') . $data_user['foto_user']; ?>" class="img-thumbnail img-fluid z-depth-2" alt="circular image and responsive" data-holder-rendered="true" style="width: 250px; height:250px">
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
                                                     <?php if ($this->session->flashdata('message1')) : ?>
                                                         <?php $message = $this->session->flashdata('message1'); ?>
                                                         <?= '<div class="alert alert-success">' . $message . '</div>'; ?>
                                                         <?php $this->session->unset_userdata('message1'); ?>
                                                     <?php endif; ?>
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
                                                         <?= form_error('password', '<small class="text-danger pl-1">', '</small>'); ?>
                                                         <div class="input-group mb-4">
                                                             <input type="password" class="form-control" placeholder="Password Baru" name="password">
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
                                                         <input type="hidden" name="id_user" value="<?= $data_user['id_user']; ?>">
                                                         <div class="form-group">
                                                             <button type="submit" class="button button-contactForm">Ubah Biodata</button>
                                                         </div>

                                                     </form>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                             </div>
                             <!-- /.card -->
                         </div>
                     </div>
                 </div>
             </div>
         </div>
 </main>