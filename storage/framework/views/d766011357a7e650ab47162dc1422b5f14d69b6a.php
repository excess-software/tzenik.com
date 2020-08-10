<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.channels_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th><?php echo e(trans('admin.channel_title')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.channel_id')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.creator')); ?></th>
                    <th class="text-center" width="200"><?php echo e(trans('admin.verification_status')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.contents')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.th_status')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.views')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($channel->title); ?></td>
                        <td class="text-center"><a href="/chanel/<?php echo e($channel->username); ?>" target="_blank"><?php echo e($channel->username); ?></a></td>
                        <td class="text-center" title="<?php echo e($channel->user->username); ?>"><a href="/profile/<?php echo e($channel->user->id); ?>" target="_blank"><?php echo e($channel->user->username); ?></a></td>
                        <td class="text-center">
                            <?php if($channel->formal == 'ok'): ?>
                                <b class="c-g"><?php echo e(trans('admin.verified')); ?></b>
                            <?php else: ?>
                                <b class="c-r"><?php echo e(trans('admin.not_verified')); ?></b>
                            <?php endif; ?>
                        </td>
                        <td class="text-center" width="50"><?php echo e($channel->contents_count ?? 0); ?></td>
                        <td class="text-center">
                            <?php if($channel->mode == 'active'): ?>
                                <span class="c-g"><?php echo e(trans('admin.active')); ?></span>
                            <?php else: ?>
                                <span class="c-r"><?php echo e(trans('admin.disabled')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo e($channel->view ?? '0'); ?></td>
                        <td class="text-center">
                            <a href="/admin/channel/item/<?php echo e($channel->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" data-href="/admin/channel/delete/<?php echo e($channel->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Users','Channels List']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/user/channels.blade.php ENDPATH**/ ?>