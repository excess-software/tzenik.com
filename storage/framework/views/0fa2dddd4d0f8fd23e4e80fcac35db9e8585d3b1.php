<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.new_promotion')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <form action="/admin/discount/content/store" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.type')); ?></label>
                    <div class="col-md-8">
                        <select name="type" class="form-control populate" id="type" required>
                            <option value=""></option>
                            <option value="content"><?php echo e(trans('admin.single_course')); ?></option>
                            <option value="category"><?php echo e(trans('admin.category_discount')); ?></option>
                            <option value="all"><?php echo e(trans('admin.all_courses_discount')); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group hide-me content">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.course')); ?></label>
                    <div class="col-md-8">
                        <select name="off_id_content" class="form-control populate" id="type" required>
                            <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($content->id); ?>"><?php echo e($content->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group hide-me category">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.category')); ?></label>
                    <div class="col-md-8">
                        <select name="off_id_category" class="form-control populate" id="type">
                            <?php $__currentLoopData = $categoreis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-md-5 control-label" for="inputDefault"><?php echo e(trans('admin.start_date')); ?></label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="date" class="form-control" id="fdate" name="fdate" required>
                                    <span class="input-group-append fdatebtn" id="fdatebtn">
                                        <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-5 control-label" for="inputDefault"><?php echo e(trans('admin.end_date')); ?></label>
                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="date" class="form-control" id="ldate" name="ldate" required>
                                    <span class="input-group-append ldatebtn" id="ldatebtn">
                                        <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="col-md-12 control-label" for="inputDefault"><?php echo e(trans('admin.amount')); ?></label>
                            <div class="col-md-12">
                                <input type="number" min="0" max="99" name="off" class="form-control text-center" placeholder="Percent only (Eg: 20 for 20%)" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-12 control-label" for="inputDefault"><?php echo e(trans('admin.th_status')); ?></label>
                            <div class="col-md-12">
                                <select name="mode" class="form-control populate" id="type">
                                    <option value="publish"><?php echo e(trans('admin.active')); ?></option>
                                    <option value="draft"><?php echo e(trans('admin.disabled')); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"></label>
                    <div class="col-md-8">
                        <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                    </div>
                </div>

            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            $('select[name="type"]').change(function () {
                $('.hide-me').hide();
                $('.' + $(this).val()).show();
            })
        })
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Promotions','New']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/discount/newcontent.blade.php ENDPATH**/ ?>