<?php $__env->startSection('tab2','active'); ?>
<?php $__env->startSection('tab'); ?>
    <div class="h-20"></div>
    <?php if(count($lists) == 0): ?>
        <div class="text-center">
            <img src="/assets/default/images/empty/Postal.png">
            <div class="h-20"></div>
            <span class="empty-first-line"><?php echo e(trans('main.not_found')); ?></span>
            <div class="h-20"></div>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table ucp-table" id="post-table">
                <thead class="back-orange">
                <th class="cell-ta"><?php echo e(trans('main.title')); ?></th>
                <th class="cell-ta" width="100"><?php echo e(trans('main.customer')); ?></th>
                <th class="cell-ta" width="100"><?php echo e(trans('main.address')); ?></th>
                <th class="text-center" width="200"><?php echo e(trans('main.tracking_code')); ?></th>
                <th class="text-center" width="200"><?php echo e(trans('main.date')); ?></th>
                <th class="text-center" width="100"><?php echo e(trans('main.income')); ?></th>
                <th class="text-center" width="100"><?php echo e(trans('main.status')); ?></th>
                <th class="text-center" width="50"><?php echo e(trans('main.controls')); ?></th>
                </thead>
                <tbody>
                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="cell-ta"><a href="/product/<?php echo e($item->content->id); ?>" class="color-in" target="_blank"><?php echo e($item->content->title); ?></a></td>
                        <td class="cell-ta"><a href="/profile/<?php echo e($item->buyer->id); ?>" class="color-in" target="_blank"><?php echo e(!empty($item->buyer->name) ? $item->buyer->name : $item->buyer->username); ?></a></td>
                        <td class="cell-ta" title="<?php echo e($item->buyer->address); ?>">
                            <?php if($item->type == 'post'): ?>
                                <span class="img-icon-s" data-toggle="modal" data-target="#address<?php echo e($item->id); ?>"><?php echo e(trans('main.view')); ?></span>
                                <div class="modal fade" id="address<?php echo e($item->id); ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                    &times;
                                                </button>
                                                <h4 class="modal-title"><?php echo e(trans('main.address')); ?></h4>
                                            </div>
                                            <div class="modal-body form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label col-md-2 text-right ta-ri"><?php echo e(trans('main.province')); ?></label>
                                                    <label class="control-label col-md-10 ta-ri"><?php echo e(userMeta($item->buyer_id,'state','')); ?></label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2 text-right ta-ri"> <?php echo e(trans('main.city')); ?></label>
                                                    <label class="control-label col-md-10 ta-ri"><?php echo e(userMeta($item->buyer_id,'city','')); ?></label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2 text-right ta-ri"> <?php echo e(trans('main.address')); ?></label>
                                                    <label class="control-label col-md-10 ta-ri"><?php echo e(userMeta($item->buyer_id,'address','')); ?></label>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-2 text-right ta-ri"> <?php echo e(trans('main.zip_code')); ?></label>
                                                    <label class="control-label col-md-10 ta-ri"><?php echo e(userMeta($item->buyer_id,'postalcode','')); ?></label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('main.close')); ?></button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($item->type == 'post'): ?>
                                <form method="post" action="/user/balance/sell/post/setPostalCode">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="sell_id" value="<?php echo e($item->id); ?>">
                                    <input type="text" class="form-control text-center" name="post_code" value="<?php echo e($item->post_code); ?>">
                            <?php endif; ?>
                        </td>
                        <td class="text-center" width="150"><?php echo e(date('d F Y | H:i',$item->created_at)); ?></td>
                        <td class="text-center"><?php echo e(currencySign()); ?><?php echo e($item->transaction->income); ?></td>
                        <td class="text-center">
                            <?php if($item->post_feedback == null): ?>
                                <b><?php echo e(trans('main.waiting')); ?></b>
                            <?php elseif($item->post_feedback == 1): ?>
                                <b class="green-s"><?php echo e(trans('main.successful')); ?></b>
                            <?php elseif($item->post_feedback == 2 or $item->post_feedback == 3): ?>
                                <b class="red-s"><?php echo e(trans('main.failed')); ?></b>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($item->type == 'post'): ?>
                                <button class="btn btn-custom pull-left" type="submit"><?php echo e(trans('main.submit_tracking_code')); ?></button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <?php if(empty(request()->get('p')) and $count > 20): ?>
                <a href="?p=1" class="next-pagination pull-left"><span class="pagicon mdi mdi-chevron-left"></span></a>
            <?php endif; ?>
            <?php if(!empty(request()->get('p')) and $count > (request()->get('p')+1) * 20): ?>
                <a href="?p=<?php echo e(request()->get('p')+1); ?>" class="next-pagination pull-left"><span class="pagicon mdi mdi-chevron-left"></span></a>
            <?php endif; ?>
            <?php if(!empty(request()->get('p')) and request()->get('p') > 0): ?>
                <a href="?p=<?php echo e(request()->get('p') - 1); ?>" class="next-pagination pull-right"><span class="pagicon mdi mdi-chevron-right"></span></a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($user['vendor'] == 1 ? getTemplate() . '.user.layout.balancelayout' : getTemplate() . '.user.layout_user.balancelayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/sell/post.blade.php ENDPATH**/ ?>