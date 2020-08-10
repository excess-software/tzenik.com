<?php $__env->startSection('tab2','active'); ?>

<?php $__env->startSection('tab'); ?>
    <div class="h-20"></div>
    <div class="off-filters-li" style="padding: 15px">
        <div class="table-responsive">
            <table class="table ucp-table" id="request-table">
                <thead class="thead-s">
                <th class="cell-ta"><?php echo e(trans('main.name')); ?></th>
                <th class="text-center"><?php echo e(trans('main.course')); ?></th>
                <th class="text-center"><?php echo e(trans('main.you_grade')); ?></th>
                <th class="text-center"><?php echo e(trans('main.quiz_grade')); ?></th>
                <th class="text-center"><?php echo e(trans('main.time_and_date')); ?></th>
                <th class="text-center"><?php echo e(trans('main.controls')); ?></th>
                </thead>
                <tbody>
                <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($certificate->quiz->name); ?></td>
                        <td class="text-center"><?php echo e($certificate->quiz->content->title); ?></td>
                        <td class="text-center"><?php echo e($certificate->user_grade); ?></td>
                        <td class="text-center"><?php echo e($certificate->quiz->pass_mark); ?></td>
                        <td class="text-center"><?php echo e(date('Y-m-d | H:i', $certificate->created_at)); ?></td>
                        <td class="text-center">
                            <a href="/user/certificates/<?php echo e($certificate->id); ?>/download" class="btn btn-success btn-round"><?php echo e(trans('main.download')); ?></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.layout_user.quizzes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/certificates/lists.blade.php ENDPATH**/ ?>