<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.edit_banner')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="card">
        <div class="card-body">
            <form action="/admin/ads/box/edit/store/<?php echo e($item->id); ?>" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                    <div class="col-md-5">
                        <input type="text" name="title" value="<?php echo e($item->title); ?>" class="form-control" required>
                    </div>
                    <div class="h-20"></div>
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.position')); ?></label>
                    <div class="col-md-5">
                        <select name="position" class="form-control">
                            <?php $__currentLoopData = \App\Models\AdsBox::$positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($index); ?>" <?php if(isset($item->position) and $item->position == $index): ?> selected <?php endif; ?>><?php echo e(trans('admin.'.$position)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.image')); ?></label>
                    <div class="col-md-5">
                        <div class="input-group" style="display: flex">
                            <button type="button" data-input="image" data-preview="holder" class="lfm_image btn btn-primary">
                                Choose
                            </button>
                            <input id="image" class="form-control" type="text" name="image" value="<?php echo e($item->image); ?>" dir="ltr" required>
                            <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="image">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="h-20"></div>
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.banner_size')); ?></label>
                    <div class="col-md-5">
                        <select name="size" class="form-control">
                            <?php $__currentLoopData = \App\Models\AdsBox::$sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($size); ?>" <?php if(isset($item->size) && $item->size == $size): ?> selected <?php endif; ?>><?php echo e($index); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.link_address')); ?></label>
                    <div class="col-md-5">
                        <input type="text" value="<?php echo e($item->url); ?>" name="url" dir="ltr" class="form-control text-left">
                    </div>
                    <div class="h-20"></div>
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.sort')); ?></label>
                    <div class="col-md-5">
                        <input type="number" min="0" max="99" value="<?php echo e($item->sort); ?>" name="sort" dir="ltr" class="form-control text-center">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <div class="custom-switches-stacked">
                            <label class="custom-switch">
                                <input type="hidden" name="mode" value="draft">
                                <input type="checkbox" name="mode" value="publish" class="custom-switch-input" <?php if($item->mode=='publish'): ?> checked <?php endif; ?> />
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



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Advertising','Edit Banner']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/ads/editbox.blade.php ENDPATH**/ ?>