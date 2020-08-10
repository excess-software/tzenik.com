<?php $__env->startSection('pages'); ?>

    <div class="container-fluid">
        <div class="container">
            <div class="h-20"></div>
            <div class="col-md-6 col-xs-12 tab-con">
                <div class="ucp-section-box">
                    <div class="header back-red"><?php echo e(trans('main.new_channel')); ?></div>
                    <div class="body">
                        <form method="post" action="/user/channel/store">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label class="control-label" for="inputDefault"><?php echo e(trans('main.title')); ?></label>
                                <input type="text" name="title" class="form-control" id="inputDefault" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="inputDefault"><?php echo e(trans('main.link')); ?></label>
                                <input type="text" name="username" class="form-control" id="inputDefault" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?php echo e(trans('main.cover')); ?></label>
                                <div class="input-group" style="display: flex">
                                    <button type="button" data-input="image" data-preview="holder" class="lfm_load btn btn-primary">
                                        Choose
                                    </button>
                                    <input id="image" class="form-control" value="<?php echo e($edit->image ?? ''); ?>" type="text" name="image" dir="ltr">
                                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="image">
                                        <span class="input-group-text">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?php echo e(trans('main.icon')); ?></label>
                                <div class="input-group" style="display: flex">
                                    <button type="button" data-input="avatar" data-preview="holder" class="lfm_load btn btn-primary">
                                        Choose
                                    </button>
                                    <input id="avatar" class="form-control" value="<?php echo e($edit->avatar ?? ''); ?>" type="text" name="avatar" dir="ltr">
                                    <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="avatar">
                                        <span class="input-group-text">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?php echo e(trans('main.description')); ?></label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-custom pull-left" value="Save Changes"><?php echo e(trans('main.save_changes')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xs-12 tab-con">
                <?php if(count($channels) == 0): ?>
                    <div class="text-center">
                        <img src="/assets/default/images/empty/channel.png">
                        <div class="h-20"></div>
                        <span class="empty-first-line"><?php echo e(trans('main.no_channel')); ?></span>
                        <div class="h-10"></div>
                        <span class="empty-second-line">
                        <span><?php echo e(trans('main.channel_desc')); ?></span>
                        </span>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table ucp-table" id="chanel-table">
                            <thead class="back-blue">
                            <th class="text-center"><?php echo e(trans('main.title')); ?></th>
                            <th class="text-center"><?php echo e(trans('main.link')); ?></th>
                            <th class="text-center"><?php echo e(trans('main.views')); ?></th>
                            <th class="text-center"><?php echo e(trans('main.contents')); ?></th>
                            <th class="text-center"><?php echo e(trans('main.status')); ?></th>
                            <th class="text-center"><?php echo e(trans('main.controls')); ?></th>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($channel->title); ?></td>
                                    <td class="text-center">
                                        <a href="/chanel/<?php echo e($channel->username); ?>"><?php echo e($channel->username); ?></a>
                                    </td>
                                    <td class="text-center"><?php echo e($channel->view); ?></td>
                                    <td class="text-center"><?php echo e($channel->contents_count); ?></td>
                                    <td class="text-center">
                                        <?php if($channel->mode==null Or $channel->mode=='pending'): ?>
                                            <b class="blue-s"><?php echo e(trans('main.waiting')); ?></b>
                                        <?php else: ?>
                                            <b class="green-s"><?php echo e(trans('main.active')); ?></b>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/user/channel/request/<?php echo e($channel->id); ?>" title="Request channel verification"><span class="crticon mdi mdi-check-decagram"></span></a>
                                        <a href="/user/channel/video/<?php echo e($channel->id); ?>" title="Add video to channel"><span class="crticon mdi mdi-file-video"></span></a>
                                        <a href="#" data-href="/user/channel/delete/<?php echo e($channel->id); ?>" data-toggle="modal" data-target="#confirm-delete" title="Delete channel"><span class="crticon mdi mdi-delete-forever"></span></a>
                                        <a href="/user/channel/edit/<?php echo e($channel->id); ?>"><span class="crticon mdi mdi-lead-pencil"></span></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('.lfm_load').filemanager('file', {prefix: '/user/laravel-filemanager'});
        $('#channel-hover').addClass('item-box-active');
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/channel/list.blade.php ENDPATH**/ ?>