<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.identity_verification')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none" style="margin-bottom: 0;" id="datatable-details">
                    <thead>
                    <tr>
                        <th class="text-center"><?php echo e(trans('admin.username')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.real_name')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.reg_date')); ?></th>
                        <th class="text-center" width="100"><?php echo e(trans('admin.income')); ?></th>
                        <th class="text-center" width="100"><?php echo e(trans('admin.account_balance')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.courses')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.purchases')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.sales')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.user_groups')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.th_controls')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th class="text-center"><a target="_blank" href="/profile/<?php echo e($user->id); ?>"><?php echo e($user->username); ?></a></th>
                            <th class="text-center"><?php echo e($user->name); ?></th>
                            <th class="text-center"><?php echo e(date('d F Y : H:i',$user->created_at)); ?></th>
                            <th class="text-center number-green" width="100" <?php if($user->income < 0): ?> style="color:red !important;" <?php endif; ?> dir="ltr"><?php echo e($user->income ?? 0); ?></th>
                            <th class="text-center number-green" width="100" <?php if($user->credit < 0): ?> style="color:red !important;" <?php endif; ?> dir="ltr"><?php echo e($user->credit ?? 0); ?></th>
                            <th class="text-center"><a href="/admin/content/user/<?php echo e($user->id); ?>"><?php echo e($user->contents_count ?? 0); ?></a></th>
                            <th class="text-center"><a href="/admin/buysell/list/?buyer=<?php echo e($user->id); ?>"><?php echo e($user->buys_count ?? 0); ?></a></th>
                            <th class="text-center"><a href="/admin/buysell/list/?user=<?php echo e($user->id); ?>"><?php echo e($user->sells_count ?? 0); ?></a></th>
                            <th class="text-center">
                                <?php if(!empty($user->category->id)): ?>
                                    <a href="/admin/user/incategory/<?php echo e($user->category->id); ?>"><?php echo e($user->category->title); ?></a>
                                <?php endif; ?>
                            </th>
                            <th class="text-center">
                                <a href="/admin/user/item/<?php echo e($user->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a href="/admin/user/userlogin/<?php echo e($user->id); ?>" title="Login as user" target="_blank"><i class="fa fa-user" aria-hidden="true"></i></a>
                                <a href="#" data-href="/admin/user/delete/<?php echo e($user->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </th>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Users','Identity Verification','Admin Panel']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/user/seller.blade.php ENDPATH**/ ?>