<?php echo $__env->make(getTemplate().'.view.layout.header',['title'=>'User Panel'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('title','User Panel'); ?>
<div class="container-fluid no-padding-xs" style="background: url(<?php echo e(get_option('upload_page_background','/assets/default/images/plant.jpg')); ?>);background-size: cover;">
    <div class="h-20"></div>
    <div class="container no-padding-xs">
        <div class="col-md-12 col-xs-12">
            <?php echo $__env->yieldContent('pages'); ?>
        </div>
    </div>
    <div class="h-20"></div>
    <div class="h-30"></div>
</div>
<?php echo $__env->make(getTemplate().'.user.layout.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make(getTemplate().'.view.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/layout/sendvideolayout.blade.php ENDPATH**/ ?>