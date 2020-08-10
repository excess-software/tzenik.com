<?php echo $__env->make(getTemplate().'.view.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <div class="container" style="width: 75% !important; margin-top: 50px; margin-bottom: 25%;">
            <div class="row">
                <div class="col">
                    <?php echo $__env->yieldContent('page'); ?>
                </div>
            </div>
    </div>



<?php echo $__env->make(getTemplate().'.view.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/layout/forum.blade.php ENDPATH**/ ?>