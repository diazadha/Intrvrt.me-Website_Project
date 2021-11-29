<div class="content-wrapper"> 
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Rincian Pesanan Merchandise</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('admin/dashboard')?>">HOME</a></li>
              <li class="breadcrumb-item active">RINCIAN PESANAN MERCHANDISE</li>
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
                            <div class="col-sm-4 invoice-col">
                                <div class="row  mb-4">
                                    <div class="col-sm-6">
                                        <b>ID Pesanan</b>
                                    </div>
                                    <div class="col-sm-6">
                                        <b>: #<?= $pesanan['id_pesanan']; ?></b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <b>Nama Pemesan </b>
                                    </div>
                                    <div class="col-sm-6">
                                        <b>: <?= $pesanan['nama_user']; ?></b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <b>Nama Penerima</b>
                                    </div>
                                    <div class="col-sm-6">
                                        <b>: <?= $pesanan['nama_penerima']; ?></b>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <b>Tanggal Pemesanan</b>
                                    </div>
                                    <div class="col-sm-6">
                                        <b>: <?= $pesanan['tgl_pesan']; ?></b>
                                    </div>
                                </div>
                                <!-- Jika yang di checkout hanya ebook maka tidak ada alamat pemesanan -->
                                <div class="row  mb-4">
                                    <div class="col-sm-6">
                                        <b>Alamat Pemesanan</b>
                                    </div>
                                    <div class="col-sm-6">
                                        <b>: <?= $pesanan['alamat']; ?></b>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Qty</th>
                                            <th>Harga</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no=1;
                                        $diskon = 0;
                                        $harga_setelah_diskon = 0;
                                        $grand_total = 0;
                                        $tot_berat = 0;
                                        foreach($pesanan1 as $p): 
                                        $total_harga = 0;
                                        $berat = $p['qty'] * $p['berat'];
                                        $tot_berat = $tot_berat + $berat;
                                        $diskon = $p['harga'] * $p['diskon'] / 100;
                                        $harga_setelah_diskon = $p['harga'] - $diskon;
                                        $total_harga = $p['qty'] * $harga_setelah_diskon;
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $p['nama_merch']; ?></td>
                                            <td><?= $p['qty']; ?></td>
                                            <td>Rp. <?= number_format($harga_setelah_diskon, 0, ',', '.'); ?></td>
                                            <td>Rp. <?= number_format($total_harga, 0, ',', '.'); ?></td>
                                        </tr>
                                        <?php 
                                        $grand_total = $grand_total + $total_harga;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Pembayaran</h5>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h5>Virtual Account :</h5>
                                                <h3>262159939380502</h3>
                                            </div>
                                            <div class="col-sm-6" style="margin-top: -60px;">
                                                <img src="<?= base_url('assets/bank_logo/bca.png') ?>" alt="Responsive image" class="img-fluid">
                                            </div>
                                        </div>
                                        <center>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h4>Tagihan Pembayaran : </h4>
                                                    <div class="mt-4">
                                                        <span style="font-size:xx-large;">Rp. <?= number_format($pesanan['total_bayar'], 0, ',', '.') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </center>
                                        <center>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h5>Batas Pembayaran : </h5>
                                                    <div class="mb-20">
                                                        <span class="post-cat" style="font-size:large;"><?= date('d-m-Y H:i:s', strtotime(28)); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>Rp. <?= number_format($grand_total, 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Berat</th>
                                            <td><?= $pesanan['total_berat']; ?>Gr</td>
                                        </tr>
                                        <tr>
                                            <th>Ongkos Kirim</th>
                                            <td>Rp. <?= number_format($pesanan['ongkir'], 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total Bayar</th>
                                            <td>Rp. <?= number_format($pesanan['total_bayar'], 0, ',', '.'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Ekspedisi</th>
                                            <td><?= strtoupper($pesanan['expedisi']); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Paket</th>
                                            <td><?= $pesanan['paket']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Estimasi</th>
                                            <td><?= $pesanan['estimasi']; ?></td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a class="btn btn-secondary float-right" href="<?= base_url('admin/pesanan/merchandise'); ?>" role="button">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
</div>