 <!-- Main Wrap Start -->

 <main class="position-relative">
     <div class="cart-page">
         <div class="container">
             <!-- main content -->
             <div class="row">
                 <div class="col-lg-7 col-md-7 mb-3">
                     <div class="card">
                         <div class="card-header">
                            <h5>Checkout Merchandise</h5>
                         </div>
                         <div class="card-body table-responsive">
                            <div class="row mt-3 mb-3">
                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <label style="font-weight:bold">Nama Penerima*</label>
                                        <input type="text" name="nama_penerima" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <div class="form-group">
                                        <label style="font-weight:bold">No Handphone Penerima*</label>
                                        <input type="tel" name="tlpn_penerima" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label style="font-weight:bold">Email Penerima*</label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-5 col-md-5 mb-3">
                     <div class="card bg-white">
                         <div class="card-body">
                             <h5>Ringkasan Pesanan</h5>
                            <table class="table table-bordered table-sm" width="100%">
                                <tr class="text-center">
                                    <th>Merchandise</th>
                                    <th width="20%">Berat</th>
                                    <th width="10%">Qty</th>
                                    <th width="20%">Total</th>
                                </tr>
                                <?php 
                                    $no=1; 
                                    $diskon = 0;
                                    $harga_setelah_diskon = 0;
                                    $grand_total=0;
                                    $tot_berat = 0;
                                    foreach($checkout as $ch):

                                        // var_dump($ch);
                                        $total_harga=0;
                                        $berat = $ch['qty'] * $ch['berat'];
                                        $tot_berat = $tot_berat + $berat;
                                        $diskon = $ch['harga'] * $ch['diskon']/100;
                                        $harga_setelah_diskon = $ch['harga'] - $diskon;
                                        $total_harga = $ch['qty'] * $harga_setelah_diskon;
                                    ?>
                                    <tr>
                                        <td><?=$ch['nama_merch']?></td>
                                        <td align="center"><?=$ch['berat']?> Gr</td>
                                        <td align="center"><?=$ch['qty']?></td>
                                        <td align="right">Rp. <?= number_format($total_harga, 0,',','.')?></td>
                                    </tr>
                                    <?php $grand_total = $grand_total + $total_harga; ?>
                                <?php endforeach;?>
                                <tr>
                                    <td colspan="3" align="right" class="font-weight-bold">Sub Total</td>
                                    <td align="right">Rp. <?=number_format($grand_total, 0,',','.')?></td>
                                </tr>
                            </table>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Sub total:</th>
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

                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <label for="" class="font-weight-bold">Pilih Metode Bayar</label>
                                    <select class="form-control" name="metode_bayar" id="">
                                        <?php foreach($VABank as $va):?>
                                            <?php if($va['is_activated']):?>
                                                <option value="<?= $va['code']?>"><?= $va['name']?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <a href="" class="btn btn-primary">Bayar Sekarang</a>
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