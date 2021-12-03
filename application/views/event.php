<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img class="jump mb-50" src="assets/imgs/loading.svg" alt="">
                <h6>Now Loading</h6>
                <div class="loader">
                    <div class="bar bar1"></div>
                    <div class="bar bar2"></div>
                    <div class="bar bar3"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-wrap">
    <aside id="sidebar-wrapper" class="custom-scrollbar offcanvas-sidebar position-right">
        <button class="off-canvas-close"><i class="ti-close"></i></button>
    </aside>
    <main class="position-relative">
        <div class="archive-header text-center mb-50">
            <div class="container">
                <h4 class="text-center" style="color: #E64F5E;">Daftar Event</h4>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 primary-sidebar sticky-sidebar sidebar-left order-2 order-md-1">
                    <div class="sidebar-widget widget_categories border-radius-10 bg-white mb-30">
                        <div class="widget-header position-relative mb-15">
                            <h5 class="widget-title"><strong>Kategori Event</strong></h5>
                        </div>
                        <ul class="font-small text-muted">
                            <li class="cat-item cat-item-2"><a href="<?= base_url('home/event/') ?>">Tampilkan Semua</a></li>
                            <?php foreach ($kategori as $k) : ?>
                                <li class="cat-item cat-item-2"><a href="<?= base_url('home/ekategori/') . $k['id_kategori'] ?>"><?= $k['nama_kategori']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 order-1 order-md-2">
                    <?= $this->session->flashdata('message');
                    $this->session->unset_userdata('message'); ?>
                    <div class="row mb-50">
                        <?php foreach ($event as $e) : ?>
                            <div class="col-lg-6 col-6 col-md-12">
                                <div class="latest-post mb-50">
                                    <div class="loop-list-style-1">
                                        <article class="p-10 background-white border-radius-10 mb-30 wow fadeIn animated">
                                            <div class="d-md-flex d-block">
                                                <div class="post-thumb post-thumb-big d-flex mr-15 border-radius-15 img-hover-scale">
                                                    <a class="color-white" href="<?= base_url('home/event_detail/') . $e['id_event'] ?>">
                                                        <img class="img-fluid border-radius-15" src="<?= base_url('assets/uploads/foto_event/') . $e['foto']; ?>" alt="Responsive image" style="height: 250px; width: 250px;">
                                                    </a>
                                                </div>
                                                <div class="post-content media-body">
                                                    <div class="entry-meta mb-15 mt-10">
                                                        <a class="entry-meta meta-2" href="<?= base_url('home/ekategori/') . $k['id_kategori'] ?>"><span class="post-in text-danger font-x-small"><?= $e['nama_kategori']; ?></span></a>
                                                    </div>
                                                    <h5 class="post-title text-limit-2-row">
                                                        <a href="<?= base_url('home/event_detail/') . $e['id_event'] ?>"><?= ucwords($e['nama_event']); ?></a>
                                                    </h5>
                                                    <h7 class="post-title mb-15 text-limit-2-row">
                                                        <a href="<?= base_url('home/event_detail/') . $e['id_event'] ?>">Acara: <?= ucwords($e['tgl_acara']); ?></a>
                                                    </h7>
                                                    <h6 class="post-title text-limit-2-row" style="margin-bottom: 20px;">
                                                        <span class="post-off">Stock: <?= $e['stock']; ?></span>
                                                    </h6>
                                                    <div class="entry-meta meta-1 font-x-small color-grey float-left">
                                                        <?php
                                                        if ($e['harga_tiket'] == 0) { ?>
                                                            <div class="entry-meta meta-0 font-small mb-30"><span class="post-in background5 text-dark font-x-small">GRATIS</span></div>
                                                        <?php } else if ($e['diskon'] != 0) { ?>
                                                            <?php $h_diskon = $e['harga_tiket'] * ($e['diskon'] / 100);
                                                            $diskon = $e['harga_tiket'] - $h_diskon;
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-sm-5 col-4">
                                                                    <div class="entry-meta meta-1" style="text-decoration: line-through; color:red;">
                                                                        <span style="color: black;">Rp <?= number_format($e['harga_tiket'], 0, ',', '.') ?></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="entry-meta meta-0 font-small mb-30">
                                                                        <span class="post-cat bg-success color-white">Rp <?= number_format($diskon, 0, ',', '.') ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } else { ?>
                                                            <div class="entry-meta meta-0 font-small mb-30 mt-1">
                                                                <span class="post-cat bg-success color-white">Rp <?= number_format($e['harga_tiket'], 0, ',', '.') ?></span>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($e['stock'] == 0) : ?>
                                                            <div class="row justify-content-center align-items-center">
                                                                <div class="col-sm-12">
                                                                    <div class="entry-meta meta-0 font-small mb-30 mt-1">
                                                                        <span class="post-cat bg-success color-white">Stock Habis</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php else : ?>
                                                            <div class="row justify-content-center align-items-center">
                                                                <div class="col-sm-5">
                                                                    <a href="<?= base_url('home/event_detail/') . $e['id_event'] ?>">
                                                                        <div class="entry-meta meta-1">
                                                                            <div class="row">
                                                                                <div class="col-sm-7 col-4">
                                                                                    <img src="<?= base_url('assets/logo/detail.png'); ?>" alt="" style="height: 30px; width: 30px;">
                                                                                </div>
                                                                                <div class="col-sm-2 col-2" style="margin-left: -28px; margin-top: 7px;">
                                                                                    <span style="font-size: medium;">Detail</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div class="col">
                                                                    <a href="<?= base_url('home/tambah_keranjang_event/') . $e['id_event']; ?>">
                                                                        <div class="entry-meta meta-1">
                                                                            <div class="row">
                                                                                <div class="col-sm-5 col-4">
                                                                                    <img src="<?= base_url('assets/logo/cart.png'); ?>" alt="" style="height: 30px; width: 30px;">
                                                                                </div>
                                                                                <div class="col-2" style="margin-left: -28px; margin-top: 7px;">
                                                                                    <span style="font-size: medium;">Tambah</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>

                                                        <hr class="mb-2" style="margin-top: 4px;">
                                                        <span class="post-off" style="color: red;">Batas Pembelian: <?= $e['tgl_berakhir']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>