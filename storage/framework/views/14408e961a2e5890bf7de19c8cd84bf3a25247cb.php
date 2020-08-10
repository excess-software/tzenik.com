<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.th_edit')); ?> <?php echo e(trans('admin.comment')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <form method="post" action="/admin/content/comment/store" class="form-horizontal form-bordered">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id" value="<?php echo e($item->id); ?>">
                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="comment" required><?php echo e($item->comment); ?></textarea>
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



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Courses','Comments','Edit']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/content/commentedit.blade.php ENDPATH**/ ?>