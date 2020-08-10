<?php $__env->startSection('tab1','active'); ?>
<?php $__env->startSection('tab'); ?>
    <div class="h-20"></div>
    <div class="h-10"></div>
    <form method="post" action="/user/article/store" class="form-horizontal">
        <?php echo e(csrf_field()); ?>

        <div class="form-group">
            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.title')); ?></label>
            <div class="col-md-6 tab-con">
                <input type="text" class="form-control" name="title">
            </div>
            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.category')); ?></label>
            <div class="col-md-4 tab-con">
                <select class="form-control font-s" name="cat_id">
                    <?php $__currentLoopData = contentMenu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <optgroup label="<?php echo e($menu['title']); ?>">
                            <?php if(count($menu['submenu']) == 0): ?>
                                <option value="<?php echo e($menu['id']); ?>"><?php echo e($menu['title']); ?></option>
                            <?php else: ?>
                                <?php $__currentLoopData = $menu['submenu']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($sub['id']); ?>"><?php echo e($sub['title']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </optgroup>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.article_summary')); ?></label>
            <div class="col-md-11 tab-con">
                <textarea class="ckeditor" name="pre_text"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.description')); ?></label>
            <div class="col-md-11 tab-con">
                <textarea class="ckeditor" name="text"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.thumbnail')); ?></label>
            <div class="col-md-5 tab-con">
                <div class="input-group" style="display: flex">
                    <button id="lfm_image" data-input="image" data-preview="holder" class="btn btn-primary">
                        Choose
                    </button>
                    <input id="image" class="form-control"  dir="ltr" type="text" name="image">
                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="image">
                        <span class="input-group-text">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.status')); ?></label>
            <div class="col-md-3 tab-con">
                <select class="form-control font-s" name="mode">
                    <option value="draft"><?php echo e(trans('main.draft')); ?></option>
                    <option value="request"><?php echo e(trans('main.send_for_review')); ?></option>
                    <option value="delete"><?php echo e(trans('main.unpublish_request')); ?></option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="submit" value="Save Article" class="btn btn-custom pull-left btn-100-p">
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="/assets/default/ckeditor/ckeditor.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.config.language = 'en';
        });
        $('#lfm_image').filemanager('file', {prefix: '/user/laravel-filemanager'});
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make(getTemplate().'.user.layout.articlelayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/article/new.blade.php ENDPATH**/ ?>