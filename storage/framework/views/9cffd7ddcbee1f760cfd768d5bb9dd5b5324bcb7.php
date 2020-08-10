<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.withdrawal_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <div class="col-md-12 col-xs-12">
                <form>
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="date" class="form-control" id="fdate" name="fdate" value="<?php echo !empty(request()->get('fdate')) ? request()->get('fdate') : ''; ?>">
                                <span class="input-group-append fdatebtn" id="fdatebtn">
                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="date" class="form-control" id="ldate" name="ldate" value="<?php echo !empty(request()->get('ldate')) ? request()->get('ldate') : ''; ?>">
                                <span class="input-group-append ldatebtn" id="ldatebtn">
                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="text" placeholder="Minimum User Balance" name="withdraw" value="<?php echo !empty(request()->get('withdraw')) ? request()->get('withdraw') : ''; ?>" class="form-control text-center">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="submit" class="text-center btn btn-primary w-100" value="Show Withdrawal List">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row h-20"></div>
            <?php if(count($users)>0): ?>
                <div class="col-md-12 col-xs-12 alert alert-success">
                    <span><?php echo trans('admin.from'); ?></span>
                    <span class="f-w-b"><?php echo e(date('d F Y',$first->created_at)); ?></span>
                    <span><?php echo trans('admin.to'); ?></span>
                    <span class="f-w-b"><?php echo e(date('d F Y',$last->created_at)); ?></span>
                    <span><?php echo trans('admin.total_withdrawal'); ?></span>
                    <span class="f-w-b"><?php echo e($allsum); ?></span>
                    <span><?php echo trans('admin.cur_dollar'); ?></span>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <a href="/admin/balance/withdraw/excel?<?php echo http_build_query(Request()->all()); ?>" class="btn btn-primary">Export as Excel file</a>
    <div class="h-10"></div>
    <section class="card">
        <div class="card-header">
            <h5><?php echo trans('admin.vendors'); ?></h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center"><?php echo e(trans('admin.username')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.real_name')); ?></th>
                    <th class="text-center" width="100"><?php echo e(trans('admin.income')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.bank_name')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.creditcard_number')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.account_number')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $meta = arrayToList($user->userMetas, 'option', 'value'); ?>
                    <tr>
                        <th class="text-center"><?php echo e($user->username); ?></th>
                        <th class="text-center"><?php echo e($user->name); ?></th>
                        <th class="text-center number-green" width="100" <?php if($user->income<0): ?> style="color:red !important;" <?php endif; ?>><?php echo e($user->income); ?></th>
                        <th class="text-center"><?php echo e(!empty($meta['bank_name']) ? $meta['bank_name'] : ''); ?></th>
                        <th class="text-center"><?php echo e(!empty($meta['bank_card']) ? $meta['bank_card'] : ''); ?></th>
                        <th class="text-center"><?php echo e(!empty($meta['bank_account']) ? $meta['bank_account'] : ''); ?></th>
                        <th class="text-center">
                            <a href="/admin/balance/new/?user=<?php echo e($user->id); ?>" title="Create financial doc."><i class="fa fa-line-chart" aria-hidden="true"></i></a>
                        </th>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>
    <section class="card">
        <div class="card-header">
            <h5><?php echo trans('admin.not_identity_verified_vendors'); ?></h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center"><?php echo e(trans('admin.username')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.real_name')); ?></th>
                    <th class="text-center" width="100"><?php echo e(trans('admin.income')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.bank_name')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.creditcard_number')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.account_number')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users_not_apply; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $meta = arrayToList($user->userMetas, 'option', 'value'); ?>
                    <tr>
                        <th class="text-center"><?php echo e($user->username); ?></th>
                        <th class="text-center"><?php echo e($user->name); ?></th>
                        <th class="text-center number-green" width="100" <?php if($user->income<0): ?> style="color:red !important;" <?php endif; ?>><?php echo e($user->income); ?></th>
                        <th class="text-center"><?php echo e(!empty($meta['bank_name']) ? $meta['bank_name'] : ''); ?></th>
                        <th class="text-center"><?php echo e(!empty($meta['bank_card']) ? $meta['bank_card'] : ''); ?></th>
                        <th class="text-center"><?php echo e(!empty($meta['bank_account']) ? $meta['bank_account'] : ''); ?></th>
                        <th class="text-center">
                            <a href="/admin/notification/new?recipent_type=userone&uid=<?php echo e($user->id); ?>" title="Send notification"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
                            <a href="/admin/balance/new/?user=<?php echo e($user->id); ?>" title="Create financial doc."><i class="fa fa-line-chart" aria-hidden="true"></i></a>
                        </th>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>
    <section class="card">
        <div class="card-header">
            <h5><?php echo trans('admin.vendor_postal_sale'); ?></h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center"><?php echo e(trans('admin.username')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.real_name')); ?></th>
                    <th class="text-center" width="100"><?php echo e(trans('admin.income')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.bank_name')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.creditcard_number')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.account_number')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users_sell_post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $meta = arrayToList($user->userMetas, 'option', 'value'); ?>
                    <tr>
                        <th class="text-center"><?php echo e($user->username); ?></th>
                        <th class="text-center"><?php echo e($user->name); ?></th>
                        <th class="text-center number-green" width="100" <?php if($user->income<0): ?> style="color:red !important;" <?php endif; ?>><?php echo e($user->income); ?></th>
                        <th class="text-center"><?php echo e(!empty($meta['bank_name']) ? $meta['bank_name'] : ''); ?></th>
                        <th class="text-center"><?php echo e(!empty($meta['bank_card']) ? $meta['bank_card'] : ''); ?></th>
                        <th class="text-center"><?php echo e(!empty($meta['bank_account']) ? $meta['bank_account'] : ''); ?></th>
                        <th class="text-center">
                            <a href="/admin/notification/new?recipent_type=userone&uid=<?php echo e($user->id); ?>" title="Send notification"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
                            <a href="/admin/balance/new/?user=<?php echo e($user->id); ?>" title="Create financial doc."><i class="fa fa-line-chart" aria-hidden="true"></i></a>
                        </th>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Accounting','Withdrawal List']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/balance/withdraw.blade.php ENDPATH**/ ?>