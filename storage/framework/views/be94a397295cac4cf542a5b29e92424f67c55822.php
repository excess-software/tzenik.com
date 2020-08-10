<?php $__env->startSection('tab3','active'); ?>
<?php $__env->startSection('tab'); ?>
    <div class="h-20"></div>

    <div class="off-filters-li">
        <div class="result-info">
            <div class="result-info-item">
                <strong><?php echo e($quiz->name); ?></strong>
                <span><?php echo e($quiz->content->title); ?></span>
            </div>

            <div class="result-info-item">
                <strong><?php echo e(trans('main.total_results')); ?></strong>
                <span><?php echo e(count($QuizResults)); ?></span>
            </div>

            <div class="result-info-item">
                <strong><?php echo e(trans('main.waiting_results')); ?></strong>
                <span><?php echo e($waitingResults); ?></span>
            </div>

            <div class="result-info-item">
                <strong><?php echo e(trans('main.passed')); ?></strong>
                <span><?php echo e($passedResults); ?></span>
            </div>

            <div class="result-info-item">
                <strong><?php echo e(trans('main.average')); ?></strong>
                <span><?php echo e($averageResults); ?></span>
            </div>
        </div>
        <?php if(count($QuizResults) == 0): ?>
            <div class="text-center">
                <img src="/assets/default/images/empty/Videos.png">
                <div class="h-20"></div>
                <span class="empty-first-line"><?php echo e(trans('main.no_quiz_result')); ?></span>
                <div class="h-20"></div>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table ucp-table" id="content-table">
                    <thead class="thead-s">
                    <th class="text-center"><?php echo e(trans('main.student')); ?></th>
                    <th class="text-center"><?php echo e(trans('main.grade')); ?></th>
                    <th class="text-center"><?php echo e(trans('main.status')); ?></th>
                    <th class="text-center"><?php echo e(trans('main.time_and_date')); ?></th>
                    <th class="text-center" width="100"><?php echo e(trans('main.controls')); ?></th>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $QuizResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($result->student->name); ?></td>
                            <td>
                                <?php if($result->status == 'waiting'): ?>
                                    <span style="color: orange;font-size: 28px">-</span>
                                <?php else: ?>
                                    <?php echo e($result->user_grade); ?>

                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($result->status == 'pass'): ?>
                                    <span class="badge badge-success"><?php echo e(trans('main.passed')); ?></span>
                                <?php elseif($result->status == 'fail'): ?>
                                    <span class="badge badge-danger"><?php echo e(trans('main.failed')); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-warning"><?php echo e(trans('main.waiting')); ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e(date('Y-m-d | H:i', $result->created_at)); ?></td>
                            <td>
                                <?php if($quiz->hasDescriptive): ?>
                                    <button data-id="<?php echo e($result->id); ?>" class="gray-s btn-transparent review-need" data-toggle="tooltip" title="<?php echo e(trans('main.review_needs')); ?>"><span class="crticon mdi mdi-eye"></span></button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <div id="resultReview" class="modal fade" role="dialog">
        <div class="modal-dialog" style="z-index: 1050">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h3><?php echo e(trans('main.review_needs')); ?></h3>
                </div>
                <div class="modal-body" style="max-height: 550px;overflow-y: scroll">
                    <form action="/user/quizzes/results/reviewed" method="post" id="resultReviewForm">
                        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                        <input type="hidden" name="result_id" class="js_result_id" value="">
                        <div class="items"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="reviewSubmit" class="btn btn-custom"><?php echo e(trans('main.save')); ?></button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $('body').on('click', '.review-need', function (e) {
            e.preventDefault();
            var $loading = '<div class="text-center"><img src="/assets/default/images/loading.gif"/></div>';
            var result_id = $(this).attr('data-id');
            var modal = $('#resultReview');
            $('.js_result_id').val(result_id);

            modal.modal('show');
            modal.find('.modal-footer').addClass('hidden');
            modal.find('.modal-body #resultReviewForm .items').html($loading);

            var data = {
                _token: '<?php echo e(csrf_token()); ?>',
                result_id: result_id
            };

            $.post('/user/quizzes/results/get_descriptive', data, function (result) {
                if (result && result.data.length) {
                    var html = '';
                    for (var i = 0; i < result.data.length; i++) {
                        var item = result.data[i];
                        var value = '';
                        if (item.result_status !== 'waiting') {
                            value = item.result_grade;
                        }

                        html += '<div class="result-review">\n' +
                            '<h3>' + item.question + '</h3>\n';
                            if(item.answer !== '') {
                                html += '<div class="student-answer">\n' +
                                    item.answer +
                                    '</div>\n' +
                                    '<input type="text" name="review[' + item.question_id + '][grade]"  placeholder="import grade (Question grade: ' + item.question_grade + ')" value="' + value + '" class="grade-input form-control"/>\n' ;
                            } else {
                                html += '<div class="">(no answer)</div>\n' +
                                    '<input type="hidden" name="review[' + item.question_id + '][grade]" value="0" class="grade-input form-control"/>\n' ;
                            }

                        html += '</div>';
                    }

                    modal.find('.modal-body #resultReviewForm .items').html(html);
                    modal.find('.modal-footer').removeClass('hidden');
                } else {
                    modal.find('.modal-body #resultReviewForm .items').html('The user left the quiz and no result was saved');
                }
            }).fail((err) => {
                modal.modal('show');
                modal.find('.modal-body #resultReviewForm .items').html('No item');
            })
        })

        $('body').on('click', '#reviewSubmit', function (e) {
            e.preventDefault();
            var form = $('#resultReviewForm');
            var submit = true;
            /*form.find('.grade-input').each(function (index, input) {
                if ($(input).val() == '' || $(input).val() == null) {
                    $(input).next().text('this field is required');
                    submit = false;
                } else {
                    $(input).next().text('')
                }
            })*/

            if (submit) {
                form.submit();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($user['vendor'] == 1 ? getTemplate() . '.user.layout.videolayout' : getTemplate() . '.user.layout_user.videolayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/quizzes/results.blade.php ENDPATH**/ ?>