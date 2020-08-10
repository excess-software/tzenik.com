<?php $__env->startSection('tab1','active'); ?>
<?php $__env->startSection('tab'); ?>
    <title>
        <?php echo e($setting['site']['site_title']); ?> -
        <?php echo e(trans('main.support')); ?>

    </title>
    <div class="h-20"></div>
    <?php if(count($supports) == 0): ?>
        <div class="text-center">
            <img src="/assets/default/images/empty/productssupport.png">
            <div class="h-20"></div>
            <span class="empty-first-line"><?php echo e(trans('main.no_sup_ticket_courses')); ?></span>
            <div class="h-20"></div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="accordion-off col-xs-12">
                <ul id="accordion" class="accordion off-filters-li">
                    <?php $__currentLoopData = $supports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li <?php if(!empty(request()->get('openid')) && $content->id == request()->get('openid')): ?> class="open" <?php endif; ?>>
                            <div class="link"><h2><?php echo e($content->title ?? ''); ?> (<?php echo e(count($content->supports->groupBy('sender_id'))); ?>)</h2><i class="mdi mdi-chevron-down"></i></div>
                            <ul class="submenu" <?php if(!empty(request()->get('openid')) && $content->id == request()->get('openid')): ?> style="display: block;" <?php endif; ?>>
                                <div class="table-responsive">
                                    <table class="table ucp-table" id="suport-table">
                                        <thead class="back-orange">
                                        <th><?php echo e(trans('main.customer')); ?></th>
                                        <th class="text-center" width="200"><?php echo e(trans('main.status')); ?></th>
                                        <th class="text-center" width="100"><?php echo e(trans('main.messages')); ?></th>
                                        <th class="text-center" width="200"><?php echo e(trans('main.date')); ?></th>
                                        <th class="text-center" width="100"><?php echo e(trans('main.controls')); ?></th>
                                        </thead>
                                        <tbody>
                                        <?php if($content->supports->count()>0): ?>
                                            <?php $__currentLoopData = listByKey($content->supports->toArray(),'sender_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $support): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e(!empty($support[0]['sender']['name']) ? $support[0]['sender']['name'] : $support[0]['sender']['username']); ?></td>
                                                    <?php if(isset($support['child']) and count($support['child']) > 0): ?>
                                                        <?php if(end($support['child'])['user_id'] != $user['id']): ?>
                                                            <td class="text-center"><?php echo e(trans('main.waiting_reply')); ?></td>
                                                        <?php else: ?>
                                                            <td class="text-center"><?php echo e(trans('main.replied')); ?></td>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <td class="text-center"><?php echo e(trans('main.waiting_reply')); ?></td>
                                                    <?php endif; ?>
                                                    <?php if(isset($support['child'])): ?>
                                                        <td class="text-center"><b><?php echo e(count($support['child']) + 1); ?></b></td>
                                                    <?php else: ?>
                                                        <td class="text-center"><b>1</b></td>
                                                    <?php endif; ?>
                                                    <td class="text-center"><?php echo e(date('d F Y | H:i',$support[0]['created_at'])); ?></td>
                                                    <td class="text-center">
                                                        <a href="javascript:void(0)" class="replyBtn" data-toggle="modal" data-target="#answerBox" sender-id="<?php echo e($support[0]['sender']['id']); ?>" content-id="<?php echo e($content->id); ?>" title="View/Reply"><i class="fa fa-comment" aria-hidden="true"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </ul>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
        <div class="modal fade" id="answerBox">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><?php echo e(trans('main.course_support')); ?></h4>
                    </div>
                    <div class="modal-body modal-body-e" id="supportModalBody">
                        <div class="loader"></div>
                    </div>
                    <div class="modal-footer">
                        <form method="post" class="form-horizontal">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <input type="hidden" name="sender_id" id="modalSenderId">
                                <input type="hidden" name="content_id" id="modalContentId">
                                <div class="col-md-12">
                                    <textarea type="text" class="form-control" rows="2" name="comment" id="modalComment"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-custom pull-left" id="sendReply" value="Send">
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $('document').ready(function () {
            var $supportModalBody = $('#supportModalBody');

            $('.replyBtn').click(function () {
                var contentId = $(this).attr('content-id');
                var senderId = $(this).attr('sender-id');

                $.getJSON('/user/ticket/support/json/' + contentId + '/' + senderId, function (data) {
                    $('#modalContentId').val(contentId);
                    $('#modalSenderId').val(senderId);
                    $supportModalBody.html('');
                    $.each(data, function (i, item) {
                        if (item.user_id !== item.supporter_id)
                            var appendHtml = '<div class="alert alert-danger marb8"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><b>' + item.name + ' : </b>' + item.comment + '</p></div>';
                        else {
                            var mode = '';
                            if (item.mode !== 'publish') {
                                mode = '(Pending)';
                            }
                            var appendHtml = '<div class="alert alert-success marb8"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><b>' + item.name + ' : </b>' + item.comment + ' ' + mode + '</p></div>';
                        }
                        $supportModalBody.append(appendHtml);
                    });
                    $supportModalBody.animate({scrollTop: $supportModalBody.height() + 2000}, 2000);
                })
            });

            $('#sendReply').click(function (e) {
                e.preventDefault();
                var comment = $('#modalComment').val();
                var senderId = $('#modalSenderId').val();
                var contentId = $('#modalContentId').val();
                $.post('/user/ticket/support/jsonStore', {'comment': comment, 'sender_id': senderId, 'content_id': contentId}, function (data) {
                    $('#modalComment').val('');
                    var appendHtml = '<div class="alert alert-success marb8"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p><b>' + data.name + ' : </b>' + data.comment + ' (Pending)</p></div>';
                    $supportModalBody.append(appendHtml);
                    $supportModalBody.animate({scrollTop: $supportModalBody.height() + 2000}, 2000);
                })
            })
        })
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make($user['vendor'] == 1 ? getTemplate() . '.user.layout.supportlayout' : getTemplate() . '.user.layout_user.supportlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/ticket/supportList.blade.php ENDPATH**/ ?>