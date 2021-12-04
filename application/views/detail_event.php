<div class="main-wrap">
    <aside id="sidebar-wrapper" class="custom-scrollbar offcanvas-sidebar position-right">
        <button class="off-canvas-close"><i class="ti-close"></i></button>
    </aside>
    <main class="position-relative">
        <div class="container">
            <!--end entry header-->
            <h3><i class="fas fa-ticket-alt"></i> Event</h3>
            <hr>
            <div class="row mb-20">
                <div class="col-lg-5 col-md-5">
                    <div class="entry-main-content">
                        <div class="wp-block-image">
                            <div id="owl-produk" class="owl-carousel owl-theme owl-img-responsive">
                                <div class="item">
                                    <img src="<?= base_url('assets/uploads/foto_event/') . $getdatabyid['foto'] ?>" style="width:100%" alt="First slide">
                                </div>
                                <?php foreach ($getfotobyid as $m) : ?>
                                    <div class="item">
                                        <img src="<?= base_url('assets/uploads/foto_event/') . $m['foto'] ?>" style="width:100%" alt="">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--comment form-->
                <div class="col-lg-7 col-md-7 mb-20">
                    <h4><?= $getdatabyid['nama_event']; ?></h4>
                    <?php
                        if ($getdatabyid['diskon'] != 0) { ?>
                        <?php $h_diskon = $getdatabyid['harga_tiket'] * ($getdatabyid['diskon'] / 100);
                            $diskon = $getdatabyid['harga_tiket'] - $h_diskon;
                            ?>
                        <div class="d-flex">
                            <div class="mr-auto">
                                <h3 class="entry-meta meta-1 text-primary">Rp <?= number_format($diskon, 0, ',', '.') ?></h3>
                            </div>
                            <div class="text-right entry-meta meta-1 d-none d-md-block" style="text-decoration: line-through; color:red;">
                                Rp <?= number_format($getdatabyid['harga_tiket'], 0, ',', '.') ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="entry-meta meta-0 mb-30 mt-1">
                            <h3 class="text-primary">Rp <?= number_format($getdatabyid['harga_tiket'], 0, ',', '.') ?></h3> 
                        </div>
                    <?php } ?>
                    <?php if ($getdatabyid['diskon'] != 0) : ?><br>
                        Diskon: <?= $getdatabyid['diskon'] . '%'; ?><br>
                    <?php endif; ?>
                        Kuota: <?= $getdatabyid['stock'] ?> peserta<br>
                        Kategori: <?=$getdatabyid['nama_kategori']?><br>
                        Tanggal Acara: <?=$this->UserModel->format_tanggal($getdatabyid['tgl_acara'])?><br><br>
                        <div class="text-danger"><i>**Daftar sebelum <?=$this->UserModel->format_tanggal($getdatabyid['tgl_berakhir'])?></i></div>
                    
                    <hr class="wp-block-separator is-style-wide">
                    <h5>Deskripsi</h5>
                    <p><?= htmlspecialchars_decode($getdatabyid['deskripsi_event']); ?></p>
                    <?php if ($getdatabyid['stock'] == 0) : ?>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="entry-meta meta-0 font-small mb-10 mt-1">
                                        <span class="post-cat bg-success color-white">Stock Habis</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <a class="btn btn-secondary" href="<?= base_url('home/event/'); ?>" role="button">Kembali</a>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="row">
                            <div class="form-group">
                                <div class="col">
                                    <a class="btn-cart btn-sm btn-primary font-weight-bold" href="<?= base_url('home/tambah_keranjang_event/') . $getdatabyid['id_event']; ?>" role="button"><ion-icon name="cart"></ion-icon> Keranjang</a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!--End row-->
            <div class="row">
                <div class="col-md-12 text-center mb-20">
                    <h4 class="text-center">Event Lainnya</h4>
                </div>
                <div class="col-md-12">
                    <div id="owl-center" class="owl-carousel owl-theme owl-img-responsive">
                        <?php foreach ($this->Tiket_model->geteventnotby($getdatabyid['id_event'])->result_array() as $m) : ?>
                        <div class="item">
                            <div class="border background-white border-radius-10 p-10 mb-30">
                                <div class="post-thumb d-flex mb-15 border-radius-15 img-hover-scale">
                                    <a href="<?= base_url('home/event_detail/') . $m['id_event'] ?>">
                                    <img class="border-radius-15 img-fluid" src="<?= base_url('assets/uploads/foto_event/') . $m['foto']; ?>" alt="" style="width: 100%;">
                                    </a>
                                </div>
                                <div class="pl-10 pr-10">
                                    <div class="d-flex entry-meta mb-15 mt-10">
                                        <div class="mr-auto">
                                            <a class="entry-meta meta-2" href="<?= base_url('home/event_kategori/') . $m['kategori']; ?>"><span class="post-in text-primary font-x-small"><?= $m['nama_kategori']; ?></span></a>
                                        </div>
                                        <small>Sisa <?= $m['stock']; ?></small>
                                    </div>
                                    <h5 class="post-title mb-15">
                                        <a href="<?= base_url('home/event_detail/') . $m['id_event'] ?>">
                                            <?php if (strlen($m['nama_event']) > 28) : ?>
                                                <?= substr(ucwords($m['nama_event']), 0, 28); ?>
                                            <?php else : ?>
                                                <?= ucwords($m['nama_event']); ?>
                                            <?php endif ?>
                                        </a>
                                    </h5>
                                    <?php
                                    if ($m['diskon'] != 0) { ?>
                                        <?php $h_diskon = $m['harga_tiket'] * ($m['diskon'] / 100);
                                        $diskon = $m['harga_tiket'] - $h_diskon;
                                        ?>
                                        <div class="d-flex">
                                            <div class="mr-auto">
                                                <div class="entry-meta meta-1">Rp <?= number_format($diskon, 0, ',', '.') ?></div>
                                            </div>
                                            <div class="text-right entry-meta meta-1 d-none d-md-block" style="text-decoration: line-through; color:red;">
                                                <small>Rp <?= number_format($m['harga_tiket'], 0, ',', '.') ?></small>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="entry-meta meta-1">Rp <?= number_format($m['harga_tiket'], 0, ',', '.') ?></div>
                                    <?php } ?>
                                    <div class="entry-meta meta-1 text-uppercase text-center mb-10 mt-15">
                                        <a href="<?= base_url('home/tambah_keranjang_event/') . $m['id_event']; ?>" class="btn-cart btn-sm btn-primary font-weight-bold" style="width: 100%;"><ion-icon name="cart"></ion-icon> Keranjang</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>