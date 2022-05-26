<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= $route->route('web.home') ?>"><img src="<?= url('cdn/assets/media/images/logo/logo.png'); ?> " class="w-50" alt="">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse me-5" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light h5 <?= ($route->isCurrentRoute('web.home') ? 'active' : '') ?>" aria-current="page" href="<?= $route->route('web.home') ?>">HOME</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link text-light h5 <?= ($route->isCurrentRoute('web.pigList') ? 'active' : '') ?>" aria-current="page" href="<?= $route->route('web.pigList') ?>">LISTA DE PORCOS</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link text-light h5 <?= ($route->isCurrentRoute('web.about') ? 'active' : '') ?>" href="<?= $route->route('web.about') ?>">SOBRE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light h5 <?= ($route->isCurrentRoute('web.contact') ? 'active' : '') ?>" href="<?= $route->route('web.contact') ?>">CONTATO</a>
                </li>
                <li class="nav-item dropdown">
                    <?php if (isset($_SESSION['userInfo'])) : ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="h5 text-white"><?= $_SESSION['userInfo']->nick ?></span>
                        </a>
                        <ul class="dropdown-menu bg-dark border-0" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-light" href="<?= $route->route('webAdmin.dashboard') ?>">Admin</a></li>
                            <li><a class="dropdown-item text-light" href="<?= $route->route('web.logout') ?>">Logout</a></li>
                        </ul>
                    <?php else : ?>
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user h5 text-light"></i>
                        </a>
                        <ul class="dropdown-menu bg-dark border-0" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item text-light" href="<?= $route->route('web.login') ?>">Login</a></li>
                            <li><a class="dropdown-item text-light" href="<?= $route->route('web.register') ?>">Registro</a></li>
                        </ul>
                    <?php endif; ?>


                </li>
            </ul>
        </div>
    </div>
</nav>