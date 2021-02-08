<?php $__env->startSection('title'); ?>
<?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : ''); ?>

- <?php echo e($quiz->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="/assets/default/clock-counter/flipTimer.css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- MultiStep Form -->
<div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="btn-cerrar-test">
                    <a href="javascript:history.back()"><i class="fa fa-times-circle-o fa-4x"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="container-fluid">
        <div class="col-md-10 titulo-test">
            <div class="row">
                <div class="col-md-6">
                    <h3><b><?php echo e($quiz->name); ?></b></h3>
                    <br>
                    <b>
                        <p><?php echo e(count($quiz->questions)); ?> preguntas</p>
                    </b>
                </div>
                <div class="col-md-6">
                    <h1 class="pull-right">15:00</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container-fluid" id="grad1">
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2 quiz-wizard">
            <div class="card">

                <div class="row">
                    <div class="col-md-12">
                        <form id="quizForm" action="/user/quizzes/<?php echo e($quiz->id); ?>/store_results" method="get"
                            class="quiz-form">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="quiz_result_id" value="<?php echo e($newQuizStart->id); ?>">
                            <?php $__currentLoopData = $quiz->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($loop->iteration > 1): ?>
                            <fieldset style="display: none;" id="pregunta<?php echo e($loop->iteration); ?>">
                                <input type="hidden" name="question[<?php echo e($question->id); ?>]" value="<?php echo e($question->id); ?>">
                                <div class="form-card">
                                    <h1 class="question-title"><b><?php echo e($loop->iteration); ?> - <?php echo e($question->title); ?></b></h1>
                                    <?php if($question->type == 'multiple' and count($question->questionsAnswers)): ?>
                                    <div class="answer-items">
                                        <?php $__currentLoopData = $question->questionsAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(empty($answer->image)): ?>
                                        <div class="form-radio">
                                            <input id="asw<?php echo e($answer->id); ?>" type="radio"
                                                name="question[<?php echo e($question->id); ?>][answer]" value="<?php echo e($answer->id); ?>">
                                            <label class="answer-label" for="asw<?php echo e($answer->id); ?>">
                                                <span class="answer-title"><?php echo e($answer->title); ?></span>
                                            </label>
                                        </div>
                                        <?php elseif(!empty($answer->image)): ?>
                                        <div class="form-radio">
                                            <input id="asw<?php echo e($answer->id); ?>" type="radio"
                                                name="question[<?php echo e($question->id); ?>][answer]" value="<?php echo e($answer->id); ?>">
                                            <label for="asw<?php echo e($answer->id); ?>">
                                                <b>
                                                    <h2><?php echo e($answer->title); ?></h2>
                                                </b>
                                                <div class="image-container">
                                                    <img src="<?php echo e($answer->image); ?>" class="fit-image" alt="">
                                                </div>
                                            </label>
                                        </div>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php elseif($question->type == 'descriptive'): ?>
                                    <textarea name="question[<?php echo e($question->id); ?>][answer]" rows="6"
                                        class="form-control textarea-respuestas-test"></textarea>
                                    <?php endif; ?>
                                </div>
                                <div class="card-actions d-flex align-items-center">
                                    <?php if($loop->iteration > 1): ?>
                                    <button type="button" class="action-button previous btn btn-custom" onclick="prev(<?php echo e($loop->iteration); ?>)">prev
                                        Step</button>
                                    <?php endif; ?>
                                    <?php if($loop->iteration < $loop->count): ?>
                                        <button type="button" class="action-button next btn btn-custom" onclick="next(<?php echo e($loop->iteration); ?>)">Next
                                            Step</button>
                                        <?php endif; ?>
                                        <button type="button"
                                            class="action-button finish btn btn-danger btn-danger-custom">finish</button>
                                </div>
                            </fieldset>
                            <?php else: ?>
                            <fieldset id="pregunta<?php echo e($loop->iteration); ?>">
                                <input type="hidden" name="question[<?php echo e($question->id); ?>]" value="<?php echo e($question->id); ?>">
                                <div class="form-card">
                                    <h1 class="question-title"><b><?php echo e($loop->iteration); ?> - <?php echo e($question->title); ?></b></h1>
                                    <?php if($question->type == 'multiple' and count($question->questionsAnswers)): ?>
                                    <div class="answer-items">
                                        <?php $__currentLoopData = $question->questionsAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(empty($answer->image)): ?>
                                        <div class="form-radio">
                                            <input id="asw<?php echo e($answer->id); ?>" type="radio"
                                                name="question[<?php echo e($question->id); ?>][answer]" value="<?php echo e($answer->id); ?>">
                                            <label class="answer-label" for="asw<?php echo e($answer->id); ?>">
                                                <span class="answer-title"><?php echo e($answer->title); ?></span>
                                            </label>
                                        </div>
                                        <?php elseif(!empty($answer->image)): ?>
                                        <div class="form-radio">
                                            <input id="asw<?php echo e($answer->id); ?>" type="radio"
                                                name="question[<?php echo e($question->id); ?>][answer]" value="<?php echo e($answer->id); ?>">
                                            <label for="asw<?php echo e($answer->id); ?>">
                                                <b>
                                                    <h2><?php echo e($answer->title); ?></h2>
                                                </b>
                                                <div class="image-container">
                                                    <img src="<?php echo e($answer->image); ?>" class="fit-image" alt="">
                                                </div>
                                            </label>
                                        </div>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php elseif($question->type == 'descriptive'): ?>
                                    <textarea name="question[<?php echo e($question->id); ?>][answer]" rows="6"
                                        class="form-control textarea-respuestas-test"></textarea>
                                    <?php endif; ?>
                                </div>
                                <div class="card-actions d-flex align-items-center">
                                    <?php if($loop->iteration > 1): ?>
                                    <button type="button" class="action-button previous btn btn-custom" onclick="prev(<?php echo e($loop->iteration); ?>)">prev
                                        Step</button>
                                    <?php endif; ?>
                                    <?php if($loop->iteration < $loop->count): ?>
                                        <button type="button" class="action-button next btn btn-custom" onclick="next(<?php echo e($loop->iteration); ?>)">Next
                                            Step</button>
                                        <?php endif; ?>
                                        <button type="button"
                                            class="action-button finish btn btn-danger btn-danger-custom">finish</button>
                                </div>
                            </fieldset>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="finishModal" class="modal fade modal-quiz" role="dialog">
    <div class="modal-dialog zinun modal-quiz-dialog">
        <!-- Modal content-->
        <div class="modal-content modal-sm">
            <div class="modal-body modst2">
                <p><?php echo e(trans('main.finish_quiz_alert')); ?></p>
                <div class="d-flex align-items-center qalrt">
                    <button id="SubmitResult" class=" btn btn-custom">
                        <?php echo e(trans('main.yes_sure')); ?>

                    </button>
                    <button type="button" data-dismiss="modal"
                        class="btn btn-danger-custom"><?php echo e(trans('main.cancel')); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="application/javascript" src="/assets/default/clock-counter/jquery.flipTimer.js"></script>
<script>
    "use strict";
    $(document).ready(function () {
       

        /*$(".previous").on('click', function () {

            current_fs = $(this).parent().parent();
            previous_fs = $(this).parent().parent().prev();

            previous_fs.show();


            current_fs.animate({
                opacity: 0
            }, {
                step: function (now) {
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });*/

        $('body').on('click', '.action-button.finish', function (e) {
            e.preventDefault();
            $('#finishModal').modal('show');
        });

        $('body').on('click', '#SubmitResult', function (e) {
            e.preventDefault();
            $('#quizForm').submit();
        });
    });
    function next(iteration){
        var current_fs = $('#pregunta'+iteration);
        var iterationnext = iteration + 1;
        var next_fs = $('#pregunta'+iterationnext);
        next_fs.show();
        current_fs.hide();
        /*current_fs.animate({
                step: function (now) {
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });*/
    }
    function prev(iteration){
        var current_fs = $('#pregunta'+iteration);
        var iterationprev = iteration - 1;
        var prev_fs = $('#pregunta'+iterationprev);
        prev_fs.show();
        current_fs.hide();
        /*current_fs.animate({
                step: function (now) {
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });*/
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/quizzes/start.blade.php ENDPATH**/ ?>