<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.th_edit')); ?> <?php echo e(trans('admin.category')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <div class="tabs">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="#list" class="nav-link" data-toggle="tab"> <?php echo e(trans('admin.categories')); ?> </a>
            </li>
            <li class="nav-item">
                <a href="/admin/content/category" class="nav-link"><?php echo e(trans('admin.new_category')); ?></a>
            </li>
            <li class="nav-item">
                <a href="#edititem" class="nav-link active" data-toggle="tab"><?php echo e(trans('admin.th_edit')); ?></a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="list" class="tab-pane ">
                <table class="table table-bordered table-striped mb-none">
                    <thead>
                    <tr>
                        <th width="36"><?php echo e(trans('admin.th_icon')); ?></th>
                        <th><?php echo e(trans('admin.th_title')); ?></th>
                        <th class="text-center" width="100"><?php echo e(trans('admin.link_title')); ?></th>
                        <th class="text-center" width="100"><?php echo e(trans('admin.th_commission')); ?></th>
                        <th class="text-center" width="150"><?php echo e(trans('admin.subcategories')); ?></th>
                        <th class="text-center" width="100"><?php echo e(trans('admin.th_controls')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="text-center"><img src="<?php echo e($list->image); ?>" class="w-24 h-a"/></td>
                            <td><?php echo e($list->title); ?></td>
                            <td class="text-center"><?php echo e($list->class); ?></td>
                            <td class="text-center"><?php echo e($list->commision); ?></td>
                            <td class="text-center"><a href="/admin/content/category/childs/<?php echo e($list->id); ?>"><?php echo e(!empty($list->childs_count) ? $list->childs_count : '0'); ?></a></td>
                            <td class="text-center">
                                <a href="/admin/content/category/edit/<?php echo e($list->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a href="/admin/content/category/filter/<?php echo e($list->id); ?>" title="Category Filters"><i class="fa fa-tags" aria-hidden="true"></i></a>
                                <a href="#" data-href="/admin/content/category/delete/<?php echo e($list->id); ?>" title="Edit" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div id="edititem" class="tab-pane active">
                <form method="post" action="/admin/content/category/store" class="form-horizontal form-bordered">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="edit" value="<?php echo e($item->id); ?>">
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.parrent_category')); ?></label>
                        <div class="col-md-6">
                            <select name="parent_id" class="form-control">
                                <option value="0"><?php echo e(trans('admin.main_category')); ?></option>
                                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($parent->id); ?>" <?php if($parent->id == $item->parent_id): ?> selected <?php endif; ?>><?php echo e($parent->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                        <div class="col-md-6">
                            <input type="text" name="title" value="<?php echo e($item->title); ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.link_title')); ?></label>
                        <div class="col-md-6">
                            <input type="text" name="class" value="<?php echo e($item->class); ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo e(trans('admin.menu_icon')); ?></label>
                        <div class="col-md-6">
                            <div class="input-group" style="display: flex">
                                <button type="button" data-input="image" data-preview="holder" class="lfm_image btn btn-primary">
                                    Choose
                                </button>
                                <input id="image" class="form-control" type="text" name="image" dir="ltr" required value="<?php echo e($item->image); ?>">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="image">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo e(trans('admin.cat_page_icon')); ?></label>
                        <div class="col-md-6">
                            <div class="input-group" style="display: flex">
                                <button type="button" data-input="icon" data-preview="holder" class="lfm_image btn btn-primary">
                                    Choose
                                </button>
                                <input id="icon" class="form-control" type="text" name="icon" dir="ltr" required value="<?php echo e($item->icon); ?>">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="icon">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo e(trans('admin.cat_page_bg')); ?></label>
                        <div class="col-md-6">
                            <div class="input-group" style="display: flex">
                                <button type="button" data-input="background" data-preview="holder" class="lfm_image btn btn-primary">
                                    Choose
                                </button>
                                <input id="background" class="form-control" type="text" name="background" dir="ltr" required value="<?php echo e($item->background); ?>">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="background">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo e(trans('admin.cat_app_icon')); ?></label>
                        <div class="col-md-6">
                            <div class="input-group" style="display: flex">
                                <button type="button" data-input="app_icon" data-preview="holder" class="lfm_image btn btn-primary">
                                    Choose
                                </button>
                                <input id="app_icon" class="form-control" type="text" name="app_icon" dir="ltr" required value="<?php echo e($item->app_icon); ?>">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="app_icon">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.color_code')); ?></label>
                        <div class="col-md-6">
                            <input type="text" name="color" value="<?php echo e($item->color); ?>" class="form-control text-center">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"><?php echo e(trans('admin.request_icon')); ?></label>
                        <div class="col-md-6">
                            <div class="input-group" style="display: flex">
                                <button type="button" data-input="req_icon" data-preview="holder" class="lfm_image btn btn-primary">
                                    Choose
                                </button>
                                <input id="req_icon" class="form-control" type="text" name="req_icon" dir="ltr" required value="<?php echo e($item->req_icon); ?>">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="req_icon">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.th_commission')); ?></label>
                        <div class="col-md-6">
                            <input type="number" name="commision" min="0" max="100" value="<?php echo e($item->commision); ?>" placeholder="%" class="form-control text-center">
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
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Courses','Category','Edit']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/content/categroyedit.blade.php ENDPATH**/ ?>