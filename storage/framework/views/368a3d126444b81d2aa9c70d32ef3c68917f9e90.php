<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.certificates_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="card">
        <header class="card-header">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title"><?php echo e(trans('admin.filter_items')); ?></h2>
        </header>
        <div class="card-body">
            <form>
                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="text-center form-control text-left" value="<?php echo e(request()->get('student_name') ?? ''); ?>" name="student_name" placeholder="Student Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="text-center form-control text-left" value="<?php echo e(request()->get('instructor') ?? ''); ?>" name="instructor" placeholder="Instructor Name">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="text" class="text-center form-control text-left" value="<?php echo e(request()->get('quiz_name') ?? ''); ?>" name="quiz_name" placeholder="Quiz Name">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="submit" class="text-center btn btn-primary w-100" value="Filter Items">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
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
                        <th class="text-center"><?php echo e(trans('main.time_and_date')); ?></th>
                        <th class="text-center" width="100"><?php echo e(trans('admin.th_controls')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $certificates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $certificate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><?php echo $certificate->id; ?></td>
                            <td>
                                <?php echo e($certificate->quiz->name); ?>

                                <small class="d-block">(<?php echo e($certificate->quiz->content->title); ?>)</small>
                            </td>
                            <td class="text-center"><?php echo e($certificate->student->name); ?></td>
                            <td class="text-center"><?php echo e($certificate->quiz->user->name); ?></td>
                            <td class="text-center"><?php echo e($certificate->user_grade); ?></td>
                            <td class="text-center"><?php echo e(date('Y-m-d | H:i', $certificate->created_at)); ?></td>
                            <td class="text-center">
                                <a href="/admin/certificates/<?php echo e($certificate->id); ?>/download" data-toggle="tooltip" title="<?php echo e(trans('admin.download')); ?>">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center">
            
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Quizzes','Latest Quizzes']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/certificates/list.blade.php ENDPATH**/ ?>