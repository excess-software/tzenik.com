<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.new_employee')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <?php if( ! empty(session('ErrorEmail'))): ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo e(trans('admin.email_exists')); ?></strong>
        </div>
    <?php endif; ?>

    <?php if( ! empty(session('ErrorUsername'))): ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo e(trans('admin.username')); ?></strong>
        </div>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <div id="main" class="tab-pane active">
                <form method="post" action="/admin/manager/new/store" class="form-horizontal form-bordered">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.real_name')); ?></label>
                        <div class="col-md-6">
                            <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control" id="inputDefault">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputReadOnly"><?php echo e(trans('admin.username')); ?></label>
                        <div class="col-md-6">
                            <input type="text" name="username" class="form-control text-left" dir="ltr" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputReadOnly"><?php echo e(trans('admin.password')); ?></label>
                        <div class="col-md-6">
                            <input type="text" name="password" class="form-control text-left" dir="ltr" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputReadOnly"><?php echo e(trans('admin.email')); ?></label>
                        <div class="col-md-6">
                            <input type="text" name="email" class="form-control text-left" dir="ltr" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo e(trans('admin.th_status')); ?></label>
                        <div class="col-md-6">
                            <select name="mode" class="form-control populate">
                                <option value="active"><?php echo e(trans('admin.active')); ?></option>
                                <option value="deactive"><?php echo e(trans('admin.banned')); ?></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Employees','New Employee']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/manager/new.blade.php ENDPATH**/ ?>