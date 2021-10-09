<!-- Main Wrap Start -->
<main class="position-relative">
    <div class="container">
        <div class="entry-header entry-header-2 mb-30 text-center">
            <div class="thumb-overlay img-hover-slide border-radius-5 position-relative" style="background-image: url(assets/imgs/news-24.jpg)">
                <div class="position-midded">
                    <div class="entry-meta meta-0 font-small mb-30">
                        <a href="category.html"><span class="post-cat bg-success color-white">Get In Touch</span></a>
                    </div>
                    <h1 class="post-title mb-30 text-white">
                        About Us
                    </h1>
                    <div class="entry-meta meta-1 font-x-small color-grey text-uppercase text-white">
                        <span class="mr-5">
                            <ion-icon name="planet"></ion-icon>
                        </span>
                        <span class="mr-15"><?=$profil_perusahaan['nama']?></span>
                        <span class="ml-15 mr-5">
                            <ion-icon name="call"></ion-icon>
                        </span>
                        <span><?=$profil_perusahaan['nomor_kontak']?></span>
                    </div>
                </div>
            </div>
        </div>
        <!--end entry header-->
        <div class="row mb-50">
            <div class="col-lg-2 d-none d-lg-block"></div>
            <div class="col-lg-8 col-md-12">
                <div class="single-social-share single-sidebar-share mt-30">
                    <ul>
                        <li><a class="social-icon facebook-icon text-xs-center" target="_blank" href="<?=$profil_perusahaan['facebook']?>"><i class="ti-facebook"></i></a></li>
                        <li><a class="social-icon twitter-icon text-xs-center" target="_blank" href="<?=$profil_perusahaan['twitter']?>"><i class="ti-twitter-alt"></i></a></li>
                        <li><a class="social-icon instagram-icon text-xs-center" target="_blank" href="<?=$profil_perusahaan['instagram']?>"><i class="ti-instagram"></i></a></li>
                        <li><a class="social-icon email-icon text-xs-center" target="_blank" href="mailto:<?=$profil_perusahaan['email']?>"><i class="ti-email"></i></a></li>
                    </ul>
                </div>
                <div class="single-excerpt">
                    <p class="font-large">
                        <?= htmlspecialchars_decode($profil_perusahaan['tentang'])?>
                    </p>
                </div>
                <div class="entry-main-content mt-50">
                    <h3>Visi</h3>
                    <hr class="wp-block-separator is-style-wide">
                    <p><?= htmlspecialchars_decode($profil_perusahaan['visi'])?></p>
                    <hr class="wp-block-separator is-style-wide">
                    <h3>Misi</h3>
                    <p><?= htmlspecialchars_decode($profil_perusahaan['misi'])?></p>
                    <h3 class="mt-30">Get in touch</h3>
                    <hr class="wp-block-separator is-style-wide">
                    <form class="form-contact comment_form" id="commentForm">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input class="form-control" name="phone" id="phone" type="text" placeholder="Phone">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Message"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="button button-contactForm">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--End row-->
    </div>
</main>
