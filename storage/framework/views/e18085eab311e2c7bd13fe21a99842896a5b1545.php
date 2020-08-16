
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.chat_messages')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th><?php echo e(trans('admin.chat_title')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.author')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.chat_message')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($message->Chat_Title); ?></td>
                        <td class="text-center"><?php echo e($message->name); ?></td>
                        <td class="text-center"><?php echo e($message->message); ?></td>
                        <td class="text-center">
                            <a href="javascript:void(0);" onclick="deleteMessage('<?php echo e($message->id); ?>');" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<script>
    var socket = io.connect('http://localhost:8890');
    function deleteMessage(id){
        var host = window.location.origin;
        $.get(host+'/admin/chat/delete_Message/'+id, function(data){
            socket.emit('deleteMessage', id);
            location.reload();
        });
    }
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Chat','Messages']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/chat/messages.blade.php ENDPATH**/ ?>