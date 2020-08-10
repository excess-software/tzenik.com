<?php $__env->startSection('title'); ?>
    <?php echo e($edit->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <form action="/admin/channel/store/<?php echo e($edit->id); ?>" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.channel_title')); ?></label>
                    <div class="col-md-11">
                        <input type="text" name="title" value="<?php echo e($edit->title); ?>" class="form-control" id="inputDefault">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-1 control-label" for="inputDefault"><?php echo e(trans('admin.channel_id')); ?></label>
                    <div class="col-md-11">
                        <input type="text" name="username" value="<?php echo e($edit->username); ?>" class="form-control" id="inputDefault" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-1 control-label"><?php echo e(trans('admin.channel_cover')); ?></label>
                    <div class="col-md-11">
                        <div class="input-group" style="display: flex">
                            <button type="button" data-input="image" data-preview="holder" class="lfm_image btn btn-primary">
                                Choose
                            </button>
                            <input id="image" class="form-control" type="text" name="image" dir="ltr" required value="<?php echo e($edit->image); ?>">
                            <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="image">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-1 control-label"><?php echo e(trans('admin.channel_icon')); ?></label>
                    <div class="col-md-11">
                        <div class="input-group" style="display: flex">
                            <button type="button" data-input="avatar" data-preview="holder" class="lfm_image btn btn-primary">
                                Choose
                            </button>
                            <input id="avatar" class="form-control" type="text" name="avatar" dir="ltr" required value="<?php echo e($edit->avatar); ?>">
                            <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="avatar">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--
                <div class="form-group">
                    <label class="col-md-1 control-label"><?php echo e(trans('admin.documents')); ?></label>
                    <div class="col-md-11">
                        <div class="input-group" style="display: flex">
                            <button type="button" data-input="attach" data-preview="holder" class="lfm_image btn btn-primary">
                                Choose
                            </button>
                            <input id="attach" class="form-control" type="text" name="attach" dir="ltr" required value="<?php echo e($edit->attach); ?>">
                            <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="attach">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                -->

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="description" required><?php echo e($edit->description); ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label"><?php echo e(trans('admin.verification_status')); ?></label>
                    <div class="col-md-11">
                        <select name="formal" class="form-control populate">
                            <option value="ok" <?php echo e($edit->formal == 'ok' ? 'selected="selected"' : ''); ?>><?php echo e(trans('admin.verified')); ?></option>
                            <option value="none" <?php echo e($edit->formal == 'none' ? 'selected="selected"' : ''); ?>><?php echo e(trans('admin.not_verified')); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-1 control-label"><?php echo e(trans('admin.th_status')); ?></label>
                    <div class="col-md-11">
                        <select name="mode" class="form-control populate">
                            <option value="active" <?php echo e($edit->mode=='active' ? 'selected="selected"' : ''); ?>><?php echo e(trans('admin.active')); ?></option>
                            <option value="deactive" <?php echo e($edit->mode=='deactive' ? 'selected="selected"' : ''); ?>><?php echo e(trans('admin.disabled')); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-1 control-label"></label>
                    <div class="col-md-11">
                        <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                    </div>
                </div>

            </form>
        </div>
    </section>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Users','Channel',$edit->title]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/user/channeledit.blade.php ENDPATH**/ ?>