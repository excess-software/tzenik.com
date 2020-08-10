<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.featured_products')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <section class="card">
        <div class="card-body">
            <form action="/admin/ads/vip/store" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.course')); ?></label>
                    <div class="col-md-4">
                        <select name="content_id" data-plugin-selectTwo class="form-control populate" id="type">
                            <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($content->id); ?>"><?php echo e($content->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="h-20"></div>
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.th_status')); ?></label>
                    <div class="col-md-4">
                        <select name="mode" class="form-control" required>
                            <option value="publish"><?php echo e(trans('admin.published')); ?></option>
                            <option value="draft"><?php echo e(trans('admin.waiting')); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.start_end')); ?></label>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="date" id="fdate" class="text-center form-control" name="fdate" placeholder="Start Date" required>
                            <span class="input-group-append fdatebtn" id="fdatebtn">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="h-20"></div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="date" id="ldate" class="text-center form-control" name="ldate" placeholder="End Date" required>
                            <span class="input-group-append ldatebtn" id="ldatebtn">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="h-20"></div>
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.type')); ?></label>
                    <div class="col-md-4">
                        <select name="type" class="form-control">
                            <option value="slide"><?php echo e(trans('admin.homepage_slider')); ?></option>
                            <option value="category"><?php echo e(trans('admin.top_category')); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.short_description')); ?></label>
                    <div class="col-md-10">
                        <textarea class="form-control" rows="8" name="description"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault"></label>
                    <div class="col-md-8">
                        <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
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
                    <th class="text-center" width="120"><?php echo e(trans('admin.start_date')); ?></th>
                    <th class="text-center" width="120"><?php echo e(trans('admin.end_date')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.course')); ?></th>
                    <th class="text-center" width="100"><?php echo e(trans('admin.type')); ?></th>
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
                            <?php if(!empty($item->content)): ?>
                                <a target="_blank" href="/product/<?php echo e($item->content->id); ?>"><?php echo e(!empty($item->content->title) ? $item->content->title : 'Item not found.'); ?></a>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($item->type == 'slide' or $item->type == null): ?>
                                <?php echo e(trans('admin.homepage_slider')); ?>

                            <?php else: ?>
                                <?php echo e(trans('admin.top_category')); ?>

                            <?php endif; ?>
                        </td>
                        <td class="text-center" width="50">
                            <?php if(time()>$item->last_date): ?>
                                <b class="color-red-i"><?php echo e(trans('admin.expired')); ?></b>
                            <?php elseif($item->mode == 'publish'): ?>
                                <b class="color-green"><?php echo e(trans('admin.active')); ?></b>
                            <?php elseif($item->mode == 'draft'): ?>
                                <b class="color-red-i"><?php echo e(trans('admin.disabled')); ?></b>
                            <?php endif; ?>
                        </td>
                        <td class="text-center" width="50">
                            <a href="/admin/ads/vip/edit/<?php echo e($item->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" data-href="/admin/ads/vip/delete/<?php echo e($item->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Advertising','Featured']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/ads/vip.blade.php ENDPATH**/ ?>