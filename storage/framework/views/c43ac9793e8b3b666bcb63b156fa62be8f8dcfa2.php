<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.usergp_pagetitle')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="card">
        <div class="card-header"><?php echo e(trans('admin.usergp_pagetitle')); ?></div>
        <div class="card-body">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#list" data-toggle="tab"> <?php echo e(trans('admin.user_groups_tab_title')); ?> </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#newitem" data-toggle="tab"><?php echo e(trans('admin.new_user_group_tab_title')); ?></a>
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
                    <form method="post" action="/admin/user/category/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>


                        <?php if($errors->any()): ?>
                            <ul>
                                <?php echo implode('', $errors->all('<li style="color: red">:message</li>')); ?>

                            </ul>
                        <?php endif; ?>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.new_user_group_title')); ?></label>
                            <div class="col-md-6">
                                <input type="text" name="title" value="" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.new_user_group_discount')); ?></label>
                            <div class="col-md-6">
                                <input type="number" name="off" value="" placeholder="%" class="form-control text-center">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.new_user_group_commission')); ?></label>
                            <div class="col-md-6">
                                <input type="number" name="commision" value="" placeholder="%" class="form-control text-center">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.new_user_group_icon')); ?></label>
                            <div class="col-md-6">
                                <div class="input-group" style="display: flex">
                                    <button type="button" data-input="image" data-preview="holder" class="lfm_image btn btn-primary">
                                        Choose
                                    </button>
                                    <input id="image" class="form-control" type="text" name="image" dir="ltr" >
                                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="image">
                                        <span class="input-group-text">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.new_user_group_status')); ?></label>
                            <div class="col-md-6">
                                <select name="mode" class="form-control populate" id="type">
                                    <option value="publish"><?php echo e(trans('admin.new_user_group_status_enabled')); ?></option>
                                    <option value="draft"><?php echo e(trans('admin.new_user_group_status_disables')); ?></option>
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
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Users','Groups','List']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/user/categroy.blade.php ENDPATH**/ ?>