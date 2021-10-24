 <!-- Main Wrap Start -->
 <main class="position-relative">
     <div class="cart-page">
         <div class="container">
             <div class="col-lg-2 d-none d-lg-block"></div>
             <!-- main content -->
             <div class="row">
                 <div class="col-lg-8 col-md-12">
                     <div class="author-bio border-radius-10 bg-white p-30 mb-50">
                         <div class="cart-page-inner">
                             <div class="table-responsive">
                                 <table class="table table-bordered">
                                     <thead class="thead-primary text-center" style="background-color: #FF656A; color: white;">
                                         <tr>
                                             <th>No</th>
                                             <th>Nama Barang</th>
                                             <th>Foto Barang</th>
                                             <th>Harga</th>
                                             <th>Jumlah</th>
                                             <th>Total Harga</th>
                                             <th>Hapus</th>
                                         </tr>
                                     </thead>
                                     <tbody class="align-middle">
                                         <tr>
                                             <td>1</td>
                                             <td width="20%">
                                                 <p>asdsa</p>

                                             </td>
                                             <td width="20%">
                                                 <div class="img">
                                                     <a href="#"><img src="<?= base_url('uploads/hewan/') ?>" alt="Image" style="width: 500px; height: 100px;"></a>
                                                 </div>
                                             </td>
                                             <td style="text-align: right;" width="20%">Rp. <?= number_format(12500, 0, ',', '.') ?></td>
                                             <td width="20%">
                                                 <center>
                                                     <div class="qty">
                                                         <button class="btn-minus" style="background-color: #FF656A; color:white; border-color:#FF656A;"><i class="fa fa-minus"></i></button>
                                                         <input class="text-center" type="text" id="qty" value="2" min="1" readonly style="width: 30%;  border: 1px solid #FF656A; border-radius: 5px">
                                                         <button class="btn-plus" style="background-color: #FF656A; color:white; border-color:#FF656A;"><i class="fa fa-plus"></i></button>
                                                     </div>
                                                 </center>
                                             </td>
                                             <td width="20%" style="text-align: right;"> <span id="total_harga_">Rp. <?= number_format(9000, 0, ',', '.') ?></span> </td>
                                             <td>
                                                 <a href=" <?= base_url('marketplace/hapus_item_keranjang/') ?> ">
                                                     <center>
                                                         <i class="fa fa-trash"></i>
                                                     </center>
                                                 </a>
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>
                                 <div class="modal-footer ml-auto">
                                     <a href="<?= base_url('home'); ?>">
                                         <div class="btn btn-sm btn-secondary">Kembali</div>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-4 col-md-12">
                     <div class="author-bio border-radius-10 bg-white p-30 mb-50">
                         <div class="cart-page-inner">
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="cart-summary">
                                         <form action=" <?= base_url('marketplace/checkout') ?> " method="POST">
                                             <div class="cart-content">
                                                 <h2>Total Biaya :</h2>
                                                 <h3><span id="grand_total">Rp. <?= number_format(2000, 0, ',', '.'); ?> </span></h3>

                                                 <input type="hidden" id="grand" name="grand" value="2000">
                                             </div>
                                             <center>
                                                 <div class="cart-btn">
                                                     <button type="submit" class="btn btn-primary">Checkout</button>
                                                 </div>
                                             </center>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </main>