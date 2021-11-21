 <!-- Main Wrap Start -->
<?= base_url('rajaongkir/provinsi') ?>
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

                                <nav class="navbar navbar-light bg-light">
                                    <div class="container-fluid" style="background-color: white;">
                                        <div class="col-12 table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Merchandise</th>
                                                    <th class="text-center">Qty</th>
                                                    <th class="text-center">Weight</th>
                                                    <th class="text-center">Price</th>
                                                    <th class="text-center">Total Price</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                        <td>66</td>
                                                        <td></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center">  Gr </td>
                                                        <td style="text-align:right">Rp.</td>
                                                        <td style="text-align:right">Rp. </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <div class="col-sm-6 mt-4">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Province*</label>
                                            <select name="provinsi" class="form-control" required>
                                                <option>- Select -</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 mt-4">
                                        <div class="form-group">
                                            <label style="font-weight:bold">City*</label>
                                            <select name="kota" class="form-control" required>
                                                <option>- Select -</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Expedition*</label>
                                            <select name="expedisi" class="form-control" required>
                                                <option>- Select -</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Service*</label>
                                            <select name="paket" class="form-control" required>
                                                <option>- Select -</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Address*</label>
                                            <input type="text" name="alamat" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Postal Code*</label>
                                            <input type="number" name="kode_pos" class="form-control" onKeyPress="if(this.value.length==5) return false;" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Receiver Name*</label>
                                            <input name="nama_penerima" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label style="font-weight:bold">Phone Number (receiver)*</label>
                                            <input type="tel" name="no_tlpn_penerima" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                </div>
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
<script>
    $(document).ready(function(){
        $.ajax({
            type: "POST",
            url: "<?= base_url('rajaongkir/provinsi') ?>", 
            success: function(hasil_provinsi) {
                // console.log(hasil_provinsi);
                $("select[name=provinsi]").html(hasil_provinsi);
            }
        });
    

        //masukan data ke select kota
        $("select[name=provinsi]").on("change", function(){
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
