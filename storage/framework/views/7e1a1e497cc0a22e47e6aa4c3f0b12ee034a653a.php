<?php $__env->startSection('tab4','active'); ?>
<?php $__env->startSection('tab'); ?>
    <div class="accordion-off col-xs-12">
        <ul id="accordion" class="accordion off-filters-li">
            <li <?php if(isset($discount->id)): ?> class="open" <?php endif; ?>>
                <div class="link"><h2><?php echo e(trans('main.new_discount')); ?></h2><i class="mdi mdi-chevron-down"></i></div>
                <ul class="submenu" <?php if(isset($discount->id)): ?> style="display: block;" <?php endif; ?>>
                    <div class="h-10"></div>
                    <form method="post" <?php if(isset($discount->id)): ?> action="/user/video/off/edit/store/<?php echo e($discount->id); ?>" <?php else: ?> action="/user/video/off/store" <?php endif; ?> class="form form-horizontal">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.course')); ?></label>
                            <div class="col-md-3 tab-con">
                                <select name="off_id" class="form-control font-s">
                                    <?php $__currentLoopData = $userContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(contentMeta($uc->id,'price',0) > 0): ?>
                                            <option value="<?php echo e($uc->id); ?>" <?php if(isset($discount->off_id) and $discount->off_id == $uc->id): ?> selected <?php endif; ?>><?php echo e($uc->title); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.amount')); ?></label>
                            <div class="col-md-3 tab-con">
                                <input type="number" name="off" value="<?php echo e(!empty($discount) ? $discount->off : ''); ?>" class="form-control text-center" min="1" max="99" placeholder="Percent (eg. 20 for 20%)" required>
                            </div>
                            <label class="control-label col-md-1 tab-con"></label>
                            <div class="col-md-3 tab-con">

                            </div>
                        </div>
                        <div class="h-10"></div>
                        <div class="form-group">
                            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.start_date')); ?></label>
                            <div class="col-md-3 tab-con">
                                <input type="date" class="form-control" name="first_date" id="first_date" value="<?php if(isset($discount->first_date)): ?> <?php echo e(date('d-m-Y',$discount->first_date)); ?> <?php endif; ?>" required>
                            </div>
                            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.end_date')); ?></label>
                            <div class="col-md-3 tab-con">
                                <input type="date" class="form-control" name="last_date" id="last_date" value="<?php if(isset($discount->last_date)): ?> <?php echo e(date('d-m-Y',$discount->last_date)); ?> <?php endif; ?>" required>
                            </div>
                            <label class="control-label col-md-1 tab-con"></label>
                            <div class="col-md-3 tab-con">
                                <button type="submit" class="btn btn-custom pull-left col-md-12"><span><?php echo e(trans('main.save_changes')); ?></span></button>
                            </div>
                        </div>
                    </form>
                    <div class="h-10"></div>
                </ul>
            </li>
            <li class="open">
                <div class="link"><h2><?php echo e(trans('main.discounts_list')); ?></h2><i class="mdi mdi-chevron-down"></i></div>
                <ul class="submenu dblock">
                    <div class="h-10"></div>
                    <?php if(count($discounts) == 0): ?>
                        <div class="text-center">
                            <img src="/assets/default/images/empty/discount.png">
                            <div class="h-20"></div>
                            <span class="empty-first-line"><?php echo e(trans('main.no_discount')); ?></span>
                            <div class="h-10"></div>
                            <span class="empty-second-line">
                                <?php echo e(trans('main.discount_desc')); ?>

                            </span>
                            <div class="h-20"></div>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table ucp-table" id="off-table">
                                <thead class="thead-s">
                                <th class="cell-ta"><?php echo e(trans('main.course')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('main.start_date')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('main.end_date')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('main.amount')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('main.status')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('main.controls')); ?></th>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $discounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-center">
                                        <td class="cell-ta"><?php echo e($item->content->title); ?></td>
                                        <td><?php echo e(date('d F Y',$item->first_date)); ?></td>
                                        <td><?php echo e(date('d F Y',$item->last_date)); ?></td>
                                        <td>%<?php echo e($item->off); ?></td>
                                        <td>
                                            <?php if($item->mode == "publish"): ?>
                                                <b class="green-s"><?php echo e(trans('main.active')); ?></b>
                                            <?php else: ?>
                                                <b class="orange-s"><?php echo e(trans('main.waiting')); ?></b>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a class="gray-s" href="/user/video/off/edit/<?php echo e($item->id); ?>" title="Edit"><span class="crticon mdi mdi-lead-pencil"></span></a>
                                            <a class="gray-s" href="/user/video/off/delete/<?php echo e($item->id); ?>" onclick="return confirm('Are you sure to delete item?');" title="Delete"><span class="crticon mdi mdi-delete-forever"></span></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>


    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>$('#buy-hover').addClass('item-box-active');</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($user['vendor'] == 1 ? getTemplate() . '.user.layout.videolayout' : getTemplate() . '.user.layout_user.videolayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/sell/off.blade.php ENDPATH**/ ?>