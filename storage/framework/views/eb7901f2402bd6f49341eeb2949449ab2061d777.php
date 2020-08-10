<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.new_banner')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="card">
        <div class="card-body">

            <form action="/admin/ads/box/store" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                    <div class="col-md-5">
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="h-20"></div>
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.position')); ?></label>
                    <div class="col-md-5">
                        <select name="position" class="form-control">
                            <option value="main-slider-side"><?php echo e(trans('admin.homepage_slider')); ?></option>
                            <option value="main-article-side"><?php echo e(trans('admin.homepage_articles')); ?></option>
                            <option value="category-side"><?php echo e(trans('admin.cat_page_sidebar')); ?></option>
                            <option value="category-pagination-bottom"><?php echo e(trans('admin.cat_page_bottom')); ?></option>
                            <option value="product-page"><?php echo e(trans('admin.product_page')); ?></option>
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
                            <input id="image" class="form-control" type="text" name="image" dir="ltr" required>
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
                                <option value="<?php echo e($size); ?>"><?php echo e($index); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.link_address')); ?></label>
                    <div class="col-md-5">
                        <input type="text" name="url" dir="ltr" value="#" class="form-control text-left" required>
                    </div>
                    <div class="h-20"></div>
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.sort')); ?></label>
                    <div class="col-md-5">
                        <input type="number" min="0" max="99" name="sort" dir="ltr" class="form-control text-center">
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


<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Advertising','New Banner']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/ads/newbox.blade.php ENDPATH**/ ?>