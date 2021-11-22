 <!-- Main Wrap Start -->

 <main class="position-relative">
     <div class="cart-page">
         <div class="container">
             <!-- main content -->
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
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <label for="">Email Peserta</label>
                                            <input type="text" class="form-control">
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
                                <tr>
                                    <th>Event</th>
                                    <th width="10%">Qty</th>
                                    <th>Total</th>
                                </tr>
                                <?php $no=1; foreach($checkout as $c):?>
                                    <tr>
                                        <td><?=$c->nama_event?></td>
                                        <td><?=$c->qty?></td>
                                        <td><?=$c->harga?></td>
                                    </tr>
                                <?php endforeach;?>
                            </table><hr>
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