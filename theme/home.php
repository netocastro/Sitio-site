<?php $v->layout('_template'); ?>

<?php $v->start('css'); ?>
<!-- Conteudo css -->

<?php $v->end(); ?>


<h1>Home</h1>
<h1><?= (isset($_SESSION['userInfo']) ? 'usuario logado' : '') ?></h1>
<h1><?= (isset($_SESSION['userInfo']) ? "<a href='{$route->route('web.logout')}'>logout</a>" : '') ?></h1>

<pre>

<?php
 if(isset($_SESSION['userInfo'])){
    print_r($_SESSION['userInfo']); 
    echo  $_SESSION['userInfo']->name;
    echo  $_SESSION['userInfo']->id;
 }

?>
</pre>


<?php $v->start('js'); ?>

<!-- Conteudo js -->

<?php $v->end(); ?>