 <!-- Main Wrap Start -->

 <main class="position-relative">
     <div class="cart-page">
         <div class="container">
             <div class="col-lg-2 d-none d-lg-block"></div>
             <!-- main content -->
             <div class="row">
                 <div class="col-lg-8 col-md-12">
                     <!-- <div class="author-bio border-radius-10 bg-white p-30 mb-50"> -->
                     <div class="cart-page-inner">
                         <div class="table-responsive">
                             <!-- As a heading -->
                             <nav class="navbar navbar-light bg-light">
                                 <h1>Merchandise</h1>
                             </nav>
                            <?= $this->session->flashdata('message2'); $this->session->unset_userdata('message2');?>
                             <hr class="mt-2">
                             <?php $no = 1;
                                $grand_total = 0; ?>

                             <nav class="navbar navbar-light bg-light">
                                 <?php foreach ($keranjang_merchandise as $m) : ?>
                                     <div class="container-fluid" style="background-color: white;">
                                         <span class="navbar-brand mb-0 h1" style="width: 1%;">
                                             <?php if ($m['status'] == 1) : ?>
                                                 <input type="checkbox" checked onclick="uncheck_status_merchandise(<?= $m['id_keranjang']; ?>)">
                                                 <?php $diskon = $m['harga'] * ($m['diskon'] / 100);
                                                    $harga_diskon = $m['harga'] - $diskon;
                                                    $total_harga =  $harga_diskon * $m['qty'];
                                                    $total_harga_row =  $harga_diskon * $m['qty'];
                                                    ?>
                                             <?php else : ?>
                                                 <input type="checkbox" onclick="check_status_merchandise(<?= $m['id_keranjang']; ?>)">
                                                 <?php $diskon = $m['harga'] * ($m['diskon'] / 100);
                                                    $harga_diskon = $m['harga'] - $diskon;
                                                    $total_harga_row = $harga_diskon * $m['qty'];
                                                    $total_harga = 0; ?>
                                             <?php endif; ?>
                                         </span>
                                         <span class="navbar-brand mb-0 h1" style="width: 1%;">
                                             <?= substr($m['nama_merch'], 0, 10); ?>
                                         </span>
                                         <span class="navbar-brand mb-0 h1" style="width: 7%;">
                                             <div class="img-fluid">
                                                 <img src="<?= base_url('assets/uploads/foto_merchandise/') . $m['foto']; ?>" alt="Responsive image">
                                             </div>
                                         </span>
                                         <input type="hidden" id="harga_<?= $m['id_keranjang']; ?>" value="<?= $harga_diskon ?>">
                                         <span class="navbar-brand mb-0 h1" style="width: 2%;">
                                             Rp. <?= number_format($harga_diskon, 0, ',', '.') ?>
                                         </span>
                                         <span class="navbar-brand mb-0 h1" style="width: 5%;">
                                             <center>
                                                 <div class="qty">
                                                     <button class="btn-sm" onclick="kurang_qty(<?= $m['id_keranjang']; ?>)" style="background-color: #FF656A; color:white; border-color:#FF656A;"><i class="fa fa-minus"></i></button>
                                                     <input class="text-center" type="text" readonly id="qty_<?= $m['id_keranjang']; ?>" value="<?= $m['qty']; ?>" min="1" style="width: 50%;  border: 1px solid #FF656A; border-radius: 5px">
                                                     <button class="btn-sm" onclick="tambah_qty(<?= $m['id_keranjang']; ?>)" style="background-color: #FF656A; color:white; border-color:#FF656A;"><i class="fa fa-plus"></i></button>
                                                 </div>
                                             </center>
                                         </span>
                                         <span class="navbar-brand mb-0 h1" id="total_harga_<?= $m['id_keranjang']; ?>" style="width: 5%;">
                                             Rp. <?= number_format($total_harga_row, 0, ',', '.') ?>
                                         </span>
                                         <span class="navbar-brand mb-0 h1">
                                             <a href="<?= base_url('home/hapus_keranjang_merchandise/') . $m['id_keranjang']; ?>">
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
                 <div class="col-lg-4 col-md-12">
                     <div class="author-bio border-radius-10 bg-white p-30 mb-50">
                         <div class="cart-page-inner">
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="cart-summary">
                                         <form action=" <?= base_url('checkout/merchandise') ?> " method="POST">
                                             <div class="cart-content">
                                                 <h2>Total Biaya :</h2>
                                                 <h3><span id="grand_total">Rp. <?= number_format($grand_total, 0, ',', '.'); ?> </span></h3>
                                                 <input type="hidden" id="grand" name="grand" value="<?= $grand_total ?>">
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
     function uncheck_status_merchandise(id_keranjang) {
         $.ajax({
             url: '<?= base_url('home/uncheck_status_merchandise'); ?>',
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

     function check_status_merchandise(id_keranjang) {
         $.ajax({
             url: '<?= base_url('home/check_status_merchandise'); ?>',
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
             url: '<?= base_url('home/updatekeranjang_merchandise'); ?>',
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
             url: '<?= base_url('home/updatekeranjang_merchandise'); ?>',
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