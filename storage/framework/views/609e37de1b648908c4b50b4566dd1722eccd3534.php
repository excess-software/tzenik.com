<?php $__env->startSection('page'); ?>

    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title"><?php echo e(trans('admin.add_user_conversation')); ?></h2>
        </header>
        <div class="panel-body">
            <form method="post" action="/admin/ticket/user/store">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>">

                <div class="col-md-6">
                    <div class="form-group">
                        <select name="user_id" data-plugin-selectTwo class="form-control populate">
                            <option value=""><?php echo e(trans('admin.all_users')); ?></option>
                            <?php $__currentLoopData = $userss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>" <?php if(!empty(request()->get('user')) and request()->get('user') == $user->id): ?> selected <?php endif; ?>><?php echo e($user->username ?? $user->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <input type="submit" class="text-center btn btn-primary w-100" value="Add User To Conversation">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <a href="/admin/ticket/reply/<?php echo e($ticket->id); ?>" class="text-center btn btn-success w-100"><?php echo e(trans('admin.go_to_ticket')); ?></a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="panel">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title"><?php echo e(trans('admin.users_list')); ?> <?php echo e($ticket->title); ?></h2>
        </header>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th><?php echo e(trans('admin.username')); ?></th>
                    <th class="text-center" width="250"><?php echo e(trans('admin.real_name')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><a href="/profile/<?php echo e($user->user->id); ?>" title="<?php echo e($user->user->name); ?>"><?php echo e($user->user->username); ?></a></td>
                        <td class="text-center"><?php echo e($user->user->name); ?></td>
                        <td class="text-center" width="50">
                            <a href="#" data-href="/admin/ticket/user/delete/<?php echo e($user->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Support',$ticket->title,'Users List']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/ticket/user.blade.php ENDPATH**/ ?>