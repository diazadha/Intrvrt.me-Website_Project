
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
                <h4 class="text-center">Daftar Merchandise</h4>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 primary-sidebar sticky-sidebar sidebar-left order-2 order-md-1 mt-2">
                    <div class="sidebar-widget widget_categories border-radius-10 bg-white mb-30">
                        <div class="widget-header position-relative mb-15">
                            <h5 class="widget-title"><strong>Kategori Merchandise</strong></h5>
                        </div>
                        <ul class="font-small text-muted">
                            <li class="cat-item cat-item-2"><a href="<?= base_url('home/merchandise'); ?>">Tampilkan Semua</a></li>
                            <?php foreach ($kategori as $k) : ?>
                                <li class="cat-item cat-item-2"><a href="<?= base_url('home/merchandise_kategori/') . $k['id_kategori_merch']; ?>"><?= ucwords($k['nama_kategori_merch']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 order-1 order-md-2">
                    <?= $this->session->flashdata('message');
                    $this->session->unset_userdata('message'); ?>
                    <div class="related-posts">
                        <div class="row">
                            <?php foreach ($getalldata as $m) : ?>
                            <article class="col-lg-4 col-6">
                                <div class="border background-white border-radius-10 p-10 mb-30">
                                    <div class="post-thumb d-flex mb-15 border-radius-15 img-hover-scale">
                                        <a href="<?= base_url('home/merchandise_detail/') . $m['id_merch'] ?>">
                                        <img class="border-radius-15 img-fluid" src="<?= base_url('assets/uploads/foto_merchandise/') . $m['foto']; ?>" alt="" style="width: 100%;">
                                        </a>
                                    </div>
                                    <div class="pl-10 pr-10">
                                        <div class="d-flex entry-meta mb-15 mt-10">
                                            <div class="mr-auto">
                                                <a class="entry-meta meta-2" href="<?= base_url('home/merchandise_kategori/') . $m['kategori']; ?>"><span class="post-in text-primary font-x-small"><?= $m['nama_kategori_merch']; ?></span></a>
                                            </div>
                                            <small>Sisa <?= $m['stock']; ?></small>
                                        </div>
                                        <h5 class="post-title mb-15">
                                            <a href="<?= base_url('home/merchandise_detail/') . $m['id_merch'] ?>">
                                                <?php if (strlen($m['nama_merch']) > 28) : ?>
                                                    <?= substr(ucwords($m['nama_merch']), 0, 28); ?>
                                                <?php else : ?>
                                                    <?= ucwords($m['nama_merch']); ?>
                                                <?php endif ?>
                                            </a>
                                        </h5>
                                        <?php
                                        if ($m['diskon'] != 0) { ?>
                                            <?php $h_diskon = $m['harga'] * ($m['diskon'] / 100);
                                            $diskon = $m['harga'] - $h_diskon;
                                            ?>
                                            <div class="d-flex">
                                                <div class="mr-auto">
                                                    <div class="entry-meta meta-1">Rp <?= number_format($diskon, 0, ',', '.') ?></div>
                                                </div>
                                                <div class="text-right entry-meta meta-1 d-none d-md-block" style="text-decoration: line-through; color:red;">
                                                    <small>Rp <?= number_format($m['harga'], 0, ',', '.') ?></small>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="entry-meta meta-1">Rp <?= number_format($m['harga'], 0, ',', '.') ?></div>
                                        <?php } ?>
                                        <div class="entry-meta meta-1 text-uppercase text-center mb-10 mt-15">
                                            <a href="<?= base_url('home/tambah_keranjang_merch/') . $m['id_merch']; ?>" class="btn-cart btn-sm btn-primary font-weight-bold" style="width: 100%;"><ion-icon name="cart"></ion-icon> Keranjang</a>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>