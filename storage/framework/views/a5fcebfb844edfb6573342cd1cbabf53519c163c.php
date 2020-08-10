<?php $__env->startSection('title'); ?>
    <?php echo trans('admin.templates'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="card card-collapsed">
        <div class="card-body">
            <p><?php echo e(trans('admin.student')); ?> : [user] </p>
            <hr>
            <p><?php echo e(trans('admin.course')); ?> : [course] </p>
            <hr>
            <p><?php echo e(trans('admin.mark')); ?> : [grade] </p>
        </div>
    </section>

    <section class="card">
        <div class="card-body">

            <form action="/admin/certificates/templates/store" id="templateForm" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id" value="<?php echo e(!empty($template) ? $template->id : ''); ?>">
                <div class="form-group">
                    <label class="col-md-4 control-label" for="inputDefault"><?php echo trans('admin.th_title'); ?></label>
                    <div class="col-md-11">
                        <input type="text" name="title" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(!empty($template) ? $template->title : ''); ?>">
                        <div class="invalid-feedback"><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                    </div>
                </div>

                <div class="input-group " style="display: flex;margin-bottom: 24px;padding: 0 15px">
                    <button id="lfm_image" data-input="image" data-preview="holder" class="btn btn-primary">
                        Choose
                    </button>
                    <input id="image" class="form-control <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" dir="ltr" name="image" value="<?php echo e(!empty($template) ? $template->image : ''); ?>">
                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="image">
                        <span class="input-group-text">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
                <div class="invalid-feedback"><?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                <div class="h-20"></div>

                <div class="row">
                    <dov class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="inputDefault"><?php echo trans('admin.position_x'); ?></label>
                            <div class="col-md-11">
                                <input type="text" name="position_x" class="form-control <?php $__errorArgs = ['position_x'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(!empty($template) ? $template->position_x : '120'); ?>">
                                <div class="invalid-feedback"><?php $__errorArgs = ['position_x'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                            </div>
                        </div>
                    </dov>
                    <dov class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="inputDefault"><?php echo trans('admin.position_y'); ?></label>
                            <div class="col-md-11">
                                <input type="text" name="position_y" class="form-control <?php $__errorArgs = ['position_y'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(!empty($template) ? $template->position_y : '100'); ?>">
                                <div class="invalid-feedback"><?php $__errorArgs = ['position_y'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                            </div>
                        </div>
                    </dov>
                    <dov class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="inputDefault"><?php echo trans('admin.font_size'); ?></label>
                            <div class="col-md-11">
                                <input type="text" name="font_size" class="form-control <?php $__errorArgs = ['font_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(!empty($template) ? $template->font_size : '26'); ?>">
                                <div class="invalid-feedback"><?php $__errorArgs = ['font_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                            </div>
                        </div>
                    </dov>
                    <dov class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="inputDefault"><?php echo trans('admin.text_color'); ?></label>
                            <div class="col-md-11">
                                <input type="text" name="text_color" class="form-control <?php $__errorArgs = ['text_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(!empty($template) ? $template->text_color : '#e1e1e1'); ?>">
                                <div class="invalid-feedback"><?php $__errorArgs = ['text_color'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                                <div>like : (#e1e1e1) or (#ffffff) or (#000000)</div>
                            </div>
                        </div>
                    </dov>
                </div>


                <div class="form-group ">
                    <label class="col-md-4 control-label" for="inputDefault">Message body</label>
                    <div class="col-md-12">
                        <textarea class="form-control text-left  <?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" dir="ltr" rows="6" name="body" style="height: auto!important; "><?php echo e((!empty($template)) ? $template->body :''); ?></textarea>
                        <div class="invalid-feedback"><?php $__errorArgs = ['body'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="custom-switches-stacked">
                        <label class="custom-switch">
                            <input type="hidden" name="status" value="draft">
                            <input type="checkbox" name="status" value="publish" <?php echo e((!empty($template) and $template->status == 'publish') ? 'checked="checked"' : ''); ?> class="custom-switch-input"/>
                            <span class="custom-switch-indicator"></span>
                            <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.active')); ?></label>
                        </label>
                    </div>
                    <div class="h-15"></div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-left" id="submiter" type="button"><?php echo e(trans('admin.save_changes')); ?></button>
                        <button class="btn btn-danger pull-left" id="preview" type="button"><?php echo e(trans('admin.preview_certificate')); ?></button>
                    </div>
                </div>

            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm_image').filemanager('image');
        var form = $('#templateForm');
        $('#preview').click(function (e) {
            e.preventDefault();

            form.attr('target', '_blank');
            form.attr('action', '/admin/certificates/templates/preview');
            form.attr('method', 'get');
            form.submit();
        });

        $('#submiter').click(function (e) {
            e.preventDefault();
            form.removeAttr('target');
            form.attr('action', '/admin/certificates/templates/store');
            form.attr('method', 'post');
            form.submit();
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Email Template']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/certificates/create_template.blade.php ENDPATH**/ ?>