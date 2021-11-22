 <!-- Main Wrap Start -->
 <main class="position-relative">
     <div class="container">
         <div class="entry-header entry-header-1 mb-30 mt-50">
             <div class="entry-meta meta-0 font-small mb-30">
                 <a href="category.html"><span class="post-cat bg-danger color-white"><?= $getdatabyid['nama_kategori']; ?></span></a>
             </div>
         </div>
         <!--end entry header-->
         <div class="row mb-50">
             <div class="col-lg-6 col-md-12">
                 <div class="entry-main-content">
                     <h2><?= $getdatabyid['nama_event']; ?></h2>
                     <hr class="wp-block-separator is-style-wide">
                     <div class="wp-block-image">
                         <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                             <center>
                                 <div class="carousel-inner">

                                     <div class="carousel-item active">
                                         <img class="d-block w-50" src="<?= base_url('assets/uploads/foto_event/') . $getdatabyid['foto'] ?>" alt="First slide" style="height:400px;">
                                     </div>
                                     <?php foreach ($getfotobyid as $m) : ?>
                                         <div class="carousel-item">
                                             <img class="d-block w-50" src="<?= base_url('assets/uploads/foto_event/') . $m['foto'] ?>" alt="" style="height: 400px;">
                                         </div>
                                     <?php endforeach; ?>
                                 </div>
                                 <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev" style="background-color:#a9a9a9;">
                                     <span class="carousel-control-prev-icon text text-primary" aria-hidden="true"></span>
                                     <span class="sr-only">Previous</span>
                                 </a>
                                 <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next" style="background-color:#a9a9a9;">
                                     <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                     <span class="sr-only">Next</span>
                                 </a>
                         </div>
                         </center>
                     </div>
                     <div class="row">
                         <div class="col-2">
                             <h6>Tanggal Acara</h6>
                         </div>
                         <div class="col entry-meta meta-0 font-small mb-30 mt-1">
                             <span class="post-cat bg-danger color-white"><?= $getdatabyid['tgl_acara']  ?></span>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-2">
                             <h6>Batas Beli</h6>
                         </div>
                         <div class="col entry-meta meta-0 font-small mb-30 mt-1">
                             <span class="post-cat bg-danger color-white"><?= $getdatabyid['tgl_berakhir']  ?></span>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-2">
                             <h6>Harga Tiket</h6>
                         </div>
                         <div class="col">
                             <?php
                                if ($getdatabyid['harga_tiket'] == 0) { ?>
                                 <a class="entry-meta meta-0"><span class="post-in background5 text-dark font-x-small">GRATIS</span></a>
                             <?php } else if ($getdatabyid['diskon'] != 0) { ?>
                                 <?php $h_diskon = $getdatabyid['harga_tiket'] * ($getdatabyid['diskon'] / 100);
                                    $diskon = $getdatabyid['harga_tiket'] - $h_diskon;
                                    ?>
                                 <div class="entry-meta meta-0 font-small mb-30 mt-1">
                                     <span class="post-cat bg-success color-white" style="text-decoration: line-through;">Rp <?= number_format($getdatabyid['harga_tiket'], 0, ',', '.') ?></span>
                                     <span class="post-in background5 text-dark font-x-small">Rp <?= number_format($diskon, 0, ',', '.') ?></span>
                                 </div>
                             <?php } else { ?>
                                 <div class="entry-meta meta-0 font-small mb-30 mt-1">
                                     <span class="post-cat bg-success color-white">Rp <?= number_format($getdatabyid['harga_tiket'], 0, ',', '.') ?></span>
                                 </div>
                             <?php } ?>
                         </div>
                     </div>
                     <?php if ($getdatabyid['diskon'] != 0) : ?>
                         <div class="row">
                             <div class="col-2">
                                 <h6>Diskon</h6>
                             </div>
                             <div class="col">
                                 <div class="entry-meta meta-0 font-small mb-30 mt-1">
                                     <span class="post-cat bg-success color-white"><?= $getdatabyid['diskon'] . '%'; ?></span>
                                 </div>
                             </div>
                         </div>
                     <?php endif; ?>
                     <h6>Deskripsi</h6>
                     <p><?= htmlspecialchars_decode($getdatabyid['deskripsi_event']); ?></p>
                 </div>
             </div>
             <!--comment form-->
             <div class="col-lg-6 col-md-12">
                 <!-- <div class="comment-form"> -->
                 <h3 class="mt-100 mb-30">Pesan Sekarang</h3>
                 <form class="form-contact comment_form" action="#" id="commentForm">
                     <div class="row">
                         <div class="col-sm-6">
                             <div class="form-group">
                                 <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                             </div>
                         </div>
                         <div class="col-sm-6">
                             <div class="form-group">
                                 <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                             </div>
                         </div>
                         <div class="col-12">
                             <div class="form-group">
                                 <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                             </div>
                         </div>
                         <div class="col-12">
                             <div class="form-group">
                                 <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <button type="submit" class="button button-contactForm">Pesan</button>
                     </div>
                 </form>
                 <!-- </div> -->
             </div>
         </div>
         <!--End row-->
         <div class="row">
             <div class="col-12 text-center mb-50">
                 <a href="#">
                     <img class="border-radius-10 d-inline" src="assets/imgs/ads-3.png" alt="">
                 </a>
             </div>
         </div>
     </div>
 </main>