<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.edit_post')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <form action="/admin/blog/post/store" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id" value="<?php echo e($item->id); ?>">

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                    <div class="col-md-10">
                        <input type="text" value="<?php echo e($item->title); ?>" name="title" class="form-control" required>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.category')); ?></label>
                    <div class="col-md-10">
                        <select name="category_id" class="form-control select2">
                            <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>" <?php if(!empty($item->category_id) and $item->category_id == $cat->id): ?> selected <?php endif; ?>><?php echo e($cat->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.thumbnail')); ?></label>
                    <div class="col-md-10">
                        <div class="input-group" style="display: flex">
                            <button type="button" data-input="image" data-preview="holder" class="lfm_image btn btn-primary">
                                Choose
                            </button>
                            <input id="image" class="form-control" type="text" name="image" dir="ltr" required value="<?php echo e($item->image); ?>">
                            <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="image">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="pre_content" required><?php echo e($item->pre_content); ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="content" required><?php echo e($item->content); ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.tags')); ?></label>
                    <div class="col-md-10">
                        <input type="text" name="tags" value="<?php echo e($item->tags); ?>" data-role="tagsinput" data-tag-class="label label-primary" class="form-control">
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

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Blog','Edit Post']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/blog/edit.blade.php ENDPATH**/ ?>