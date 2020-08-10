<?php $__env->startSection('tab3','active'); ?>
<?php $__env->startSection('tab'); ?>

    <div class="h-20"></div>
    <div class="row">
        <div class="col-md-6 col-xs-12 tab-con">
            <div class="ucp-section-box">
                <div class="header back-red"><?php echo e(trans('main.reply')); ?></div>
                <div class="body">
                    <form method="post" action="/user/ticket/reply/store">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="ticket_id" value="<?php echo e($ticket->id); ?>">

                        <div class="form-group">
                            <textarea class="form-control" placeholder="Reply..." rows="7" name="msg" required></textarea>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-2 control-label-p"><?php echo e(trans('main.attachment')); ?></label>
                            <div class="input-group" style="display: flex">
                                <button type="button" id="lfm_attach" data-input="attach" data-preview="holder" class="btn btn-primary">
                                    Choose
                                </button>
                                <input id="attach" class="form-control"  dir="ltr" type="text" name="attach" value="<?php echo e(!empty($meta['attach']) ? $meta['attach'] : ''); ?>">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="attach">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-custom pull-left" value="Send"><?php echo e(trans('main.send')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12 tab-con">
            <?php $__currentLoopData = $ticket->messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($msg->mode == 'user'): ?>
                    <div class="ucp-section-box">
                        <div class="header back-blue"><?php echo e(trans('main.user')); ?>-<?php echo e($msg->user->name); ?>

                            <span class="pull-left"><?php echo e(date('d F y h:i',$msg->created_at)); ?></span>
                        </div>
                        <div class="body pos-rel">
                            <?php echo $msg->msg; ?>

                            <?php if($msg->attach != null && $msg->attach != ''): ?>
                                <br>
                                <a href="<?php echo $msg->attach; ?>" target="_blank" class="pull-left attach-s"><span class="crticon mdi mdi-paperclip"></span>&nbsp;Attachment</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="ucp-section-box">
                        <div class="header back-green"><?php echo e(trans('main.staff')); ?>

                            <span class="pull-left"><?php echo e(date('d F y h:i',$msg->created_at)); ?></span>
                        </div>
                        <div class="body pos-rel">
                            <?php echo $msg->msg; ?>

                            <?php if($msg->attach != null && $msg->attach != ''): ?>
                                <br>
                                <a href="<?php echo $msg->attach; ?>" target="_blank" class="pull-left attach-s"><span class="crticon mdi mdi-paperclip"></span>&nbsp;Attachment</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm_attach').filemanager('file', {prefix: '/user/laravel-filemanager'});
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($user['vendor'] == 1 ? getTemplate() . '.user.layout.supportlayout' : getTemplate() . '.user.layout_user.supportlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/ticket/reply.blade.php ENDPATH**/ ?>