<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.new_financial_doc')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
    <section class="card">
        <div class="card-body">
            <form action="/admin/balance/store" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                    <div class="col-md-8">
                        <input type="text" name="title" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo e(trans('admin.amount')); ?></label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="number" name="price" required class="form-control text-center numtostr">
                            <span class="input-group-addon click-for-upload cursor-pointer"></span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.target_account')); ?></label>
                    <div class="col-md-8">
                        <select name="account" class="form-control" required>
                            <option value="credit"><?php echo e(trans('admin.account_balance')); ?></option>
                            <option value="income"><?php echo e(trans('admin.user_income')); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.document_type')); ?></label>
                    <div class="col-md-8">
                        <select name="type" class="form-control" required>
                            <option value="add" class="c-g f-w-b"><?php echo e(trans('admin.addiction')); ?></option>
                            <option value="minus" class="c-r f-w-b"><?php echo e(trans('admin.deduction')); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.username')); ?></label>
                    <div class="col-md-8">
                        <select name="user_id" data-plugin-selectTwo class="form-control populate" required>
                            <option value=""><?php echo e(trans('admin.business_account')); ?></option>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($user->id); ?>" <?php if(!empty(request()->get('user')) and request()->get('user')==$user->id): ?> selected <?php endif; ?>><?php echo e(!empty($user->name) ? $user->name : $user->username); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.description')); ?></label>
                    <div class="col-md-8">
                        <textarea class="form-control" name="description" rows="6"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-11">
                        <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                    </div>
                </div>

            </form>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Accounting','New Financial Document']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/balance/new.blade.php ENDPATH**/ ?>