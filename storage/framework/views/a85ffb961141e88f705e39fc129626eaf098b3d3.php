<?php $__env->startSection('tab1','active'); ?>
<?php $__env->startSection('tab'); ?>
    <div class="h-20"></div>
    <a href="#modal-meeting-date" data-toggle="modal" class="btn btn-primary">Add Meeting Date</a>
    <a href="#modal-meeting-link" data-toggle="modal" class="btn btn-success">Active Meeting Link</a>
    <?php if($content->meeting_mode == 'active'): ?>
    <a href="/user/content/meeting/action?action=inactive&id=<?php echo $id; ?>" data-toggle="modal" class="btn btn-warning">InActive Meeting Link</a>
    <?php endif; ?>
    <div class="h-20"></div>

    <div class="table-responsive">
        <table class="table ucp-table" id="content-table">
            <thead class="thead-s">
                <th><?php echo e(trans('main.title')); ?></th>
                <th class="text-center"><?php echo e(trans('main.date')); ?></th>
                <th class="text-center"><?php echo e(trans('main.time')); ?></th>
                <th class="text-center"><?php echo e(trans('main.duration')); ?></th>
                <th class="text-center"><?php echo e(trans('main.controls')); ?></th>
            </thead>
            <tbody>
            <?php $__currentLoopData = $dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="text-center"><?php echo $item->title ?? ''; ?></td>
                    <td class="text-center"><?php echo $item->date ?? ''; ?></td>
                    <td class="text-center"><?php echo $item->time ?? ''; ?></td>
                    <td class="text-center"><?php echo $item->duration ?? ''; ?><?php echo trans('admin.minutes'); ?></td>
                    <td class="text-center">
                        <a href="/user/content/meeting/delete/<?php echo e($item->id); ?>" title="Delete" class="gray-s"><span class="crticon mdi mdi-delete-forever"></span></a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>


    <div class="modal fade" id="modal-meeting-date">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    				<h4 class="modal-title">Meeting Date</h4>
    			</div>
                <form method="post" action="/user/content/meeting/new/store/<?php echo $id; ?>">
                    <?php echo csrf_field(); ?>
    			<div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label><?php echo trans('main.date'); ?></label>
                                <input type="date" class="form-control" name="date" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label><?php echo trans('main.title'); ?></label>
                                <input type="text" class="form-control" name="title">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <label><?php echo trans('main.time'); ?></label>
                                <input type="time" class="form-control" name="time" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label><?php echo trans('main.duration'); ?></label>
                                <div class="input-group">
                                    <input type="text" class="form-control text-center" name="duration">
                                    <span class="input-group-addon"><?php echo trans('admin.minutes'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
    			</div>
    			<div class="modal-footer text-right">
    				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				<button type="submit" class="btn btn-primary">Save changes</button>
    			</div>
                </form>
    		</div>
    	</div>
    </div>
    <div class="modal fade" id="modal-meeting-link">
    	<div class="modal-dialog">
    		<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    				<h4 class="modal-title">Modal Meeting Link</h4>
    			</div>
                <form method="post" action="/user/content/meeting/action?action=active&id=<?php echo $id; ?>">
                <?php echo csrf_field(); ?>
    			<div class="modal-body">
                    <div class="form-group">
                        <label><?php echo trans('main.system'); ?></label>
                        <select name="type" id="system-type" class="form-control" required>
                            <option value="">Select one</option>
                            <option value="zoom">Zoom(auto Generated)</option>
                            <option value="jitsti">Jitsti</option>
                            <option value="google_meet">Google Meet</option>
                            <option value="big_blue_button">Big Blue Button</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php echo trans('main.join_link'); ?></label>
                        <input type="text" class="form-control" name="join_link" required>
                    </div>
                    <div class="form-group start-link" style="display: none">
                        <label><?php echo trans('main.start_link'); ?></label>
                        <input type="text" class="form-control" name="start_link">
                    </div>
                    <div class="form-group start-link">
                        <label><?php echo trans('main.meeting_password'); ?></label>
                        <input type="text" class="form-control" name="meeting_password">
                    </div>
    			</div>
    			<div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-generate-zoom-meeting pull-right" data-content="<?php echo $id; ?>" style="display: none">auto generate zoom meeting</button>
    				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				<button type="submit" class="btn btn-primary"><?php echo trans('main.save'); ?></button>
    			</div>
                </form>
    		</div>
    	</div>
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
                $.getJSON('/user/content/meeting/action?action=zoom&content_id='+$(this).attr('data-content'),function (response) {
                    if(response.status == 0){
                        $('.start-link').show();
                        $('input[name="join_link"]').val(response.join_url);
                        $('input[name="start_link"]').val(response.start_url);
                    }
                })
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($user['vendor'] == 1 ? getTemplate() . '.user.layout.videolayout' : getTemplate() . '.user.layout_user.videolayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/user/content/meeting/list.blade.php ENDPATH**/ ?>