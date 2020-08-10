<?php $__env->startSection('tab2','active'); ?>
<?php $__env->startSection('tab'); ?>
    <div class="h-20"></div>
    <?php if(count($lists) == 0): ?>
        <div class="text-center">
            <img src="/assets/default/images/empty/comments.png">
            <div class="h-20"></div>
            <span class="empty-first-line"><?php echo e(trans('main.no_comment')); ?></span>
            <div class="h-20"></div>
        </div>
    <?php else: ?>
        <div class="col-xs-12">
            <div class="row">
                <div class="table-responsive">
                    <table class="table ucp-table">
                        <thead class="back-orange">
                        <tr>
                            <th class="cell-ta"><?php echo e(trans('main.comment')); ?></th>
                            <th width="400" class="text-center"><?php echo e(trans('main.course')); ?></th>
                            <th width="200" class="text-center"><?php echo e(trans('main.user')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="lh180 cell-ta"><?php echo e($item->comment); ?></td>
                                <td class="text-center"><a href="/product/<?php echo e($item->content->id); ?>"><?php echo e(!empty($item->content->title) ? $item->content->title : 'Removed'); ?></a></td>
                                <td class="text-center"><a href="/profile/<?php echo e($item->user->id); ?>"><?php echo e(!empty($item->name) ? $item->name : $item->user->username); ?></a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <?php if(empty(request()->get('p')) and $count > 20): ?>
                    <a href="?p=1" class="next-pagination pull-left"><span class="pagicon mdi mdi-chevron-left"></span></a>
                <?php endif; ?>
                <?php if(!empty(request()->get('p')) and $count>(request()->get('p') + 1) * 20): ?>
                    <a href="?p=<?php echo e(request()->get('p') + 1); ?>" class="next-pagination pull-left"><span class="pagicon mdi mdi-chevron-left"></span></a>
                <?php endif; ?>
                <?php if(!empty(request()->get('p')) and request()->get('p') > 0): ?>
                    <a href="?p=<?php echo e(request()->get('p') - 1); ?>" class="next-pagination pull-right"><span class="pagicon mdi mdi-chevron-right"></span></a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($user['vendor'] == 1 ? getTemplate() . '.user.layout.supportlayout' : getTemplate() . '.user.layout_user.supportlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/ticket/commentList.blade.php ENDPATH**/ ?>