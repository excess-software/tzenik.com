<?php echo $__env->make(getTemplate().'.view.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldContent('page'); ?>

<?php echo $__env->make(getTemplate().'.view.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\proacademy\resources\views/web/default/view/layout/layout.blade.php ENDPATH**/ ?>