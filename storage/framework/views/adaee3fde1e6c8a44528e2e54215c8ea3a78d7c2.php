
<?php $__env->startSection('title'); ?>
<?php echo e(trans('admin.quizzes')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

<section class="card">
    <div class="card-body">

        <div class="row">
            <div class="col-md-12">

                <?php if(empty($quiz)): ?>
                <div class="link">
                    <h2><?php echo e(trans('main.quizzes_list')); ?></h2><i class="mdi mdi-chevron-down"></i>
                </div>
                <ul class="submenu dblock">
                    <div class="h-10"></div>
                    
                    <?php if(empty($quizzes)): ?>
                    <div class="text-center">
                        <img src="/assets/default/images/empty/Request.png">
                        <div class="h-20"></div>
                        <span class="empty-first-line"><?php echo e(trans('main.no_quizzes')); ?></span>
                        <div class="h-10"></div>

                        <div class="h-20"></div>
                    </div>
                    <?php else: ?>
                    <div class="table-responsive">
                        <table class="table ucp-table" id="request-table">
                            <thead class="thead-s">
                                <th class="cell-ta"><?php echo e(trans('main.name')); ?></th>
                                <th class="text-center"><?php echo e(trans('main.students')); ?></th>
                                <th class="text-center"><?php echo e(trans('main.questions')); ?></th>
                                <th class="text-center"><?php echo e(trans('main.average_grade')); ?></th>
                                <th class="text-center"><?php echo e(trans('main.review_needs')); ?></th>
                                <th class="text-center"><?php echo e(trans('main.status')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('main.controls')); ?></th>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center">
                                        <?php echo e($quiz->name); ?>

                                        <small class="dblock">(<?php echo e($quiz->content->title); ?>)</small>
                                    </td>
                                    <td class="text-center"><?php echo e(count($quiz->QuizResults)); ?></td>
                                    <td class="text-center"><?php echo e(count($quiz->questions)); ?></td>
                                    <td class="text-center"><?php echo e($quiz->average_grade); ?></td>
                                    <td class="text-center"><?php echo e($quiz->review_needs); ?></td>
                                    <td class="text-center">
                                        <?php if($quiz->status == 'active'): ?>
                                        <b class="c-g"><?php echo e(trans('admin.active')); ?></b>
                                        <?php else: ?>
                                        <span class="c-r"><?php echo e(trans('admin.disabled')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center" width="250">
                                        <a href="/user/vendor/quizzes/edit/<?php echo e($quiz->id); ?>" class="gray-s"
                                            data-toggle="tooltip" title="<?php echo e(trans('main.edit_quizzes')); ?>"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="/user/vendor/quizzes/<?php echo e($quiz->id); ?>/questions" class="gray-s"
                                            data-toggle="tooltip" title="<?php echo e(trans('main.questions')); ?>">
                                            <i class="fa fa-question"></i>
                                        </a>
                                        <a href="/user/vendor/quizzes/<?php echo e($quiz->id); ?>/results" class="gray-s"
                                            data-toggle="tooltip" title="<?php echo e(trans('main.show_results')); ?>">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button data-id="<?php echo e($quiz->id); ?>" class="btn-transparent"
                                            data-toggle="tooltip" title="<?php echo e(trans('main.delete')); ?>" style="color: red;"><i
                                                class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="h-10"></div>
                    <?php endif; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.vendor.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/vendor/quizzes/list.blade.php ENDPATH**/ ?>