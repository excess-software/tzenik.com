<?php $__env->startSection('title'); ?>
    <?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : ''); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <?php echo $__env->make(getTemplate() . '.view.parts.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make(getTemplate() . '.view.parts.container', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(isset($setting['site']['main_page_newest_container']) and $setting['site']['main_page_newest_container'] == 1): ?>
        <?php echo $__env->make(getTemplate() . '.view.parts.newest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(isset($setting['site']['main_page_popular_container']) and $setting['site']['main_page_popular_container'] == 1): ?>
        <?php echo $__env->make(getTemplate() . '.view.parts.popular', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make(getTemplate() . '.view.parts.most_sell', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(isset($setting['site']['main_page_vip_container']) and $setting['site']['main_page_vip_container'] == 1): ?>
        <?php echo $__env->make(getTemplate() . '.view.parts.vip', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make(getTemplate() . '.view.parts.news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/main.blade.php ENDPATH**/ ?>