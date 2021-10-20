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
                        <?php foreach($sosmed as $s):?>
                            <li><a class="social-icon text-xs-center" target="_blank" href="<?=$s->sosmed?>"><img src="<?=$s->icon?>" alt=""></a></li>
                        <?php endforeach;?>
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
                        </span><strong>Alamat</strong>:<?= htmlspecialchars_decode($profil_perusahaan['alamat'])?>
                    </p>
                    <p>
                        <span class="mr-5">
                            <ion-icon name="planet-outline"></ion-icon>
                        </span><strong>Support center</strong>: <?= htmlspecialchars_decode($profil_perusahaan['email'])?>
                </div>
            </div>
        </div>
        <!--End row-->
    </div>
</main>
