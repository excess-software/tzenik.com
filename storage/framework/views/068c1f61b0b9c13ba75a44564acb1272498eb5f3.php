<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.rules')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#request" data-toggle="tab"> <?php echo e(trans('admin.request_rules')); ?> </a></li>
                    <li class="nav-item"><a class="nav-link" href="#term" data-toggle="tab"><?php echo e(trans('admin.publish_course')); ?></a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="request" class="tab-pane active">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea class="summernote" name="request_term"><?php echo $_setting['request_term'] ?? ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="term" class="tab-pane">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea class="summernote" name="content_terms" required><?php echo e($_setting['content_terms'] ?? ''); ?></textarea>
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


<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Settings','Rule & Terms']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/setting/term.blade.php ENDPATH**/ ?>