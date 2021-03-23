
<?php $__env->startSection('page'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<section class="card">
    <header class="card-header">
        <h2 class="card-title">Progreso de los alumnos</h2>
    </header>
    <div class="card-body">
        <table id="tabla" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Usuario</th>
                    <th>Duraci&oacute;n</th>
                    <th>Progreso</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $asignados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asignado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($item->id == $asignado[0]): ?>
                    <td><?php echo e($item->title); ?></td>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($user->id == $asignado[1]): ?>
                        <?php if(isset($user->username)): ?>
                            <td><?php echo e($user->username.' - '.$user->name); ?></td>
                        <?php else: ?>
                            <td>Sin username</td>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <td><?php echo e($asignado[2].' / '.$asignado[3]); ?></td>
                    <td class="text-center">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e($asignado[4]); ?>" aria-valuemin="0"
                                aria-valuemax="100" style="width:<?php echo e($asignado[4]); ?>%">
                                <b><?php echo e(round($asignado[4])); ?>%</b>
                            </div>
                        </div>
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
    /*function setLink(curso, user) {
        $('#asignar').attr('href', '/admin/content/asignar/' + curso + '/' + user);
    }

    function setData() {
        var curso = $('#curso').val();
        var user = $('#usuario').val();
        console.log(user);
        setLink(curso, user);
    }*/

    function getUsers(curso) {
        $.ajax({
            type: 'GET',
            url: "/admin/content/private/getUsers/" + curso,
            dataType: "json",
            success: function (data) {
                var html = '';
                for (i = 0; i < data.length; i++) {
                    html += '<div class="checkbox">\
                        <label><input type="checkbox" name="usuarios[]" value="' + data[i][0] + '"> ' + data[i][2] +
                        ' - ' + data[i][1] + '</input></label>\
                    </div>';
                }
                $('#listado').html(html);
            }
        });
    }

    $(document).ready(function () {
        $('#tabla').DataTable();
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.vendor.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/vendor/content/progresoAlumnos.blade.php ENDPATH**/ ?>