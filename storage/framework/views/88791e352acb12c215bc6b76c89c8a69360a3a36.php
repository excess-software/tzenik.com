<?php $__env->startSection('title'); ?>
    <?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : ''); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
    <!-- MultiStep Form -->
    <div class="container-fluid" id="grad1">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2 quiz-wizard">
                <div class="card quiz-result">
                    <div class="card-header d-flex align-items-center">
                        <div>
                            <div>
                                <h2 class="quiz-name"><?php echo e($quiz->name); ?></h2>
                                <span class="course-name d-block"><?php echo e($quiz->content->title); ?></span>
                            </div>
                            <div class="quiz-info">
                                <span>Question : <small><?php echo e(count($quiz->questions)); ?></small></span>
                                <span>Pass Mark : <small><?php echo e($quiz->pass_mark); ?></small></span>
                                <span>Total Mark : <small><?php echo e((count($quiz->questionsGradeSum) > 0) ? $quiz->questionsGradeSum[0]->grade_sum : 0); ?></small></span>
                            </div>
                        </div>
                        <div class="result-mark <?php echo e($quiz_result->status); ?>">
                            <strong><?php echo e($quiz_result->user_grade); ?></strong>
                            <span>(<?php echo e($quiz_result->status == 'pass' ? trans('main.passed') : ($quiz_result->status == 'fail' ? trans('main.failed') : trans('main.waiting'))); ?>)</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="result-card">
                                <img src="/assets/default/images/<?php echo e($quiz_result->status == 'pass' ? 'winners.png' : 'feeling.png'); ?>" alt="">
                                <h3 class="result-msg"><?php echo e($quiz_result->status == 'pass' ? trans('main.quiz_winners') : ($quiz_result->status == 'fail' ? trans('main.quiz_feeling') : trans('main.quiz_waiting'))); ?></h3>
                                <?php if($quiz_result->status == 'fail' and $canTryAgain): ?>
                                    <a href="/user/quizzes/<?php echo e($quiz->id); ?>/start" class="btn btn-custom btn-danger"><?php echo e(trans('main.try_again')); ?></a>
                                    <?php elseif($quiz_result->status == 'pass' and $quiz->certificate): ?>
                                    <a href="/user/certificates/<?php echo e($quiz_result->id); ?>/download" class="btn btn-custom btn-danger"><?php echo e(trans('main.download_certificate')); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function () {

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/quizzes/student_results.blade.php ENDPATH**/ ?>