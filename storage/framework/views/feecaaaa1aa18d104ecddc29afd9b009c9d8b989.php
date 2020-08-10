<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.th_edit')); ?> <?php echo e(trans('admin.articles')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="card">
        <div class="card-body">
            <form action="/admin/blog/article/edit/store/<?php echo e($item->id); ?>" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                    <div class="col-md-10">
                        <input type="text" value="<?php echo e($item->title); ?>" name="title" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.category')); ?></label>
                    <div class="col-md-10">
                        <select name="cat_id" class="form-control">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo $category->id ?? ''; ?>" <?php if($category->id == $item->cat_id): ?> selected <?php endif; ?> ><?php echo $category->title ?? ''; ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.thumbnail')); ?></label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="image">
                                <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
                            </span>
                            <input type="text" name="image" id="image" value="<?php echo e($item->image); ?>" dir="ltr" class="form-control">
                            <span id="click-for-upload" data-input="image" class="input-group-append click-for-upload cu-p">
                                <span class="input-group-text"><i class="fa fa-upload" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="pre_text" required><?php echo e($item->pre_text); ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="text" required><?php echo e($item->text); ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2"><?php echo e(trans('admin.th_status')); ?></label>
                    <div class="col-md-10">
                        <select class="form-control f-s-1" name="mode">
                            <option value="publish" <?php if($item->mode == 'publish'): ?> selected <?php endif; ?> class="f-w-b c-g"><?php echo e(trans('admin.published')); ?></option>
                            <option value="draft" <?php if($item->mode == 'draft'): ?> selected <?php endif; ?>><?php echo e(trans('admin.draft')); ?></option>
                            <option value="request" <?php if($item->mode == 'request'): ?> selected <?php endif; ?>><?php echo e(trans('admin.review_request')); ?></option>
                            <option value="delete" <?php if($item->mode == 'delete'): ?> selected <?php endif; ?>><?php echo e(trans('admin.unpublish_request')); ?></option>
                        </select>
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
<?php $__env->startSection('script'); ?>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $('#click-for-upload').filemanager('image');
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Blog','Edit Article']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/blog/articleedit.blade.php ENDPATH**/ ?>