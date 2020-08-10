<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.notifications')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th><?php echo e(trans('admin.th_title')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.sent_date')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.sender')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.receipts')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->title); ?></td>
                        <td class="text-center" width="150"><?php echo e(date('d F Y / H:i',$item->created_at)); ?></td>
                        <td class="text-center" title="<?php echo e($item->user->username ?? 'Automatic'); ?>" width="150"><?php echo e($item->user->name ?? 'Automatic'); ?></td>
                        <td class="text-center" width="150">
                            <?php if($item->recipent_type == 'users'): ?>
                                <?php echo e('Users'); ?>

                            <?php elseif($item->recipent_type == 'user'): ?>
                                <?php echo e('Single User'); ?>

                            <?php elseif($item->recipent_type == 'category'): ?>
                                <?php echo e('User Group'); ?>

                            <?php elseif($item->recipent_type == 'seller'): ?>
                                <?php echo e('Vendors'); ?>

                            <?php elseif($item->recipent_type == 'buyer'): ?>
                                <?php echo e('Customers'); ?>

                            <?php elseif($item->recipent_type == 'female'): ?>
                                <?php echo e('Females'); ?>

                            <?php elseif($item->recipent_type == 'male'): ?>
                                <?php echo e('Males'); ?>

                            <?php endif; ?>
                        </td>
                        <td class="text-center" width="50">
                            <a href="/admin/notification/edit/<?php echo e($item->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" data-href="/admin/notification/delete/<?php echo e($item->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Notifications','Notifications List']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/notification/list.blade.php ENDPATH**/ ?>