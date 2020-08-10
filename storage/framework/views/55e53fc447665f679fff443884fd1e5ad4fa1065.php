<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.ads_requests')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center"><?php echo e(trans('admin.plan')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.description')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.username')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.course_title')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.th_status')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.th_date')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e(!empty($list->plan) ? $list->plan->title : ''); ?></td>
                        <td class="text-center"><?php echo e($list->description); ?></td>
                        <td class="text-center"><?php echo e(!empty($list->user->username) ? $list->user->username : 'Deleted User'); ?></td>
                        <td class="text-center"><?php echo e(!empty($list->content) ? $list->content->title : ''); ?></td>
                        <td class="text-center">
                            <?php if($list->mode == 'pending'): ?>
                                <b class="color-red-i"><?php echo e(trans('admin.waiting_payment')); ?></b>
                            <?php else: ?>
                                <b class="color-green"><?php echo e(trans('admin.paid_successful')); ?></b>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo e(date('d F Y H:i',$list->created_at)); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Advertising','Requests']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/ads/requests.blade.php ENDPATH**/ ?>