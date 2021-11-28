 <!-- Main Wrap Start -->

 <main class="position-relative">
     <div class="cart-page">
         <div class="container">
             <!-- main content -->
             <div class="row justify-content-md-center">
                 <div class="col-lg-12 col-md-7 mb-3">
                     <div class="card">
                         <div class="container">
                             <!-- Content Header (Page header) -->
                             <section class="content-header">
                                 <div class="container-fluid">
                                     <div class="row mb-2 mt-4">
                                         <div class="col-sm-6">
                                             <h1>Detail Riwayat Merchandise</h1>
                                         </div>
                                     </div>
                                 </div><!-- /.container-fluid -->
                             </section>

                             <section class="content">
                                 <div class="container-fluid">
                                     <div class="row">
                                         <div class="col-12">
                                             <!-- Main content -->
                                             <div class="invoice p-3 mb-3">
                                                 <!-- info row -->
                                                 <div class="row invoice-info">
                                                     <!-- /.col -->
                                                     <div class="col-sm-4 invoice-col">
                                                         <div class="row  mb-4">
                                                             <div class="col-sm-6">
                                                                 <b>ID Pesanan</b>
                                                             </div>
                                                             <div class="col-sm-6">
                                                                 <b>: #007612</b>
                                                             </div>
                                                         </div>
                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <b>Nama Pemesan </b>
                                                             </div>
                                                             <div class="col-sm-6">
                                                                 <b>: Diaz</b>
                                                             </div>
                                                         </div>
                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <b>Nama Penerima</b>
                                                             </div>
                                                             <div class="col-sm-6">
                                                                 <b>: Aldi</b>
                                                             </div>
                                                         </div>
                                                         <div class="row">
                                                             <div class="col-sm-6">
                                                                 <b>Tanggal Pemesanan</b>
                                                             </div>
                                                             <div class="col-sm-6">
                                                                 <b>: 01-01-1970 01:00:00</b>
                                                             </div>
                                                         </div>
                                                         <!-- Jika yang di checkout hanya ebook maka tidak ada alamat pemesanan -->
                                                         <div class="row  mb-4">
                                                             <div class="col-sm-6">
                                                                 <b>Alamat Pemesanan</b>
                                                             </div>
                                                             <div class="col-sm-6">
                                                                 <b>: Jalan Mahkota</b>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <!-- /.col -->
                                                 </div>
                                                 <!-- /.row -->

                                                 <!-- Table row -->
                                                 <div class="row">
                                                     <div class="col-12 table-responsive">
                                                         <table class="table table-striped">
                                                             <thead>
                                                                 <tr>
                                                                     <th>No</th>
                                                                     <th>Nama Produk</th>
                                                                     <th>Qty</th>
                                                                     <th>Harga</th>
                                                                     <th>Total Harga</th>
                                                                 </tr>
                                                             </thead>
                                                             <tbody>
                                                                 <tr>
                                                                     <td>1</td>
                                                                     <td>Call of Duty</td>
                                                                     <td>455-981-221</td>
                                                                     <td>$64.50</td>
                                                                     <td>$64.50</td>
                                                                 </tr>
                                                             </tbody>
                                                         </table>
                                                     </div>
                                                     <!-- /.col -->
                                                 </div>
                                                 <!-- /.row -->

                                                 <div class="row">
                                                     <!-- accepted payments column -->
                                                     <div class="col-6">
                                                         <div class="card">
                                                             <div class="card-header">
                                                                 <h5>Pembayaran</h5>
                                                             </div>
                                                             <div class="card-body table-responsive">
                                                                 <div class="row">
                                                                     <div class="col-sm-6">
                                                                         <h5>Virtual Account :</h5>
                                                                         <h3>262159939380502</h3>
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
                                                                                 <span class="post-cat bg-info color-white" style="font-size:xx-large;">Rp. <?= number_format(50000, 0, ',', '.') ?></span>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </center>
                                                                 <center>
                                                                     <div class="row">
                                                                         <div class="col-sm-12">
                                                                             <h5>Batas Pembayaran : </h5>
                                                                             <div class="entry-meta meta-0 font-small mt-2 mb-20">
                                                                                 <span class="post-cat" style="font-size:large;"><?= date('d-m-Y H:i:s', strtotime(28)); ?></span>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </center>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <!-- /.col -->
                                                     <div class="col-6">
                                                         <div class="table-responsive">
                                                             <table class="table">
                                                                 <tr>
                                                                     <th style="width:50%">Subtotal:</th>
                                                                     <td>$250.30</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <th>Berat</th>
                                                                     <td>$10.34</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <th>Ongkos Kirim</th>
                                                                     <td>$5.80</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <th>Total Bayar</th>
                                                                     <td>$265.24</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <th>Ekspedisi</th>
                                                                     <td>JNE</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <th>Paket</th>
                                                                     <td>OKE</td>
                                                                 </tr>
                                                                 <tr>
                                                                     <th>Estimasi</th>
                                                                     <td>2-3 Hari</td>
                                                                 </tr>

                                                             </table>
                                                         </div>
                                                     </div>
                                                     <!-- /.col -->
                                                 </div>
                                                 <!-- /.row -->

                                                 <!-- this row will not appear when printing -->
                                                 <div class="row no-print">
                                                     <div class="col-12">
                                                         <a class="btn btn-secondary float-right" href="<?= base_url('home/my_account/'); ?>" role="button">Kembali</a>
                                                     </div>
                                                 </div>
                                             </div>
                                             <!-- /.invoice -->
                                         </div><!-- /.col -->
                                     </div><!-- /.row -->
                                 </div><!-- /.container-fluid -->
                             </section>
                             <!-- /.content -->
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </main>