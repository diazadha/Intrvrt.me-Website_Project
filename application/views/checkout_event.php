 <!-- Main Wrap Start -->
 <main class="position-relative">
     <div class="cart-page">
         <div class="container">
             <!-- main content -->
             <?= form_open(base_url('checkout/proses_event'));?>   
             <div class="row">
                 <div class="col-lg-7 col-md-7 mb-3">
                     <div class="card">
                         <div class="card-header">
                            <h5>Registrasi Data Peserta</h5>
                         </div>
                         <div class="card-body table-responsive">
                            <?php $no=1; foreach($checkout as $c):?>
                                <strong>Event: <?=$c->nama_event?></strong>
                                <?php for($i=1; $i <= $c->qty; $i++):?>
                                    <div class="row mt-3 mb-3">
                                        <div class="col-md-6 mb-1">
                                            <label for="">Nama Peserta</label>
                                            <input type="text" class="form-control" required name="nama[]">
                                            <input type="hidden" readonly class="form-control" name="id_event_detail[]" value="<?=$c->id?>">
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <label for="">Email Peserta</label>
                                            <input type="text" class="form-control" required name="email[]">
                                        </div>
                                    </div>
                                <?php endfor;?>
                            <?php endforeach;?>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-5 col-md-5 mb-3">
                     <div class="card bg-white">
                         <div class="card-body">
                             <h5>Ringkasan Pesanan</h5>
                            <table class="table table-bordered table-sm" width="100%">
                                <tr class="text-center">
                                    <th>Event</th>
                                    <th width="10%">Qty</th>
                                    <th width="20%">Total</th>
                                </tr>
                                <?php $no=1; $subtotal=0;  foreach($checkout as $ch): 
                                    $diskon = $ch->harga * ($ch->diskon / 100);
                                    $harga_diskon = $ch->harga - $diskon;
                                    $total = $harga_diskon * $ch->qty;
                                    $subtotal+=$total;?>
                                    <tr>
                                        <td><?=$ch->nama_event?></td>
                                        <td align="center"><?=$ch->qty?></td>
                                        <td align="right"><?=number_format($total)?></td>
                                    </tr>
                                <?php endforeach;?>
                                <tr>
                                    <td colspan="2" align="right" class="font-weight-bold">Sub Total</td>
                                    <td align="right"><?=number_format($subtotal)?></td>
                                </tr>
                            </table>
                            <?php if($subtotal != 0):?>
                            <div class="row mt-3 mb-3">
                                <div class="col-md-12">
                                    <label for="" class="font-weight-bold">Pilih Metode Bayar</label>
                                    <select class="form-control" name="vaBank" required>
                                        <?php foreach($VABank as $va):?>
                                            <?php if($va['is_activated']):?>
                                                <option value="<?= $va['code']?>"><?= $va['name']?></option>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <?php endif;?>
                            <hr>
                            <input type="hidden" readonly value="<?=$subtotal?>" name="totaltagihan">
                            <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                         </div>
                     </div>
                 </div>
             </div>
             <?php echo form_close(); ?>
         </div>
     </div>
 </main>