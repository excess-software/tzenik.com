<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.usage_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none" id="datatable-details">
                    <thead>
                    <tr>
                        <th class="text-center" width="30">#</th>
                        <th><?php echo e(trans('admin.th_username')); ?></th>
                        <th class="text-center" width="150"><?php echo e(trans('admin.spend_time')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo ($index + 1); ?></td>
                            <td>
                                <?php if(!empty($item->user)): ?>
                                    <?php echo $item->user->username; ?></td>
                                <?php endif; ?>
                            <td class="text-center" width="150"><?php echo $item->total * 5; ?> Min</td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Courses','Usage List']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/content/usage.blade.php ENDPATH**/ ?>