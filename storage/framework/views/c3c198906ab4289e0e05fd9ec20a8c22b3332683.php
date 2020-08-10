<?php echo $__env->make(getTemplate().'.view.layout.header',['title'=>'User Plan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make(getTemplate().'.user.layout.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="h-20"></div>
<div class="container-fluid">
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <ul class="nav nav-tabs nav-justified panel-tabs" role="tablist">
                <li class="<?php echo $__env->yieldContent('tab1'); ?>"><a href="/user/content/part/new/<?php echo e($id ?? 0); ?>"><?php echo e(trans('main.new_part')); ?></a></li>
                <li class="<?php echo $__env->yieldContent('tab2'); ?>"><a href="/user/content/part/list/<?php echo e($id ?? 0); ?>"><?php echo e(trans('main.videos_list')); ?></a></li>
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
<?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/layout/partlayout.blade.php ENDPATH**/ ?>