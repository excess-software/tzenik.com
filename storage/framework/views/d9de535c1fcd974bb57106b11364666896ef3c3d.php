<?php echo $__env->make(getTemplate().'.view.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('content'); ?>

<?php echo $__env->make(getTemplate().'.view.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/layout/layout.blade.php ENDPATH**/ ?>