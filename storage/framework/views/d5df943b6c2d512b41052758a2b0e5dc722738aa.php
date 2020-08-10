<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.th_edit')); ?> <?php echo e(trans('admin.discounts')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="panel">
        <div class="panel-body">
            <form action="/admin/discount/store" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id" value="<?php echo e($item->id); ?>">
                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                    <div class="col-md-8">
                        <input type="text" name="title" value="<?php echo e($item->title); ?>" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.type')); ?></label>
                    <div class="col-md-8">
                        <select name="type" class="form-control populate" id="type">
                            <option value="gift" <?php if($item->type == "gift"): ?> selected <?php endif; ?>><?php echo e(trans('admin.giftcard')); ?></option>
                            <option value="off" <?php if($item->type == "off"): ?> selected <?php endif; ?>><?php echo e(trans('admin.discount_card')); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.amount')); ?></label>
                    <div class="col-md-8">
                        <input type="number" name="off" value="<?php echo e($item->off ?? '0'); ?>" class="form-control text-center" placeholder="Percent for Discount cards | Fixed amount for Giftcards" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.gift_code')); ?></label>
                    <div class="col-md-8">
                        <input type="text" name="code" value="<?php echo e($item->code); ?>" class="form-control text-center" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.expire_date')); ?></label>
                    <div class="col-md-8">
                        <div class="input-group">
                            <input type="date" id="block_date" value="<?php if(isset($item->expire_at)): ?> <?php echo e(date('Y/m/d',$item->expire_at)); ?> <?php endif; ?>" class="form-control text-center" id="inputDefault">
                            <input type="hidden" name="expire_at" id="expire_at" value="<?php if(isset($item->expire_at)): ?> <?php echo e(date('d-m-Y',$item->expire_at)); ?> <?php endif; ?>">
                            <span class="input-group-append bdatebtn" id="bdatebtn">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.th_status')); ?></label>
                    <div class="col-md-8">
                        <select name="mode" class="form-control populate" id="type">
                            <option value="publish"><?php echo e(trans('admin.active')); ?></option>
                            <option value="draft"><?php echo e(trans('admin.disabled')); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"></label>
                    <div class="col-md-8">
                        <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Discounts','Edit']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/discount/edit.blade.php ENDPATH**/ ?>