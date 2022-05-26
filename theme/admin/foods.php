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
                <div class="d-flex justify-content-between">
                    <h3 class="box-title">Rações</h3>
                    <a href="<?= $route->route('webAdmin.addFood'); ?>" class="h2" style="margin-right: 25%;"><i class="fas fa-plus-circle"></i></a>
                </div>

                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Nome</th>
                                <th class="border-top-0"></th>
                                <th class="border-top-0"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($foods)) : ?>
                                <?php foreach ($foods as $food) : ?>
                                    <tr id="<?= $food->id; ?>">
                                        <td class="fw-bold"><?= $food->id ?></td>
                                        <td><?= $food->name ?></td>
                                        <td><a href="#"><i class="fas fa-edit"></i></a></td>
                                        <td><button data-bs-target="#delete" data-bs-toggle="modal" class="btn delete"><i class="fas fa-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Apagar mensagem"></i></button></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
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

<!-- Modal Deletar Informações-->
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="delete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border">
                <h6 class="modal-title">
                    Confirmação
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body my-3 ps-2 " id="delete-message">
                <div class="text-center"> Tem certeza que deseja deletar essa ração?</div>
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-primary confirm-delete" data-id="0" data-bs-dismiss="modal" data-url="<?= $route->route('food.delete'); ?>">Confirmar</button>
                </div>
            </div>

            <div class="modal-footer ">
                <button type="button" class="btn btn-outline-secondary " data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php $v->start('js'); ?>

<script src="<?= url('theme/admin/js/foods.js'); ?>"></script>

<?php $v->end(); ?>