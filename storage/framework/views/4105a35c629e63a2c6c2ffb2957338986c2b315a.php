<?php echo $__env->make('admin.layout.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.users_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="card">
        <header class="card-header">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title"><?php echo e(trans('admin.filter_items')); ?></h2>
        </header>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="date" id="fsdate" class="text-center form-control" value="<?php echo e(request()->get('fsdate') ?? ''); ?>" name="fsdate" placeholder="Start Date">
                            <input type="hidden" id="fdate" name="fdate" value="<?php echo e(request()->get('fdate') ?? ''); ?>">
                            <div class="input-group-append">
                                <span class="input-group-text fdatebtn" id="fdatebtn"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="date" id="lsdate" class="text-center form-control" name="lsdate" value="<?php echo e(request()->get('lsdate') ?? ''); ?>" placeholder="End Date">
                            <input type="hidden" id="ldate" name="ldate" value="<?php echo e(request()->get('ldate') ?? ''); ?>">
                            <div class="input-group-append">
                                <span class="input-group-text ldatebtn" id="ldatebtn"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="order" class="form-control">
                                <option value=""><?php echo e(trans('admin.filter_type')); ?></option>
                                <option value="sella" <?php if(!empty(request()->get('order')) and request()->get('order') == 'sella'): ?> selected <?php endif; ?>><?php echo e(trans('admin.sales')); ?>-<?php echo e(trans('admin.ascending')); ?></option>
                                <option value="selld" <?php if(!empty(request()->get('order')) and request()->get('order') == 'selld'): ?> selected <?php endif; ?>><?php echo e(trans('admin.sales')); ?>-<?php echo e(trans('admin.descending')); ?></option>
                                <option value="buya" <?php if(!empty(request()->get('order')) and request()->get('order') == 'buya'): ?> selected <?php endif; ?>><?php echo e(trans('admin.purchases')); ?>-<?php echo e(trans('admin.ascending')); ?></option>
                                <option value="buyd" <?php if(!empty(request()->get('order')) and request()->get('order') == 'buyd'): ?> selected <?php endif; ?>><?php echo e(trans('admin.purchases')); ?>-<?php echo e(trans('admin.descending')); ?></option>
                                <option value="contenta" <?php if(!empty(request()->get('order')) and request()->get('order') == 'contenta'): ?> selected <?php endif; ?>><?php echo e(trans('admin.badges_tab_courses_count')); ?>-<?php echo e(trans('admin.ascending')); ?></option>
                                <option value="contentd" <?php if(!empty(request()->get('order')) and request()->get('order') == 'contentd'): ?> selected <?php endif; ?>><?php echo e(trans('admin.badges_tab_courses_count')); ?>-<?php echo e(trans('admin.descending')); ?></option>
                                <option value="datea" <?php if(!empty(request()->get('order')) and request()->get('order') == 'datea'): ?> selected <?php endif; ?>><?php echo e(trans('admin.th_date')); ?>-<?php echo e(trans('admin.ascending')); ?></option>
                                <option value="seller" <?php if(!empty(request()->get('order')) and request()->get('order') == 'seller'): ?> selected <?php endif; ?>><?php echo e(trans('admin.sell_purchase')); ?></option>
                                <option value="disabled" <?php if(!empty(request()->get('order')) and request()->get('order') == 'disabled'): ?> selected <?php endif; ?>><?php echo e(trans('admin.disabled_users')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="submit" class="text-center btn btn-primary w-100" value="Filter Items">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="card">
        <header class="card-header">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>
            <h2 class="panel-title"><?php echo e(trans('admin.users_list')); ?></h2>
        </header>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none m-b-0" id="datatable-details">
                    <thead>
                    <tr>
                        <th class="text-center"><?php echo e(trans('admin.username')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.real_name')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.reg_date')); ?></th>
                        <th class="text-center" width="100"><?php echo e(trans('admin.income')); ?></th>
                        <th class="text-center" width="100"><?php echo e(trans('admin.account_balance')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.badges_tab_courses_count')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.purchases')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.sales')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.user_groups')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.th_status')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.th_controls')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th class="text-center"><a <?php if($user['vendor'] == 1): ?> style="color: green;font-weight: bold;" title="vendor" <?php endif; ?> target="_blank" href="/profile/<?php echo e($user->id); ?>"><?php echo e($user->username); ?></a></th>
                            <th class="text-center"><?php echo e($user->name); ?></th>
                            <th class="text-center"><?php echo e(date('d F Y / H:i',$user->created_at)); ?></th>
                            <th class="text-center number-green" width="100" <?php if($user->income < 0): ?> style="color:red !important;" <?php endif; ?> dir="ltr"><?php echo e(number_format($user->income)); ?></th>
                            <th class="text-center number-green" width="100" <?php if($user->credit < 0): ?> style="color:red !important;" <?php endif; ?> dir="ltr"><?php echo e(number_format($user->credit)); ?></th>
                            <th class="text-center"><a href="/admin/content/user/<?php echo e($user->id); ?>"><?php echo e($user->contents_count); ?></a></th>
                            <th class="text-center"><a href="/admin/buysell/list/?buyer=<?php echo e($user->id); ?>"><?php echo e($user->buys_count); ?></a></th>
                            <th class="text-center"><a href="/admin/buysell/list/?user=<?php echo e($user->id); ?>"><?php echo e($user->sells_count); ?></a></th>
                            <?php if(!empty($user->category->id)): ?>
                                <th class="text-center"><a href="/admin/user/incategory/<?php echo e($user->category->id); ?>"><?php echo e($user->category->title); ?></a></th>
                            <?php else: ?>
                                <td></td>
                            <?php endif; ?>
                            <th class="text-center">
                                <?php if($user->mode == 'active'): ?>
                                    <span class="c-g"><?php echo e(trans('admin.active')); ?></span>
                                <?php elseif($user->mode == 'deactive'): ?>
                                    <span class="c-o"><?php echo e(trans('admin.disabled')); ?></span>
                                <?php elseif($user->mode == 'block'): ?>
                                    <span class="c-r"><?php echo e(trans('admin.banned')); ?></span>
                                <?php endif; ?>
                            </th>
                            <th class="text-center" width="150">
                                <a href="/admin/user/item/<?php echo e($user->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a href="/admin/user/userlogin/<?php echo e($user->id); ?>" title="Login as user" target="_blank"><i class="fa fa-user" aria-hidden="true"></i></a>
                                <a href="/admin/user/event/<?php echo e($user->id); ?>" title="User Events"><i class="fa fa-calendar" aria-hidden="true"></i></a>
                                <a href="#" data-href="/admin/user/delete/<?php echo e($user->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete" class="c-r"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </th>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center">
            <?php echo $users->appends($_GET)->links('pagination.default'); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Users','Rating','Admin Panel']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\proacademy\resources\views/admin/user/list.blade.php ENDPATH**/ ?>