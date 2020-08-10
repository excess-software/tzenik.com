<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.promotions')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th class="text-center" width="80"><?php echo e(trans('admin.start_date')); ?></th>
                    <th class="text-center" width="80"><?php echo e(trans('admin.expire_date')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.type')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.contents')); ?></th>
                    <th class="text-center" width="200"><?php echo e(trans('admin.th_vendor')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.amount')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.th_status')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center" width="80"><?php echo e(date('d F Y',$item->first_date)); ?></td>
                            <td class="text-center" width="80"><?php echo e(date('d F Y',$item->last_date)); ?></td>
                            <td class="text-center" width="50">
                                <?php if($item->type == 'content'): ?>
                                    <?php echo e('Single Course'); ?>

                                <?php elseif($item->type == 'category'): ?>
                                    <?php echo e('Category'); ?>

                                <?php elseif($item->type == 'all'): ?>
                                    <?php echo e('All Courses'); ?>

                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($item->type == 'content' and !empty($item->content)): ?>
                                    <a href="/admin/content/edit/<?php echo e($item->content->id); ?>"><?php echo e($item->content->title); ?></a>
                                <?php elseif($item->type == 'category' and !empty($item->category)): ?>
                                    <a href="/admin/content/category/edit/<?php echo e($item->category->id); ?>"><?php echo e($item->category->title); ?></a>
                                <?php elseif($item->type == 'all'): ?>
                                    All Courses
                                <?php endif; ?>
                            </td>
                            <td class="text-center"><?php echo e((!empty($item->content) and !empty($item->content->user)) ? $item->content->user->name : 'User Group'); ?></td>
                            <td class="text-center" width="50">
                                    <?php echo e($item->off); ?> %
                            </td>
                            <td class="text-center" width="50">
                                <?php if($item->mode == 'publish'): ?>
                                    <b class="c-g"><?php echo e(trans('admin.active')); ?></b>
                                <?php elseif($item->mode == 'draft'): ?>
                                    <b class="c-o"><?php echo e(trans('admin.disabled')); ?></b>
                                <?php endif; ?>
                                <?php if(time()>$item->last_date): ?>
                                    <span class="custom-list">(<?php echo e(trans('admin.expired')); ?>)</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center" width="50">
                                <?php if($item->mode == 'draft'): ?>
                                    <a href="/admin/discount/content/publish/<?php echo e($item->id); ?>" title="Publish"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                                <?php else: ?>
                                    <a href="/admin/discount/content/draft/<?php echo e($item->id); ?>" title="Add to waiting list (Disable)"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                <?php endif; ?>
                                <a href="/admin/discount/content/edit/<?php echo e($item->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a href="#" data-href="/admin/discount/content/delete/<?php echo e($item->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Promotions','List']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/discount/contentlist.blade.php ENDPATH**/ ?>