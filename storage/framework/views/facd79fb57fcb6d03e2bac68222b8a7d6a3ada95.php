<?php $__env->startSection('title'); ?>
    <?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : 'Website title'); ?>

    <?php echo e(trans('main.active_account')); ?> -
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="h-25"></div>
    <div class="h-25"></div>
    <div class="col-md-4 col-md-offset-4 col-xs-12">
        <div class="ucp-section-box">
            <div class="header back-orange"><?php echo e(trans('main.activation')); ?></div>
            <div class="body">
                <p><?php echo e(trans('main.account_activation_success')); ?></p>
            </div>
        </div>
    </div>

    <div class="h-10 clearfix"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/auth/active.blade.php ENDPATH**/ ?>