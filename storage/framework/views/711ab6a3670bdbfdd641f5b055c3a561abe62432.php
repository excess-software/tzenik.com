<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.submit_ticket')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="card">
        <div class="card-body">
            <form action="/admin/ticket/store" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                    <div class="col-md-11">
                        <input type="text" name="title" value="<?php echo e(request()->get('title') ?? ''); ?>" class="form-control" required>
                    </div>
                </div>

                <div class="form-group" id="userone">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.department')); ?></label>
                    <div class="col-md-11">
                        <select name="category_id" class="form-control select2">
                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group" id="userone">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.users')); ?></label>
                    <div class="col-md-11">
                        <select name="user_id" class="form-control select2">
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>" <?php if(!empty(request()->get('uid')) and request()->get('uid') == $user->id): ?> selected <?php endif; ?>><?php echo e($user->username); ?> (<?php echo e($user->name); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="msg" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.send')); ?></button>
                    </div>
                </div>

            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Support','New Ticket']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/ticket/new.blade.php ENDPATH**/ ?>