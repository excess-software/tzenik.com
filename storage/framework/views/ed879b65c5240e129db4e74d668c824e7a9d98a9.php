
<?php $__env->startSection('page'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<section class="card">
    <header class="card-header">
        <h2 class="card-title">Tareas de tus cursos</h2>
    </header>
    <div class="card-body">
        <button class="btn btn-info" data-toggle="modal" data-target="#nuevaTarea">Nueva tarea</button>
        <div id="accordion">
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!($course->homeworks)->isEmpty()): ?>
                    <div class="card">
                        <div class="card-header" id="heading-<?php echo e($course->id); ?>">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?php echo e($course->id); ?>"
                                    aria-expanded="true" aria-controls="collapseOne">
                                    <?php echo e($course->title); ?>

                                </button>
                            </h5>
                        </div>
                        <div id="collapse-<?php echo e($course->id); ?>" class="collapse show" aria-labelledby="heading-<?php echo e($course->id); ?>" data-parent="#accordion">
                            <div class="card-body">
                                <?php $__currentLoopData = $course->homeworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homework): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="tareas/<?php echo e($homework->content_id); ?>/<?php echo e($homework->part_id); ?>"><p><?php echo e($homework->part); ?> - <?php echo e($homework->title); ?></p></a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
    <div class="card-footer text-center">
    </div>
</section>

<div id="nuevaTarea" class="modal fade" role="dialog">
    <div class="modal-dialog zinun">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="/user/vendor/content/tarea/nueva" method="post">
            <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h3>Nueva tarea</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body modst">
                    <div class="form-group">
                        <label for="curso" class="col-form-label">Curso</label>
                        <select class="form-control" id="idcurso" name="curso" onchange="getPartes(this.value)">
                            <option disabled selected>-- Seleccione el curso --</option>
                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($course->id); ?>"><?php echo e($course->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="modulo" class="col-form-label">Modulo</label>
                        <select name="modulo" id="idmodulo" class="form-control">
                            <option disabled selected>-- Seleccione un curso primero --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-form-label">Título</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group">
                        <label for="description" class="col-form-label">Descripci&oacute;n</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary"><?php echo e(trans('main.save')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function getPartes(curso) {
    $.ajax({
        type: 'GET',
        url: "/user/vendor/content/getPartes/" + curso,
        dataType: "json",
        success: function (data) {
            var html = '';
            for (i = 0; i < data.length; i++) {
                html += '<option value="'+data[i].id+'">'+data[i].title+'</option>';
            }
            $('#idmodulo').html(html);
        }
    });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.vendor.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/vendor/content/tareas.blade.php ENDPATH**/ ?>