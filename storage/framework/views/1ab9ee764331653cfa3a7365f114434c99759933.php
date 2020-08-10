<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.closed_tickets_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <form>
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="date" value="<?php echo request()->get('fsdate') ?? ''; ?>" id="fsdate" class="text-center form-control" name="fsdate" placeholder="Start Date">
                            <input type="hidden" id="fdate" name="fdate" value="<?php echo request()->get('fdate') ?? ''; ?>">
                            <span class="input-group-append fdatebtn" id="fdatebtn">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="date" id="lsdate" value="<?php echo request()->get('lsdate') ?? ''; ?>" class="text-center form-control" name="lsdate" placeholder="End Date">
                            <input type="hidden" id="ldate" name="ldate" value="<?php echo request()->get('ldate') ?? ''; ?>">
                            <span class="input-group-addon ldatebtn" id="ldatebtn">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="user" data-plugin-selectTwo class="form-control populate">
                                <option value=""><?php echo e(trans('admin.all_users')); ?></option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php if(!empty(request()->get('user')) and request()->get('user') == $user->id): ?> selected <?php endif; ?>><?php echo e($user->username ?? $user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="submit" class="text-center btn btn-primary w-100" value="Show Results">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="card">
        <div class="card-body">
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
                        <td class="text-center"><?php echo e(date('d F Y : H:i',$item->updated_at)); ?></td>
                        <td class="text-center">
                            <?php if(!empty($item->user)): ?>
                                <a title="<?php echo e($item->user->name); ?>" href="/profile/<?php echo e($item->user->id); ?>"><?php echo e($item->user->username); ?></a>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($item->users != null): ?>
                                <?php $__currentLoopData = $item->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a title="<?php echo e($u->name); ?>" href="/profile/<?php echo e($u->id); ?>"><?php echo e($u->username); ?></a>
                                    <br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo e(!empty($item->category) ? $item->category->title : ''); ?></td>
                        <td class="text-center">
                            <?php if($item->mode == 'open'): ?>
                                <b class="f-w-b"><?php echo e(trans('admin.pending')); ?></b>
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
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Support','Closed Tickets']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/ticket/listclose.blade.php ENDPATH**/ ?>