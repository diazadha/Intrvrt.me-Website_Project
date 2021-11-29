<div class="content-wrapper"> 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Rincian Pesanan Event</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard')?>">HOME</a></li>
              <li class="breadcrumb-item active">RINCIAN PESANAN EVENT</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- info row -->
                        <div class="row invoice-info">
                            <!-- /.col -->
                            <div class="col-sm-6 invoice-col">
                                <div class="row  mb-4">
                                    <div class="col-sm-6">
                                        <b>ID Pesanan</b>
                                    </div>
                                    <div class="col-sm-6">
                                        <b>: #<?= $pesanan->id ?></b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <b>Nama Pemesan </b>
                                    </div>
                                    <div class="col-sm-6">
                                        <b>: <?= $pesanan->nama_user?></b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <b>Tanggal Pemesanan</b>
                                    </div>
                                    <div class="col-sm-6">
                                        <b>: <?= $pesanan->tgl_pesan ?></b>
                                    </div>
                                </div>
                                <div class="row  mb-4">
                                    <div class="col-sm-6">
                                        <b>Tagihan</b>
                                    </div>
                                    <div class="col-sm-6">
                                        <b>: Rp<?= number_format($pesanan->expected_amount); ?></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <?php foreach($this->PesananModel->get_event($pesanan->id)->result() as $e):?>
                                        <tr>
                                            <td colspan="3"><h5 class="font-weight-bold"><?= $e->nama_event?></h5></td>
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
                        </div>
                        <div class="row no-print">
                            <div class="col-12">
                                <a class="btn btn-secondary float-right" href="<?= base_url('admin/pesanan/event'); ?>" role="button">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>