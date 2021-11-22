 <!-- Main Wrap Start -->
 <main class="position-relative">
     <div class="cart-page">
         <div class="container">
             <div class="col-lg-2 d-none d-lg-block"></div>
             <!-- main content -->
                <div class="row">
                    <div class="col">
                        <!-- <div class="author-bio border-radius-10 bg-white p-30 mb-50"> -->
                        <div class="cart-page-inner">
                            <div class="table-responsive">
                                <!-- As a heading -->
                                <nav class="navbar navbar-light bg-light">
                                    <h1>Checkout Merchandise</h1>
                                </nav>
                                <hr class="mt-2">
                                <form action="<?php echo base_url('home/proses_checkout_m');?>" method="post" enctype="multipart/form-data">
                                <nav class="navbar navbar-light bg-light">
                                    <div class="container-fluid" style="background-color: white;">
                                    
                                    <!-- <div class="col-sm-6 mt-4">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Nama Penerima*</label>
                                            <input name="nama_penerima" class="form-control" required>
                                        </div>
                                    </div> -->

                                    <div class="col-sm-6 mt-4">
                                        <div class="form-group">
                                            <label style="font-weight:bold">No Handphone Penerima*</label>
                                            <input type="tel" name="tlpn_penerima" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mt-4">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Email*</label>
                                            <input type="email" name="email_penerima" class="form-control" required>
                                        </div>
                                    </div>
                               
                                    <?php if(in_array('1',$d,TRUE)&& in_array('0',$d,TRUE)): ?>
                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Email*</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Merchandise</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-center">Berat</th>
                                                    <th class="text-center">Harga</th>
                                                    <th class="text-center">Harga Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no=1;
                                                        $diskon = 0;
                                                        $harga_setelah_diskon = 0;
                                                        $grand_total=0;
                                                        $tot_berat = 0;
                                                        foreach($checkout as $items) { 
                                                            // var_dump($items);
                                                            $total_harga=0;
                                                            $berat = $items['qty'] * $items['berat'];
                                                            $tot_berat = $tot_berat + $berat;
                                                            $diskon = $items['harga'] * $items['diskon']/100;
                                                            $harga_setelah_diskon = $items['harga'] - $diskon;
                                                            $total_harga = $items['qty'] * $harga_setelah_diskon;
                                                    ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $items["nama_merch"]; ?></td>
                                                        <td class="text-center"><?= $items["qty"]; ?></td>
                                                        <td class="text-center"> <?= $items['berat'] ?>  Gr </td>
                                                        <td style="text-align:right">Rp. <?= number_format($harga_setelah_diskon, 0,',','.') ?></td>
                                                        <td style="text-align:right">Rp. <?= number_format($total_harga, 0,',','.') ?></td>
                                                    </tr>
                                                    <?php $grand_total = $grand_total + $total_harga; ?>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    <div class="col-6">

                                    </div>
                                    <div class="col-4">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th style="width:50%">Grand total:</th>
                                                    <td>Rp. <?php echo number_format($grand_total, 0,',','.'); ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Berat:</th>
                                                    <td><?= $tot_berat ?> Gr</td>
                                                </tr>
                                                <tr>
                                                    <th>Total Bayar:</th>
                                                    <td>Rp. <?php echo number_format($grand_total, 0,',','.'); ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                             </nav>

                               <!-- Simpan Transaksi -->
                                <!-- <input name="no_detail" value="<?= $no_detail ?>" hidden> -->
                                <input name="id_order" hidden>
                                <input name="id_user" value="<?= $this->session->userdata('id_user') ?>" hidden>
                                <input name="berat" value="<?= $tot_berat ?>" hidden><br>
                                <input name="total_bayar" value="<?php echo $grand_total ?>" hidden><br>
                                <input name="grand_total" value="<?php echo $grand_total ?>" hidden><br>
                             
                             <div class="modal-footer ml-auto">
                                 <a href="<?= base_url('home'); ?>">
                                     <div class="btn btn-sm btn-secondary">Kembali</div>
                                 </a>
                                 <button type="submit" class="btn btn-sm btn-secondary">Proses</button>
                             </div>
                        </form>
                         </div>
                     </div>
                     <!-- </div> -->
                 </div>
             </div>
         </div>
     </div>
     <div class="cart-page">
         <div class="container">
             <div class="col-lg-2 d-none d-lg-block"></div>
             <!-- main content -->
             <div class="row">

             </div>
         </div>
     </div>