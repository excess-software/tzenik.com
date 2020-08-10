<form id="multipleAnswer" action="<?php if(!empty($question_edit)): ?> /user/questions/<?php echo e($question_edit->id); ?>/update <?php else: ?> /user/quizzes/<?php echo e($quiz->id); ?>/questions <?php endif; ?>" method="post">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="type" value="multiple">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <label class="control-label tab-con"><?php echo e(trans('main.question_title')); ?></label>
                <input type="text" name="title" value="<?php echo e(!empty($question_edit) ? $question_edit->title : ''); ?>" placeholder="<?php echo e(trans('main.question_title')); ?>" class="form-control">
                <div class="help-block"><?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?></div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group <?php $__errorArgs = ['grade'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <label class="control-label tab-con"><?php echo e(trans('main.question_grade')); ?></label>
                <input type="number" name="grade" value="<?php echo e(!empty($question_edit) ? $question_edit->grade : ''); ?>" placeholder="<?php echo e(trans('main.question_grade')); ?>" class="form-control">
                <div class="help-block"><?php $__errorArgs = ['grade'];
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
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div style="display: flex;align-items: center;margin-bottom: 24px">
                <p><?php echo e(trans('main.answer_alert')); ?></p>
                <button type="button" class="btn add-btn btn-info" style="margin-left: 16px"><i class="mdi mdi-plus"></i></button>
            </div>

            <?php if(!empty($question_edit)): ?>
                <?php $__currentLoopData = $question_edit->questionsAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make(getTemplate() .'.user.quizzes.multiple_answer_form',['answer' => $answer], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php else: ?>
                <?php echo $__env->make(getTemplate() .'.user.quizzes.multiple_answer_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
    </div>
</form>
<?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/quizzes/multiple_question_form.blade.php ENDPATH**/ ?>