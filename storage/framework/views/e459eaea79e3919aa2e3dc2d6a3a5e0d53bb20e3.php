<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.latest_requests')); ?>

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
                            <input type="date" id="lsdate" value="<?php echo request()->get('lsdate') ?? ''; ?>" class="text-center form-control" name="lsdate" placeholder="End Date">
                            <input type="hidden" id="ldate" name="ldate" value="<?php echo request()->get('ldate') ?? ''; ?>">
                            <span class="input-group-append ldatebtn" id="ldatebtn">
                                <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                            </span>
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
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none" id="datatable-details">
                    <thead>
                    <tr>
                        <th><?php echo e(trans('admin.th_title')); ?></th>
                        <th class="text-center" width="150"><?php echo e(trans('admin.th_date')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.applicant_user')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.applicated_user')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.followers')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.category')); ?></th>
                        <th class="text-center"><?php echo e(trans('admin.accepted_content')); ?></th>
                        <th class="text-center" width="50"><?php echo e(trans('admin.th_status')); ?></th>
                        <th class="text-center" width="100"><?php echo e(trans('admin.th_controls')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="cu-p" data-toggle="modal" href="#description<?php echo e($item->id); ?>"><?php echo e($item->title); ?></td>
                            <td class="text-center" width="150"><?php echo e(date('d F Y / H:i',$item->created_at)); ?></td>
                            <td class="text-center" title="<?php echo e(!empty($item->requester) ? $item->requester->username : ''); ?>"><?php echo e(!empty($item->requester) ? $item->requester->name : ''); ?></td>
                            <td class="text-center" title="<?php echo e(!empty($item->user) ? $item->user->username : ''); ?>"><?php echo e(!empty($item->user) ? $item->user->name : ''); ?></td>
                            <td class="text-center"><?php echo e($item->fans_count); ?></td>
                            <td class="text-center"><?php echo e(!empty($item->category) ? $item->category->title : ''); ?></td>
                            <td class="text-center">
                                <?php if(!empty($item->content)): ?>
                                    <a href="/product/<?php echo e($item->content->id); ?>" target="_blank"><?php echo e($item->content->title); ?></a>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($item->mode == 'publish'): ?>
                                    <span class="c-g f-w-b"><?php echo e(trans('admin.published')); ?></span>
                                <?php else: ?>
                                    <span class="c-o"><?php echo e(trans('admin.waiting')); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php if($item->mode == 'publish'): ?>
                                    <a href="/admin/request/draft/<?php echo e($item->id); ?>" title="Add to waiting list"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                                <?php else: ?>
                                    <a href="/admin/request/publish/<?php echo e($item->id); ?>" title="Publish item"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                                <?php endif; ?>
                                <a href="#" data-href="/admin/request/delete/<?php echo e($item->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="modal fade" role="dialog" id="description<?php echo e($item->id); ?>">
            <div class="modal-dialog" style="z-index: 1050">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo e($item->description ?? 'No Description...'); ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(trans('admin.close')); ?></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Course Requests','Latest Requests']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/request/list.blade.php ENDPATH**/ ?>