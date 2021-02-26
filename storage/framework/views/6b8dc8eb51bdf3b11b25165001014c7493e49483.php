<div  class="container">
    <ul class="nav nav-pills nav-justified">
        <?php $__currentLoopData = $setting['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($mainCategory->title == 'Forum' || $mainCategory->title == 'forum'): ?>
        <li role="presentation" class="<?php echo e(request()->is('user/'.$mainCategory->title) ? 'active' : ''); ?>"><a class="nav-home" href="/user/forum"><?php echo e($mainCategory->title); ?></a></li>
        <?php elseif($mainCategory->title == 'Coach' || $mainCategory->title == 'coach' || $mainCategory->title == 'Coaching' || $mainCategory->title == 'coaching'): ?>
        <?php else: ?>
            <?php if(request()->is("category/".$mainCategory->title)): ?>
            <li role="presentation" class="active"><a class="nav-home" href="/category/<?php echo e($mainCategory->title); ?>"><?php echo e(Str::limit($mainCategory->title, 15)); ?></a></li>
            <?php else: ?>
            <li role="presentation"><a class="nav-home" href="/category/<?php echo e($mainCategory->title); ?>"><?php echo e(Str::limit($mainCategory->title, 15)); ?></a></li>
            <?php endif; ?>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <li role="presentation" class="<?php echo e(request()->is('blog') ? 'active' : ''); ?>"><a class="nav-home" href="/blog">Blog</a></li>
    </ul>
</div><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/parts/navigation.blade.php ENDPATH**/ ?>