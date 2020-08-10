<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.custom_codes')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#css" data-toggle="tab"> <?php echo e(trans('admin.input_css')); ?> </a></li>
                    <li class="nav-item"><a class="nav-link" href="#js" data-toggle="tab"> <?php echo e(trans('admin.input_js')); ?> </a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="css" class="tab-pane active">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea class="form-control text-left h-400" style="height: 400px !important;" dir="ltr" name="main_css"><?php echo $_setting['main_css'] ?? ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="js" class="tab-pane">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea class="form-control text-left h-400" style="height: 400px !important;" dir="ltr" name="main_js"><?php echo $_setting['main_js'] ?? ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Settings','Custom CSS & JS']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/setting/display.blade.php ENDPATH**/ ?>