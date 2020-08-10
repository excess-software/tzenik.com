<div class="<?php echo e((empty($answer) or (!empty($loop) and $loop->iteration == 1)) ? 'main-row-answer' : ''); ?> answer-box" style="display: flex;align-items: center">
    <div class="col-md-12 answer-card">
        <div class="form-group">
            <label class="control-label tab-con"><?php echo e(trans('main.answer')); ?></label>
            <button type="button" class="btn btn-xs remove-btn btn-danger pull-right <?php echo e(!empty($answer) ? 'show' : ''); ?>" style="margin-bottom: 12px"><i class="mdi mdi-close"></i></button>

            <input type="text" name="answers[<?php echo e((empty($answer) or (!empty($loop) and $loop->iteration == 1)) ? 'record' : $answer->id); ?>][title]" value="<?php echo e(!empty($answer) ? $answer->title : ''); ?>" placeholder="<?php echo e(trans('main.add_answer')); ?>" class="form-control">
            <div class="help-block"></div>
        </div>
        <div class="row">
            <div class="col-md-8 pull-left">
                <div class="form-group">
                    <label class="control-label"><?php echo e(trans('main.images')); ?></label>
                    <div style="display: flex">
                        <button type="button" data-input="answer_image" data-preview="holder" class="lfm-btn btn btn-primary">
                            Choose
                        </button>
                        <input name="answers[<?php echo e((empty($answer) or (!empty($loop) and $loop->iteration == 1)) ? 'record' : $answer->id); ?>][image]" value="<?php echo e(!empty($answer) ? $answer->image : ''); ?>" id="answer_image" class="form-control lfm-input" dir="ltr" type="text">
                    </div>
                </div>
            </div>

            <div class="col-md-4 pull-left">
                <div class="form-group">
                    <label class="control-label tab-con"><?php echo e(trans('main.correct')); ?></label>
                    <div class="switch switch-sm switch-primary" style="width: 100%">
                        <input type="hidden" class="correct-toggle" value="0" name="answers[<?php echo e((empty($answer) or (!empty($loop) and $loop->iteration == 1)) ? 'record' : $answer->id); ?>][correct]">
                        <input type="checkbox" class="correct-toggle" name="answers[<?php echo e((empty($answer) or (!empty($loop) and $loop->iteration == 1)) ? 'record' : $answer->id); ?>][correct]" <?php if(!empty($answer) and $answer->correct): ?> checked <?php endif; ?> value="1" data-plugin-ios-switch/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\proacademy\resources\views/web/default/user/quizzes/multiple_answer_form.blade.php ENDPATH**/ ?>