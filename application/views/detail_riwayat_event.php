<section class="content">
     <div class="container-fluid">
         <div class="row">
             <div class="col-12">
                 <!-- Main content -->
                 <div class="invoice p-3 mb-3">
                     <!-- title row -->
                     <div class="row">
                         <div class="col-12">
                             <h4>
                                 #INTRVRT.ME-<?= $pesanan->id ?> 
                             </h4>
                         </div>
                         <!-- /.col -->
                     </div>
                     <!-- info row -->
                     <div class="row invoice-info">
                         <div class="col-sm-4 invoice-col">
                             <address>
                                 Pemesan: <strong><?= $pesanan->nama_user?></strong><br>
                                 Tgl. Pemesanan: <?= $pesanan->tgl_pesan ?> <br>
                                 Harga Tiket: Rp<?= number_format($pesanan->expected_amount); ?> <br>
                                 Status: <?= ($pesanan->status == 2) ? '<span class="text-danger">BELUM BAYAR</span>' : '<span class="text-success">LUNAS</span>';?><br>
                             </address>
                         </div>
                         <?php if($pesanan->status == 2):?>
                         <div class="col-sm-4 invoice-col">
                             <address>
                                 Silahkan Melakukan Pembayaran Anda ke:<br>
                                 Bank: <strong><?= $pesanan->bank_code?></strong><br>
                                 Virtual Account: <strong><?= $pesanan->account_number?></strong><br>
                                 Tagihan Pembayaran: <strong>Rp. <?= number_format($pesanan->expected_amount) ?></strong> <br>
                                 Batas Pembayaran: <span class="text-danger"><?= $pesanan->expiration_date; ?></span>
                             </address>
                         </div>
                         <?php endif;?>
                     </div>
                     <!-- /.row -->

                     <!-- Table row -->
                     <div class="row">
                         <div class="col-12 table-responsive">
                             <table class="table table-striped">
                                <?php foreach($this->PesananModel->get_event($pesanan->id)->result() as $e):?>
                                    <tr>
                                        <td colspan="3"><h5 class="font-weight-bold">Tiket <?= $e->nama_event?></h5></td>
                                    </tr>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                    </tr>
                                    <?php $no=1; foreach($this->PesananModel->get_peserta($e->id)->result() as $pp):?>
                                        <tr>
                                            <td width="5%"><?=$no?></td>
                                            <td><?=$pp->nama?></td>
                                            <td><?=$pp->email?></td>
                                        </tr>
                                    <?php $no++; endforeach;?>
                                <?php endforeach;?>
                             </table>
                         </div>
                         <!-- /.col -->
                     </div>
                     <div class="row no-print">
                         <div class="col-12">
                             <a href="<?=base_url('home/my_account')?>" class="btn btn-secondary float-right" style="margin-right: 5px;">
                                 Kembali
                             </a>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>