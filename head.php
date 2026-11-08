<?php
include('conn.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Aplikasi Pemantau Tingkat Stress Akademis Siswa Menggunakan Metode Perceived Stress Scale</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="assets/home/style.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>

<body>
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <header class="header-area" style="background-color: #050C9C;">
        <div class="newsbox-main-menu">
            <div class="classy-nav-container breakpoint-off" style="background-color: #050C9C;">
                <div class="container-fluid">
                    <nav class="classy-navbar justify-content-between" id="newsboxNav">
                        <a href="index.php" class="nav-brand"><span class="text-white">Stresstracker</span></a>
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>
                        <div class="classy-menu">
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.php" class="text-warning">Home</a></li>
                                    <?php if (isset($_SESSION['akun'])): ?>
                                        <!-- Jika pengguna sudah login -->
                                        <li><a href="profile.php" class="text-warning">Profile</a></li>
                                        <li><a href="hasil.php" class="text-warning">Hasil</a></li>
                                        <li><a href="logout.php" class="text-warning">Logout</a></li>
                                    <?php else: ?>
                                        <!-- Jika pengguna belum login -->
                                        <li><a href="login.php" class="text-warning">Login</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <section class="breaking-news-area clearfix mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breaking-news-ticker d-flex flex-wrap align-items-center">
                        <div id="breakingNewsTicker" class="ticker">
                            <ul>
                                <li><a href="#">Dibuat Oleh : </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>