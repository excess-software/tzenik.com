
<?php $__env->startSection('title'); ?>
    Nuevo Usuario
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="cards">
        <div class="card-body">
            <div class="tabs">
                <div class="tab-content">
                    <div id="main" class="tab-pane active">
                        <form action="/admin/user/guardar" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.real_name')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="name" value="" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputReadOnly"><?php echo e(trans('admin.username')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" value="" id="User" name="username" id="inputReadOnly" onChange="verifyUser()" class="form-control" required>
                                    <small id="UserAbout" class="form-text" style="color: red;"></small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputReadOnly"><?php echo e(trans('admin.email')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" value="" id="Mail" name="email" id="inputReadOnly" onChange="verifyMail()" class="form-control text-left" dir="ltr" required>
                                    <small id="MailAbout" class="form-text" style="color: red;"></small>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.th_status')); ?></label>
                                <div class="col-md-6">
                                    <select name="mode" class="form-control populate">
                                        <option value="active">Activo</option>
                                        <option value="block">Inactivo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.user_groups')); ?></label>
                                <div class="col-md-6">
                                    <select name="category_id" class="form-control populate">
                                        <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" id="btn-register" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="UserVerify">
    <input type="hidden" id="MailVerify">
    <script>
    function verifyUser() {
        var user = $('#User').val();
        $.ajax({
            type: "GET",
            url: "/admin/user/verificar/user/" + user,
            success: function (response) {
                if (response != true) {
                    $('#UserAbout').html('Este usuario ya se encuentra en uso');
                    $('#UserVerify').val('false');
                    verify();
                } else {
                    $('#UserAbout').html('');
                    $('#UserVerify').val('true');
                    verify();
                }
            }
        });
    }

    function verifyMail() {
        var mail = $('#Mail').val();
        $.ajax({
            type: "GET",
            url: "/admin/user/verificar/mail/" + mail,
            success: function (response) {
                if (response != true) {
                    $('#MailAbout').html('Este Mail ya se encuentra en uso');
                    $('#MailVerify').val('false');
                    verify();
                } else {
                    $('#MailAbout').html('');
                    $('#MailVerify').val('true');
                    verify();
                }
            }
        });
    }

    function verify() {
        var PassVerify = $('#UserVerify').val();
        var MailVerify = $('#MailVerify').val();
        if (PassVerify == 'true' && MailVerify == 'true') {
            $('#btn-register').attr('disabled', false);
        } else {
            $('#btn-register').attr('disabled', true);
        }
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Users','Edit']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/user/crear.blade.php ENDPATH**/ ?>