<?php $v->layout('_templateAdmin'); ?>

<?php $v->start('css'); ?>
<!-- Conteudo css -->

<?php $v->end(); ?>
<?= $_SESSION['userInfo']->id ?>
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
                <form action="<?= $route->route('dailyFood.store'); ?>" method="POST" data-type="JSON" id="form">
                    <h3 class="box-title">Alimentar porco</h3>
                    <div class="row">
                        <div class="col-1 col-md-3 col-lg-4"></div>
                        <div class="col-10 col-md-6 col-lg-4">
                            <div class="mt-2">
                                <label for="date">Data</label>
                                <input type="date" name="date" class="form-control col-3" id="date">
                            </div>
                            <div class="mt-2">
                                <label for="pig_id">Escolha o porco</label>
                                <select name="pig_id" id="pig_id" class="form-control">
                                    <option value=""> -- </option>
                                    <?php foreach ($pigs as $pig) : ?>
                                        <option value="<?= $pig->id ?>"><?= $pig->id ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mt-2">
                                <label for="food_id">Escolha a comida</label>
                                <select name="food_id" id="food_id" class="form-control">
                                    <option value=""> -- </option>
                                    <?php foreach ($foods as $food) : ?>
                                        <option value="<?= $food->id ?>"><?= $food->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mt-2">
                                <label for="amount">Quantidade de comida (kg)</label>
                                <input type="text" name="amount" class="form-control">
                            </div>

                            <div class="d-grid mt-3">
                                <button class="btn btn-primary" type="submit">Salvar</button>
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

<script src="<?= url('theme/admin/js/addDailyFood.js'); ?>"></script>

<?php $v->end(); ?>