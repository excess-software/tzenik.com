<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.cat_filters')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="card">
        <div class="card-body">
            <div class="tabs">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#list" data-toggle="tab"> <?php echo e(trans('admin.cat_filters')); ?> </a></li>
                    <li class="nav-item"><a class="nav-link" href="#newitem" data-toggle="tab"> <?php echo e(trans('admin.new_filter')); ?> </a></li>
                </ul>
                <div class="tab-content">
                    <div id="list" class="tab-pane active">
                        <table class="table table-bordered table-striped mb-none" id="datatable-details">
                            <thead>
                            <tr>
                                <th><?php echo e(trans('admin.th_title')); ?></th>
                                <th class="text-center" width="80"><?php echo e(trans('admin.filter_tags')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('admin.th_controls')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($list->filter); ?></td>
                                    <td class="text-center"><?php echo e($list->tags_count); ?></td>
                                    <td class="text-center">
                                        <a href="/admin/content/category/filter/tag/<?php echo e($list->id); ?>" title="Filter Tags"><i class="fa fa-tags" aria-hidden="true"></i></a>
                                        <a href="/admin/content/category/filter/<?php echo e($id); ?>/edit/<?php echo e($list->id); ?>#edit" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        <a href="#" data-href="/admin/content/category/filter/delete/<?php echo e($list->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="newitem" class="tab-pane ">
                        <form method="post" action="/admin/content/category/filter/store/new" class="form-horizontal form-bordered">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="category_id" value="<?php echo e($id); ?>">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.filter_title')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="filter" value="" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.sort')); ?></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control text-center" name="sort" maxlength="3" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Courses','Categories','Filters']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/content/filters.blade.php ENDPATH**/ ?>