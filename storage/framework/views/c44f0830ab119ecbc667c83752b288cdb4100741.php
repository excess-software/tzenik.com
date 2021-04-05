
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('main.forum_title')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make(getTemplate() . '.user.parts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-md-12">
            <h2 class="titulo-partials"></h2>
            <a href="/user/forum" class="float-left" style="text-decoration: none;"><h4 class="text-dark"><i class="fas fa-arrow-left"></i> Regresar</h4></a>
        </div>
        <div class="col-lg-6 col-xs-6 col-md-6">
            
        </div>        
    </div>
    <br>

    <section class="card">
        <div class="card-body">
            <table class="table table-dark" id="datatable-details">
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
                            <td><a style="text-decoration: none; color: white;" href="/user/forum/post/read/<?php echo e($item->id); ?>"><?php echo e($item->title); ?></a></td>
                            <td class="text-center" title="<?php echo e($item->username or ''); ?>"><?php echo e($item->name or ''); ?></td>
                            <td class="text-center" width="150"><?php echo e(date('d F Y : H:i',$item->create_at)); ?></td>
                            <!--<td class="text-center"><?php echo e(count($item->comments) or '0'); ?></td>-->
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/forum/listbycategory.blade.php ENDPATH**/ ?>