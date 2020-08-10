<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.discounts')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th><?php echo e(trans('admin.th_title')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.created_date')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.expire_date')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.type')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.amount')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.th_status')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->title); ?></td>
                        <td class="text-center" width="150"><?php echo e(date('d F Y / H:i',$item->created_at)); ?></td>
                        <td class="text-center" width="150" <?php if($item->expire_at < time()): ?> title="Expired" style="color:red" <?php endif; ?> ><?php echo e(date('d F Y',$item->expire_at)); ?></td>
                        <td class="text-center" width="150">
                            <?php if($item->type == 'gift'): ?>
                                <?php echo e('Giftcard'); ?>

                            <?php elseif($item->type == 'off'): ?>
                                <?php echo e('Discount Card'); ?>

                            <?php endif; ?>
                        </td>
                        <td class="text-center" width="150">
                            <?php if($item->type == 'gift'): ?>
                                <?php echo e($item->off ?? ''); ?> <?php echo e(trans('admin.cur_dollar')); ?>

                            <?php elseif($item->type == 'off'): ?>
                                <?php echo e($item->off ?? ''); ?> %
                            <?php endif; ?>
                        </td>
                        <td class="text-center" width="50">
                            <?php if($item->mode == 'publish'): ?>
                                <i class="fa fa-check c-g" aria-hidden="true" title="Active"></i>
                            <?php elseif($item->recipent_type == 'darft'): ?>
                                <i class="fa fa-times c-r" aria-hidden="true" title="Disabled"></i>
                            <?php endif; ?>
                        </td>
                        <td class="text-center" width="50">
                            <a href="/admin/discount/edit/<?php echo e($item->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" data-href="/admin/discount/delete/<?php echo e($item->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Giftcards','Promotions']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/discount/list.blade.php ENDPATH**/ ?>