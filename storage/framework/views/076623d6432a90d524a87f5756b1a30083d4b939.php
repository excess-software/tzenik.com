
<?php $__env->startSection('title'); ?>
    <?php echo e(trans('main.forum_title')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make(getTemplate() . '.user.parts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row">
        <div class="col-md-12 ">
            <h2 class="titulo-partials-forum "><?php echo e(trans('main.forum_category_title')); ?></h2>
            <a href="/user/forum/post/new" class="">
                <button class="btn btn-custom-forum ">Crear Nueva Discución</button>
            </a>
        </div>
    </div> 
    
    <div class="row">
        <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($loop->index%2==0): ?>
    </div>
    <div class="row">
        <?php endif; ?>
            <div class="col-md-6">    
                <a style="text-decoration: none;" href="/user/forum/post/category/<?php echo e($list->id); ?>">
                    <section class="panel panel-default">
                        <div class="panel-body-forum">
                            <div class="row ultimos-blogs-titulo">
                                <h3> <?php echo e($list->title); ?></h3>
                                <p class="text-secondary"><?php echo e($list->desc); ?></p>
                            </div>
                        </div>    
                    </section>
                </a>
            </div>    
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php if($private): ?>
        <h3>Cursos Privados</h3>
        <div class="row">
            <?php $__currentLoopData = $private; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($loop->index%2==0): ?>
                    </div>
                    <div class="row">
                <?php endif; ?>
                <div class="col-md-6">    
                    <section class="panel panel-default">
                        <div class="panel-body-forum">
                            <div class="row ultimos-blogs-titulo">
                                <h3><a style="text-decoration: none;" href="/user/forum/post/category/<?php echo e($list['id']); ?>" class="text-primary"><?php echo e($list['title']); ?></a></h3>
                                <p class="text-secondary"><?php echo e($list['desc']); ?></p>
                            </div>
                        </div>    
                    </section>
                </div>    
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>    
        
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/forum/list.blade.php ENDPATH**/ ?>