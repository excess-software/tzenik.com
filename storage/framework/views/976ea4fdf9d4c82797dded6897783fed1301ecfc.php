
<?php $__env->startSection('title'); ?>
<?php echo e(trans('Edit quiz')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

<section class="card">
    <div class="card-body">

        <form action="/user/quizzes/<?php echo e(!empty($quiz) ? 'update/'.$quiz->id : 'store'); ?>" method="post" class="form">
            <?php echo e(csrf_field()); ?>


            <div class="row">
                <div class="col-md-6 pull-left">
                    <div class="form-group <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <label class="control-label tab-con"><?php echo e(trans('main.quiz_name')); ?></label>
                        <input type="text" name="name" value="<?php echo e(!empty($quiz) ? $quiz->name : old('name')); ?>"
                            class="form-control">
                        <div class="help-block"><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 pull-left">
                    <div class="form-group <?php $__errorArgs = ['content_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <label class="control-label tab-con"><?php echo e(trans('main.course')); ?></label>
                        <select name="content_id" class="form-control font-s">
                            <option selected disabled><?php echo e(trans('main.select_course')); ?></option>
                            <?php $__currentLoopData = $user->contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($content->id); ?>"
                                <?php echo e((!empty($quiz) and $quiz->content_id == $content->id) ? 'selected' : ''); ?>>
                                <?php echo e($content->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="help-block"><?php $__errorArgs = ['content_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 pull-left">
                    <div class="form-group">
                        <label class="control-label tab-con"><?php echo e(trans('main.quiz_time')); ?>

                            (<?php echo e(trans('main.minute')); ?>)</label>
                        <input type="number" name="time" value="<?php echo e(!empty($quiz) ? $quiz->time : old('time')); ?>"
                            placeholder="Empty means infinity" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 pull-left">
                    <div class="form-group">
                        <label class="control-label tab-con"><?php echo e(trans('main.quiz_number_attempt')); ?></label>
                        <input type="number" name="attempt"
                            value="<?php echo e(!empty($quiz) ? $quiz->attempt : old('attempt')); ?>"
                            placeholder="Empty means infinity" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 pull-left">
                    <div class="form-group <?php $__errorArgs = ['pass_mark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <label class="control-label tab-con"><?php echo e(trans('main.quiz_pass_mark')); ?></label>
                        <input type="number" name="pass_mark"
                            value="<?php echo e(!empty($quiz) ? $quiz->pass_mark : old('pass_mark')); ?>" class="form-control">
                        <div class="help-block"><?php $__errorArgs = ['pass_mark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="custom-switches-stacked col-md-6">
                    <label class="control-label tab-con"><?php echo e(trans('main.certificate')); ?></label>
                    <label class="custom-switch">
                        <input type="hidden" name="certificate" value="0">
                        <input type="checkbox" name="certificate" value="1" class="custom-switch-input"
                            <?php echo e((!empty($quiz) and $quiz->certificate) ? 'checked' : ''); ?> />
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 pull-left">
                    <div class="form-group">
                        <label class="control-label tab-con"><?php echo e(trans('main.status')); ?></label>
                        <select name="status" class="form-control font-s">
                            <option value="disabled"
                                <?php echo e((!empty($quiz) and $quiz->status == 'disabled') ? 'selected' : ''); ?>>
                                <?php echo e(trans('main.disabled')); ?></option>
                            <option value="active"
                                <?php echo e((!empty($quiz) and $quiz->status == 'active') ? 'selected' : ''); ?>>
                                <?php echo e(trans('main.active')); ?></option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 pull-left">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <span><?php echo e(trans('main.save_changes')); ?></span>
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.vendor.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/vendor/quizzes/newquiz.blade.php ENDPATH**/ ?>