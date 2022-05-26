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
                    <h3 class="box-title">Alimentação diaria</h3>
                    <form action="<?= $route->route('requestAdmin.dailyFoods'); ?>" method="POST" data-type="JSON" id="form">
                        <input type="date" name="date" class="form-control" value="<?= $date ?>" id="date">
                    </form>
                    <a href="<?= $route->route('webAdmin.addDailyFood'); ?>" class="h2" style="margin-right: 25%;"><i class="fas fa-plus-circle"></i></a>
                </div>

                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th class="border-top-0">Porco</th>
                                <th class="border-top-0">Ração</th>
                                <th class="border-top-0">Quantidade</th>
                                <th class="border-top-0"></th>
                                <th class="border-top-0"></th>
                            </tr>
                        </thead>
                        <?php if (isset($feederPigs)) : ?>  
                            <tbody>
                                <?php foreach ($feederPigs as $feederPig) : ?>
                                    <?php if($feederPig->dailyFood($date)) : ?>
                                        <tr id="<?= $feederPig->dailyFood($date)->id; ?>">
                                            <td class="fw-bold"><?= $feederPig->dailyFood($date)->pig_id ?></td>
                                            <td><?= $feederPig->dailyFood($date)->foodName() ?></td>
                                            <td><?= $feederPig->dailyFood($date)->amount ?> kg </td>
                                            
                                            <td><a href="#"><i class="fas fa-edit"></i></a></td>
                                            <td><button data-bs-target="#delete" data-bs-toggle="modal" class="btn delete"><i class="fas fa-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Apagar mensagem"></i></button></td>
                                        </tr>
                                        <?php endif; ?>
                                <?php endforeach; ?>
                            </tbody>
                        <?php endif; ?>
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
                <div class="text-center"> Tem certeza que deseja apagar esse registro de alimentação diaria?</div>
                <div class="text-center mt-3">
                    <button type="button" class="btn btn-primary confirm-delete" data-id="0" data-bs-dismiss="modal" 
                    data-url="<?= $route->route('dailyFood.delete'); ?>">Confirmar</button>
                </div>
            </div>
                                        
            <div class="modal-footer ">
                <button type="button" class="btn btn-outline-secondary " data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<?php $v->start('js'); ?>

<script src="<?= url('theme/admin/js/dailyFood.js'); ?>"></script>

<?php $v->end(); ?>