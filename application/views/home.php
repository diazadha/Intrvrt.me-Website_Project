<!-- Preloader Start -->
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
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="latest-post mb-50">
                        <div class="widget-header position-relative mb-30">
                            <div class="row">
                                <div class="col-7">
                                    <h4 class="widget-title mb-0">Blog's</h4>
                                </div>
                            </div>
                        </div>
                        <div class="loop-list-style-1">
                            <article class="border first-post p-10 background-white border-radius-10 mb-30 wow fadeIn animated">
                                <div class="img-hover-slide border-radius-15 mb-30 position-relative overflow-hidden">
                                    <span class="top-right-icon bg-dark"><i class="mdi mdi-flash-on"></i></span>
                                    <a href="<?= base_url('blog/p/' . $firstLatePost->slug) ?>">
                                        <img src="<?= $firstLatePost->foto ?>" alt="post-slider">
                                    </a>
                                </div>
                                <div class="pr-10 pl-10">
                                    <div class="entry-meta mb-30">
                                        <a class="entry-meta meta-0" href="#"><span class="post-in background2 text-primary font-x-small"><?= $this->BlogModel->get_kategori_IN($firstLatePost->kategori, 'html') ?></span></a>
                                    </div>
                                    <h4 class="post-title mb-20">
                                        <a href="<?= base_url('blog/p/' . $firstLatePost->slug) ?>"><?= $firstLatePost->judul ?></a>
                                    </h4>
                                    <div class="mb-20 overflow-hidden">
                                        <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase">
                                            <span class="post-by">By <a href="#"><?= $this->BlogModel->penulis($firstLatePost->penulis) ?></a></span>
                                            <span class="post-on"><?= $this->UserModel->format_tanggal($firstLatePost->tanggal_dibuat) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <?php foreach ($this->BlogModel->late_post_exclude($firstLatePost->id_blog) as $konten) : ?>
                                <article class="border p-10 background-white border-radius-10 mb-30 wow fadeIn animated">
                                    <div class="d-flex">
                                        <div class="post-thumb d-flex mr-15 border-radius-15 img-hover-scale">
                                            <a class="color-white" href="<?= base_url('blog/p/' . $konten->slug) ?>">
                                                <img class="border-radius-15" src="<?= $konten->foto ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="post-content media-body">
                                            <div class="entry-meta mb-15 mt-10">
                                                <a class="entry-meta meta-2" href="#"><span class="post-in text-danger font-x-small"><?= $this->BlogModel->get_kategori_IN($konten->kategori, 'html') ?></span></a>
                                            </div>
                                            <h5 class="post-title mb-15 text-limit-2-row">
                                                <a href="<?= base_url('blog/p/' . $konten->slug) ?>"><?= $konten->judul ?></a>
                                            </h5>
                                            <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase">
                                                <span class="post-by">By <a href="#"><?= $this->BlogModel->penulis($konten->penulis) ?></a></span>
                                                <span class="post-on"><?= $this->UserModel->format_tanggal($konten->tanggal_dibuat) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 sidebar-right">
                    <!--Post aside style 2-->
                    <div class="sidebar-widget">
                        <div class="widget-header mb-30">
                            <h5 class="widget-title">Merchandise (Terbaru)</h5>
                        </div>
                        <div class="post-aside-style-2">
                            <ul class="list-post">
                                <?php foreach ($getalldata as $g) : ?>
                                    <li class="mb-30 wow fadeIn animated">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex">
                                                    <div class="post-thumb border-radius-5 mr-15 img-hover-scale">
                                                        <a class="color-white" href="<?= base_url('home/merchandise_detail/') . $g['id_merch'] ?>">
                                                            <img class="img-fluid" src="<?= base_url('assets/uploads/foto_merchandise/') . $g['foto']; ?>" alt="Responsive image" style="height: 65px; width: 80px;">
                                                        </a>
                                                    </div>
                                                    <div class="post-content media-body">
                                                        <h6 class="post-title mb-10 text-limit-2-row">
                                                            <a href="<?= base_url('home/merchandise_detail/') . $g['id_merch'] ?>">
                                                                <?php if (strlen($g['nama_merch']) > 28) : ?>
                                                                    <?= substr(ucwords($g['nama_merch']), 0, 28); ?>
                                                                <?php else : ?>
                                                                    <?= ucwords($g['nama_merch']); ?>
                                                                <?php endif ?>
                                                            </a>
                                                        </h6>
                                                        <small>Stok: <?=$g['stock']?> item</small>
                                                        <div class="entry-meta meta-1">
                                                            <?php
                                                            if ($g['diskon'] != 0) { ?>
                                                                <?php $h_diskon = $g['harga'] * ($g['diskon'] / 100);
                                                                $diskon = $g['harga'] - $h_diskon;
                                                                ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="mr-auto">
                                                                        Rp <?= number_format($diskon, 0, ',', '.') ?>
                                                                    </div>
                                                                    <div class="entry-meta meta-0">
                                                                        <div class="entry-meta meta-1" style="text-decoration: line-through; color:red;">Rp <?= number_format($g['harga'], 0, ',', '.') ?></div>
                                                                    </div>
                                                                </div>
                                                            <?php } else { ?>
                                                                <div class="entry-meta meta-0">
                                                                    Rp <?= number_format($g['harga'], 0, ',', '.') ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <hr>
                        <div class="widget-header mb-30 ">
                            <h5 class="widget-title">Event (Terbaru)</span></h5>
                        </div>
                        <div class="post-aside-style-2">
                            <ul class="list-post">
                                <?php foreach ($event as $e) : ?>
                                    <li class="mb-30 wow fadeIn animated">
                                        <div class="card">
                                            <div class="card-body">
                                                    <div class="d-flex">
                                                    <div class="post-thumb d-flex mr-15 border-radius-5 img-hover-scale">
                                                        <a class="color-white" href="<?= base_url('home/event_detail/') . $e['id_event'] ?>">
                                                            <img class="img-fluid" src="<?= base_url('assets/uploads/foto_event/') . $e['foto']; ?>" alt="Responsive image" style="height: 65px; width: 80px;">
                                                        </a>
                                                    </div>
                                                    <div class="post-content media-body">
                                                        <h6 class="post-title mb-10 text-limit-2-row"><a href="<?= base_url('home/event_detail/') . $e['id_event'] ?>"><?= ucwords($e['nama_event']); ?></a></h6>
                                                        <small>Kuota: <?=$e['stock']?> peserta</small> 
                                                        <div class="entry-meta meta-1">
                                                            <?php if ($e['harga_tiket'] == 0) { ?>
                                                                <div class="d-flex mt-2">
                                                                    <div class="mr-auto">
                                                                        <span class="entry-meta meta-0 text-success">GRATIS</span>
                                                                    </div>
                                                                    Rp 0
                                                                </div>
                                                            <?php } else { ?>
                                                                <?php
                                                                if ($e['diskon'] != 0) { ?>
                                                                    <?php $h_diskon_event = $e['harga_tiket'] * ($e['diskon'] / 100);
                                                                    $diskon_event = $e['harga_tiket'] - $h_diskon_event;
                                                                    ?>
                                                                    <div class="d-flex mt-2">
                                                                        <div class="mr-auto">
                                                                            Rp <?= number_format($diskon_event, 0, ',', '.') ?>
                                                                        </div>
                                                                        <div class="entry-meta meta-0">
                                                                            <div class="entry-meta meta-1" style="text-decoration: line-through; color:red;">Rp <?= number_format($e['harga_tiket'], 0, ',', '.') ?></div>
                                                                        </div>
                                                                    </div>
                                                                <?php } else { ?>
                                                                    <div class="entry-meta meta-0 font-small mb-30">
                                                                        <span class="post-cat bg-success color-white">Rp <?= number_format($e['harga_tiket'], 0, ',', '.') ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                            <?php } ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-50 mt-15">
                <div class="col-md-12">
                    <div class="widget-header position-relative mb-30">
                        <h4 class="widget-title mb-0">Partner</h4>
                    </div>
                    <div class="post-carausel-2 post-module-2 row">
                        <?php foreach ($partner as $p) : ?>
                            <div class="col">
                                <div class="post-thumb position-relative">

                                    <div class="border-radius-15 position-relative">
                                        <div class="post-content-overlay">
                                            <div class="post-thumb post-thumb-small d-flex img-hover-scale">
                                                <img src="<?= $p['foto']; ?>" alt="" style="height: 150px;">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>