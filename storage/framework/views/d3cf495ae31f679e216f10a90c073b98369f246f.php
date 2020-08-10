<?php $__env->startSection('video_tab2','active'); ?>

<?php $__env->startSection('video_tab'); ?>
    <div class="accordion-off col-xs-12">
        <ul id="accordion" class="accordion off-filters-li">
            <li <?php if(isset($record->id)): ?> class="open" <?php endif; ?>>
                <div class="link"><h2><?php echo e(trans('main.submit_future_course')); ?></h2><i class="mdi mdi-chevron-down"></i></div>
                <ul class="submenu" <?php if(isset($record->id)): ?> style="display: block;" <?php endif; ?>>
                    <div class="h-10"></div>
                    <form method="post" <?php if(isset($record->id)): ?> action="/user/video/record/edit/store/<?php echo e($record->id); ?>" <?php else: ?> action="/user/video/record/store" <?php endif; ?> class="form form-horizontal">
                        <?php echo e(csrf_field()); ?>

                        <div class="h-10"></div>
                        <div class="form-group">
                            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.title')); ?></label>
                            <div class="col-md-5 tab-con">
                                <input type="text" name="title" value="<?php echo e(!empty($record) ? $record->title : ''); ?>" class="form-control">
                            </div>
                            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.category')); ?></label>
                            <div class="col-md-5 tab-con">
                                <select name="category_id" class="form-control font-s">
                                    <option value="0"><?php echo e(trans('main.select_category')); ?></option>
                                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($menu->parent_id == 0): ?>
                                            <optgroup label="<?php echo e($menu->title); ?>">
                                                <?php if(count($menu->childs)>0): ?>
                                                    <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($sub->id); ?>" <?php if(isset($record->category_id) and $sub->id == $record->category_id): ?> selected <?php endif; ?>><?php echo e($sub->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <option value="<?php echo e($menu->id); ?>" <?php if(isset($record->category_id) and $menu->id == $record->category_id): ?> selected <?php endif; ?>><?php echo e($menu->title); ?></option>
                                                <?php endif; ?>
                                            </optgroup>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.course')); ?></label>
                            <div class="col-md-5 tab-con">
                                <select name="off_id" class="form-control font-s">
                                    <option value="0" <?php if(isset($record->content_id) and $record->content_id == 0): ?> selected <?php endif; ?>><?php echo e(trans('main.recording')); ?></option>
                                    <?php $__currentLoopData = $userContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($uc->id); ?>" <?php if(isset($record->content_id) and $record->content_id == $uc->id): ?> selected <?php endif; ?>><?php echo e($uc->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.thumbnail')); ?></label>
                            <div class="col-md-5 tab-con">
                                <div class="input-group">
                                    <span class="input-group-addon view-selected img-icon-s" data-toggle="modal" data-target="#ImageModal" data-whatever="image"><span class="formicon mdi mdi-eye"></span></span>
                                    <input type="text" name="image" dir="ltr" value="<?php echo e(!empty($record->image) ? $record->image : ''); ?>" class="form-control">
                                    <span class="input-group-addon click-for-upload img-icon-s"><span class="formicon mdi mdi-arrow-up-thick"></span></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.description')); ?></label>
                            <div class="col-md-5 tab-con">
                                <textarea class="form-control" name="description"><?php echo e(!empty($record->description) ? $record->description : ''); ?></textarea>
                            </div>
                            <label class="control-label col-md-1 tab-con"></label>
                            <div class="col-md-5 tab-con">
                                <button type="submit" class="btn btn-custom pull-left"><span><?php echo e(trans('main.save_changes')); ?></span></button>
                            </div>
                        </div>
                    </form>
                    <div class="h-10"></div>
                </ul>
            </li>
            <li class="open">
                <div class="link"><h2><?php echo e(trans('main.future_courses_list')); ?></h2><i class="mdi mdi-chevron-down"></i></div>
                <ul class="submenu dblock">
                    <div class="h-10"></div>
                    <?php if(count($lists) == 0): ?>
                        <div class="text-center">
                            <img src="/assets/default/images/empty/Videos.png">
                            <div class="h-20"></div>
                            <span class="empty-first-line"><?php echo e(trans('main.no_future_course')); ?></span>
                            <div class="h-10"></div>
                            <span class="empty-second-line">
                                <span><?php echo e(trans('main.future_course_desc')); ?></span>
                            </span>
                            <div class="h-20"></div>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table ucp-table" id="record-table">
                                <thead class="thead-s">
                                <th class="cell-ta"><?php echo e(trans('main.title')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('main.thumbnail')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('main.followers')); ?></th>
                                <th class="text-center"><?php echo e(trans('main.course')); ?></th>
                                <th class="text-center"><?php echo e(trans('main.category')); ?></th>
                                <th class="text-center"><?php echo e(trans('main.date')); ?></th>
                                <th class="text-center" width="50"><?php echo e(trans('main.status')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('main.controls')); ?></th>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="text-center">
                                        <td class="cell-ta"><?php echo e($item->title); ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo e($item->image); ?>" target="_blank"><?php echo e(trans('main.view')); ?></a>
                                        </td>
                                        <td class="text-center"><?php echo e($item->fans_count); ?></td>
                                        <td class="text-center">
                                            <?php if(!empty($item->content)): ?>
                                                <?php echo e($item->content->title ?? 'Future Course (Recording)'); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if(!empty($item->category)): ?>
                                                <?php echo e($item->category->title); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center"><?php echo e(date('d F Y H:i',$item->created_at)); ?></td>
                                        <td>
                                            <?php if($item->mode == "publish"): ?>
                                                <b class="green-s"><?php echo e(trans('main.published')); ?></b>
                                            <?php elseif($item->mode == "delete"): ?>
                                                <b class="red-s"><?php echo e(trans('main.delete')); ?></b>
                                            <?php else: ?>
                                                <b class="orange-s"><?php echo e(trans('main.disabled')); ?></b>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a class="gray-s" href="/user/video/record/edit/<?php echo e($item->id); ?>" title="Edit"><span class="crticon mdi mdi-lead-pencil"></span></a>
                                            <a class="gray-s" href="/user/video/record/delete/<?php echo e($item->id); ?>" onclick="return confirm('Are you sure to delete item?');" title="Delete"><span class="crticon mdi mdi-delete-forever"></span></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </ul>
            </li>
        </ul>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>$('#buy-hover').addClass('item-box-active');</script>
    <script>
        $(function () {
            var objCal = new AMIB.persianCalendar('first_date_t',
                {
                    btnClassName: 'first_date_btn',
                    extraInputID: "first_date",
                    extraInputFormat: "DD-MM-YYYY"
                });
            $('.first_date_btn').click(function (e) {
                objCal.showHidePicker();
            });
        });
        $(function () {
            var objCal1 = new AMIB.persianCalendar('last_date_t',
                {
                    btnClassName: 'last_date_btn',
                    extraInputID: "last_date",
                    extraInputFormat: "DD-MM-YYYY"
                });
            $('.last_date_btn').click(function (e) {
                objCal1.showHidePicker();
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($user['vendor'] == 1 ? getTemplate() . '.user.layout.requestVideoLayout' : getTemplate() . '.user.layout_user.requestVideoLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/record/record.blade.php ENDPATH**/ ?>