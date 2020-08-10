<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.blog_comments')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th><?php echo e(trans('admin.text')); ?></th>
                    <th class="text-center" width="120"><?php echo e(trans('admin.username')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_status')); ?></th>
                    <th class="text-center" width="200"><?php echo e(trans('admin.post')); ?></th>
                    <th class="text-center" width="200"><?php echo e(trans('admin.created_date')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo $item->comment; ?></td>
                        <td class="text-center">
                            <?php if(!empty($item->user)): ?>
                                <a target="_blank" href="javascript:void(0);"><?php echo e($item->user->name); ?></a>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($item->mode == 'publish'): ?>
                                <b class="c-g"><?php echo e(trans('admin.published')); ?></b>
                            <?php else: ?>
                                <b class="c-o"><?php echo e(trans('admin.waiting')); ?></b>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo date('d F Y / H:i',$item->created_at); ?></td>
                        <td class="text-center"><a href="/admin/blog/post/edit/<?php echo e($item->post->id); ?>"><?php echo e($item->post->title); ?></a></td>
                        <td class="text-center">
                            <a href="/admin/blog/comment/reply/<?php echo e($item->id); ?>" title="Reply"><i class="fa fa-reply" aria-hidden="true"></i></a>
                            <a href="/admin/blog/comment/edit/<?php echo e($item->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" data-href="/admin/blog/comment/delete/<?php echo e($item->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            <?php if($item->mode == 'publish'): ?>
                                <a href="/admin/blog/comment/view/draft/<?php echo e($item->id); ?>/" title="Add to waiting list"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            <?php else: ?>
                                <a href="/admin/blog/comment/view/publish/<?php echo e($item->id); ?>/" title="Approve Comment"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Blog','Comments']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/blog/comments.blade.php ENDPATH**/ ?>