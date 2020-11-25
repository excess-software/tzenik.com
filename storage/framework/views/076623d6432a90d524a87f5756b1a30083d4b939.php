
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('main.forum_title')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make(getTemplate() . '.user.parts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="row">
        <div class="col-lg-7 col-xs-7 col-md-7">
            <a href="/user/forum/post/new" class="float-right" style="float: right"><button class="btn btn-info"><?php echo e(trans('main.forum_btn_new_thread')); ?></button></a>
        </div>
        <!--<div class="col-lg-6 col-xs-6 col-md-6">
            <a href="/user/video/buy" class="float-left" style="text-decoration: none;"><h4 class="text-dark"><- <?php echo e(trans('main.forum_goback')); ?></h4></a>
        </div>    -->    
    </div>

    <br>

    <section class="card">
        <div class="card-body">
            <table class="table table-borderes table-striped mb-none" id="datatable-details">
                <thead>
                    <tr>
                        <th><?php echo e(trans('main.forum_category_title')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><p><a style="text-decoration: none;" href="/user/forum/post/category/<?php echo e($list->id); ?>" class="text-primary"><?php echo e($list->title); ?></a></p><p clasS="text-secondary"><?php echo e($list->desc); ?></p></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php if($private): ?>
        <div class="card-body">
            <h1>Private</h1>
            <table class="table table-borderes table-striped mb-none" id="datatable-details">
                <thead>
                    <tr>
                        <th><?php echo e(trans('main.forum_category_title')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $private; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><p><a style="text-decoration: none;" href="/user/forum/post/category/<?php echo e($list['id']); ?>" class="text-primary"><?php echo e($list['title']); ?></a></p><p clasS="text-secondary"><?php echo e($list['desc']); ?></p></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/forum/list.blade.php ENDPATH**/ ?>