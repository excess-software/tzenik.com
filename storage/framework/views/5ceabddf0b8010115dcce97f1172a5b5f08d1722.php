<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.sales_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <form>
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="date" id="fsdate" class="text-center form-control" value="<?php echo e(request()->get('fsdate') ?? ''); ?>" name="fsdate" placeholder="Start Date">
                            <input type="hidden" id="fdate" name="fdate" value="<?php echo e(request()->get('fdate') ?? ''); ?>">
                            <span class="input-group-append fdatebtn" id="fdatebtn">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="date" id="lsdate" class="text-center form-control" name="lsdate" value="<?php echo e(request()->get('lsdate') ?? ''); ?>" placeholder="End Date">
                            <input type="hidden" id="ldate" name="ldate" value="<?php echo e(request()->get('ldate') ?? ''); ?>">
                            <span class="input-group-append ldatebtn" id="ldatebtn">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="user" data-plugin-selectTwo class="form-control populate">
                                <option value=""><?php echo e(trans('admin.all_vendors')); ?></option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php if(!empty(request()->get('user')) and request()->get('user') == $user->id): ?> selected <?php endif; ?>><?php echo e($user->name ?? $user->username); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="buyer" data-plugin-selectTwo class="form-control populate">
                                <option value=""><?php echo e(trans('admin.all_customers')); ?></option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php if(!empty(request()->get('buyer')) and request()->get('buyer') == $user->id): ?> selected <?php endif; ?>><?php echo e($user->name ?? $user->username); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 h-15"></div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select name="content" data-plugin-selectTwo class="form-control populate">
                                <option value=""><?php echo e(trans('admin.all_courses')); ?></option>
                                <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($content->id); ?>" <?php if(!empty(request()->get('content')) and request()->get('content') == $content->id): ?> selected <?php endif; ?>><?php echo e($content->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="type" class="form-control">
                                <option value=""><?php echo e(trans('admin.all_types')); ?></option>
                                <option value="download" <?php if(!empty(request()->get('type')) and request()->get('type') == 'download'): ?> selected <?php endif; ?>><?php echo e(trans('admin.download')); ?></option>
                                <option value="post" <?php if(!empty(request()->get('type')) and request()->get('type') == 'post'): ?> selected <?php endif; ?>><?php echo e(trans('admin.postal')); ?></option>
                                <option value="success" <?php if(!empty(request()->get('type')) and request()->get('type') == 'success'): ?> selected <?php endif; ?>><?php echo e(trans('admin.postal_successful')); ?></option>
                                <option value="fail" <?php if(!empty(request()->get('type')) and request()->get('type') == 'fail'): ?> selected <?php endif; ?>><?php echo e(trans('admin.postal_failed')); ?></option>
                                <option value="wait" <?php if(!empty(request()->get('type')) and request()->get('type') == 'wait'): ?> selected <?php endif; ?>><?php echo e(trans('admin.postal_waiting')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="submit" class="text-center btn btn-primary w-100" value="Show Results">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="card">
        <header class="card-header">
            <h4 class="card-title"><?php echo e(trans('admin.sales_list')); ?></h4>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th><?php echo e(trans('admin.course_title')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_vendor')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_customer')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.amount')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_date')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.sales_type')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_status')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php if(!empty($item->content)): ?>
                                <a href="/product/<?php echo e($item->content->id); ?>"><?php echo e($item->content->title); ?></a>
                            <?php endif; ?>
                        </td>
                        <td class="text-center" title="<?php echo e(!empty($item->user) ? $item->user->name : ''); ?>"><a href="/profile/<?php echo e(!empty($item->user) ? $item->user->id : ''); ?>"><?php echo e(!empty($item->user) ? $item->user->username : ''); ?></a></td>
                        <td class="text-center" title="<?php echo e(!empty($item->buyer) ? $item->buyer->name : ''); ?>"><a href="/profile/<?php echo e(!empty($item->buyer) ? $item->buyer->id : ''); ?>"><?php echo e(!empty($item->buyer) ? $item->buyer->username : ''); ?></a></td>
                        <td class="text-center"><?php echo e(!empty($item->transaction) ? $item->transaction->price : ''); ?> <?php echo e(trans('admin.cur_dollar')); ?></td>
                        <td class="text-center"><?php echo e(date('d F Y : H:i',$item->created_at)); ?></td>
                        <td class="text-center">
                            <?php if($item->type == 'download'): ?>
                                <b class="c-g"><?php echo e(trans('admin.download')); ?></b>
                            <?php else: ?>
                                <b class="c-b" title="Shipping Tracing Code <?php echo e($item->post_code); ?>"><?php echo e(trans('admin.postal')); ?></b>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($item->mode == 'pay'): ?>
                                <?php if($item->type == 'download'): ?>
                                    <b class="c-g"><?php echo e(trans('admin.paid_successful')); ?></b>
                                <?php else: ?>
                                    <?php if($item->post_feedback == 1): ?>
                                        <b class="c-g"><?php echo e(trans('admin.paid_successful')); ?></b>
                                    <?php elseif($item->post_feedback == 2 and $item->post_feedback == 2): ?>
                                        <b class="c-r"><?php echo e(trans('admin.paid_failed')); ?></b>
                                    <?php else: ?>
                                        <b class="c-o"><?php echo e(trans('admin.paid_waiting')); ?></b>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php elseif($item->mode == 'get'): ?>
                                <b class="c-b"><?php echo e(trans('admin.delivered')); ?></b>
                            <?php else: ?>
                                <b class="c-o"><?php echo e(trans('admin.waiting_payment')); ?></b>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Sales','Sales List']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/sell/sell.blade.php ENDPATH**/ ?>