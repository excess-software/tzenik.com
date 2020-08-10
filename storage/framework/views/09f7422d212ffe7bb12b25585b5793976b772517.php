<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.quiz_results')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <a href="/admin/quizzes/<?php echo e($quiz->id); ?>/results/excel" class="btn btn-primary">Export as xls</a>
    <div class="h-10"></div>
    <section class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none" id="datatable-details">
                    <thead>
                    <tr>
                        <th class="text-center" width="30">#</th>
                        <th><?php echo e(trans('admin.th_name')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.student')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.instructor')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.grades')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.grade_date')); ?></th>
                        <th class="text-center" width="50"><?php echo e(trans('admin.th_status')); ?></th>
                        <th class="text-center" width="100"><?php echo e(trans('admin.th_controls')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $quiz_results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo $quiz->id; ?></td>
                            <td>
                                <?php echo e($quiz->name); ?>

                                <small class="d-block">(<?php echo e($quiz->content->title); ?>)</small>
                            </td>
                            <td class="text-center"><?php echo e($result->student->name); ?></td>
                            <td class="text-center"><?php echo e($quiz->user->name); ?></td>
                            <td class="text-center"><?php echo e($result->user_grade); ?></td>
                            <td class="text-center"><?php echo e(date('Y-m-d | H:i', $result->created_at)); ?></td>

                            <td class="text-center">
                                <?php if($result->status == 'pass'): ?>
                                    <span class="badge badge-success"><?php echo e(trans('main.passed')); ?></span>
                                <?php elseif($result->status == 'fail'): ?>
                                    <span class="badge badge-danger"><?php echo e(trans('main.failed')); ?></span>
                                <?php else: ?>
                                    <span class="badge badge-warning"><?php echo e(trans('main.waiting')); ?></span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <a href="#" data-href="/admin/quizzes/<?php echo e($quiz->id); ?>/results/<?php echo e($result->id); ?>/delete" title="Delete" data-toggle="modal" data-target="#confirm-delete" class="c-r">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center">
            <?php echo $quiz_results->links('pagination.default'); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Quizzes','Result Quizzes']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\proacademy\resources\views/admin/quizzes/result.blade.php ENDPATH**/ ?>