<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.view_templates')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="card">
        <div class="card-header">
            <h3><?php echo e(trans('admin.add_new_template')); ?></h3>
        </div>
        <div class="card-body">
            <div class="tab-pane active">
                <form method="post" action="/admin/setting/view_templates/store" class="form-horizontal form-bordered">
                    <?php echo e(csrf_field()); ?>


                    <?php if($errors->any()): ?>
                        <ul>
                            <?php echo implode('', $errors->all('<li style="color: red">:message</li>')); ?>

                        </ul>
                    <?php endif; ?>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.folder')); ?></label>
                        <div class="col-md-8">
                            <input type="text" name="folder" placeholder="<?php echo e(trans('admin.add_folder_name')); ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <div class="custom-switches-stacked">
                                <label class="custom-switch">
                                    <input type="hidden" name="status" value="0">
                                    <input type="checkbox" name="status" value="1" class="custom-switch-input"/>
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault">status</label>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6">
                            <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h3><?php echo e(trans('admin.view_templates_list')); ?></h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-basic">
                <thead>
                <tr>
                    <th><?php echo e(trans('admin.folder')); ?></th>
                    <th class="text-center" width="200"><?php echo e(trans('admin.status')); ?></th>
                    <th class="text-center" width="200"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($list->folder); ?></td>
                        <td class="text-center">
                            <?php if($list->status): ?>
                                <?php echo e(trans('admin.active')); ?>

                            <?php else: ?>
                                <?php echo e(trans('admin.disabled')); ?>

                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="/admin/setting/view_templates/toggle/<?php echo e($list->id); ?>" title="<?php echo e(($list->status) ? 'Disable' : 'Active'); ?>">
                                <i class="fa fa-arrow-<?php echo e(($list->status) ? 'down' : 'up'); ?>" style="font-size: 18px;margin-right: 16px" aria-hidden="true"></i>
                            </a>
                            <a href="#" data-href="/admin/setting/view_templates/delete/<?php echo e($list->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" style="font-size: 18px" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Settings','Social Networks']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/setting/view_templates.blade.php ENDPATH**/ ?>