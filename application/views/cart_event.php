 <!-- Main Wrap Start -->

 <main class="position-relative">
     <div class="cart-page">
         <div class="container">
             <div class="col-lg-2 d-none d-lg-block"></div>
             <!-- main content -->
             <div class="row">
                 <div class="col-lg-7 col-md-7 mb-3">
                     <!-- <div class="author-bio border-radius-10 bg-white p-30 mb-50"> -->
                     <div class="card">
                         <div class="card-body table-responsive">
                             <!-- As a heading -->
                             <nav class="navbar navbar-light bg-light">
                                 <h2>Pembelian Tiket Event</h2>
                             </nav>
                             <hr class="mt-2">
                             <?php $no = 1;
                                $grand_total = 0; ?>

                             <nav class="navbar navbar-light bg-light">
                                 <?php foreach ($keranjang_event as $e) : ?>
                                     <div class="container-fluid" style="background-color: white;">
                                         <span class="navbar-brand mb-0 h1" style="width: 1%;">
                                             <?php if ($e['status'] == 1) : ?>
                                                 <input type="checkbox" checked onclick="uncheck_status_event(<?= $e['id_keranjang']; ?>)">
                                                 <?php $diskon = $e['harga_tiket'] * ($e['diskon'] / 100);
                                                    $harga_diskon = $e['harga_tiket'] - $diskon;
                                                    $total_harga =  $harga_diskon * $e['qty'];
                                                    $total_harga_row =  $harga_diskon * $e['qty'];
                                                    ?>
                                             <?php else : ?>
                                                 <input type="checkbox" onclick="check_status_event(<?= $e['id_keranjang']; ?>)">
                                                 <?php $diskon = $e['harga_tiket'] * ($e['diskon'] / 100);
                                                    $harga_diskon = $e['harga_tiket'] - $diskon;
                                                    $total_harga_row = $harga_diskon * $e['qty'];
                                                    $total_harga = 0; ?>
                                             <?php endif; ?>
                                         </span>
                                         <span class="navbar-brand mb-0 h1" style="width: 1%;">
                                             <?= $e['nama_event']; ?>
                                         </span>
                                         <span class="navbar-brand mb-0 h1" style="width: 7%;">
                                             <div class="img-fluid">
                                                 <img src="<?= base_url('assets/uploads/foto_event/') . $e['foto']; ?>" alt="Responsive image">
                                             </div>
                                         </span>
                                         <input type="hidden" id="harga_<?= $e['id_keranjang']; ?>" value="<?= $harga_diskon ?>">
                                         <span class="navbar-brand mb-0 h1" style="width: 2%;">
                                             Rp. <?= number_format($harga_diskon, 0, ',', '.') ?>
                                         </span>
                                         <span class="navbar-brand mb-0 h1" style="width: 5%;">
                                             <center>
                                                 <div class="qty">
                                                     <button class="btn-sm" onclick="kurang_qty(<?= $e['id_keranjang']; ?>)" style="background-color: #FF656A; color:white; border-color:#FF656A;"><i class="fa fa-minus"></i></button>
                                                     <input class="text-center" type="text" readonly id="qty_<?= $e['id_keranjang']; ?>" value="<?= $e['qty']; ?>" min="1" style="width: 50%;  border: 1px solid #FF656A; border-radius: 5px">
                                                     <button class="btn-sm" onclick="tambah_qty(<?= $e['id_keranjang']; ?>)" style="background-color: #FF656A; color:white; border-color:#FF656A;"><i class="fa fa-plus"></i></button>
                                                 </div>
                                             </center>
                                         </span>
                                         <span class="navbar-brand mb-0 h1" id="total_harga_<?= $e['id_keranjang']; ?>" style="width: 5%;">
                                             Rp. <?= number_format($total_harga_row, 0, ',', '.') ?>
                                         </span>
                                         <span class="navbar-brand mb-0 h1">
                                             <a href="<?= base_url('home/hapus_keranjang_event/') . $e['id_keranjang']; ?>">
                                                 <center>
                                                     <i class="fa fa-trash"></i>
                                                 </center>
                                             </a>
                                         </span>
                                     </div>
                                     <?php $grand_total = $grand_total + $total_harga; ?>
                                 <?php endforeach; ?>
                             </nav>

                             <div class="modal-footer ml-auto">
                                 <a href="<?= base_url('home'); ?>">
                                     <div class="btn btn-sm btn-secondary">Kembali</div>
                                 </a>
                             </div>
                         </div>
                     </div>
                     <!-- </div> -->
                 </div>
                 <div class="col-lg-5 col-md-5 mb-3">
                     <div class="card bg-white">
                         <div class="card-body">
                             <?php if ($checkout > 0) : ?>
                                 <div class="card-text">
                                     <h4><small class="font-weight-bold">Pending Proses Checkout:</small></h4>
                                 </div>
                                 <center>
                                     <div class="d-flex">
                                         <div class="mr-auto">
                                             <a href="<?= base_url('checkout/event') ?>" class="btn btn-sm btn-primary">Lanjutkan Checkout</a>
                                         </div>
                                         <a href="<?= base_url('checkout/event_batal') ?>" class="ml-2 btn btn-sm btn-primary">Batal</a>
                                     </div>
                                 </center>
                             <?php else : ?>
                                 <div class="card-text">
                                     <h2>Total Biaya :</h2>
                                     <h3><span id="grand_total">Rp. <?= number_format($grand_total, 0, ',', '.'); ?> </span></h3>
                                     <input type="hidden" id="grand" name="grand" value="<?= $grand_total ?>">
                                 </div>
                                 <center>
                                     <div class="cart-btn">
                                         <a href="<?= base_url('checkout/event') ?>" class="btn btn-sm btn-warning">Checkout</a>
                                     </div>
                                 </center>
                             <?php endif; ?>
                         </div>
                     </div>
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

 </main>
 <script>
     function uncheck_status_event(id_keranjang) {
         $.ajax({
             url: '<?= base_url('home/uncheck_status_event'); ?>',
             data: {
                 id_keranjang: id_keranjang,
             },
             method: 'post',
             dataType: 'json',
             success: function(data) {
                 console.log(data);
                 location.reload();
             }
         });
     }

     function check_status_event(id_keranjang) {
         $.ajax({
             url: '<?= base_url('home/check_status_event'); ?>',
             data: {
                 id_keranjang: id_keranjang,
             },
             method: 'post',
             dataType: 'json',
             success: function(data) {
                 console.log(data);
                 location.reload();
             }
         });
     }

     function tambah_qty(id_keranjang) {
         let qty = $('#qty_' + id_keranjang).val();
         let qty_new = parseInt(qty) + 1;
         $('#qty_' + id_keranjang).val(qty_new);

         $.ajax({
             url: '<?= base_url('home/updatekeranjang_event'); ?>',
             data: {
                 id_keranjang: id_keranjang,
                 qty: qty_new
             },
             method: 'post',
             dataType: 'json',
             success: function(data) {
                 console.log(data);
                 let harga_before = $('#harga_' + id_keranjang).val();
                 let new_harga = parseInt(harga_before) * data.qty;
                 $('#total_harga_' + id_keranjang).html('Rp. ' + new_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

                 let grand_total_before = $('#grand').val();
                 let new_grand = parseInt(grand_total_before) + parseInt($('#harga_' + id_keranjang).val());

                 $('#grand_total').html('Rp. ' + new_grand.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                 $('#grand').val(new_grand);
             }
         });
     }

     function kurang_qty(id_keranjang) {
         let qty = $('#qty_' + id_keranjang).val();
         let qty_new = parseInt(qty) - 1;
         $('#qty_' + id_keranjang).val(qty_new);

         $.ajax({
             url: '<?= base_url('home/updatekeranjang_event'); ?>',
             data: {
                 id_keranjang: id_keranjang,
                 qty: qty_new
             },
             method: 'post',
             dataType: 'json',
             success: function(data) {
                 console.log(data);
                 let harga_before = $('#harga_' + id_keranjang).val();
                 let new_harga = parseInt(harga_before) * data.qty;
                 $('#total_harga_' + id_keranjang).html('Rp. ' + new_harga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));

                 let grand_total_before = $('#grand').val();
                 let new_grand = parseInt(grand_total_before) - parseInt($('#harga_' + id_keranjang).val());

                 $('#grand_total').html('Rp. ' + new_grand.toString().replace(/\B(?=(\d{3})+(?!\d))/g, "."));
                 $('#grand').val(new_grand);
             }
         });
     }
 </script>