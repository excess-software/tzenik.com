<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.default_placeholders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <div class="card">

        <div class="card-body">
            <div id="images" class="tab-pane active">
                <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo e(trans('admin.user_avatar')); ?></label>
                        <div class="col-md-6">
                            <div class="input-group" style="display: flex">
                                <button type="button" data-input="default_user_avatar" data-preview="holder" class="lfm_image btn btn-primary">
                                    Choose
                                </button>
                                <input id="default_user_avatar" class="form-control" type="text" name="default_user_avatar" dir="ltr" value="<?php echo e($_setting['default_user_avatar'] ?? ''); ?>" placeholder="Displays as default users profile picture">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="default_user_avatar">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo e(trans('admin.user_profile_cover')); ?></label>
                        <div class="col-md-6">
                            <div class="input-group" style="display: flex">
                                <button type="button" data-input="default_user_cover" data-preview="holder" class="lfm_image btn btn-primary">
                                    Choose
                                </button>
                                <input id="default_user_cover" class="form-control" type="text" name="default_user_cover" dir="ltr" value="<?php echo e($_setting['default_user_cover'] ?? ''); ?>" placeholder="Displays as user profile header background (1920*200px)">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="default_user_cover">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo e(trans('admin.channel_icon')); ?></label>
                        <div class="col-md-6">
                            <div class="input-group" style="display: flex">
                                <button type="button" data-input="default_chanel_icon" data-preview="holder" class="lfm_image btn btn-primary">
                                    Choose
                                </button>
                                <input id="default_chanel_icon" class="form-control" type="text" name="default_chanel_icon" dir="ltr" value="<?php echo e($_setting['default_chanel_icon'] ?? ''); ?>" placeholder="Displays as default channel icon">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="default_chanel_icon">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo e(trans('admin.channel_cover')); ?></label>
                        <div class="col-md-6">
                            <div class="input-group" style="display: flex">
                                <button type="button" data-input="default_chanel_cover" data-preview="holder" class="lfm_image btn btn-primary">
                                    Choose
                                </button>
                                <input id="default_chanel_cover" class="form-control" type="text" name="default_chanel_cover" dir="ltr" value="<?php echo e($_setting['default_chanel_cover'] ?? ''); ?>" placeholder="Displays as channel header background (1920*200px)">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="default_chanel_cover">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo e(trans('admin.customer_dashboard_cover')); ?></label>
                        <div class="col-md-6">
                            <div class="input-group" style="display: flex">
                                <button type="button" data-input="default_customer_dashboard_cover" data-preview="holder" class="lfm_image btn btn-primary">
                                    Choose
                                </button>
                                <input id="default_customer_dashboard_cover" class="form-control" type="text" name="default_customer_dashboard_cover" dir="ltr" value="<?php echo e($_setting['default_customer_dashboard_cover'] ?? ''); ?>" placeholder="Displays as Customer Dashboard Cover (1920*200px)">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="default_customer_dashboard_cover">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Settings','Default Placeholders']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/setting/default.blade.php ENDPATH**/ ?>