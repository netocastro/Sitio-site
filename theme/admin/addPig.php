<?php $v->layout('_templateAdmin'); ?>

<?php $v->start('css'); ?>
<!-- Conteudo css -->

<?php $v->end(); ?>


<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <form action="<?= $route->route('pig.store'); ?>" method="POST" data-type="JSON" id="form">
                    <h3 class="box-title">Adicionar porco</h3>
                    <div class="row">
                        <div class="col-1 col-md-3 col-lg-4"></div>
                        <div class="col-10 col-md-6 col-lg-4">
                            <div class="mt-2">
                                <label for="name">Nome</label>
                                <input type="text" name="name" class="form-control" id="nome">
                            </div>
                            <div class="mt-2">
                                <label for="breed_id">Raça</label>
                                <select name="breed_id" id="breed_id" class="form-control">
                                    <option value=""> -- </option>
                                    <?php foreach ($breeds as $breed) : ?>
                                        <option value="<?= $breed->id ?>"><?= $breed->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mt-2">
                                <label for="birthday">Nascimento</label>
                                <input type="date" name="birthday" class="form-control col-3" id="birthday">
                            </div>
                            <div class="mt-2">
                                <label for="starting_weight">Peso inicial (kg)</label>
                                <input type="number" name="starting_weight" class="form-control" id="starting_weight" step="0.001">
                            </div>

                            <div class="d-grid mt-3">
                                <button class="btn btn-primary" type="submit">Salvar</button>
                            </div>

                            <div class="d-none justify-content-center mt-2 load">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>

                        </div>
                        <div class="col-1 col-md-3 col-lg-4"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->
    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->

<?php $v->start('js'); ?>

<script src="<?= url('theme/admin/js/addPig.js'); ?>"></script>

<?php $v->end(); ?>