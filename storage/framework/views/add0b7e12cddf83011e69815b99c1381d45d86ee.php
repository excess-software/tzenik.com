<?php $__env->startSection('title'); ?>
    User groups
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <div class="tabs">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#list" data-toggle="tab"><?php echo e(trans('admin.user_groups')); ?></a>
            </li>
            <li>
                <a href="#newitem" data-toggle="tab"><?php echo e($edit->title); ?> <?php echo e(trans('admin.edit_button')); ?></a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="list" class="tab-pane active">
                <table class="table table-bordered table-striped mb-none" id="datatable-details">
                    <thead>
                    <tr>
                        <th><?php echo e(trans('admin.user_groups_th_group_title')); ?></th>
                        <th class="text-center" width="80"><?php echo e(trans('admin.th_discount')); ?></th>
                        <th class="text-center" width="80"><?php echo e(trans('admin.th_commission')); ?></th>
                        <th class="text-center" width="80"><?php echo e(trans('admin.th_users')); ?></th>
                        <th class="text-center" width="80"><?php echo e(trans('admin.th_status')); ?></th>
                        <th class="text-center" width="80"><?php echo e(trans('admin.th_controls')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($list->title); ?></td>
                            <td class="text-center" width="80">%<?php echo e($list->off); ?></td>
                            <td class="text-center" width="80">%<?php echo e($list->commision); ?></td>
                            <td class="text-center" width="80"><a href="/admin/user/incategory/<?php echo e($list->id); ?>"><?php echo e($list->users_count); ?></a></td>
                            <td class="text-center">
                                <?php if($list->mode == 'publish'): ?>
                                    <b class="c-g"><?php echo e(trans('admin.new_user_group_status_enabled')); ?></b>
                                <?php else: ?>
                                    <b class="c-r"><?php echo e(trans('admin.new_user_group_status_disables')); ?></b>
                                <?php endif; ?>
                            </td>
                            <td class="text-center" width="80">
                                <a href="/admin/user/category/edit/<?php echo e($list->id); ?>#newitem" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a href="#" data-href="/admin/user/category/delete/<?php echo e($list->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div id="newitem" class="tab-pane ">
                <form method="post" action="/admin/user/category/edit/store/<?php echo e($edit->id); ?>" class="form-horizontal form-bordered">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.new_user_group_title')); ?></label>
                        <div class="col-md-6">
                            <input type="text" name="title" value="<?php echo e($edit->title); ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.th_discount')); ?></label>
                        <div class="col-md-6">
                            <input type="number" name="off" value="<?php echo e($edit->off); ?>" placeholder="%" class="form-control text-center">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.th_commission')); ?></label>
                        <div class="col-md-6">
                            <input type="number" name="commision" value="<?php echo e($edit->commision); ?>" placeholder="%" class="form-control text-center">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.th_icon')); ?></label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-addon view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="image"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                <input type="text" name="image" dir="ltr" value="<?php echo e($edit->image); ?>" class="form-control">
                                <span class="input-group-addon click-for-upload cu-p"><i class="fa fa-upload" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.th_status')); ?></label>
                        <div class="col-md-6">
                            <select name="mode" class="form-control populate" id="type">
                                <option value="publish" <?php if($edit->mode == 'publish'): ?> selected <?php endif; ?>><?php echo e(trans('admin.new_user_group_status_enabled')); ?></option>
                                <option value="draft" <?php if($edit->mode == 'draft'): ?> selected <?php endif; ?>><?php echo e(trans('admin.new_user_group_status_disables')); ?></option>
                            </select>
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

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Users','Group','List']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/user/categroyedit.blade.php ENDPATH**/ ?>