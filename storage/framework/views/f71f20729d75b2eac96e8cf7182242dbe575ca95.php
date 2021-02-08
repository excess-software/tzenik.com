
<?php $__env->startSection('page'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<section class="card">
    <header class="card-header">
        <h2 class="card-title"><?php echo e($content_title); ?> - <?php echo e($part_title); ?> - <?php echo e($title); ?></h2>
    </header>
    <div class="card-body">
        <table id="tabla" class="display" style="width:100%">
            <thead class="text-center">
                <tr>
                    <th>Usuario</th>
                    <th>Ver tarea</th>
                    <th>Marcar de recibido</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php $__currentLoopData = $homeworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homework): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($homework->user); ?></td>
                    <td><a class="btn block-btn btn-info" href="<?php echo e($homework->route); ?>" target="_blank">Abrir</a></td>
                    <td id="btn-recibida-<?php echo e($homework->id); ?>">
                    <?php if(!isset($homework->viewed)): ?>
                        <button class="btn btn-warning" onclick="recibir(<?php echo e($homework->id); ?>)">Marcar Recibida</button>
                    <?php else: ?>
                        <button class="btn btn-success" disabled>Recibida</button>
                    <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer text-center">
    </div>
</section>
<script>

    function recibir(tarea) {
        console.log('ejecutada');
        $.ajax({
            type: 'GET',
            url: "/user/vendor/content/tarea/" + tarea + "/recibir" ,
            dataType: "json",
            success: function (data) {
                $('#btn-recibida-' + tarea).html('<button class="btn btn-success" disabled>Recibida</button>');
                console.log(tarea);
            }
        });
    }

    $(document).ready(function () {
        $('#tabla').DataTable();
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.vendor.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/vendor/content/tareas_usuarios.blade.php ENDPATH**/ ?>