<?php echo $__env->make(getTemplate().'.view.layout.header',['title'=>'User Panel'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make(getTemplate().'.user.layout.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="h-20"></div>
<div class="container-fluid">
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <ul class="nav nav-tabs nav-justified panel-tabs" role="tablist">
                <li class="<?php echo $__env->yieldContent('tab1'); ?>">
                    <a href="/user/ticket/support">
                        <span class="submicon mdi mdi-headset"></span>
                        <?php echo e(trans('main.courses_sup')); ?>

                    </a>
                </li>
                <li class="<?php echo $__env->yieldContent('tab2'); ?>">
                    <a href="/user/ticket/comments">
                        <span class="submicon mdi mdi-message-bulleted"></span>
                        <?php echo e(trans('main.comments')); ?>

                    </a>
                </li>
                <li class="<?php echo $__env->yieldContent('tab3'); ?>">
                    <a href="/user/ticket">
                        <span class="submicon mdi mdi-comment-multiple"></span>
                        <?php echo e(trans('main.sup_tickets')); ?>

                    </a>
                </li>
                <li class="<?php echo $__env->yieldContent('tab4'); ?>">
                    <a href="/user/ticket/notification">
                        <span class="submicon mdi mdi-bell-alert"></span>
                        <?php echo e(trans('main.notifications')); ?>

                    </a>
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
    <script>$('#ticket-hover').addClass('item-box-active');</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.user.layout.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make(getTemplate().'.view.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\laragon\www\proacademy\resources\views/web/default/user/layout/supportlayout.blade.php ENDPATH**/ ?>