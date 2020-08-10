<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.new_plan')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="card">
        <div class="card-body">
            <form action="/admin/ads/plan/store" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                    <div class="col-md-10">
                        <input type="text" name="title" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label"><?php echo e(trans('admin.price')); ?></label>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" name="price" class="form-control text-center numtostr">
                            <span class="input-group-append click-for-upload cursor-pointer">
                                <span class="input-group-text"><?php echo e(trans('admin.cur_dollar')); ?></span>
                            </span>
                        </div>
                    </div>
                    <label class="col-md-1 control-label"><?php echo e(trans('admin.duration')); ?></label>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="number" name="day" class="form-control text-center">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="description" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="custom-switches-stacked">
                            <label class="custom-switch">
                                <input type="hidden" name="mode" value="draft">
                                <input type="checkbox" name="mode" value="publish" class="custom-switch-input"/>
                                <span class="custom-switch-indicator"></span>
                                <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.publish_item')); ?></label>
                            </label>
                        </div>
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


<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Advertising','New Plan']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/ads/newplan.blade.php ENDPATH**/ ?>