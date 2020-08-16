
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.chat_users_chat')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th><?php echo e(trans('admin.chat_title')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.chat_user')); ?></th>
                    <th class="text-center"><?php echo e(trans('admin.th_controls')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $chat_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chat_u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($chat_u->Chat_Name); ?></td>
                        <td class="text-center"><?php echo e($chat_u->name); ?></td>
                        <td class="text-center">
                            <a href="javascript:void(0);" onclick="deleteUser('<?php echo e($chat_u->id); ?>', '<?php echo e($chat_u->Chat_Id); ?>');" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

<script>
    var socket = io.connect('http://localhost:8890');
    function deleteUser(id, chat_id){
            var host = window.location.origin;
            $.get(host+'/admin/chat/delete_User/'+id+'/'+chat_id, function(data){
                socket.emit('deleteUser', id, chat_id);
                location.reload();
            });
        }
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Chat','Messages']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/chat/userschat.blade.php ENDPATH**/ ?>