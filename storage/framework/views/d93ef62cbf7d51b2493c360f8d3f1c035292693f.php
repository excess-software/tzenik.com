<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.blog_posts')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th><?php echo e(trans('admin.th_title')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.th_date')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.author')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.comments')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.category')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_status')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($item->title); ?></td>
                        <td class="text-center" width="150"><?php echo e(date('d F Y : H:i',$item->created_at)); ?></td>
                        <td class="text-center" title="<?php echo e(!empty($item->user) ? $item->user->username : ''); ?>"><?php echo e(!empty($item->user) ? $item->user->name : ''); ?></td>
                        <td class="text-center"><?php echo e(count($item->comments)); ?></td>
                        <td class="text-center"><?php echo e(!empty($item->category) ? $item->category->title : ''); ?></td>
                        <td class="text-center">
                            <?php if($item->mode == 'publish'): ?>
                                <i class="fa fa-check c-g" aria-hidden="true" title="Publish"></i>
                            <?php else: ?>
                                <i class="fa fa-times c-r" aria-hidden="true" title="Draft"></i>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="/admin/blog/post/edit/<?php echo e($item->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" data-href="/admin/blog/post/delete/<?php echo e($item->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Blog','Posts']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/blog/list.blade.php ENDPATH**/ ?>