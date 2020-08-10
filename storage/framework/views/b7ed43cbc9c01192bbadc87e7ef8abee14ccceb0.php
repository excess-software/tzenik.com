<?php echo $__env->make(getTemplate().'.view.layout.header',['title'=>'User Panel'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make(getTemplate().'.user.layout.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('title','Courses'); ?>
<div class="h-20"></div>
<div class="container-fluid">
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <ul class="nav nav-tabs nav-justified panel-tabs" role="tablist">
                <li class="<?php echo $__env->yieldContent('tab1'); ?>">
                    <a href="/user/content">
                        <span class="submicon mdi mdi-library-movie"></span>
                        <?php echo e(trans('main.my_courses')); ?>

                    </a>
                </li>
                <li class="<?php echo $__env->yieldContent('tab2'); ?>">
                    <a href="/user/video/buy">
                        <span class="submicon mdi mdi-cloud-download"></span>
                        <?php echo e(trans('main.my_purchases')); ?>

                    </a>
                </li>
                <li class="<?php echo $__env->yieldContent('tab7'); ?>">
                    <a href="/user/video/live">
                        <span class="submicon mdi mdi-video"></span>
                        <?php echo e(trans('main.live_class')); ?></a>
                </li>
                <?php if(function_exists('checkQuiz')): ?>
                <li class="<?php echo $__env->yieldContent('tab3'); ?>">
                    <a href="/user/quizzes">
                        <span class="submicon mdi mdi-text"></span>
                        <?php echo e(trans('main.quizzes')); ?>

                    </a>
                </li>
                <?php endif; ?>
                <li class="<?php echo $__env->yieldContent('tab4'); ?>">
                    <a href="/user/video/off">
                        <span class="submicon mdi mdi-sale"></span>
                        <?php echo e(trans('main.discounts')); ?>

                    </a>
                </li>
                <li class="<?php echo $__env->yieldContent('tab5'); ?>">
                    <a href="/user/video/promotion">
                        <span class="submicon mdi mdi-rocket"></span>
                        <?php echo e(trans('main.promotions')); ?>

                    </a>
                </li>
                <li class="<?php echo $__env->yieldContent('tab6'); ?>">
                    <a href="/user/video/request">
                        <span class="submicon mdi mdi-camera-enhance"></span>
                        <?php echo e(trans('main.requests')); ?></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane fade in" id="tab1">
                    <?php echo $__env->yieldContent('tab'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('script'); ?>
    <script>$('#buy-hover').addClass('item-box-active');</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.user.layout.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make(getTemplate().'.view.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/layout/videolayout.blade.php ENDPATH**/ ?>