
<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.course_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<section class="card">
    <header class="card-header">
        <h2 class="card-title">Asignar usuarios a cursos privados</h2>
    </header>
    <div class="card-body">
        <form action="/user/vendor/content/asignar" method="post">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <select id="curso" class="form-control populate" name="curso" onChange="getUsers(this.value);">
                            <option>Seleccione curso</option>
                            <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Usuarios de Fundal</h4>
                    <div>
                        <table id="tabla_users" class="display" style="width:100%">
                            <thead>
                                <th>Seleccionar</th>
                                <th>Usuario</th>
                            </thead>
                            <tbody id="listado">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="form-group">
                        <button type="submit" class="text-center btn btn-primary w-50">Asignar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<section class="card">
    <header class="card-header">
        <h2 class="card-title">Usuarios asignados a cursos</h2>
    </header>
    <div class="card-body">
        <table id="tabla" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Usuario</th>
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
                    <td><?php echo e($user->username.' - '.$user->name); ?></td>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            url: "/user/vendor/content/private/getUsers/" + curso,
            dataType: "json",
            success: function (data) {
                var html = '';
                for (i = 0; i < data.length; i++) {
                    html += '<tr>\
                        <td class="text-center"><input type="checkbox" name="usuarios[]" value="' + data[i][0] + '"></td><td>' + data[i][2] +
                        ' - ' + data[i][1] + '</td>\
                    </tr>';
                }
                $('#listado').html(html);
                $('#tabla_users').DataTable();
            }
        });
    }

    $(document).ready(function () {
        $('#tabla').DataTable();
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.vendor.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/vendor/content/usuariosEnCursos.blade.php ENDPATH**/ ?>