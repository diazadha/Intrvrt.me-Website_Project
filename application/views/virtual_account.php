 <!-- Main Wrap Start -->

 <main class="position-relative">
     <div class="cart-page">
         <div class="container">
             <!-- main content -->
             <div class="row justify-content-md-center">
                 <div class="col-lg-6 col-md-7 mb-3">
                     <div class="card">
                         <div class="card-header">
                             <h5>Checkout Merchandise</h5>
                         </div> 
                         <div class="card-body table-responsive">
                             <div class="row">
                                 <div class="col-sm-6">
                                     <h5>Virtual Account :</h5>
                                     <h3><?= $getVA['account_number']?></h3>
                                 </div>
                                 <div class="col-sm-6" style="margin-top: -60px;">
                                     <img src="<?= base_url('assets/bank_logo/bca.png') ?>" alt="Responsive image" class="img-fluid">
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
                                     <a class="btn btn-secondary" href="<?= base_url('home/merchandise/'); ?>" role="button">Bayar Nanti</a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </main>