<!-- Footer Start-->
<footer class="pt-50">
    <div class="footer-area pt-15 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-6">
                    <ul class="float-left mr-30 font-medium">
                        <li class="cat-item cat-item-2"><img class="logo-img d-inline" src="<?= $this->SettingModel->getRowPerusahaan('logo'); ?>" alt="Responsive image" style="height: 40px; width: 60px;"></li>
                        <li class="cat-item cat-item-3"><?= $this->SettingModel->getRowPerusahaan('alamat'); ?></li>
                        <li class="cat-item cat-item-3"><?= $this->SettingModel->getRowPerusahaan('email'); ?></li>
                        <li class="cat-item cat-item-3"><?= $this->SettingModel->getRowPerusahaan('nomor_kontak'); ?></li>
                    </ul>
                </div>
                <div class="col-md-4 col-6">
                    <ul class="float-left mr-30 font-medium">
                        <li class="cat-item cat-item-2">
                            Merchandise
                        </li>
                        <li class="cat-item cat-item-2">
                            Event
                        </li>
                        <li class="cat-item cat-item-2">
                            About Us
                        </li>
                        <li class="cat-item cat-item-2">
                            <div class="d-flex">
                                <!-- Facebook -->
                                <a href="<?= $this->SettingModel->getRowPerusahaan('instagram'); ?>"><i class="fab fa-facebook-f"></i></a>

                                <!-- Twitter -->
                                <a href="<?= $this->SettingModel->getRowPerusahaan('twitter'); ?>"><i class="ml-3 fab fa-twitter"></i></a>

                                <!-- Instagram -->
                                <a href="<?= $this->SettingModel->getRowPerusahaan('facebook'); ?>"><i class="ml-3 fab fa-instagram"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- footer-bottom aera -->
    <div class="footer-bottom-area bg-white text-muted">
        <div class="container">
            <div class="footer-border pt-20 pb-20">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-12">
                        <div class="footer-copy-right">
                            <p class="font-small text-muted">© <?= date('Y') ?>, intrvrt.me | All rights reserved </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Vendor JS-->
<script src="<?= base_url('assets'); ?>/js/vendor/modernizr-3.6.0.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/popper.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/bootstrap.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/jquery.slicknav.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/owl.carousel.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/slick.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/wow.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/animated.headline.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/jquery.magnific-popup.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/jquery.ticker.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/jquery.vticker-min.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/jquery.scrollUp.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/jquery.nice-select.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/jquery.sticky.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/perfect-scrollbar.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/waypoints.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/jquery.counterup.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/vendor/jquery.theia.sticky.js"></script>
<script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- jquery-validation -->
<script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendor/AdminLTE-3.0.5/plugins/jquery-validation/additional-methods.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" type="text/javascript"></script>
<!-- NewsViral JS -->
<script src="<?= base_url('assets'); ?>/js/main.js"></script>
<script type="text/javascript">
    var base_url = '<?= base_url() ?>';
</script>
<?php if (isset($title) == 'About Us') {
    echo '<script src="' . base_url('assets') . '/js/about.js"></script>';
} ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table_e').DataTable();
    });
    $(document).ready(function() {
        $('#table_m').DataTable();
    });
</script>
<script>
    $(function() {
        $("#table_merchandise").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
<script>
    $(function() {
        $("#table_event").DataTable({
            "responsive": true,
            "autoWidth": false,
        });
    });
</script>
</body>

</html>