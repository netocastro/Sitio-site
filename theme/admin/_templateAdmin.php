<!DOCTYPE html>
<html lang="<?= LANGUAGE ?>">

<head>
    <meta charset="<?= CHARSET ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description" content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">

    <title><?= $title . " | " . ucfirst(explode('.', $_SERVER['HTTP_HOST'])[0])  ?></title>


    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= url('theme/admin/plugins/images/favicon.png'); ?>">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= url('theme/admin/plugins/bower_components/chartist/dist/chartist.min.css'); ?>">
    <link rel="stylesheet" href="<?= url('theme/admin/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css'); ?>">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= url('theme/admin/css/style.min.css'); ?>">


</head>

<body>

    <?php if (isset($_SESSION['userInfo'])) : ?>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <header class="topbar" data-navbarbg="skin5">
                <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                    <div class="navbar-header" data-logobg="skin6">
                        <!-- ============================================================== -->
                        <!-- Logo -->
                        <!-- ============================================================== -->
                        <a class="navbar-brand" href="dashboard.html">
                            <!-- Logo icon -->
                            <b class="logo-icon">
                                <!-- Dark Logo icon -->
                                <img src="<?= url('theme/admin/plugins/images/logo-icon.png'); ?>" alt="homepage" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <!-- dark Logo text -->
                                <img src="<?= url('theme/admin/plugins/images/logo-text.png'); ?>" alt="homepage" />
                            </span>
                        </a>
                        <!-- ============================================================== -->
                        <!-- End Logo -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- toggle and nav items -->
                        <!-- ============================================================== -->
                        <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                        <!-- ============================================================== -->
                        <!-- Right side toggle and nav items -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav ms-auto d-flex align-items-center">

                            <!-- ============================================================== -->
                            <!-- Search -->
                            <!-- ============================================================== -->
                            <li class=" in">
                                <form role="search" class="app-search d-none d-md-block me-3">
                                    <input type="text" placeholder="Search..." class="form-control mt-0">
                                    <a href="" class="active">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </form>
                            </li>
                            <!-- ============================================================== -->
                            <!-- User profile and search -->
                            <!-- ============================================================== -->
                            <li>
                                <a class="profile-pic" href="#">
                                    <img src="<?= url('theme/admin/plugins/images/users/varun.jpg'); ?>" alt="user-img" width="36" class="img-circle"><span class="text-white font-medium">Steave</span></a>
                            </li>
                            <!-- ============================================================== -->
                            <!-- User profile and search -->
                            <!-- ============================================================== -->
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <aside class="left-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <!-- User Profile-->
                            <li class="sidebar-item pt-2">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $route->route('webAdmin.dashboard') ?>" aria-expanded="false">
                                    <i class="far fa-clock" aria-hidden="true"></i>
                                    <span class="hide-menu">Dashboard(static)</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $route->route('webAdmin.profile') ?>" aria-expanded="false">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <span class="hide-menu">Profile</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $route->route('webAdmin.pigs') ?>" aria-expanded="false">
                                    <i class="fas fa-piggy-bank"></i>
                                    <span class="hide-menu">Porcos</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $route->route('webAdmin.foods') ?>" aria-expanded="false">
                                    <i class="fa-solid fa-sack-xmark" aria-hidden="true"></i>
                                    <span class="hide-menu">Rações</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $route->route('webAdmin.dailyFoods') ?>" aria-expanded="false">
                                    <i class=" fas fa-utensils" aria-hidden="true"></i><!-- <i class="fas fa-sack"></i> -->
                                    <span class="hide-menu">Alimentação diária</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $route->route('webAdmin.foodStock') ?>" aria-expanded="false">
                                    <i class="fa-solid fa-boxes-stacked" aria-hidden="true"></i>
                                    <span class="hide-menu">Estoque rações</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $route->route('webAdmin.myShopping') ?>" aria-expanded="false">
                                    <i class="fa-solid fa-cart-shopping" aria-hidden="true"></i>
                                    <span class="hide-menu">Compras</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $route->route('web.home') ?>" aria-expanded="false">
                                    <i class=" fas fa-reply" aria-hidden="true"></i>
                                    <span class="hide-menu">Voltar ao site</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?= $route->route('web.logout') ?>" aria-expanded="false">
                                    <i class="fa-solid fa-arrow-right-from-bracket"  aria-hidden="true"></i>
                                    <span class="hide-menu">Deslogar</span>
                                </a>
                            </li>
                            <li class="text-center p-20 upgrade-btn">
                                <a href="https://www.wrappixel.com/templates/ampleadmin/" class="btn d-grid btn-danger text-white" target="_blank">
                                    Upgrade to Pro</a>
                            </li>
                        </ul>

                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="page-breadcrumb bg-white">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">Dashboard</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <div class="d-md-flex">
                                <ol class="breadcrumb ms-auto">
                                    <li><a href="#" class="fw-normal">Dashboard</a></li>
                                </ol>
                                <a href="https://www.wrappixel.com/templates/ampleadmin/" target="_blank" class="btn btn-danger  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Upgrade
                                    to Pro</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <?= $v->section('content'); ?>
                <footer class="footer text-center"> 2021 © Ample Admin brought to you by <a href="https://www.wrappixel.com/">wrappixel.com</a>
                </footer>
                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->

        <script src="<?= url('theme/admin/plugins/bower_components/jquery/dist/jquery.min.js'); ?>"></script>

        <!-- Bootstrap tether Core JavaScript -->
        <script src="<?= url('theme/admin/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
        <script src="<?= url('theme/admin/js/app-style-switcher.js'); ?>"></script>
        <script src="<?= url('theme/admin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js'); ?>"></script>

        <!--Wave Effects -->
        <script src="<?= url('theme/admin/js/waves.js'); ?>"></script>

        <!--Menu sidebar -->
        <script src="<?= url('theme/admin/js/sidebarmenu.js'); ?>"></script>

        <!--Custom JavaScript -->
        <script src="<?= url('theme/admin/js/custom.js'); ?>"></script>

        <!--Fontawesome CDN -->
        <script src="https://kit.fontawesome.com/0a22232c6d.js" crossorigin="anonymous"></script>

        <!--This page JavaScript -->
        <!--chartis chart-->
        <script src="<?= url('theme/admin/plugins/bower_components/chartist/dist/chartist.min.js'); ?>"></script>
        <script src="<?= url('theme/admin/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js'); ?>"></script>
        <script src="<?= url('theme/admin/js/pages/dashboards/dashboard1.js'); ?>"></script>

        <!-- Javascript Global -->
        <script src="<?= url('cdn/js/global.js'); ?>"></script>

        <!-- Javascript dinâmico para página específica -->
        <?= $v->section('js') ?>

    <?php else :  ?>

        <?php $route->redirect('web.home')  ?>

    <?php endif;  ?>

</body>

</html>