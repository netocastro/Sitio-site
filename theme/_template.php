<!doctype html>
<html lang="<?= LANGUAGE ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="<?= CHARSET ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Palavras chaves para buscadores -->
    <meta name="keywords" content="">

    <!-- Cabeçalhos dinâmicos para uma determinada página -->
    <?= $v->section('css') ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= url('cdn/libs/bootstrap/dist/bootstrap-5.0.0-beta3/css/bootstrap.min.css'); ?>">

    <!-- Importando estilos -->
    <link rel="stylesheet" href="<?= url('theme/css/style.css'); ?>">

    <!-- CDN do Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">

    <!-- Fav icon -->
    <link rel="shortcut icon" type="image/x-icon" href=" <?= url('cdn/assets/media/images/favicons/favicon.ico'); ?>">

    <!-- Título da página -->
    <title><?= $title . " | " . ucfirst(explode('.', $_SERVER['HTTP_HOST'])[0])  ?></title>
</head>

<body>

    <!-- Inserindo navbar -->
    <?= $v->insert('fragments/navbar'); ?>

    <!-- Conteúdo da página -->
    <?= $v->section('content'); ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= url('cdn/libs/jquery/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?= url('cdn/libs/bootstrap/dist/bootstrap-5.0.0-beta3/js/popper.min.js'); ?>"></script>
    <script src="<?= url('cdn/libs/bootstrap/dist/bootstrap-5.0.0-beta3/js/bootstrap.min.js'); ?>"></script>

    <!-- Javascript Global -->
    <script src="<?= url('cdn/js/global.js'); ?>"></script>

    <!-- Habilitando Tooltip e Popover do bootstrap -->
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));

        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));

        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    </script>

    <!-- Javascript dinâmico para página específica -->
    <?= $v->section('js') ?>

</body>

</html>