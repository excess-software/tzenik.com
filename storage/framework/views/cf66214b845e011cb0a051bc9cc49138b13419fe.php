<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.reply_ticket')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="card">
        <div class="card-body">
            <a href="/admin/ticket/user/<?php echo e($ticket->id); ?>" class="btn btn-primary"><?php echo e(trans('admin.add_user_conversation')); ?></a>
            &nbsp;&nbsp;
            <span><?php echo e(trans('admin.ticket_created_by')); ?> </span>
            <span><a href="/profile/<?php echo e($ticket->user->id); ?>" target="_blank"><?php echo e($ticket->user->username); ?></a></span>
            <span> <?php echo e(trans('admin.and_this_users_invited')); ?> </span>
            <span>
                <?php $__currentLoopData = $ticket->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    &nbsp;<a href="/profile/<?php echo e($tUser->user->id); ?>" target="_blank"><?php echo e($tUser->user->username); ?></a>&nbsp;
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </span>
        </div>
    </div>

    <?php $__currentLoopData = $ticketMsg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <section class="card">
            <?php if($msg->mode == 'user'): ?>
                <header class="card-header">
                    <?php else: ?>
                        <header class="card-header" style="background: #008DEF">
                            <?php endif; ?>
                            <div class="card-header-action" style="float: right;position: relative;right: 10px;">
                                <?php if($msg->attach != null && $msg->attach != ''): ?>
                                    <a href="<?php echo $msg->attach; ?>" target="_blank" class="panel-action custom-reply"><i class="fa fa-paperclip" style="color: gray"></i></a>
                                <?php endif; ?>
                                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                            </div>

                            <?php if($msg->mode == 'user'): ?>
                                <h4 class="card-title"><?php echo e(trans('admin.user')); ?> - <?php echo e($msg->user->name); ?></h4>
                            <?php else: ?>
                                <h4 class="card-title" style="color: #fafafa"> <?php echo e(trans('admin.support_staff')); ?> - <?php echo e($msg->user->name); ?></h4>
                            <?php endif; ?>
                        </header>
                        <div class="card-body">
                            <?php echo $msg->msg; ?>

                            <hr>
                            <a href="/admin/ticket/reply/<?php echo e($msg->ticket_id); ?>/edit/<?php echo e($msg->id); ?>" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <a href="#" title="Delete" data-href="/admin/ticket/reply/delete/<?php echo e($msg->id); ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            <span class="float-right custom-reply-2"><?php echo e(date('d F Y : H:i',$msg->created_at)); ?></span>
                        </div>
        </section>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <section class="card">
        <header class="card-header">
            <div class="card-header-action">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h4 class="card-title"><?php echo e(trans('admin.reply_ticket')); ?></h4>

        </header>
        <div class="card-body">
            <form action="/admin/ticket/reply/store/<?php echo e($ticket->id); ?>" class="form-horizontal form-bordered" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id" value="<?php echo e($item->id ?? ''); ?>">

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="msg" required><?php echo e($item->msg ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3 text-left"><?php echo e(trans('admin.attachments')); ?></label>
                    <div class="col-md-6">

                        <div class="input-group" style="display: flex">
                            <button type="button" data-input="attach" data-preview="holder" class="lfm_image btn btn-primary">
                                Choose
                            </button>
                            <input id="attach" class="form-control" value="<?php echo e($item->attach ?? ''); ?>" type="text" name="attach" dir="ltr" >
                            <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="attach">
                                <span class="input-group-text">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <?php if($ticket->mode == 'open'): ?>
                            <a class="btn btn-danger pull-right" href="/admin/ticket/close/<?php echo e($ticket->id); ?>"><?php echo e(trans('admin.close_ticket')); ?></a>
                        <?php else: ?>
                            <a class="btn btn-success pull-right" href="/admin/ticket/open/<?php echo e($ticket->id); ?>"><?php echo e(trans('admin.open_ticket')); ?></a>
                        <?php endif; ?>
                        <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.send')); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Support','Reply Ticket',$ticket->title]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/ticket/reply.blade.php ENDPATH**/ ?>