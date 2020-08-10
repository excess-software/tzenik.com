

<?php if($user['vendor'] == 1): ?>
    <?php $__env->startSection('tab7','active'); ?>
<?php else: ?>
    <?php $__env->startSection('tab1','active'); ?>
<?php endif; ?>

<?php $__env->startSection('tab'); ?>
    <div class="accordion-off">
        <ul id="accordion" class="accordion off-filters-li">
            <li class="open">
                <div class="link">
                    <h2><?php echo trans('main.live_class'); ?></h2>
                    <i class="mdi mdi-chevron-down"></i>
                </div>
                <ul class="submenu" style="display: block;">
                    <div class="h-10"></div>
                    <form method="post" <?php if(!isset($edit)): ?> action="/user/video/live/new/store" <?php else: ?> action="/user/video/live/edit/store/<?php echo $edit->id; ?>" <?php endif; ?>>
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label><?php echo trans('main.status'); ?></label>
                                    <select name="mode" class="form-control">
                                        <option value="active" <?php if(isset($edit) && $edit->mode == 'active'): ?> selected <?php endif; ?>><?php echo trans('admin.active'); ?></option>
                                        <option value="done" <?php if(isset($edit) && $edit->mode == 'done'): ?> selected <?php endif; ?>><?php echo trans('main.done'); ?></option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label><?php echo trans('main.course'); ?></label>
                                    <select name="content_id" class="form-control">
                                        <option value=""><?php echo trans('admin.select_item'); ?></option>
                                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo $course->id; ?>" <?php if(isset($edit) && $edit->content_id == $course->id): ?> selected <?php endif; ?>><?php echo $course->title ?? ''; ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label><?php echo trans('main.date'); ?></label>
                                    <input type="date" class="form-control" name="date" value="<?php echo $edit->date ?? ''; ?>" required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label><?php echo trans('main.title'); ?></label>
                                    <input type="text" class="form-control" value="<?php echo $edit->title ?? ''; ?>" name="title">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label><?php echo trans('main.time'); ?></label>
                                        <input type="time" class="form-control" value="<?php echo $edit->time ?? ''; ?>" name="time" required>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label><?php echo trans('main.duration'); ?></label>
                                        <div class="input-group">
                                            <input type="text" value="<?php echo $edit->duration ?? ''; ?>" class="form-control text-center" name="duration">
                                            <span class="input-group-addon"><?php echo trans('admin.minutes'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </ul>
            </li>
            <li class="open">
                <div class="link"><h2><?php echo e(trans('main.live_list')); ?></h2><i class="mdi mdi-chevron-down"></i></div>
                <ul class="submenu dblock">
                    <div class="h-10"></div>
                    <div class="table-responsive">
                        <table class="table ucp-table" id="request-table">
                            <thead class="thead-s">
                            <th class="cell-ta"><?php echo e(trans('main.title')); ?></th>
                            <th class="text-center"><?php echo e(trans('main.course')); ?></th>
                            <th class="text-center"><?php echo e(trans('main.date')); ?></th>
                            <th class="text-center"><?php echo e(trans('main.time')); ?></th>
                            <th class="text-center"><?php echo e(trans('main.duration')); ?></th>
                            <th class="text-center"><?php echo e(trans('main.status')); ?></th>
                            <th class="text-center" width="200"><?php echo e(trans('main.controls')); ?></th>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td class="cell-ta"><?php echo $item->title ?? ''; ?></td>
                                    <td class="text-center"><a href="/product/<?php echo $item->content_id ?? ''; ?>" target="_blank"><?php echo $item->content->title ?? ''; ?></a></td>
                                    <td class="text-center"><?php echo $item->date ?? ''; ?></td>
                                    <td class="text-center"><?php echo $item->time ?? ''; ?></td>
                                    <td class="text-center"><?php echo $item->duration ?? ''; ?></td>
                                    <td class="text-center"><?php echo $item->mode ?? ''; ?></td>
                                    <td class="text-center">
                                        <a href="#add_url_modal_<?php echo $item->id; ?>" data-toggle="modal" title="Add Join Link" class="gray-s add_url_btn" data-id="<?php echo $item->id; ?>"><span class="crticon mdi mdi-link"></span></a>
                                        <a href="/user/video/live/users/<?php echo e($item->content_id); ?>" title="Content Users" class="gray-s"><span class="crticon mdi mdi-view-list"></span></a>
                                        <a href="/user/content/meeting/delete/<?php echo e($item->id); ?>" title="Delete" class="gray-s"><span class="crticon mdi mdi-delete-forever"></span></a>
                                        <a href="/user/video/live/edit/<?php echo e($item->id); ?>" title="Edit" class="gray-s"><span class="crticon mdi mdi-pencil"></span></a>
                                    </td>
                                    <div class="modal fade" id="add_url_modal_<?php echo $item->id; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title"><?php echo trans('main.add_url'); ?></h4>
                                                </div>
                                                <form method="post" action="/user/video/live/url/store/<?php echo $item->id; ?>">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label><?php echo trans('main.system'); ?></label>
                                                            <select name="type" id="system-type" class="form-control" required>
                                                                <option value="">Select one</option>
                                                                <option value="zoom" <?php if($item->type == 'zoom'): ?> selected <?php endif; ?>>Zoom(auto Generated)</option>
                                                                <option value="jitsti" <?php if($item->type == 'jitsti'): ?> selected <?php endif; ?>>Jitsti</option>
                                                                <option value="google_meet" <?php if($item->type == 'google_meet'): ?> selected <?php endif; ?>>Google Meet</option>
                                                                <option value="big_blue_button" <?php if($item->type == 'big_blue_button'): ?> selected <?php endif; ?>>Big Blue Button</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label><?php echo trans('main.join_link'); ?></label>
                                                            <input type="text" class="form-control" value="<?php echo $item->join_url ?? ''; ?>" name="join_url" required>
                                                        </div>
                                                        <div class="form-group start-link" <?php if($item->start_url == null && $item->start_url == ''): ?> style="display: none" <?php endif; ?>>
                                                            <label><?php echo trans('main.start_link'); ?></label>
                                                            <input type="text" class="form-control" value="<?php echo $item->start_url ?? ''; ?>" name="start_url">
                                                        </div>
                                                        <div class="form-group">
                                                            <label><?php echo trans('main.meeting_password'); ?></label>
                                                            <input type="text" class="form-control" value="<?php echo $item->password ?? ''; ?>" name="password">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger btn-generate-zoom-meeting pull-right" data-content="<?php echo $item->content_id; ?>" style="display: none">auto generate zoom meeting</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary"><?php echo trans('main.save'); ?></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="h-10"></div>
                </ul>
            </li>
        </ul>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $('#system-type').on('change',function () {
            if($(this).val() == 'zoom'){
                $('.btn-generate-zoom-meeting').show();
            }else{
                $('.btn-generate-zoom-meeting').hide();
                $('.start-link').hide();
            }
        })
    </script>
    <script>
        $('document').ready(function () {
            $('.btn-generate-zoom-meeting').on('click', function () {
                let btn = $(this);
                $.getJSON('/user/content/meeting/action?action=zoom&content_id='+$(this).attr('data-content'),function (response) {
                    if(response.status == 0){
                        btn.parent().parent().find('.start-link').show();
                        btn.parent().parent().find('input[name="join_url"]').val(response.join_url);
                        btn.parent().parent().find('input[name="start_url"]').val(response.start_url);
                    }else{
                        $.notify({
                            message: 'problem with zoom jwt'
                        }, {
                            type: 'danger',
                            allow_dismiss: false,
                            z_index: '99999999',
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                            position: 'fixed'
                        });
                    }
                })
            })
        })
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make($user['vendor'] == 1 ? getTemplate() . '.user.layout.videolayout' : getTemplate() . '.user.layout_user.quizzes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/meeting/list.blade.php ENDPATH**/ ?>