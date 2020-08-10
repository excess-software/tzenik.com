<?php $__env->startSection('pages'); ?>
    <div class="container-fluid">
        <div class="container">
            <div class="h-20"></div>
            <div class="col-md-6 col-xs-12 tab-con">
                <div class="ucp-section-box">
                    <div class="header back-red"><?php echo e(trans('main.add_content_to_channel')); ?></div>
                    <div class="body">
                        <form method="post" action="/user/channel/video/store/<?php echo e($chanel->id); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label class="control-label"><?php echo e(trans('main.content')); ?></label>
                                <select name="content_id" class="form-control font-s">
                                    <?php $__currentLoopData = $userContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($uc->id); ?>"><?php echo e($uc->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-custom pull-left" value="Save Changes"><?php echo e(trans('main.save_changes')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xs-12 tab-con">
                <div class="table-responsive">
                    <table class="table ucp-table">
                        <thead class="back-blue">
                        <th><?php echo e(trans('main.course_title')); ?></th>
                        <th class="text-center" width="50"><?php echo e(trans('main.controls')); ?></th>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $chanel->contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($content->content->title); ?></td>
                                <td class="text-center" width="50">
                                    <a href="#" data-href="/user/channel/video/delete/<?php echo e($content->id); ?>" data-toggle="modal" data-target="#confirm-delete" title="Remove video"><span class="crticon mdi mdi-delete-forever"></span></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>$('#channel-hover').addClass('item-box-active');</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/channel/video.blade.php ENDPATH**/ ?>