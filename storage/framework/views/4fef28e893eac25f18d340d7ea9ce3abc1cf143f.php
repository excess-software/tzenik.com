<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.ads_plans')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center"><?php echo e(trans('admin.th_title')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.description')); ?></th>
                    <th class="text-center" width="100"><?php echo e(trans('admin.price')); ?></th>
                    <th class="text-center" width="100"><?php echo e(trans('admin.duration')); ?></th>
                    <th class="text-center" width="100"><?php echo e(trans('admin.th_status')); ?></th>
                    <th class="text-center" width="100"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th class="text-center"><?php echo e($list->title); ?></th>
                        <th class="text-center"><?php echo $list->description; ?></th>
                        <th class="text-center number-green" width="100" <?php if($list->price < 1000): ?> style="color:red !important;" <?php endif; ?> dir="ltr"><?php echo e($list->price); ?></th>
                        <th class="text-center number-green" width="100" <?php if($list->day < 30): ?> style="color:red !important;" <?php endif; ?> dir="ltr"><?php echo e($list->day); ?></th>
                        <th class="text-center">
                            <?php if($list->mode == 'publish'): ?>
                                <span class="color-green"><?php echo e(trans('admin.active')); ?></span>
                            <?php elseif($list->mode == 'draft'): ?>
                                <span class="color-orange"><?php echo e(trans('admin.disabled')); ?></span>
                            <?php endif; ?>
                        </th>
                        <th class="text-center">
                            <a href="/admin/ads/plan/edit/<?php echo e($list->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" data-href="/admin/ads/plan/delete/<?php echo e($list->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </th>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Advertising','Plans']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/ads/list.blade.php ENDPATH**/ ?>