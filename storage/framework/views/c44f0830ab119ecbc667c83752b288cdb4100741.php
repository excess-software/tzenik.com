
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('main.forum_title')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <div class="row">
        <div class="col-lg-6 col-xs-6 col-md-6">
            <a href="/user/forum/post/new" class="float-right" style="float: right"><button class="btn btn-info"><?php echo e(trans('main.forum_btn_new_thread')); ?></button></a>
        </div>
        <div class="col-lg-6 col-xs-6 col-md-6">
            <a href="/user/forum" class="float-left" style="text-decoration: none;"><h4 class="text-dark"><- <?php echo e(trans('main.forum_goback')); ?></h4></a>
        </div>        
    </div>
    <br>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th style="" ><?php echo e(trans('admin.th_title')); ?></th>
                    <th style="width: 15%" class="text-center"><?php echo e(trans('admin.author')); ?></th>
                    <th style="width: 15%" class="text-center" width="150"><?php echo e(trans('admin.th_date')); ?></th>
                    <!--<th style="width: 10%" class="text-center"><?php echo e(trans('admin.comments')); ?></th>-->
                </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><p><a style="text-decoration: none;" href="/user/forum/post/read/<?php echo e($item->id); ?>"><?php echo e($item->title); ?></a></p></td>
                            <td class="text-center" title="<?php echo e($item->username or ''); ?>"><?php echo e($item->name or ''); ?></td>
                            <td class="text-center" width="150"><?php echo e(date('d F Y : H:i',$item->create_at)); ?></td>
                            <!--<td class="text-center"><?php echo e(count($item->comments) or '0'); ?></td>-->
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('web.default.user.layout.forum',['breadcom'=>['Forum','Posts']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/forum/listbycategory.blade.php ENDPATH**/ ?>