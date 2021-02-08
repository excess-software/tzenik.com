<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.quizzes_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <a href="/admin/quizzes/excel" class="btn btn-primary">Export as xls</a>
    <div class="h-10"></div>
    <section class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none" id="datatable-details">
                    <thead>
                    <tr>
                        <th class="text-center" width="30">#</th>
                        <th><?php echo e(trans('admin.th_name')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.instructor')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.question_count')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.students_count')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.average_grade')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.certificate')); ?></th>
                        <th class="text-center" width="50"><?php echo e(trans('admin.th_status')); ?></th>
                        <th class="text-center" width="100"><?php echo e(trans('admin.th_controls')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo $quiz->id; ?></td>
                            <td>
                                <?php echo e($quiz->name); ?>

                                <small class="d-block">(<?php echo e($quiz->content->title); ?>)</small>
                            </td>
                            <td class="text-center"><?php echo e($quiz->user->name); ?></td>
                            <td class="text-center">
                                <?php echo e(count($quiz->questions)); ?>

                            </td>
                            <td class="text-center">
                                <?php echo e(count($quiz->QuizResults)); ?>

                                <span class="d-block">(<?php echo e(trans('main.passed')); ?>: <?php echo e($quiz->passed); ?>)</span>
                            </td>
                            <td class="text-center"><?php echo e($quiz->average_grade); ?></td>
                            <td class="text-center"><?php echo e(($quiz->certificate) ? trans('admin.yes') : trans('admin.no')); ?></td>

                            <td class="text-center">
                                <?php if($quiz->status == 'active'): ?>
                                    <b class="c-g"><?php echo e(trans('admin.active')); ?></b>
                                <?php else: ?>
                                    <span class="c-r"><?php echo e(trans('admin.disabled')); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="/admin/quizzes/<?php echo e($quiz->id); ?>/results" data-toggle="tooltip" title="<?php echo e(trans('admin.quiz_results')); ?>">
                                    <i class="fa fa-poll-h fa-2x" aria-hidden="true"></i>
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center">
            <?php echo $quizzes->links('pagination.default'); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Quizzes','Latest Quizzes']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/quizzes/list.blade.php ENDPATH**/ ?>