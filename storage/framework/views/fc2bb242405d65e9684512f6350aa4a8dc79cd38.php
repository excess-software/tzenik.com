

<?php if($user['vendor'] == 1): ?>
    <?php $__env->startSection('tab7','active'); ?>
<?php else: ?>
    <?php $__env->startSection('tab1','active'); ?>
<?php endif; ?>

<?php $__env->startSection('tab'); ?>
    <div class="accordion-off col-xs-12">
        <ul id="accordion" class="accordion off-filters-li">
            <li class="open">
                <div class="link"><h2><?php echo e(trans('main.user_list')); ?></h2><i class="mdi mdi-chevron-down"></i></div>
                <ul class="submenu dblock">
                    <div class="h-10"></div>
                    <div class="table-responsive">
                        <table class="table ucp-table" id="request-table">
                            <thead class="thead-s">
                            <th class="cell-ta"><?php echo e(trans('main.name')); ?></th>
                            <th class="text-center"><?php echo e(trans('main.email')); ?></th>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td class="cell-ta"><?php echo $item->buyer->name ?? ''; ?></td>
                                    <td class="text-center"><?php echo $item->buyer->email ?? ''; ?></td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="h-10"></div>
                </ul>

            </li>
        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($user['vendor'] == 1 ? getTemplate() . '.user.layout.videolayout' : getTemplate() . '.user.layout_user.quizzes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/meeting/users.blade.php ENDPATH**/ ?>