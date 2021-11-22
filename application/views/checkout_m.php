 <!-- Main Wrap Start -->
 <main class="position-relative">
     <div class="cart-page">
         <div class="container">
             <div class="col-lg-2 d-none d-lg-block"></div>
             <!-- main content -->
                
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

                    
                        <div class="col-sm-3 mt-4">
                            <div class="form-group">
                                <label style="font-weight:bold">Provinsi Tujuan*</label>
                                <select name="provinsi" class="form-control" required>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-3 mt-4">
                            <div class="form-group">
                                <label style="font-weight:bold">Kota Tujuan*</label>
                                <select name="kota" class="form-control" required>
                                    <option>- Select -</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 mt-4">
                            <div class="form-group">
                                <label style="font-weight:bold">Ekspedisi*</label>
                                <select name="expedisi" class="form-control" required>
                                    <option>- Select -</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-3 mt-4">
                            <div class="form-group">
                                <label style="font-weight:bold">Paket*</label>
                                <select name="paket" class="form-control" required>
                                    <option>- Select -</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label style="font-weight:bold">Kode Pos*</label>
                                <input type="number" name="kodepos" class="form-control" onKeyPress="if(this.value.length==5) return false;" required>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label style="font-weight:bold">No Handphone Penerima*</label>
                                <input type="tel" name="tlpn_penerima" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label style="font-weight:bold">Nama Penerima*</label>
                                <input name="nama_penerima" class="form-control" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label style="font-weight:bold">Alamat*</label>
                                <input type="text" name="alamat" class="form-control" required>
                            </div>
                        </div>

                        <?php if(in_array('1',$d,TRUE)&& in_array('0',$d,TRUE)): ?>
                            <div class="col-sm-6">
                            <div class="form-group">
                                <label style="font-weight:bold">Email*</label>
                                <input type="email" name="email_penerima" class="form-control" required>
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
                                        <th>Ongkos Kirim:</th>
                                        <td>Rp. <label id="ongkir"></label></td>
                                    </tr>
                                    <tr>
                                        <th>Total Bayar:</th>
                                        <td>Rp. <label id="total_bayar"></label></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                    </nav>

                    <!-- Simpan Transaksi -->
                    <!-- <input name="no_detail" value="<?= $no_detail ?>" hidden> -->
                    <input name="id_pesanan" hidden>
                    <input name="id_user" value="<?= $this->session->userdata('id_user') ?>" hidden>
                    <input name="estimasi" hidden>
                    <input name="ongkir" hidden>
                    <input name="berat" value="<?= $tot_berat ?>" hidden><br>
                    <input name="grand_total" value="<?php echo $grand_total ?>" hidden><br>
                    <input name="total_bayar" hidden>
                    
                    <div class="modal-footer ml-auto">
                        <a href="<?= base_url('home'); ?>">
                            <div class="btn btn-sm btn-secondary">Kembali</div>
                        </a>
                        <button type="submit" class="btn btn-sm btn-secondary">Proses Checkout</button>
                    </div>
                </form>
                </div>
            </div>
                     <!-- </div> -->
         </div>
     </div>
     
    <?php $this->load->view('template_introvert/footer');?>

    <script type="text/javascript">
        $(document).ready(function(){
            $.ajax({
                type: "POST",
                url: "<?= base_url('rajaongkir/provinsi') ?>", 
                success: function(hasil_provinsi) {
                    console.log(hasil_provinsi);
                    $("select[name=provinsi]").html(hasil_provinsi);
                }
            });
        
            //masukan data ke select kota
            $("select[name=provinsi]").change( function(){
                var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('rajaongkir/kota') ?>", 
                    data: 'id_provinsi=' + id_provinsi_terpilih,
                    success: function(hasil_kota) {
                    // console.log(hasil_kota);
                    $("select[name=kota]").html(hasil_kota);
                    }
                });
            });

            $("select[name=kota]").on("change", function(){
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('rajaongkir/expedisi') ?>", //harus diedit
                    success: function(hasil_expedisi){
                        // console.log(hasil_expedisi);
                        $('select[name=expedisi]').html(hasil_expedisi);
                    }
                });
            });

            $("select[name=expedisi]").on("change", function(){
                //mendapatkan expedisi terpilih
                var expedisi_terpilih = $("select[name=expedisi]").val()
                // mendapatkan id kota tujuan terpilih
                var id_kota_tujuan_terpilih = $("option:selected","select[name=kota]").attr('id_kota')
                // mendapatkan berat produk
                var total_berat = <?= $tot_berat ?>;
                
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('rajaongkir/paket') ?>", //harus diedit
                    data: 'expedisi=' + expedisi_terpilih + '&id_kota='+id_kota_tujuan_terpilih + '&berat=' + total_berat,
                    success: function(hasil_paket){
                        // console.log(hasil_paket);
                        $('select[name=paket]').html(hasil_paket);
                    }
                });
            });


            $("select[name=paket]").on("change", function(){
                // menampilkan ongkir
                var data_ongkir = $("option:selected",this).attr('ongkir')
                // alert(data_ongkir);
                var reverse2 = data_ongkir.toString().split('').reverse().join(''),
                    ribuan_data_ongkir = reverse2.match(/\d{1,3}/g);
                ribuan_data_ongkir = ribuan_data_ongkir.join('.').split('').reverse().join('');
                $("#ongkir").html(ribuan_data_ongkir)

                // menghitung total bayar
                var ongkir = $("option:selected",this).attr('ongkir');
                var total_bayar = parseInt(ongkir) + parseInt(<?php echo $grand_total ?>);
                var reverse = total_bayar.toString().split('').reverse().join(''),
                    ribuan_total_bayar = reverse.match(/\d{1,3}/g);
                ribuan_total_bayar = ribuan_total_bayar.join('.').split('').reverse().join('');
                $("#total_bayar").html(ribuan_total_bayar);

                // estimasi dan ongkir
                var estimasi = $("option:selected",this).attr('estimasi')
                $("input[name=estimasi]").val(estimasi);
                $("input[name=ongkir]").val(data_ongkir);
                $("input[name=total_bayar]").val(total_bayar);
            });
        });
    </script>