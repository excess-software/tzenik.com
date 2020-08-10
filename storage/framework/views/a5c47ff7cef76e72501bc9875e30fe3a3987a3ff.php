<?php echo $__env->make(getTemplate().'.view.layout.header',['title'=>'User Panel'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make(getTemplate().'.user.layout.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="h-20"></div>
<div class="container-fluid">
    <div class="container">
        <div class="col-md-12 col-xs-12">
            <ul class="nav nav-tabs nav-justified panel-tabs" role="tablist">
                <li class="<?php echo $__env->yieldContent('tab1'); ?>">
                    <a href="/user/article/new" id="newarticle">
                        <span class="submicon mdi mdi-book-plus"></span>
                        <?php echo e(trans('main.new_article')); ?>

                    </a>
                </li>
                <li class="<?php echo $__env->yieldContent('tab2'); ?>">
                    <a href="/user/article/list">
                        <span class="submicon mdi mdi-book"></span>
                        <?php echo e(trans('main.my_articles')); ?>

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
    <script type="text/javascript" src="/assets/default/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            CKEDITOR.config.language = 'fa';
        });
    </script>
    <script>$('#article-hover').addClass('item-box-active');</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.user.layout.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make(getTemplate().'.view.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/layout/articlelayout.blade.php ENDPATH**/ ?>