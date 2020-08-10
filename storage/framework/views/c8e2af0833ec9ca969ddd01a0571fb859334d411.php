<?php $__env->startSection('tab2','active'); ?>
<?php $__env->startSection('tab'); ?>
    <div class="h-20"></div>
    <?php if(count($lists) == 0): ?>
        <div class="text-center">
            <img src="/assets/default/images/empty/articles.png">
            <div class="h-20"></div>
            <span class="empty-first-line"><?php echo e(trans('main.no_article')); ?></span>
            <div class="h-10"></div>
            <span class="empty-second-line">
                <span><?php echo e(trans('main.article_desc')); ?></span>
            </span>
            <div class="h-20"></div>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table ucp-table" id="article-table">
                <thead class="thead-s">
                <th class="cell-ta"><?php echo e(trans('main.title')); ?></th>
                <th class="text-center" width="150"><?php echo e(trans('main.category')); ?></th>
                <th class="text-center" width="150"><?php echo e(trans('main.date')); ?></th>
                <th class="text-center" width="150"><?php echo e(trans('main.status')); ?></th>
                <th class="text-center" width="100"><?php echo e(trans('main.controls')); ?></th>
                </thead>
                <tbody>
                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="cell-ta"><?php echo e($item->title); ?></td>
                        <td class="text-center">
                            <?php if(!empty($item->category)): ?>
                                <?php echo e($item->category->title); ?>

                            <?php endif; ?>
                        </td>
                        <td class="text-center" width="150"><?php echo e(date('d F Y | H:i',$item->created_at)); ?></td>
                        <td class="text-center">
                            <?php if($item->mode == 'publish'): ?>
                                <b class="green-s"><?php echo e(trans('main.published')); ?></b>
                            <?php elseif($item->mode == 'draft'): ?>
                                <b class="orange-s"><?php echo e(trans('main.draft')); ?></b>
                            <?php elseif($item->mode == 'request'): ?>
                                <b class="blue-s"><?php echo e(trans('main.send_for_review')); ?></b>
                            <?php elseif($item->mode == 'delete'): ?>
                                <b class="red-s"><?php echo e(trans('main.unpublish_request')); ?></b>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="/user/article/edit/<?php echo e($item->id); ?>" title="Edit"><span class="crticon mdi mdi-lead-pencil"></span></a>
                            <a href="/user/article/delete/<?php echo e($item->id); ?>" title="Unpublish Request"><span class="crticon mdi mdi-delete-forever"></span></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.user.layout.articlelayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/article/list.blade.php ENDPATH**/ ?>