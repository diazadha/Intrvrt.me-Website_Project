<div class="main-wrap">
    <aside id="sidebar-wrapper" class="custom-scrollbar offcanvas-sidebar position-right">
        <button class="off-canvas-close"><i class="ti-close"></i></button>
    </aside>
    <main class="position-relative">
        <div class="cart-page">
            <div class="container">
                <!-- main content -->
                <div class="row justify-content-md-center">
                    <div class="col-lg-12 col-md-7 mb-3">
                        <div class="card">
                            <div class="container">
                                <!-- Content Header (Page header) -->
                                <section class="content-header">
                                    <div class="container-fluid">
                                        <div class="row mb-2 mt-4">
                                            <div class="col-sm-6">
                                                <h1>Detail Riwayat Merchandise</h1>
                                            </div>
                                        </div>
                                    </div><!-- /.container-fluid -->
                                </section>

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
                                                                    <b>: <?= $data_riwayat_biodata['id_pesanan']; ?></b>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <b>Nama Pemesan </b>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <b>: <?= $data_riwayat_biodata['nama_user']; ?></b>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <b>Nama Penerima</b>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <b>: <?= $data_riwayat_biodata['nama_penerima']; ?></b>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <b>Email Penerima</b>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <b>: <?= $data_riwayat_biodata['email_penerima']; ?></b>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <b>Tanggal Pemesanan</b>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <b>: <?= date('d F Y', strtotime($data_riwayat_biodata['tgl_pesan'])); ?></b>
                                                                </div>
                                                            </div>
                                                            <!-- Jika yang di checkout hanya ebook maka tidak ada alamat pemesanan -->
                                                            <?php if (empty($data_riwayat_biodata['alamat'] || $data_riwayat_biodata['provinsi'] || $data_riwayat_biodata['kodepos'] || $data_riwayat_biodata['kota'])) : ?>
                                                                <div class="row ">
                                                                    <div class="col-sm-6">
                                                                        <b>Alamat Pemesanan</b>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <b>: -</b>
                                                                    </div>
                                                                </div>
                                                                <div class="row  ">
                                                                    <div class="col-sm-6">
                                                                        <b>Provinsi</b>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <b>: -</b>
                                                                    </div>
                                                                </div>
                                                                <div class="row  ">
                                                                    <div class="col-sm-6">
                                                                        <b>kodepos</b>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <b>: -</b>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <div class="col-sm-6">
                                                                        <b>Kota</b>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <b>: -</b>
                                                                    </div>
                                                                </div>
                                                            <?php else : ?>
                                                                <div class="row ">
                                                                    <div class="col-sm-6">
                                                                        <b>Alamat Pemesanan</b>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <b>: <?= $data_riwayat_biodata['alamat']; ?></b>
                                                                    </div>
                                                                </div>
                                                                <div class="row  ">
                                                                    <div class="col-sm-6">
                                                                        <b>Provinsi</b>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <b>: <?= $data_riwayat_biodata['provinsi']; ?></b>
                                                                    </div>
                                                                </div>
                                                                <div class="row  ">
                                                                    <div class="col-sm-6">
                                                                        <b>kodepos</b>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <b>: <?= $data_riwayat_biodata['kodepos']; ?></b>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-4">
                                                                    <div class="col-sm-6">
                                                                        <b>Kota</b>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <b>: <?= $data_riwayat_biodata['kota']; ?></b>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
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
                                                                    <?php $no = 1;
                                                                        foreach ($data_riwayat_barang as $d) : ?>
                                                                        <?php
                                                                            $diskon = $d['harga'] * ($d['diskon'] / 100);
                                                                            $harga_diskon = $d['harga'] - $diskon;
                                                                            $total_harga = $harga_diskon * $d['qty'];
                                                                            ?>
                                                                        <tr>
                                                                            <td><?= $no; ?></td>
                                                                            <td><?= $d['nama_merch']; ?></td>
                                                                            <td><?= $d['qty']; ?></td>
                                                                            <td>Rp. <?= number_format($harga_diskon, 0, ',', '.'); ?></td>
                                                                            <td>Rp. <?= number_format($total_harga, 0, ',', '.'); ?></td>
                                                                            <?php $no++; ?>
                                                                        </tr>
                                                                    <?php endforeach; ?>
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
                                                                        <div class="col-sm-6 mb-4">
                                                                            <h5>Virtual Account :</h5>
                                                                            <h3><?= $data_riwayat_biodata['account_number']; ?></h3>
                                                                        </div>
                                                                        <div class="col-sm-6" style="margin-top: -10px;">
                                                                            <?php if ($data_riwayat_biodata['bank_code'] == 'BCA') { ?>
                                                                                <img src="<?= base_url('assets/bank_logo/bca2.png') ?>" alt="Responsive image" class="img-fluid">
                                                                            <?php } else if ($data_riwayat_biodata['bank_code'] == 'BRI') { ?>
                                                                                <img src="<?= base_url('assets/bank_logo/bri2.png') ?>" alt="Responsive image" class="img-fluid">
                                                                            <?php } else if ($data_riwayat_biodata['bank_code'] == 'BNI') { ?>
                                                                                <img src="<?= base_url('assets/bank_logo/bni.png') ?>" alt="Responsive image" class="img-fluid">
                                                                            <?php } else if ($data_riwayat_biodata['bank_code'] == 'MANDIRI') { ?>
                                                                                <img src="<?= base_url('assets/bank_logo/mandiri.png') ?>" alt="Responsive image" class="img-fluid">
                                                                            <?php } else if ($data_riwayat_biodata['bank_code'] == 'PERMATA') { ?>
                                                                                <img src="<?= base_url('assets/bank_logo/permata.png') ?>" alt="Responsive image" class="img-fluid">
                                                                            <?php } else if ($data_riwayat_biodata['bank_code'] == 'CIMB') { ?>
                                                                                <img src="<?= base_url('assets/bank_logo/cimb.png') ?>" alt="Responsive image" class="img-fluid">
                                                                            <?php } else if ($data_riwayat_biodata['bank_code'] == 'BSI') { ?>
                                                                                <img src="<?= base_url('assets/bank_logo/bsi.png') ?>" alt="Responsive image" class="img-fluid">
                                                                            <?php } else if ($data_riwayat_biodata['bank_code'] == 'SAHABAT_SAMPOERNA') { ?>
                                                                                <img src="<?= base_url('assets/bank_logo/sahabat_sampoerna.png') ?>" alt="Responsive image" class="img-fluid">
                                                                            <?php } else { ?>
                                                                                <h5>Logo Tidak Tersedia</h5>
                                                                            <?php } ?>

                                                                        </div>
                                                                    </div>
                                                                    <center>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <h4>Tagihan Pembayaran : </h4>
                                                                                <div class="entry-meta meta-0 font-small mt-4 mb-30">
                                                                                    <span class="post-cat bg-info color-white" style="font-size:xx-large;">Rp. <?= number_format($data_riwayat_biodata['total_bayar'], 0, ',', '.') ?></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </center>
                                                                    <center>
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <h5>Batas Pembayaran : </h5>
                                                                                <div class="entry-meta meta-0 font-small mt-2 mb-20">
                                                                                    <span class="post-cat" style="font-size:large;"><?= date('d-m-Y H:i:s', strtotime($data_riwayat_biodata['tgl_pesan'] . " +1 days")); ?></span>
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
                                                                        <td class="text-right">Rp. <?= number_format($data_riwayat_biodata['grand_total'], 0, ',', '.'); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Berat</th>
                                                                        <td class="text-right"><?= $data_riwayat_biodata['berat']; ?> Gr</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Ongkos Kirim</th>
                                                                        <td class="text-right">Rp. <?= number_format($data_riwayat_biodata['ongkir'], 0, ',', '.'); ?></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Total Bayar</th>
                                                                        <td class="text-right">Rp. <?= number_format($data_riwayat_biodata['total_bayar'], 0, ',', '.'); ?></td>
                                                                    </tr>
                                                                    <?php if (empty($data_riwayat_biodata['expedisi'] || $data_riwayat_biodata['paket'] || $data_riwayat_biodata['estimasi'])) : ?>
                                                                        <tr>
                                                                            <th>Ekspedisi</th>
                                                                            <td class="text-right">-</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Paket</th>
                                                                            <td class="text-right">-</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Estimasi</th>
                                                                            <td class="text-right">-</td>
                                                                        </tr>
                                                                    <?php else : ?>
                                                                        <tr>
                                                                            <th>Ekspedisi</th>
                                                                            <td class="text-right"><?= $data_riwayat_biodata['expedisi']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Paket</th>
                                                                            <td class="text-right"><?= $data_riwayat_biodata['paket']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Estimasi</th>
                                                                            <td class="text-right"><?= $data_riwayat_biodata['estimasi']; ?></td>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                    <!-- /.row -->

                                                    <!-- this row will not appear when printing -->
                                                    <div class="row no-print">
                                                        <div class="col-12">
                                                            <a class="btn btn-secondary float-right" href="<?= base_url('home/my_account/'); ?>" role="button">Kembali</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.invoice -->
                                            </div><!-- /.col -->
                                        </div><!-- /.row -->
                                    </div><!-- /.container-fluid -->
                                </section>
                                <!-- /.content -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>