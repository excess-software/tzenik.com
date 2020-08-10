<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.new_notification')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <?php if(!empty(session('status'))): ?>
        <?php if(session('status') == 'error'): ?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong><?php echo e(trans('admin.notification_send_failed')); ?></strong>
            </div>
        <?php else: ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <strong>
                    <?php echo e(trans('admin.notification_sent_successfully')); ?>

                </strong>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <section class="card">
        <div class="card-body">
            <form action="/admin/notification/store" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                    <div class="col-md-11">
                        <input type="text" name="title" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.receipts')); ?></label>
                    <div class="col-md-11">
                        <select name="recipent_type" class="form-control select2 recipent_selection">
                            <option value=""></option>
                            <option value="userone" <?php if(!empty(request()->get('recipent_type')) and request()->get('recipent_type') == 'userone'): ?> selected <?php endif; ?>><?php echo e(trans('admin.single_user')); ?></option>
                            <option value="users" <?php if(!empty(request()->get('recipent_type')) and request()->get('recipent_type') == 'users'): ?> selected <?php endif; ?>><?php echo e(trans('admin.users_list')); ?></option>
                            <option value="category" <?php if(!empty(request()->get('recipent_type')) and request()->get('recipent_type') == 'category'): ?> selected <?php endif; ?>><?php echo e(trans('admin.user_groups')); ?></option>
                            <option value="seller"><?php echo e(trans('admin.vendors')); ?></option>
                            <option value="buyer"><?php echo e(trans('admin.cusomers')); ?></option>
                            <option value="female"><?php echo e(trans('admin.females')); ?></option>
                            <option value="male"><?php echo e(trans('admin.males')); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group recipent" id="users">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.users')); ?></label>
                    <div class="col-md-11" dir="ltr">
                        <select name="recipent_list_users[]" multiple class="form-control selectric text-left">
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>"><?php echo e($user->username); ?> (<?php echo e($user->name); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group <?php if(empty(request()->get('recipent_type')) or request()->get('recipent_type') != 'userone'): ?> recipent <?php endif; ?>" id="userone">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.user')); ?></label>
                    <div class="col-md-11">
                        <select name="recipent_list_user" class="form-control selectric">
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>" <?php if(!empty(request()->get('uid')) and request()->get('uid') == $user->id): ?> selected <?php endif; ?>><?php echo e($user->username); ?> (<?php echo e($user->name); ?>)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group recipent" id="category">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.user_group')); ?></label>
                    <div class="col-md-11">
                        <select name="recipent_list_category" class="form-control selectric">
                            <?php $__currentLoopData = $userCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="msg" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.send')); ?></button>
                    </div>
                </div>

            </form>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {
            $('.recipent_selection').change(function () {
                $('.recipent').hide();
                $('#' + $(this).val()).slideDown(300);
            })
        })
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Notifications','New Notification']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/notification/new.blade.php ENDPATH**/ ?>