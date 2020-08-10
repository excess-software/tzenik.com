<?php $__env->startSection('tab2','active'); ?>
<?php $__env->startSection('tab'); ?>
    <div class="h-20"></div>
    <div class="table-responsive">
        <table class="table ucp-table">
            <thead class="thead-s">
            <th><?php echo e(trans('main.title')); ?></th>
            <th><?php echo e(trans('main.description')); ?></th>
            <th class="text-center" width="150"><?php echo e(trans('main.volume')); ?></th>
            <th class="text-center" width="150"><?php echo e(trans('main.duration')); ?></th>
            <th class="text-center" width="150"><?php echo e(trans('main.date')); ?></th>
            <th class="text-center" width="50"><?php echo e(trans('main.status')); ?></th>
            <th class="text-center" width="100"><?php echo e(trans('main.controls')); ?></th>
            </thead>
            <tbody>
            <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->title); ?></td>
                    <td><?php echo $item->description; ?></td>
                    <td class="text-center"><?php echo e($item->size); ?><?php echo e(trans('main.mb')); ?> </td>
                    <td class="text-center"><?php echo e($item->duration); ?><?php echo e(trans('main.minute')); ?> </td>
                    <td class="text-center" width="150"><?php echo e(date('d F Y | H:i',$item->created_at)); ?></td>
                    <td class="text-center">
                        <?php if($item->mode == 'publish'): ?>
                            <b class="blue-s"><?php echo e(trans('main.publish')); ?></b>
                        <?php elseif($item->mode == 'draft'): ?>
                            <b class="orange-s"><?php echo e(trans('main.draft')); ?></b>
                        <?php elseif($item->mode == 'request'): ?>
                            <span class="green-s"><?php echo e(trans('main.waiting')); ?></span>
                        <?php elseif($item->mode == 'delete'): ?>
                            <span class="red-s"><?php echo e(trans('main.unpublish_request')); ?></span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="/user/content/part/edit/<?php echo e($item->id); ?>" title="Edit" class="gray-s"><i class="fa fa-edit" aria-hidden="true"></i></a>
                        <a href="/user/content/part/delete/<?php echo e($item->id); ?>" title="Delete" class="gray-s"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        <a href="/user/content/part/request/<?php echo e($item->id); ?>" title="Add to waiting" class="gray-s"><i class="fa fa-refresh" aria-hidden="true"></i></a>
                        <a href="/user/content/part/draft/<?php echo e($item->id); ?>" title="Draft" class="gray-s"><i class="fa fa-minus-square" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.user.layout.partlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/content/part/list.blade.php ENDPATH**/ ?>