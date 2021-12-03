<div class="main-wrap">
    <aside id="sidebar-wrapper" class="custom-scrollbar offcanvas-sidebar position-right">
        <button class="off-canvas-close"><i class="ti-close"></i></button>
    </aside>

    <!-- Main Wrap Start -->
    <main class="position-relative">
        <div class="archive-header text-center mb-50">
            <div class="container">
                <h2>
                    <span class="text-danger"><?= $title ?></span>
                </h2>
            </div>
        </div>
        <div class="container">
            <div class="row post-module-1 mb-50">

                <!-- <div class="latest-post mb-50">
                        <div class="loop-list-style-1">
                            <div class="d-md-flex d-block">
                                <div class="post-thumb post-thumb-small d-flex mr-15 border-radius-15 img-hover-scale">
                                    <img class="img-fluid" src="<?= $p['foto']; ?>" alt="Responsive image" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div> -->

                <div class="row">
                    <?php foreach ($partner as $p) : ?>
                        <div class="col">
                            <img class="img-responsive center-block border-radius-15" src="<?= $p['foto']; ?>" alt="Responsive image" style="height:180px; width:100%; display:block; margin-left:auto; margin-right:auto;">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </main>
</div> <!-- Main Wrap End-->