<?php $__env->startSection('tab6','active'); ?>
<?php $__env->startSection('tab'); ?>
        <ul class="nav nav-tabs nav-justified panel-tabs" style="margin-top: 45px" role="tablist">
            <li class="<?php echo $__env->yieldContent('video_tab1'); ?>">
                <a href="/user/video/request">
                    <span class="submicon mdi mdi-camera-enhance"></span>
                    <?php echo e(trans('main.requests')); ?></a>
                </a>
            </li>

            <li class="<?php echo $__env->yieldContent('video_tab2'); ?>">
                <a href="/user/video/record">
                    <span class="submicon mdi mdi-video"></span>
                    <?php echo e(trans('main.future_courses')); ?>

                </a>
            </li>
        </ul>

    <div class="tab-content">
        <div class="active tab-pane fade in" id="tab1">
            <?php echo $__env->yieldContent('video_tab'); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make($user['vendor'] == 1 ? getTemplate() . '.user.layout.videolayout' : getTemplate() . '.user.layout_user.requestlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/layout/requestVideoLayout.blade.php ENDPATH**/ ?>