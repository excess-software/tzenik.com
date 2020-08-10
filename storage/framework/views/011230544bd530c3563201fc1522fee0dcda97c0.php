<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.course_list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <header class="card-header">
            <h2 class="card-title"><?php echo e(trans('admin.filter_items')); ?></h2>
        </header>
        <div class="card-body">
            <form>
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="date" class="form-control text-center" id="fdate" name="fdate" value="<?php echo request()->get('fdate') ?? ''; ?>">
                            <span class="input-group-append fdatebtn" id="fdatebtn">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group">
                            <input type="date" id="ldate" name="ldate" class="form-control text-center" value="<?php echo request()->get('ldate') ?? ''; ?>">
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
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" class="form-control text-center" name="id" placeholder="Item Code" value="<?php echo request()->get('id') ?? ''; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
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
    <a href="/admin/content/list/excel?<?php echo http_build_query(Request()->all()); ?><?php echo e(!empty($mode) ? '&mode='.$mode : ''); ?>" class="btn btn-primary">Export as xls</a>
    <div class="h-10"></div>
    <section class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none" id="datatable-details">
                    <thead>
                    <tr>
                        <th class="text-center" width="30">#</th>
                        <th><?php echo e(trans('admin.th_title')); ?></th>
                        <th class="text-center" width="150"><?php echo e(trans('admin.th_date')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.th_vendor')); ?></th>
                        <th class="text-center" width="50"><?php echo e(trans('admin.sales')); ?></th>
                        <th class="text-center" width="50"><?php echo e(trans('admin.parts')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.income')); ?></th>
                        <th class="text-center" width="50"><?php echo e(trans('admin.views')); ?></th>
                        <th class="text-center" width="50"><?php echo e(trans('admin.item_price')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.category')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.type')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.spend_time')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.top_viewer')); ?></th>
                        <th class="text-center" width="50"><?php echo e(trans('admin.th_status')); ?></th>
                        <th class="text-center" width="100"><?php echo e(trans('admin.th_controls')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $meta = arrayToList($item->metas,'option','value'); ?>
                        <tr>
                            <td class="text-center"><?php echo $item->id; ?></td>
                            <td><a href="/product/<?php echo e($item->id); ?>" target="_blank"><?php echo e($item->title); ?></a></td>
                            <td class="text-center" width="150"><?php echo e(date('d F Y / H:i',$item->created_at)); ?></td>
                            <td class="text-center" title="<?php echo e($item->user->username); ?>"><a href="/admin/user/item/<?php echo e($item->user->id); ?>"><?php echo e($item->user->name); ?></a></td>
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
                            <td class="text-center"><?php echo productSpendTime($item->id); ?></td>
                            <td class="text-center">
                                <?php if(productTopViewer($item->id)): ?>
                                    <?php echo productTopViewer($item->id); ?>

                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($item->mode == 'publish'): ?>
                                    <b class="c-g"><?php echo e(trans('admin.published')); ?></b>
                                <?php elseif($item->mode == 'draft'): ?>
                                    <b class="c-o"><?php echo e(trans('admin.draft')); ?></b>
                                <?php elseif($item->mode == 'request'): ?>
                                    <span class="c-r"><?php echo e(trans('admin.pending')); ?></span>
                                <?php elseif($item->mode == 'delete'): ?>
                                    <span class="c-r"><?php echo e(trans('admin.unpublish_request')); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="/admin/notification/new?recipent_type=userone&uid=<?php echo e($item->user->id); ?>" title="Send notification to user"><i class="fa fa-bell-o" aria-hidden="true"></i></a>
                                <a href="/admin/ticket/new?uid=<?php echo e($item->user->id); ?>&title=Course <?php echo e($item->title); ?>" title="Send support ticket to user"><i class="fa fa-life-ring" aria-hidden="true"></i></a>
                                <a href="/admin/content/edit/<?php echo e($item->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a href="#" data-href="/admin/content/delete/<?php echo e($item->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                <a href="/admin/content/usage/<?php echo e($item->id); ?>" title="Spend Time"><i class="fa fa-clock" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-center">
            <?php echo $lists->appends($_GET)->links('pagination.default'); ?>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Courses','Latest Courses']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\proacademy\resources\views/admin/content/list.blade.php ENDPATH**/ ?>