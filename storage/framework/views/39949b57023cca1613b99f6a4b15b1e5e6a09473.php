<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.tickets_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none" id="datatable-details">
                    <thead>
                    <tr>
                        <th><?php echo e(trans('admin.th_title')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.created_date')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.last_update')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.username')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.invited_users')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.department')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.th_status')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.th_controls')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><a href="/admin/ticket/reply/<?php echo e($item->id); ?>"><?php echo e($item->title); ?></a></td>
                            <td class="text-center"><?php echo e(date('d F Y : H:i',$item->created_at)); ?></td>
                            <?php if($item->updated_at>0): ?>
                                <td class="text-center"><?php echo e(date('d F Y : H:i',$item->updated_at)); ?></td>
                            <?php else: ?>
                                <td class="text-center"><?php echo e(date('d F Y : H:i',$item->created_at)); ?></td>
                            <?php endif; ?>
                            <td class="text-center">
                                <a title="<?php echo e($item->user->name); ?>" href="/profile/<?php echo e($item->user->id); ?>"><?php echo e($item->user->username); ?></a>
                            </td>
                            <td class="text-center">
                                <?php if($item->users != null): ?>
                                    <?php $__currentLoopData = $item->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a title="<?php echo e($u->user->name); ?>" href="/profile/<?php echo e($u->user->id); ?>"><?php echo e($u->user->username); ?></a>
                                        <br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?php echo e($item->category->title); ?></td>
                            <td class="text-center">
                                <?php if($item->mode == 'open'): ?>
                                    <b class="f-w-b"><?php echo e(trans('admin.waiting')); ?></b>
                                <?php elseif($item->mode == 'admin'): ?>
                                    <b class="c-g"><?php echo e(trans('admin.replied')); ?></b>
                                <?php else: ?>
                                    <b class="c-r"><?php echo e(trans('admin.closed')); ?></b>
                                <?php endif; ?>
                            </td>
                            <td class="text-center" width="50">
                                <a href="/admin/ticket/user/<?php echo e($item->id); ?>" title="Add user to conversation"><i class="fa fa-user" aria-hidden="true"></i></a>
                                <a href="/admin/ticket/reply/<?php echo e($item->id); ?>" title="Reply"><i class="fa fa-reply" aria-hidden="true"></i></a>
                                <a href="#" data-href="/admin/ticket/delete/<?php echo e($item->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center">
            <?php echo $lists->appends($_GET)->links('pagination.default'); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Support','Tickets']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/ticket/list.blade.php ENDPATH**/ ?>