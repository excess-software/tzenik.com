
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.edit_post')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">

            <form action="/user/vendor/forum/post/store" class="form-horizontal form-bordered" method="post">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="id" value="<?php echo e($item->id ?? ''); ?>">
                <input type="hidden" name="user_id" value="<?php echo e($item->user_id ?? ''); ?>">

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                    <div class="col-md-10">
                        <input type="text" value="<?php echo e($item->title ?? ''); ?>" name="title" class="form-control" required>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.category')); ?></label>
                    <div class="col-md-10">
                        <select name="category_id" class="form-control select2">
                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id ?? 0); ?>" <?php if(!empty($item->category_id) && $item->category_id == $cat->id): ?> <?php echo e('selected'); ?>  <?php endif; ?>><?php echo e($cat->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.thumbnail')); ?></label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="image" >
                                <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
                            </span>
                            <input type="text" name="image" value="<?php echo e($item->image ?? ''); ?>" dir="ltr" class="form-control">
                            <span class="input-group-append click-for-upload cu-p">
                                <span class="input-group-text"><i class="fa fa-upload" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="content" required><?php echo e($item->content ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.tags')); ?></label>
                    <div class="col-md-10">
                        <input type="text" name="tags" value="<?php echo e($item->tags ?? ''); ?>" data-role="tagsinput" data-tag-class="label label-primary" class="form-control">
                    </div>
                </div>

                <div class="custom-switches-stacked col-md-12">
                    <label class="custom-switch">
                        <input type="hidden" name="comment" value="disable">
                        <input type="checkbox" name="comment" value="enable" class="custom-switch-input" <?php if($item->comment == 'enable'): ?> <?php echo e('checked'); ?> <?php endif; ?> />
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.comments_enabled')); ?></label>
                    </label>
                    <label class="custom-switch">
                        <input type="hidden" name="mode" value="draft">
                        <input type="checkbox" name="mode" value="publish" class="custom-switch-input" <?php if($item->mode == 'publish'): ?> <?php echo e('checked'); ?> <?php endif; ?> />
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.publish')); ?></label>
                    </label>
                </div>

                <div class="h-10"></div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                    </div>
                </div>

            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.vendor.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/vendor/content/forumedit.blade.php ENDPATH**/ ?>