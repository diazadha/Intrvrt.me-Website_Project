<!-- Main Wrap Start -->
<main class="position-relative">
    <div class="container">
        <div class="entry-header entry-header-1 mb-30 mt-50">
            <h1 class="post-title mb-30">
                <?=$post->judul?>
            </h1>
            <div class="entry-meta meta-1 font-x-small color-grey text-uppercase">
                <span class="post-by">By <a href="#"><?=$post->sumber?></a></span>
                <span class="post-on"><?= $this->UserModel->format_tanggal($post->tanggal_dibuat)?></span>
            </div>
        </div>
        <!--end entry header-->
        <div class="row mb-50">
            <div class="col-lg-8 col-md-12">
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
                <div class="entry-main-content">
                    <?= htmlspecialchars_decode($post->isi_konten) ?>
                </div>
                <div class="entry-bottom mt-50 mb-30">
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
                </div>
                <!--author box-->
                <div class="author-bio border-radius-10 bg-white p-30 mb-40">
                    <div class="author-image mb-30">
                        <a href="author.html"><img src="assets/imgs/authors/author.png" alt="" class="avatar"></a></div>
                    <div class="author-info">
                        <h3><span class="vcard author"><span class="fn"><a href="author.html" title="Posts by Robert" rel="author"><?=$this->BlogModel->penulis($post->penulis)?></a></span></span></h3>
                        <h5 class="text-muted">
                            <span class="mr-15">Author Intrvrt.me</span>
                            <i class="ti-star"></i>
                            <i class="ti-star"></i>
                            <i class="ti-star"></i>
                            <i class="ti-star"></i>
                            <i class="ti-star"></i>
                        </h5>
                        <a href="author.html" class="author-bio-link text-muted">View all posts</a>
                    </div>
                </div>
            </div>
            <!--End col-lg-8-->
            <div class="col-lg-4 col-md-12 sidebar-right sticky-sidebar">
                <div class="pl-lg-50">
                    <!--Post aside style 1-->
                    <div class="sidebar-widget mb-30">
                        <div class="widget-header position-relative mb-30">
                            <div class="row">
                                <div class="col-7">
                                    <h4 class="widget-title mb-0">Don't <span>miss</span></h4>
                                </div>
                                <div class="col-5 text-right">
                                    <h6 class="font-medium pr-15">
                                        <a class="text-muted font-small" href="#">View all</a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="post-aside-style-1 border-radius-10 p-20 bg-white">
                            <ul class="list-post">
                                <li class="mb-20">
                                    <div class="d-flex">
                                        <div class="post-thumb d-flex mr-15 border-radius-5 img-hover-scale">
                                            <a class="color-white" href="single.html">
                                                <img src="assets/imgs/thumbnail-4.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="post-content media-body">
                                            <h6 class="post-title mb-10 text-limit-2-row"><a href="single.html">Federal arrests show no sign that antifa plotted protests</a></h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-20">
                                    <div class="d-flex">
                                        <div class="post-thumb d-flex mr-15 border-radius-5 img-hover-scale">
                                            <a class="color-white" href="single.html">
                                                <img src="assets/imgs/thumbnail-15.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="post-content media-body">
                                            <h6 class="post-title mb-10 text-limit-2-row"><a href="single.html">How line-dried laundry gets that fresh smell</a></h6>
                                        </div>
                                    </div>
                                </li>
                                <li class="mb-20">
                                    <div class="d-flex">
                                        <div class="post-thumb d-flex mr-15 border-radius-5 img-hover-scale">
                                            <a class="color-white" href="single.html">
                                                <img src="assets/imgs/thumbnail-16.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="post-content media-body">
                                            <h6 class="post-title mb-10 text-limit-2-row"><a href="single.html">Traveling tends to magnify all human emotions</a></h6>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <div class="post-thumb d-flex mr-15 border-radius-5 img-hover-scale">
                                            <a class="color-white" href="single.html">
                                                <img src="assets/imgs/thumbnail-15.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="post-content media-body">
                                            <h6 class="post-title mb-10 text-limit-2-row"><a href="single.html">How line-dried laundry gets that fresh smell</a></h6>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--Post aside style 2-->
                    <div class="sidebar-widget mb-50">
                        <div class="widget-header mb-30">
                            <h5 class="widget-title">Recent <span>posts</span></h5>
                        </div>
                        <div class="post-aside-style-3">
                            <article class="bg-white border-radius-15 mb-30 p-10 wow fadeIn  animated">
                                <div class="post-thumb d-flex mb-15 border-radius-15 img-hover-scale">
                                    <a href="single.html">
                                        <video autoplay="" class="photo-item__video" loop="" muted="" preload="none">
                                            <source src="https://player.vimeo.com/external/210754416.sd.mp4?s=826dbe91a402d3fc239674b6595a0100b2a45098&amp;profile_id=164&amp;oauth2_token_id=57447761" type="video/mp4">
                                        </video>
                                    </a>
                                </div>
                                <div class="pl-10 pr-10">
                                    <h5 class="post-title mb-15"><a href="single.html">Vancouver woman finds pictures and videos of herself online</a></h5>
                                    <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase mb-10">
                                        <span class="post-in">In <a href="category.html">Global</a></span>
                                        <span class="post-by">By <a href="author.html">K. Marry</a></span>
                                        <span class="post-on">4m ago</span>
                                    </div>
                                </div>
                            </article>
                            <article class="bg-white border-radius-15 mb-30 p-10 wow fadeIn  animated">
                                <div class="post-thumb d-flex mb-15 border-radius-15 img-hover-scale">
                                    <a href="single.html">
                                        <img class="border-radius-15" src="assets/imgs/news-22.jpg" alt="">
                                    </a>
                                </div>
                                <div class="pl-10 pr-10">
                                    <h5 class="post-title mb-15"><a href="single.html">Fight breaks out at Disneyland</a></h5>
                                    <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase mb-10">
                                        <span class="post-in">In <a href="category.html">Healthy</a></span>
                                        <span class="post-by">By <a href="author.html">Steven</a></span>
                                        <span class="post-on">14m ago</span>
                                    </div>
                                </div>
                            </article>
                            <article class="bg-white border-radius-15 mb-30 p-10 wow fadeIn  animated">
                                <div class="post-thumb d-flex mb-15 border-radius-15 img-hover-scale">
                                    <a href="single.html">
                                        <img class="border-radius-15" src="assets/imgs/news-20.jpg" alt="">
                                    </a>
                                </div>
                                <div class="pl-10 pr-10">
                                    <h5 class="post-title mb-15"><a href="single.html">California sheriff’s deputy shot during ‘ambush’ at police station, officials say</a></h5>
                                    <div class="entry-meta meta-1 font-x-small color-grey float-left text-uppercase mb-10">
                                        <span class="post-in">In <a href="category.html">US</a></span>
                                        <span class="post-by">By <a href="author.html">Murler</a></span>
                                        <span class="post-on">16m ago</span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
            <!--End col-lg-4-->
        </div>
    </div>
</main>