<!-- Main Wrap Start -->
<main class="position-relative">
    <div class="container">
        <div class="entry-header entry-header-1 mb-30 mt-50">
            <h1 class="post-title mb-30">
                <?= $post->judul ?>
            </h1>
            <div class="entry-meta meta-1 font-x-small color-grey text-uppercase">
                <span class="post-by">Written By <a href="#"><?= $post->sumber ?></a></span>
                <span class="post-on"><?= $this->UserModel->format_tanggal($post->tanggal_dibuat) ?></span>
            </div>
        </div>
        <!--end entry header-->
        <div class="row mb-50">
            <div class="col-lg-12 col-md-12">
                <div class="single-social-share single-sidebar-share mt-30">
                    <ul>
                        <li><a class="social-icon facebook-icon text-xs-center" target="_blank" href="#"><i class="ti-facebook"></i></a></li>
                        <li><a class="social-icon twitter-icon text-xs-center" target="_blank" href="#"><i class="ti-twitter-alt"></i></a></li>
                        <li><a class="social-icon pinterest-icon text-xs-center" target="_blank" href="#"><i class="ti-pinterest"></i></a></li>
                        <li><a class="social-icon instagram-icon text-xs-center" target="_blank" href="#"><i class="ti-instagram"></i></a></li>
                        <li><a class="social-icon linkedin-icon text-xs-center" target="_blank" href="#"><i class="ti-linkedin"></i></a></li>
                        <li><a class="social-icon email-icon text-xs-center" target="_blank" href="#"><i class="ti-email"></i></a></li>
                    </ul>
                </div>
                <div class="bt-1 border-color-1 mb-30"></div>
                <div class="entry-main-content mb-40">
                    <?= htmlspecialchars_decode($post->isi_konten) ?>
                </div>
                <!-- <div class="entry-bottom mt-50 mb-30">
                    <div class="overflow-hidden mt-30">
                        <div class="tags float-left text-muted mb-md-30">
                            <span class="font-small mr-10"><i class="fa fa-tag mr-5"></i>Tags: </span>
                            <a href="category.html" rel="tag">tech</a>
                            <a href="category.html" rel="tag">world</a>
                            <a href="category.html" rel="tag">global</a>
                        </div>
                        <div class="single-social-share float-right">
                            <ul class="d-inline-block list-inline">
                                <li class="list-inline-item"><span class="font-small text-muted"><i class="ti-sharethis mr-5"></i>Share: </span></li>
                                <li class="list-inline-item"><a class="social-icon facebook-icon text-xs-center" target="_blank" href="#"><i class="ti-facebook"></i></a></li>
                                <li class="list-inline-item"><a class="social-icon twitter-icon text-xs-center" target="_blank" href="#"><i class="ti-twitter-alt"></i></a></li>
                                <li class="list-inline-item"><a class="social-icon pinterest-icon text-xs-center" target="_blank" href="#"><i class="ti-pinterest"></i></a></li>
                                <li class="list-inline-item"><a class="social-icon instagram-icon text-xs-center" target="_blank" href="#"><i class="ti-instagram"></i></a></li>
                                <li class="list-inline-item"><a class="social-icon linkedin-icon text-xs-center" target="_blank" href="#"><i class="ti-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div> -->
                <!--author box-->
                <div class="author-bio border-radius-10 bg-white p-30 mb-40">
                    <div class="author-image mb-30">
                        <img src="<?=base_url('assets/uploads/user/'.$this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row()->foto_user)?>" alt="" class="avatar">
                    </div>
                    <div class="author-info">
                        <h3><span class="vcard author"><span class="fn"><a href="author.html" title="Posts by Robert" rel="author"><?= $this->BlogModel->penulis($post->penulis) ?></a></span></span></h3>
                        <h5 class="text-muted">
                            <span class="mr-15">Author Intrvrt.me</span>
                            <i class="ti-star"></i>
                            <i class="ti-star"></i>
                            <i class="ti-star"></i>
                            <i class="ti-star"></i>
                            <i class="ti-star"></i>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>