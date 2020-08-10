<?php $__env->startSection('tab5','active'); ?>
<?php $__env->startSection('tab'); ?>
    <div class="row">
        <div class="accordion-off col-xs-12">
            <ul id="accordion" class="accordion off-filters-li">
                <li>
                    <div class="link"><h2><?php echo e(trans('main.promoted_courses')); ?></h2><i class="mdi mdi-chevron-down"></i></div>
                    <ul class="submenu">
                        <div class="h-10"></div>
                        <?php if(count($list) == 0): ?>
                            <div class="text-center">
                                <img src="/assets/default/images/empty/Promotion.png">
                                <div class="h-20"></div>
                                <span class="empty-first-line"><?php echo e(trans('main.no_promotion')); ?></span>
                                <div class="h-10"></div>
                                <span class="empty-second-line">
                                <span><?php echo e(trans('main.promotion_desc')); ?></span>
                            </span>
                                <div class="h-20"></div>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table ucp-table">
                                    <thead class="thead-s">
                                    <th class="text-center"><?php echo e(trans('main.plan')); ?></th>
                                    <th class="text-center"><?php echo e(trans('main.description')); ?></th>
                                    <th class="text-center"><?php echo e(trans('main.course')); ?></th>
                                    <th class="text-center"><?php echo e(trans('main.status')); ?></th>
                                    <th class="text-center" width="150"><?php echo e(trans('main.expire_date')); ?></th>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php if(!empty($item->plan)): ?>
                                                    <?php echo e($item->plan->title); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"><?php echo e($item->description); ?></td>
                                            <td class="text-center">
                                                <?php if(!empty($item->content)): ?>
                                                    <a class="gray-s" href="/product/<?php echo e($item->content->id); ?>"><?php echo e($item->content->title); ?></a>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if($item->mode == 'publish'): ?>
                                                    <b class="blue-s"><?php echo e(trans('main.active')); ?></b>
                                                <?php elseif($item->mode == 'pay'): ?>
                                                    <b class="green-s"><?php echo e(trans('main.paid')); ?></b>
                                                <?php else: ?>
                                                    <b class="orange-s"><?php echo e(trans('main.waiting')); ?></b>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"><?php echo e(date('d F Y H:i',$item->created_at)); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="open">
                    <div class="link"><h2><?php echo e(trans('main.promotion_plans')); ?></h2><i class="mdi mdi-chevron-down"></i></div>
                    <ul class="submenu dblock">
                        <div class="h-10"></div>
                        <div class="row">
                            <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-3 col-xs-12 plan-box tab-con">
                                    <div class="price-section"><?php echo e($plan->title); ?></div>
                                    <div class="plan-box-section plan-box-section-s"><?php echo e(currencySign()); ?><?php echo e($plan->price); ?></div>
                                    <div class="plan-box-section plan-box-section-r"><?php echo e(!empty($plan->day) ? $plan->day : '0'); ?> <?php echo e(trans('main.days')); ?></div>
                                    <div class="plan-box-section plan-box-section-e"><?php echo e(!empty($plan->description) ? $plan->description : 'No Description'); ?></div>
                                    <div class="plan-box-section"><a href="/user/video/promotion/buy/<?php echo e($plan->id); ?>" class="btn btn-custom"><?php echo e(trans('main.purchase_plan')); ?></a></div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.layout.videolayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/promotion/promotion.blade.php ENDPATH**/ ?>