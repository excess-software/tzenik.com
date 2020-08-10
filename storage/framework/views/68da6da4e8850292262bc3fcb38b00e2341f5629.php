<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.users_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title"><?php echo e(trans('admin.list')); ?> <?php echo e($category->title ?? 'Users'); ?></h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center"><?php echo e(trans('admin.username')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.real_name')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.reg_date')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.courses')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.purchases')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.sales')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.user_group')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_status')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th class="text-center"><?php echo e($user->username); ?></th>
                        <th class="text-center"><?php echo e($user->name); ?></th>
                        <th class="text-center"><?php echo e(date('d F Y / H:i',$user->created_at)); ?></th>
                        <th class="text-center"><a href="/admin/content/user/<?php echo e($user->id); ?>"><?php echo e(count($user->contents)); ?></a></th>
                        <th class="text-center"><a href="/admin/sell/buyer/<?php echo e($user->id); ?>"><?php echo e(count($user->buys)); ?></a></th>
                        <th class="text-center"><a href="/admin/sell/user/<?php echo e($user->id); ?>"><?php echo e(count($user->sells)); ?></a></th>
                        <th class="text-center"><a href="/admin/user/incategory/<?php echo e($user->category->id); ?>"><?php echo e($user->category->title); ?></a></th>
                        <th class="text-center">
                            <?php if($user->mode == 'active'): ?>
                                <i class="fa fa-check c-g" aria-hidden="true" title="Active"></i>
                            <?php else: ?>
                                <i class="fa fa-times c-r" aria-hidden="true" title="Banned"></i>
                            <?php endif; ?>
                        </th>
                        <th class="text-center">
                            <a href="/admin/user/item/<?php echo e($user->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        </th>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Users List']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/user/incategory.blade.php ENDPATH**/ ?>