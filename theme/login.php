<?php $v->layout('_template'); ?>
<?php $v->start('css'); ?>
<!-- Conteudo css -->

<?php $v->end(); ?>



<div class="row mt-5">
    <div class="col-3 col-md-4"></div>
    <div class="col-6 col-md-4">
    <h1>Login</h1>
        <form action="<?= $route->route('request.login') ?>" method="POST" data-type="JSON">
            <input type="text" class="form-control mb-2" name="email" placeholder="Digite o email">
            <input type="password" class="form-control mb-2" name="password" placeholder="Digite a senha">
            <button type="submit" class="btn btn-primary">Logar</button>
        </form>
    </div>
    <div class="col-3 col-md-4"></div>
</div>

<?php $v->start('js'); ?>

<script>
    let home = '<?= $route->route('webAdmin.dashboard'); ?>';
</script>

<script src="<?= url('theme/js/login.js'); ?>"></script>

<?php $v->end(); ?>