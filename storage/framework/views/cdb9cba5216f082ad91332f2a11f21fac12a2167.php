<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.user_setting')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#main" data-toggle="tab"> <?php echo e(trans('admin.user_setting')); ?> </a></li>
                    <li class="nav-item"><a class="nav-link" href="#seller" data-toggle="tab"> <?php echo e(trans('admin.vendor_settings')); ?> </a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="main" class="tab-pane active">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.activation_method')); ?></label>
                            <div class="col-md-7">
                                <select class="form-control" id="user_register_mode" name="user_register_mode">
                                    <option value="active" <?php if(isset($_setting['user_register_mode']) and $_setting['user_register_mode'] == 'active'): ?> selected <?php endif; ?>><?php echo e(trans('admin.quick_activation')); ?></option>
                                    <option value="deactive" <?php if(isset($_setting['user_register_mode']) and $_setting['user_register_mode'] == 'deactive'): ?> selected <?php endif; ?>><?php echo e(trans('admin.email_verification')); ?></option>
                                </select>
                            </div>
                        </div>

                        <?php if(isset($_setting['user_register_mode']) and $_setting['user_register_mode'] == 'deactive'): ?>
                            <div class="form-group" id="user_register_active_email">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.email_verification_template')); ?></label>
                                <div class="col-md-7">
                                    <select id="template" name="user_register_active_email" class="form-control">
                                        <option value=""></option>
                                        <?php $__currentLoopData = $template; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($temp->id); ?>" <?php if(isset($_setting['user_register_active_email']) and $temp->id == $_setting['user_register_active_email']): ?> selected <?php endif; ?>><?php echo e($temp->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.user_welcome_email')); ?></label>
                            <div class="col-md-7">
                                <select id="template" name="user_register_wellcome_email" class="form-control">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $template; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($temp->id); ?>" <?php if(isset($_setting['user_register_wellcome_email']) and $temp->id == $_setting['user_register_wellcome_email']): ?> selected <?php endif; ?>><?php echo e($temp->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.pass_change_email_template')); ?></label>
                            <div class="col-md-7">
                                <select id="template" name="user_register_reset_email" class="form-control">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $template; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($temp->id); ?>" <?php if(isset($_setting['user_register_reset_email']) and $temp->id == $_setting['user_register_reset_email']): ?> selected <?php endif; ?>><?php echo e($temp->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.new_pass_email_template')); ?></label>
                            <div class="col-md-7">
                                <select id="template" name="user_register_new_password_email" class="form-control">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $template; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($temp->id); ?>" <?php if(isset($_setting['user_register_new_password_email']) and $temp->id == $_setting['user_register_new_password_email']): ?> selected <?php endif; ?>><?php echo e($temp->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.notification_email_template')); ?></label>
                            <div class="col-md-7">
                                <select id="template" name="email_notification_template" class="form-control">
                                    <option value=""></option>
                                    <?php $__currentLoopData = $template; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($temp->id); ?>" <?php if(isset($_setting['email_notification_template']) and $temp->id == $_setting['email_notification_template']): ?> selected <?php endif; ?>><?php echo e($temp->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="seller" class="tab-pane">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.not_identity_verified_alert')); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control h-400" name="seller_not_apply"><?php echo e($_setting['seller_not_apply'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="/assets/vendor/ios7-switch/ios7-switch.js"></script>
    <script src="/assets/vendor/fuelux/js/spinner.js"></script>
    <script>
        $(document).ready(function () {
            $('#user_register_mode').change(function () {
                if($(this).val() == 'active'){
                    $('#user_register_active_email').hide();
                }else{
                    $('#user_register_active_email').show();
                }
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Settings','Users']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/setting/user.blade.php ENDPATH**/ ?>