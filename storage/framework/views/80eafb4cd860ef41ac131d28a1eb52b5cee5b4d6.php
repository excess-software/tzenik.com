<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.list_courses')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <form>
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="date" value="<?php echo request()->get('fsdate') ?? ''; ?>" id="fsdate" class="text-center form-control" name="fsdate" placeholder="Start Date">
                            <input type="hidden" id="fdate" name="fdate" value="<?php echo request()->get('fdate') ?? ''; ?>">
                            <span class="input-group-append fdatebtn" id="fdatebtn">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="date" value="<?php echo request()->get('lsdate') ?? ''; ?>" id="lsdate" class="text-center form-control" name="lsdate" placeholder="End Date">
                            <input type="hidden" id="ldate" name="ldate" value="<?php echo request()->get('ldate') ?? ''; ?>">
                            <span class="input-group-append fdatebtn" id="fdatebtn">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="user" data-plugin-selectTwo class="form-control populate">
                                <option value=""><?php echo e(trans('admin.all_users')); ?></option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php if(!empty(request()->get('user')) and request()->get('user') == $user->id): ?> selected <?php endif; ?>><?php echo e($user->name ?? $user->username); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="cat" data-plugin-selectTwo class="form-control populate">
                                <option value=""><?php echo e(trans('admin.all_categories')); ?></option>
                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($cat->id); ?>" <?php if(!empty(request()->get('cat')) and request()->get('cat') == $cat->id): ?> selected <?php endif; ?>><?php echo e($cat->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 h-15"></div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input type="text" class="form-control text-center" name="id" value="<?php echo request()->get('id') ?? ''; ?>" placeholder="Item Code">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control text-center" name="title" value="<?php echo request()->get('title') ?? ''; ?>" placeholder="Course Title">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="order" class="form-control">
                                <option value=""><?php echo e(trans('admin.filter_type')); ?></option>
                                <option value="sella" <?php if(!empty(request()->get('order')) and request()->get('order') == 'sella'): ?> selected <?php endif; ?>><?php echo e(trans('admin.sales')); ?>-<?php echo e(trans('admin.ascending')); ?></option>
                                <option value="selld" <?php if(!empty(request()->get('order')) and request()->get('order') == 'selld'): ?> selected <?php endif; ?>><?php echo e(trans('admin.sales')); ?>-<?php echo e(trans('admin.descending')); ?></option>
                                <option value="suma" <?php if(!empty(request()->get('order')) and request()->get('order') == 'suma'): ?> selected <?php endif; ?>><?php echo e(trans('admin.sales_amount')); ?>-<?php echo e(trans('admin.ascending')); ?></option>
                                <option value="sumd" <?php if(!empty(request()->get('order')) and request()->get('order') == 'sumd'): ?> selected <?php endif; ?>><?php echo e(trans('admin.sales_amount')); ?>-<?php echo e(trans('admin.descending')); ?></option>
                                <option value="viewd" <?php if(!empty(request()->get('order')) and request()->get('order') == 'viewd'): ?> selected <?php endif; ?>><?php echo e(trans('admin.views')); ?>-<?php echo e(trans('admin.descending')); ?></option>
                                <option value="viewa" <?php if(!empty(request()->get('order')) and request()->get('order') == 'viewa'): ?> selected <?php endif; ?>><?php echo e(trans('admin.views')); ?>-<?php echo e(trans('admin.ascending')); ?></option>
                                <option value="pricea" <?php if(!empty(request()->get('order')) and request()->get('order') == 'pricea'): ?> selected <?php endif; ?>><?php echo e(trans('admin.item_price')); ?>-<?php echo e(trans('admin.ascending')); ?></option>
                                <option value="priced" <?php if(!empty(request()->get('order')) and request()->get('order') == 'priced'): ?> selected <?php endif; ?>><?php echo e(trans('admin.item_price')); ?>-<?php echo e(trans('admin.descending')); ?></option>
                                <option value="datea" <?php if(!empty(request()->get('order')) and request()->get('order') == 'datea'): ?> selected <?php endif; ?>><?php echo e(trans('admin.th_date')); ?>-<?php echo e(trans('admin.ascending')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="submit" class="text-center btn btn-primary w-100" value="Apply Filter">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th><?php echo e(trans('admin.th_title')); ?></th>
                    <th class="text-center" width="150"><?php echo e(trans('admin.th_date')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_vendor')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.sales')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.parts')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.income')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.views')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.price')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.category')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.type')); ?></th>
                    <th class="text-center" width="50"><?php echo e(trans('admin.th_status')); ?></th>
                    <th class="text-center" width="100"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $meta = arrayToList($item->metas, 'option', 'value'); ?>
                    <tr>
                        <td><a href="/product/<?php echo e($item->id); ?>" target="_blank"><?php echo e($item->title); ?></a></td>
                        <td class="text-center" width="150"><?php echo e(date('d F Y / H:i',$item->created_at)); ?></td>
                        <td class="text-center" title="<?php echo e($item->user->username); ?>"><?php echo e($item->user->name); ?></td>
                        <td class="text-center"><?php echo e($item->sells_count ?? '0'); ?></td>
                        <td class="text-center"><?php echo e($item->partsactive_count ?? '0'); ?></td>
                        <td class="text-center"><?php echo e($item->transactions->sum('price')); ?><br><?php echo e(trans('admin.cur_dollar')); ?></td>
                        <td class="text-center"><?php echo e($item->view ?? '0'); ?></td>
                        <td class="text-center"><?php echo e($meta['price'] ?? 'Free'); ?></td>
                        <td class="text-center"><?php echo e(!empty($item->category) ? $item->category->title : ''); ?></td>
                        <td class="text-center">
                            <?php if($item->private==1): ?>
                                <b class="c-g"><?php echo e(trans('admin.exclusive')); ?></b>
                            <?php else: ?>
                                <b class="c-o"><?php echo e(trans('admin.open')); ?></b>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($item->parts_request_count > 0): ?>
                                <b class="c-o"><?php echo e(trans('admin.pending')); ?></b>
                            <?php endif; ?>
                            <?php if($item->mode == 'request'): ?>
                                <b class="c-r"><?php echo e(trans('admin.review_request')); ?></b>
                            <?php elseif($item->mode == 'delete'): ?>
                                <b class="c-r"><?php echo e(trans('admin.unpublish_request')); ?></b>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="/admin/notification/new?recipent_type=userone&uid=<?php echo e($item->user->id); ?>" title="Send notification to user"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
                            <a href="/admin/ticket/new?uid=<?php echo e($item->user->id); ?>&title=Course <?php echo e($item->title); ?>" title="Send support ticket to user"><i class="fa fa-life-ring" aria-hidden="true"></i></a>
                            <a href="/admin/content/edit/<?php echo e($item->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" data-href="/admin/content/delete/<?php echo e($item->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            <?php echo $lists->appends($_GET)->links('pagination.default'); ?>

        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Courses','Latest Courses']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/content/waiting.blade.php ENDPATH**/ ?>