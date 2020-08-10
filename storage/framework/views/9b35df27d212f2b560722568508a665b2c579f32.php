<?php $__env->startSection('page'); ?>
    <?php if($errors->any()): ?>
        <div class="alert alert-primary">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo e($errors->first()); ?></strong>
        </div>
    <?php endif; ?>

    <div class="tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#main" class="nav-link active" data-toggle="tab"> <?php echo e(trans('admin.general')); ?> </a>
            </li>
            <li class="nav-item">
                <a href="#security" class="nav-link" data-toggle="tab"><?php echo e(trans('admin.security')); ?></a>
            </li>
        </ul>
        <div class="card">
            <div class="card-body">
                <div class=" tab-content">
                    <div id="main" class="tab-pane active">
                        <form action="/admin/profile/main/update" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.real_name')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control" id="inputDefault">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputReadOnly"><?php echo e(trans('admin.email')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" value="<?php echo e($user->email); ?>" id="inputReadOnly" class="form-control text-left" dir="ltr" disabled>
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
                    <div id="security" class="tab-pane">
                        <form action="/admin/profile/security/update" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.new_password')); ?></label>
                                <div class="col-md-6">
                                    <input type="password" name="password" class="form-control" id="inputDefault" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.new_password_repeat')); ?></label>
                                <div class="col-md-6">
                                    <input type="password" name="re_password" class="form-control" id="inputDefault" required>
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
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Employees','Profile',$user->name]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/manager/profile.blade.php ENDPATH**/ ?>