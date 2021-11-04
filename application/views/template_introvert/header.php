<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= $title; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="<?= $profil_perusahaan['logo']; ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <!-- NewsViral CSS  -->
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/widgets.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/color.css">
    <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/responsive.css">

</head>

<body>
    <!-- Main Header -->
    <header class="main-header header-style-2 mb-40">
        <div class="header-bottom header-sticky background-white text-center">
            <div class="scroll-progress gradient-bg-1"></div>
            <div class="mobile_menu d-lg-none d-block"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3">
                        <div class="header-logo d-none d-lg-block">
                            <a href="<?= base_url() ?>">
                                <img class="logo-img d-inline" src="<?= $profil_perusahaan['logo']; ?>" alt="Responsive image" style="height: 45px; width: 60px;">
                            </a>
                        </div>
                        <div class="logo-tablet d-md-inline d-lg-none d-none">
                            <a href="<?= base_url() ?>">
                                <img class="logo-img d-inline" src="<?= $profil_perusahaan['logo']; ?>" alt="Responsive image" style="height: 45px; width: 60px;">
                            </a>
                        </div>
                        <div class="logo-mobile d-block d-md-none">
                            <a href="<?= base_url() ?>">
                                <img class="logo-img d-inline" src="<?= $profil_perusahaan['logo']; ?>" alt="Responsive image" style="height: 45px; width: 60px;">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-9 main-header-navigation">
                        <!-- Main-menu -->
                        <div class="main-nav text-left float-lg-left float-md-right">
                            <ul class="mobi-menu d-none menu-3-columns" id="navigation">
                                <li>
                                    <a href="<?= base_url(); ?>"><span class="mr-15">
                                            <ion-icon name="home-outline"></ion-icon>
                                        </span>Home</a>
                                </li>
                                <li><a href="<?= base_url('home/merchandise') ?>"><span class="mr-15">
                                            <i class="fas fa-gift"></i>
                                        </span>Merchandise</a></li>
                                <li><a href="<?= base_url('home/event') ?>"><span class="mr-15">
                                            <i class="fas fa-ticket-alt"></i>
                                        </span>Event</a></li>
                                <li><a href="<?= base_url('about') ?>"><span class="mr-15">
                                            <i class="far fa-building"></i>
                                        </span>About Us</a>
                                </li>
                                <?php if ($this->session->userdata('nama')) : ?>
                                    <li class="menu-item-has-children">
                                        <a href="<?= base_url(); ?>"><span class="mr-15">
                                                <!-- <ion-icon name="contact"></ion-icon> -->
                                                <i class="fas fa-user"></i>
                                            </span>Hai, <?= $this->session->userdata('nama'); ?></a>
                                        <ul class="sub-menu text-muted font-small">
                                            <li><a href="<?= base_url('home/profil') ?>">Profil</a></li>
                                            <li><a href="<?= base_url('home/logout') ?>">Log Out</a></li>
                                        </ul>
                                    </li>
                                <?php else : ?>
                                    <li class="menu-item-has-children">
                                        <a href="<?= base_url(); ?>"><span class="mr-15">
                                                <!-- <ion-icon name="contact"></ion-icon> -->
                                                <i class="fas fa-user"></i>
                                            </span>User Akun</a>
                                        <ul class="sub-menu text-muted font-small">
                                            <li><a href="<?= base_url('home/login') ?>">Login</a></li>
                                            <li><a href="<?= base_url('home/registrasi') ?>">Register</a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <nav>
                                <ul class="main-menu d-none d-lg-inline">
                                    <li>
                                        <a href="<?= base_url(); ?>"><span class="mr-15">
                                                <ion-icon name="home-outline"></ion-icon>
                                            </span>Home</a>
                                    </li>
                                    <li><a href="<?= base_url('home/merchandise') ?>"><span class="mr-15">
                                                <i class="fas fa-gift"></i>
                                            </span>Merchandise</a></li>
                                    <li><a href="<?= base_url('home/event') ?>"><span class="mr-15">
                                                <i class="fas fa-ticket-alt"></i>
                                            </span>Event</a></li>
                                    <li><a href="<?= base_url('about') ?>"><span class="mr-15">
                                                <i class="far fa-building"></i>
                                            </span>About Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <!-- <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                        <div class="main-nav text-left float-lg-right float-md-right">
                            <nav>
                                <ul class="main-menu d-none d-lg-inline">
                                    <li class="menu-item-has-children">
                                        <a href="<?= base_url(); ?>"><span class="mr-15">
                                                <!-- <ion-icon name="contact"></ion-icon> -->
                                                <i class="fas fa-shopping-cart"></i>
                                        </a>
                                        <ul class="sub-menu text-muted font-small">
                                            <li><a href="<?= base_url('home/cart_merchandise') ?>">Merchandise</a></li>
                                            <li><a href="<?= base_url('home/cart_event') ?>">Event</a></li>
                                        </ul>
                                    </li>
                                    <li> <a href="<?= base_url('home/cart') ?>"> </a></li>
                                    <?php if ($this->session->userdata('nama')) : ?>
                                        <li class="menu-item-has-children">
                                            <a href="<?= base_url(); ?>"><span class="mr-15">
                                                    <!-- <ion-icon name="contact"></ion-icon> -->
                                                    <i class="fas fa-user"></i>
                                                </span>Hai, <?= $this->session->userdata('nama'); ?></a>
                                            <ul class="sub-menu text-muted font-small">
                                                <li><a href="<?= base_url('home/profil') ?>">Profil</a></li>
                                                <li><a href="<?= base_url('home/logout') ?>">Log Out</a></li>
                                            </ul>
                                        </li>
                                    <?php else : ?>
                                        <li class="menu-item-has-children">
                                            <a href="<?= base_url(); ?>"><span class="mr-15">
                                                    <!-- <ion-icon name="contact"></ion-icon> -->
                                                    <i class="fas fa-user"></i>
                                                </span>User Akun</a>
                                            <ul class="sub-menu text-muted font-small">
                                                <li><a href="<?= base_url('home/login') ?>">Login</a></li>
                                                <li><a href="<?= base_url('home/registrasi') ?>">Register</a></li>
                                            </ul>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>