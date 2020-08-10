<?php $__env->startSection('tab1','active'); ?>

<?php $__env->startSection('tab'); ?>
    <div class="row">
        <div class="h-20"></div>
        <div class="col-md-7 col-xs-12">
            <div class="ucp-section-box">
                <div class="header back-orange"><?php echo e(trans('main.edit_part')); ?></div>
                <div class="body">
                    <form action="/user/content/part/edit/store/<?php echo e($part->id); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="content_id" value="<?php echo e($part->content->id); ?>">
                        <div class="form-group">
                            <label class="control-label" for="inputDefault"><?php echo e(trans('main.title')); ?></label>
                            <input type="text" name="title" value="<?php echo e($part->title); ?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="inputDefault"><?php echo e(trans('main.description')); ?></label>
                            <textarea class="form-control" rows="7" name="description"><?php echo e($part->description); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo e(trans('main.volume')); ?></label>
                            <div class="input-group">
                                <input type="number" min="0" name="size" value="<?php echo e($part->size); ?>" class="form-control text-center">
                                <span class="input-group-addon click-for-upload img-icon-s"><?php echo e(trans('main.mb')); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo e(trans('main.duration')); ?></label>
                            <div class="input-group">
                                <input type="number" min="0" name="duration" value="<?php echo e($part->duration); ?>" class="form-control text-center">
                                <span class="input-group-addon click-for-upload img-icon-s"><?php echo e(trans('main.minute')); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo e(trans('main.video_file')); ?></label>
                            <div class="input-group">
                                <span class="input-group-addon view-selected img-icon-s" data-toggle="modal" data-target="#VideoModal" data-whatever="upload_video"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                <input type="text" name="upload_video" dir="ltr" value="<?php echo e($part->upload_video); ?>" class="form-control">
                                <span class="input-group-addon click-for-upload img-icon-s"><i class="fa fa-upload" aria-hidden="true"></i></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label"><?php echo e(trans('main.sort')); ?></label>
                            <div data-plugin-spinner data-plugin-options='{ "value":0, "min": 0, "max": 100 }'>
                                <input type="number" value="<?php echo e($part->number); ?>" class="spinner-input form-control" maxlength="3">
                            </div>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-orange pull-left" type="submit"><?php echo e(trans('main.save_changes')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-xs-12">
            <div class="ucp-section-box">
                <div class="header back-green"><?php echo e(trans('main.term_rules')); ?></div>
                <div class="body">
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.user.layout.partlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/content/part/edit.blade.php ENDPATH**/ ?>