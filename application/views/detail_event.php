 <!-- Main Wrap Start -->
 <main class="position-relative">
     <div class="container">
         <div class="entry-header entry-header-1 mb-30 mt-50">
             <h1 class="post-title mb-30">
                 <?= $event->nama_event ?>
             </h1>
         </div>
         <!--end entry header-->
         <div class="row mb-50">
             <div class="col-lg-8 col-md-12">
                 <div class="entry-main-content">
                     <div class="wp-block-image">
                         <figure class="alignleft is-resized">
                             <img class="border-radius-5" style="width:200px;" src="<?= base_url('assets/uploads/foto_event/').$event->foto ?>">
                         </figure>
                     </div>
                     <h5>Harga</h5>
                     <?php
                    if ($event->harga_tiket==0){?>
                        <a class="entry-meta meta-0"><span class="post-in background5 text-dark font-x-small">GRATIS</span></a>
                    <?php } else{ ?>
                        <div class="entry-meta meta-0 font-small">
                            <span class="post-cat bg-success color-white">Rp <?=number_format($event->harga_tiket, 0,',','.') ?></span>
                        </div>
                    <?php } ?>
                     <h5 class="mt-4">Kategori Event</h5>
                    <div class="entry-meta meta-0 font-small mb-30">
                        <a href="<?= base_url('home/ekategori/').$event->kategori ?>"><span class="post-cat bg-danger color-white"><?= $event->nama_kategori ?></span></a>
                    </div>
                     <h5 class="mt-4">Deskripsi Event</h5>
                     <?= htmlspecialchars_decode($event->deskripsi_event) ?>
                 </div>
             </div>
                 <!--comment form-->
                 <div class="comment-form">
                     <h3 class="mb-30">Pesan Sekarang</h3>
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