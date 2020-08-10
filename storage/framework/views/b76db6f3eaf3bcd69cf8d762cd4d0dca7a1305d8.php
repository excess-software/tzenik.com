<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.notification_template')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <p><?php echo e(trans('admin.username')); ?> : [u.username]</p>
            <hr>
            <p><?php echo e(trans('admin.real_name')); ?> : [u.name]</p>
            <hr>
            <p><?php echo e(trans('admin.email')); ?> : [u.email]</p>
            <hr>
            <p><?php echo e(trans('admin.new_user_group_title')); ?> : [u.c.title]</p>
            <hr>
            <p><?php echo e(trans('admin.badge_title')); ?> : [u.m.title]</p>
            <hr>
            <p><?php echo e(trans('admin.course_title')); ?> : [c.title]</p>
            <hr>
            <p><?php echo e(trans('admin.item_doc')); ?> : [c.id]</p>
            <hr>
            <p><?php echo e(trans('admin.course_req_title')); ?> : [r.title]</p>
            <hr>
            <p><?php echo e(trans('admin.support_ticket_title')); ?> : [t.title]</p>
            <hr>
            <p><?php echo e(trans('admin.financial_doc_amount')); ?> : [b.amount]</p>
            <hr>
            <p><?php echo e(trans('admin.financial_doc_desc')); ?> : [b.description]</p>
            <hr>
            <p><?php echo e(trans('admin.financial_doc_type')); ?> : [b.type]</p>
        </div>
    </section>

    <section class="card">
        <div class="card-body">

            <form action="/admin/notification/template/edit" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id" value="<?php echo e($item->id ?? ''); ?>">
                <div class="form-group">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                    <div class="col-md-11">
                        <input type="text" name="title" class="form-control" value="<?php echo e($item->title ?? ''); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="template" required>
                                <?php echo e($item->template ?? ''); ?>

                        </textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                    </div>
                </div>

            </form>
        </div>
    </section>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Notifications','Templates']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/notification/templateitem.blade.php ENDPATH**/ ?>