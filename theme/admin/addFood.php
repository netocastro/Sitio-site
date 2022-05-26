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
                <form action="<?= $route->route('food.store'); ?>" method="POST" data-type="JSON" id="form">
                    <h3 class="box-title">Adicionar ração</h3>
                    <div class="row">
                        <div class="col-1 col-md-3 col-lg-4"></div>
                        <div class="col-10 col-md-6 col-lg-4">
                            <div class="mt-2">
                                <label for="name">Ração</label>
                                <input type="text" name="name" id="name" class="form-control">
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

<script src="<?= url('theme/admin/js/addPig.js'); ?>"></script>

<?php $v->end(); ?>