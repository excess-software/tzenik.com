<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.corse_comments')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th><?php echo e(trans('admin.comment')); ?></th>
                    <th class="text-center" width="120"><?php echo e(trans('admin.username')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_status')); ?></th>
                    <th class="text-center" width="200"><?php echo e(trans('admin.course')); ?></th>
                    <th class="text-center" width="100"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo $item->comment; ?></td>
                        <td class="text-center"><a target="_blank" href="/profile/<?php echo e($item->user->id); ?>"><?php echo e($item->user->name); ?></a></td>
                        <td class="text-center">
                            <?php if($item->mode == 'publish'): ?>
                                <span class="c-g f-w-b"><?php echo e(trans('admin.published')); ?></span>
                            <?php else: ?>
                                <span class="c-o"><?php echo e(trans('admin.pending')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if(!empty($item->content)): ?>
                                <a href="/product/<?php echo e($item->content->id); ?>" target="_blank"><?php echo e($item->content->title); ?></a>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="/admin/content/comment/edit/<?php echo e($item->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" data-href="/admin/content/comment/delete/<?php echo e($item->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            <?php if($item->mode == 'publish'): ?>
                                <a href="/admin/content/comment/view/draft/<?php echo e($item->id); ?>/" title="Add to pending list (Hide)"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            <?php else: ?>
                                <a href="/admin/content/comment/view/publish/<?php echo e($item->id); ?>/" title="Publish Comment"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Courses','Comments']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/content/comments.blade.php ENDPATH**/ ?>