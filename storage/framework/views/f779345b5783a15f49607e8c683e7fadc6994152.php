<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.financial_documents')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <a href="/admin/balance/list/excel" class="btn btn-primary">Export as xls</a>
    <div class="h-10"></div>
    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center" width="170"><?php echo e(trans('admin.th_date')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_title')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.document_type')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.amount')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.creator')); ?></th>
                    <td class="text-center"><?php echo e(trans('admin.username')); ?></td>
                    <th class="text-center"><?php echo e(trans('admin.description')); ?></th>
                    <td class="text-center"><?php echo e(trans('admin.th_controls')); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center" width="170"><?php echo e(date('d F Y / H:i',$item->created_at)); ?></td>
                        <td class="text-center"><?php echo e($item->title); ?></td>
                        <td class="text-center">
                            <?php if($item->type == 'add'): ?>
                                <span class="f-w-b color-green"><?php echo e(trans('admin.addiction')); ?></span>
                            <?php else: ?>
                                <span class="color-red-i f-w-b"><?php echo e(trans('admin.deduction')); ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($item->type == 'add'): ?>
                                <span class="f-w-b color-green"><?php echo e($item->price); ?>+</span>
                            <?php else: ?>
                                <span class="color-red-i f-w-b"><?php echo e($item->price); ?>-</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($item->mode == 'auto'): ?>
                                <span><?php echo e(trans('admin.automatic')); ?></span>
                            <?php elseif($item->mode == 'user' and !empty($item->exporter)): ?>
                                <span><a href="/admin/user/item/<?php echo e($item->exporter->id); ?>" title="<?php echo e($item->exporter->name); ?>"><?php echo e($item->exporter->username); ?></a></span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if(!empty($item->user)): ?>
                                <a href="/admin/user/edit/<?php echo e($item->user->id); ?>" title="<?php echo e($item->user->name); ?>">
                                    <?php echo e(!empty($item->user->username) ? $item->user->username : 'Fund'); ?>

                                </a>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?php echo e($item->description); ?></td>
                        <td class="text-center">
                            <a href="/admin/balance/print/<?php echo e($item->id); ?>" target="_blank" title="Print Document"><i class="fa fa-print" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Accounting','Financial Documents']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/balance/list.blade.php ENDPATH**/ ?>