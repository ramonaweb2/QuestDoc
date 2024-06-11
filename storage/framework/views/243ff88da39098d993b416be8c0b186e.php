<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('pageTitle'); ?></title>

    <!-- Vendor CSS ================================================== -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/vendor.css')); ?>">

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!--Bootstrap ================================================== -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jQuery :) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.2/jquery.modal.min.css" />

    <!-- Style Sheet ================================================== -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/styles.css')); ?>">

    <!-- Google Fonts ================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,700;1,300&family=Roboto:wght@300;400;700&display=swap"
        rel="stylesheet">


    <!-- script ================================================== -->
    <script src="<?php echo e(asset('js/modernizr.js')); ?>"></script>

    <link rel="stylesheet" href="<?php echo e(asset('css/timepicker.css')); ?>">

</head>

<body data-bs-spy="scroll" data-bs-target="#header-nav" tabindex="0">

<nav class="navbar navbar-expand-lg bg-white navbar-light container-fluid py-3 position-fixed ">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('index')); ?>"><img src="<?php echo e(asset('images/main-logo.png')); ?>" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
             aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav align-items-center justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase  active px-3" aria-current="page"
                           href="<?php echo e(route('index')); ?>">Начало</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase  px-3" href="#">Платформа</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase  px-3" href="#">Относно</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase  px-3" href="#">Контакти</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</nav>

<?php echo $__env->yieldContent('content'); ?>

<section id="footer">
    <div class="container footer-container mt-5">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 my-5">

            <div class="col-md-3 mt-5 mt-md-0 ">
                <img src="<?php echo e(asset('images/main-logo.png')); ?>" alt="image" class="my-3">
                <p class="">Elit adipi massa diam in dignissim. Sagittis pulvinar ut dis venenatis nunc nunc vitae
                    aliquam vestibulum.</p>
                <div class="d-flex align-items-center ">
                    <a href="#" target="_blank"><iconify-icon class="social-link-icon active pe-4"
                                                              icon="mdi:facebook"></iconify-icon></a>
                    <a href="#" target="_blank"><iconify-icon class="social-link-icon pe-4"
                                                              icon="mdi:twitter"></iconify-icon></a>
                    <a href="#" target="_blank"><iconify-icon class="social-link-icon pe-4"
                                                              icon="mdi:instagram"></iconify-icon></a>
                    <a href="#" target="_blank"><iconify-icon class="social-link-icon pe-4"
                                                              icon="mdi:linkedin"></iconify-icon></a>
                    <a href="#" target="_blank"><iconify-icon class="social-link-icon pe-4"
                                                              icon="mdi:youtube"></iconify-icon></a>
                </div>

            </div>

            <div class="col-md-2 offset-md-1">
                <h5 class="py-3">Страници</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-3"><a href="#" class="nav-link fw-normal p-0">Начало</a></li>
                    <li class="nav-item mb-3"><a href="#" class="nav-link fw-normal p-0">Платформа</a></li>
                    <li class="nav-item mb-3"><a href="#" class="nav-link fw-normal p-0">Относно</a></li>
                    <li class="nav-item mb-3"><a href="#" class="nav-link fw-normal p-0">Контакти</a></li>
                </ul>
            </div>
            <div class="col-md-2 ">
                <h5 class="py-3">Полезни връзки</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-3"><a href="#" class="nav-link fw-normal p-0">Вход в системата</a></li>
                    <li class="nav-item mb-3"><a href="#" class="nav-link fw-normal p-0">Регистриай се</a></li>
                    <li class="nav-item mb-3"><a href="#" class="nav-link fw-normal p-0">Форум</a></li>
                    <li class="nav-item mb-3"><a href="#" class="nav-link fw-normal p-0">Общи условия</a></li>
                    <li class="nav-item mb-3"><a href="#" class="nav-link fw-normal p-0">Защита на личните данни</a></li>
                </ul>
            </div>
            <div class="col-md-3 offset-md-1">
                <h5 class="py-3">Контакти</h5>
                <ul class="nav flex-column">
                    <li class="nav-item d-flex mb-3">
                        Използвайте: формата за контакт или фомата за регистрация; робота в сайта или фейсбук
                    </li>
                </ul>
            </div>



        </footer>
    </div>

    <footer class="d-flex flex-wrap justify-content-between align-items-center border-top"></footer>

    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-2 pt-4">
            <div class="col-md-6 d-flex align-items-center">
                <p>© 2024 All rights reserved</p>
            </div>
        </footer>
    </div>
</section>

<!-- script ================================================== -->
<script src="<?php echo e(asset('js/jquery-1.11.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/plugins.js')); ?>"></script>
<script src="<?php echo e(asset('js/script.js')); ?>"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>

<script src="<?php echo e(asset('js/timepicker.js')); ?>"></script>

</body>

</html>
<?php /**PATH /home/ramona/PhpstormProjects/QuestDoc/resources/views/layout.blade.php ENDPATH**/ ?>