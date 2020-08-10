<?php $__env->startSection('title'); ?>
    <?php echo trans('admin.templates'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="card card-collapsed">
        <div class="card-body">
            <p><?php echo e(trans('admin.username')); ?> : [username] </p>
            <hr>
            <p><?php echo e(trans('admin.real_name')); ?> : [name] </p>
            <hr>
            <p><?php echo e(trans('admin.password')); ?> : [password] </p>
            <hr>
            <p><?php echo e(trans('admin.email')); ?> : [email] </p>
            <hr>
            <p><?php echo e(trans('admin.user_activation_link')); ?> : [active] </p>
            <hr>
            <p><?php echo e(trans('admin.change_password_link')); ?> : [token] </p>
        </div>
    </section>

    <section class="card">
        <div class="card-body">

            <form action="/admin/email/template/edit" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id" value="<?php echo e($item->id ?? ''); ?>">
                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputDefault"><?php echo trans('admin.th_title'); ?></label>
                    <div class="col-md-11">
                        <input type="text" name="title" class="form-control" value="<?php echo e($item->title ?? ''); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputDefault">Message body</label>
                    <div class="col-md-12">
                        <textarea class="form-control text-left summernote" dir="ltr" rows="15" name="template" required>
                            <?php if(isset($item->template)): ?>
                                <?php echo htmlentities($item->template); ?>

                            <?php endif; ?>
                        </textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                    </div>
                </div>

            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Email Template']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/email/templateitem.blade.php ENDPATH**/ ?>