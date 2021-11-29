 <!-- Main Wrap Start -->

 <main class="position-relative">
     <div class="cart-page">
         <div class="container">
             <!-- main content -->
             <div class="row justify-content-md-center">
                 <div class="col-lg-6 col-md-7 mb-3">
                     <div class="card">
                         <div class="card-header">
                             <h5>Pembayaran</h5>
                         </div> 
                         <div class="card-body table-responsive">
                             <div class="row">
                                 <div class="col-sm-6">
                                     <h5>Virtual Account :</h5>
                                     <h3><?= $getVA['account_number']?></h3>
                                 </div>
                                 <div class="col-sm-6 mb-4" >
                                <?php if($getVA['bank_code'] == 'BCA'){ ?>
                                    <img src="<?= base_url('assets/bank_logo/bca2.png') ?>" alt="Responsive image" class="img-fluid">
                                <?php }else if($getVA['bank_code'] == 'BRI'){ ?>
                                    <img src="<?= base_url('assets/bank_logo/bri2.png') ?>" alt="Responsive image" class="img-fluid">
                                <?php }else if($getVA['bank_code'] == 'BNI'){ ?>
                                    <img src="<?= base_url('assets/bank_logo/bni.png') ?>" alt="Responsive image" class="img-fluid">
                                <?php }else if($getVA['bank_code'] == 'MANDIRI'){ ?>
                                    <img src="<?= base_url('assets/bank_logo/mandiri.png') ?>" alt="Responsive image" class="img-fluid">
                                <?php }else if($getVA['bank_code'] == 'PERMATA'){ ?>
                                    <img src="<?= base_url('assets/bank_logo/permata.png') ?>" alt="Responsive image" class="img-fluid">
                                <?php }else if($getVA['bank_code'] == 'CIMB'){ ?>
                                    <img src="<?= base_url('assets/bank_logo/cimb.png') ?>" alt="Responsive image" class="img-fluid">
                                <?php }else if($getVA['bank_code'] == 'BSI'){ ?>
                                    <img src="<?= base_url('assets/bank_logo/bsi.png') ?>" alt="Responsive image" class="img-fluid">
                                <?php }else if($getVA['bank_code'] == 'SAHABAT_SAMPOERNA'){ ?>
                                    <img src="<?= base_url('assets/bank_logo/sahabat_sampoerna.png') ?>" alt="Responsive image" class="img-fluid">
                                <?php }else{ ?>
                                    <h5>Logo Tidak Tersedia</h5>
                                <?php } ?>
                                 </div>
                             </div>
                             <center>
                                 <div class="row">
                                     <div class="col-sm-12">
                                         <h4>Tagihan Pembayaran : </h4>
                                         <div class="entry-meta meta-0 font-small mt-4 mb-30">
                                             <span class="post-cat bg-info color-white" style="font-size:xx-large;">Rp. <?= number_format($getVA['expected_amount'], 0, ',', '.') ?></span>
                                         </div>
                                     </div>
                                 </div>
                             </center>
                             <center>
                                 <div class="row">
                                     <div class="col-sm-12">
                                         <h5>Batas Pembayaran : </h5>
                                         <div class="entry-meta meta-0 font-small mt-2 mb-20">
                                             <span class="post-cat" style="font-size:large;"><?= date('d-m-Y H:i:s', strtotime($getVA['expiration_date']));?></span>
                                         </div>
                                     </div>
                                 </div>
                             </center>
                             <hr>
                             <div class="row" style="float:right;">
                                 <div class="col" style="margin-top: -15px; ">
                                     <a class="btn btn-secondary" href="<?= base_url('home/my_account/'); ?>" role="button">Bayar Nanti</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </main>