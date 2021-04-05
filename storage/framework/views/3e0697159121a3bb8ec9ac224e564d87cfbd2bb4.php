

<?php $__env->startSection('title'); ?>
<?php echo e(get_option('site_title','')); ?> - <?php echo e(!empty($category->title) ? $category->title : 'Categories'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="">
    <?php echo $__env->make(getTemplate() . '.user.parts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="col-md-3">
        <h2 class="titulo-partials">Filtros</h2>
        <ul class="list-group">
            <a href="/user/dashboard/all" style="text-decoration: none;">
                <li class="list-group-item list-content-media"><b>Todos los cursos</b></li>
            </a>
            <br>
            <a href="/user/dashboard/inProcess" style="text-decoration: none;">
                <li class="list-group-item list-content-media"><b>Cursos en proceso</b></li>
            </a>
            <br>
            <a href="/user/dashboard/finished" style="text-decoration: none;">
                <li class="list-group-item list-content-media"><b>Cursos terminados</b></li>
            </a>
            <br>
            <a href="/user/quizzes" style="text-decoration: none;">
                <li class="list-group-item list-content-media list-active"><b>Calificaciones</b></li>
            </a>
        </ul>
    </div>
    <div class="col-md-9">
        <h2 class="titulo-partials">Resultados</h2>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">
                        <h3><b style="color: white;">Curso</b> </h3>
                    </th>
                    <th scope="col">
                        <h3><b style="color: white;">Nota</b> </h3>
                    </th>
                    <th scope="col">
                        <h3><b style="color: white;">Extras</b> </h3>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($quiz->comprado == true): ?>
                <tr>
                    <td>
                        <a href="/product/<?php echo e($quiz->content->id); ?>">
                            <h4><?php echo e($quiz->content->title); ?></h4>
                        </a>
                    </td>
                    <td>
                        <h4><?php echo e((!empty($quiz->result) and isset($quiz->result)) ? $quiz->result->user_grade : 'No grade'); ?>

                        </h4>
                        <?php if(!empty($quiz->result) and isset($quiz->result)): ?>
                        <?php if($quiz->result->status == 'pass'): ?>
                        <span class="badge badge-success"><?php echo e(trans('main.passed')); ?></span>
                        <?php elseif($quiz->result->status == 'fail'): ?>
                        <span class="badge badge-danger"><?php echo e(trans('main.failed')); ?></span>
                        <?php else: ?>
                        <span class="badge badge-warning"><?php echo e(trans('main.waiting')); ?></span>
                        <?php endif; ?>
                        <?php else: ?>
                        <span class="badge badge-warning"><?php echo e(trans('main.no_term')); ?></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if(!empty($quiz->result) and isset($quiz->result)): ?>
                        <?php if($quiz->result->status == 'pass'): ?>
                        <a class="btn btn-ultimos-blogs btn-block"
                            href="certificates/<?php echo e($quiz->result->id); ?>/download">
                            <button class="btn btn-ultimos-blogs btn-block">
                                <h4><b>Certificado</b></h4>
                            </button>
                        </a>
                        <?php else: ?>
                        <button class="btn btn-ultimos-blogs btn-block" disabled>
                            <h4><b>Certificado</b></h4>
                        </button>
                        <?php endif; ?>
                        <?php else: ?>
                        <button class="btn btn-ultimos-blogs btn-block" disabled>
                            <h4><b>Certificado</b></h4>
                        </button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>            
</div>

<div id="quizzesDelete" class="modal fade" role="dialog">
    <div class="modal-dialog zinun">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3><?php echo e(trans('main.delete')); ?></h3>
            </div>
            <div class="modal-body modst">
                <p><?php echo e(trans('main.quiz_delete_alert')); ?></p>
                <div>
                    <a href="" class=" btn btn-danger delete">
                        <?php echo e(trans('main.yes_sure')); ?>

                    </a>
                    <button type="button" data-dismiss="modal" class="btn btn-info"><?php echo e(trans('main.cancel')); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    "use strict";
    $('body').on('click', '.btn-delete-quiz', function (e) {
        e.preventDefault();
        var quiz_id = $(this).attr('data-id');
        $('#quizzesDelete').modal('show');
        $('#quizzesDelete').find('.delete').attr('href', '/user/quizzes/delete/' + quiz_id);
    })

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/quizzes/list.blade.php ENDPATH**/ ?>