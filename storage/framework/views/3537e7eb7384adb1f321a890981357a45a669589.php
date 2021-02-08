
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.edit_post')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th width="120"><?php echo e(trans('admin.text')); ?></th>
                    <th class="text-center" width="120"><?php echo e(trans('admin.username')); ?></th>
                    <th class="text-center" width="200"><?php echo e(trans('admin.created_date')); ?></th>
                    <th class="text-center" width="200"><?php echo e(trans('admin.post')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                            <td><?php echo $item->comment; ?></td>
                            <td class="text-center"><a target="_blank" href="javascript:void(0);"><?php echo e($item->user->name ?? ''); ?></a></td>
                            <td class="text-center"><?php echo date('d F Y / H:i',$item->create_at); ?></td>
                            <td class="text-center"><?php echo e($item->post->title ?? ''); ?></td>
                            <td class="text-center">
                                <a href="#" data-href="/user/vendor/forum/comment/delete/<?php echo e($item->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.vendor.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/vendor/content/forumcomments.blade.php ENDPATH**/ ?>