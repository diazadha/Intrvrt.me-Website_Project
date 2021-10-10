<!-- Main Wrap Start -->
<main class="position-relative">
    <div class="container">
        <div class="row text-center mb-30">
            <div class="col">
                <h2 class="post-title mb-30">
                    About Us
                </h2>
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
                    <hr class="wp-block-separator is-style-wide">
                    <p>
                        <span class="mr-5">
                            <ion-icon name="location-outline"></ion-icon>
                        </span><?= htmlspecialchars_decode($profil_perusahaan['alamat'])?>
                    </p>
                </div>
            </div>
        </div>
        <!--End row-->
    </div>
</main>
