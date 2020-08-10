<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.transactions_bradcom')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">

        <div class="card-body">
            <form>
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="date" id="fsdate" value="<?php echo request()->get('fsdate') ?? ''; ?>" class="text-center form-control" name="fsdate" placeholder="Start Date">
                            <input type="hidden" id="fdate" name="fdate">
                            <span class="input-group-append fdatebtn" id="fdatebtn">
                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="date" id="lsdate" value="<?php echo request()->get('lsdate') ?? ''; ?>" class="text-center form-control" name="lsdate" placeholder="End Date">
                            <input type="hidden" id="ldate" name="ldate">
                            <span class="input-group-append ldatebtn" id="ldatebtn">
                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="submit" class="text-center btn btn-primary w-100" value="Show Results">
                    </div>
                </div>
            </form>
            <div class="h-20"></div>
            <?php if(count($lists)>0): ?>
                <div class="alert alert-info">
                    <span><?php echo e(trans('admin.since')); ?></span>
                    <span class="f-w-b"><?php echo e(date('d F Y : H:i',$first->created_at)); ?></span>
                    <span><?php echo e(trans('admin.till')); ?></span>
                    <span class="f-w-b"><?php echo e(date('d F Y : H:i',$last->created_at)); ?></span>
                    <span></span><?php echo e(trans('admin.total_transactions_amount')); ?></span>
                    <span class="f-w-b"><?php echo e($allPrice); ?></span>
                    <span><?php echo e(trans('admin.cur_dollar')); ?></span>
                    <span><?php echo e(trans('admin.and_business_income_is')); ?></span>
                    <span class="f-w-b"><?php echo e($siteIncome); ?></span>
                    <span><?php echo e(trans('admin.cur_dollar')); ?></span>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="card">
        <header class="card-heading">
            <div class="card-actions">
                <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
            </div>

            <h2 class="card-title"></h2><?php echo e(trans('admin.transactions_list_header')); ?></h2>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center"><?php echo e(trans('admin.th_customer')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_vendor')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_course')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.total_payment_table_header')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.business_income_table_header')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.th_date')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.th_status')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($lists)): ?>
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th class="text-center">
                                <?php if(!empty($item->buyer)): ?>
                                    <a href="/profile/<?php echo e($item->buyer->id); ?>" target="_blank"><?php echo e($item->buyer->name); ?></a>
                                <?php endif; ?>
                            </th>
                            <th class="text-center">
                                <?php if(!empty($item->user)): ?>
                                    <a href="/profile/<?php echo e($item->user->id); ?>" target="_blank"><?php echo e($item->user->name); ?></a>
                                <?php endif; ?>
                            </th>
                            <th class="text-center">
                                <?php if(!empty($item->content)): ?>
                                    <a href="/product/<?php echo e($item->content->id); ?>" target="_blank"><?php echo e($item->content->title); ?></a>
                                <?php endif; ?>
                            </th>
                            <th class="text-center"><?php echo e($item->price); ?><br><?php echo e(trans('admin.cur_dollar')); ?></th>
                            <th class="text-center"><?php echo e($item->income); ?><br><?php echo e(trans('admin.cur_dollar')); ?></th>
                            <td class="text-center" width="150"><?php echo e(date('d F Y : H:i',$item->created_at)); ?></td>
                            <td class="text-center">
                                <?php if($item->mode == 'deliver'): ?>
                                    <i class="fa fa-check c-g" aria-hidden="true" title="Successfully Paid"></i>
                                <?php else: ?>
                                    <i class="fa fa-times c-r" aria-hidden="true" title="Waiting For Payment"></i>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Reports','Transactions']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/report/transaction.blade.php ENDPATH**/ ?>