<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.employees_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center"><?php echo e(trans('admin.username')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.real_name')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.reg_date')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.last_login')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.permissions')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_status')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $meta = arrayToList($user->usermetas->toArray(), 'option', 'value'); ?>
                    <tr>
                        <td class="text-center"><?php echo e($user->username); ?></td>
                        <td class="text-center"><?php echo e($user->name); ?></td>
                        <td class="text-center" width="220"><?php if(is_numeric($user->created_at)): ?> <?php echo e(date('d F Y : H:i',$user->created_at)); ?> <?php endif; ?></td>
                        <td class="text-center" width="220"><?php if(is_numeric($user->last_view)): ?> <?php echo e(date('d F Y : H:i',$user->last_view)); ?> <?php endif; ?></td>
                        <td class="text-center"><?php if(!empty($meta['capatibility'])): ?><?php echo e(returnCaptibiliy($meta['capatibility'])); ?><?php endif; ?></td>
                        <td class="text-center">
                            <?php if($user->mode == 'active'): ?>
                                <i class="fa fa-check c-g" aria-hidden="true" title="Active"></i>
                            <?php else: ?>
                                <i class="fa fa-times c-r" aria-hidden="true" title="Banned"></i>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="/admin/manager/item/<?php echo e($user->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" data-href="/admin/user/delete/<?php echo e($user->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Administradores','Lista']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/manager/list.blade.php ENDPATH**/ ?>