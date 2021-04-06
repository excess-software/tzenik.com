
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.new_post')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make(getTemplate() . '.user.parts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <div class="col-lg-12 col-xs-6">
        <h2 class="titulo-partials"></h2>
        <a href="../" class="float-left" style="text-decoration: none;"><h4 class="text-dark"><i class="fas fa-arrow-left"></i> Regresar</h4></a>
    </div>        
</div>
<div class="row">
    <div class="col-lg-12">
        <form action="/user/forum/post/store" class="form-horizontal form-bordered" method="post">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="col-md-2 control-label" for="inputDefault" style="float: left;"><?php echo e(trans('admin.th_title')); ?></label>
                <div class="col-md-10">
                    <input type="text" name="title" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="inputDefault" style="float: left;"><?php echo e(trans('admin.category')); ?></label>
                <div class="col-md-10">
                    <select id="category_id" name="category_id" class="form-control">
                        <option>-- Seleccione --</option>
                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($private): ?>
                            <option disabled><b> -- Categor&iacute;as privadas --</b></option>
                            <?php $__currentLoopData = $private; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat['id']); ?>"><?php echo e($cat['title']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="inputDefault" style="float: left; margin-left: 0px; padding-left: 0px;"><?php echo e(trans('admin.description')); ?></label>
                <div class="col-md-10">
                    <textarea class="form-control" id="" rows="3"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button class="btn btn-custom pull-right" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                </div>
            </div>
        </form>
    </div>         
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>$(".inputtags").tagsinput('items');</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/forum/new.blade.php ENDPATH**/ ?>