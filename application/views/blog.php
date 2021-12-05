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
                <h4 class="text-center">Blog</h4>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-3 primary-sidebar sticky-sidebar sidebar-left order-2 order-md-1">
                    <div class="sidebar-widget widget_categories border-radius-10 bg-white mb-30">
                        <div class="widget-header position-relative mb-15">
                            <h5 class="widget-title"><strong>Kategori Blog</strong></h5>
                        </div>
                        <ul class="font-small text-muted">
                            <li class="cat-item cat-item-2"><a href="<?= base_url('blog') ?>">Tampilkan Semua</a></li>
                            <?php foreach ($kategori as $k) : ?>
                                <li class="cat-item cat-item-2"><a href="<?= base_url('blog/kategori/') . $k->id_kategori ?>"><?= $k->nama_kategori; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10 col-md-9 order-1 order-md-2">
                    <?= $this->session->flashdata('message');
                    $this->session->unset_userdata('message'); ?>
                    <div class="related-posts">
                        <div class="row">
                            <?php foreach ($post as $e) : ?>
                            <article class="col-lg-4 col-6">
                                <div class="border background-white border-radius-10 p-10 mb-30">
                                    <div class="post-thumb d-flex mb-15 border-radius-15 img-hover-scale">
                                        <a href="<?= base_url('blog/p/') . $e['slug'] ?>">
                                        <img class="border-radius-15 img-fluid" src="<?= $e['foto']; ?>" alt="" style="width: 100%;">
                                        </a>
                                    </div>
                                    <div class="pl-10 pr-10">
                                        <div class="d-flex entry-meta mb-15 mt-10">
                                            <div class="mr-auto">
                                                <?= $this->BlogModel->get_kategori_IN($e['kategori'], 'html') ?>
                                            </div>
                                        </div>
                                        <h5 class="post-title">
                                            <a href="<?= base_url('blog/p/') . $e['slug'] ?>">
                                                <?php if (strlen($e['judul']) > 28) : ?>
                                                    <?= substr(ucwords($e['judul']), 0, 28); ?>
                                                <?php else : ?>
                                                    <?= ucwords($e['judul']); ?>
                                                <?php endif ?>
                                            </a>
                                        </h5>
                                        <i class="far fa-paper-plane"></i> <small><?= $this->UserModel->format_tanggal(ucwords($e['tanggal_dibuat'])); ?></small>
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