<?php echo $__env->make(getTemplate().'.view.layout.header',['title'=>'User Panel'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make(getTemplate().'.user.layout.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title','User Panel'); ?>
<div class="h-20"></div>
<div class="container-fluid">
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <ul class="nav nav-tabs nav-justified panel-tabs" role="tablist">
                <li class="<?php echo $__env->yieldContent('tab1'); ?>">
                    <a href="/user/balance/">
                        <span class="submicon mdi mdi-podium-gold"></span>
                        <?php echo e(trans('main.my_sales')); ?>

                    </a>
                </li>
                <li class="<?php echo $__env->yieldContent('tab2'); ?>">
                    <a href="/user/balance/sell/post">
                        <span class="submicon mdi mdi-truck-fast"></span>
                        <?php echo e(trans('main.pending_sales')); ?>

                    </a>
                </li>
                <li class="<?php echo $__env->yieldContent('tab3'); ?>">
                    <a href="/user/balance/log">
                        <span class="submicon mdi mdi-point-of-sale"></span>
                        <?php echo e(trans('main.financial_documents')); ?>

                    </a>
                </li>
                <li class="<?php echo $__env->yieldContent('tab4'); ?>">
                    <a href="/user/balance/charge">
                        <span class="submicon mdi mdi-credit-card-plus"></span>
                        <?php echo e(trans('main.charge_account')); ?>

                    </a>
                </li>
                <li class="<?php echo $__env->yieldContent('tab5'); ?>">
                    <a href="/user/balance/report">
                        <span class="submicon mdi mdi-chart-areaspline"></span>
                        <?php echo e(trans('main.reports')); ?>

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
    <script>$('#balance-hover').addClass('item-box-active');</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.user.layout.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make(getTemplate().'.view.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/layout/balancelayout.blade.php ENDPATH**/ ?>