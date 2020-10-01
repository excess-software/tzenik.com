<?php $__env->startSection('title'); ?>
<?php echo e(get_option('site_title','')); ?> - <?php echo e(!empty($category->title) ? $category->title : 'Categories'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make(getTemplate() . '.view.parts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <div class="container-fluid">
        <div class="col titulo-cursos-destacados">
            <span>
                <h2><img src="<?php echo e($category->icon); ?>" width="30px" height="30px" /><b> <?php echo e($category->title); ?></b></h2>
            </span>
        </div>
    </div>
</div>
<br>
<div class="row ultimos-blogs">
    <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-5">
        <a href="/product/<?php echo e($content['id']); ?>" title="<?php echo e($content['title']); ?>" class="enlace-tabs">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img class="img-responsive img-ultimos-blogs"
                                src="<?php echo e(!empty($content['metas']['thumbnail']) ? $content['metas']['thumbnail'] : ''); ?>"
                                alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-description vertical-center">
                                <div class="row ultimos-blogs-titulo">
                                    <h4><b><?php echo e($content['title']); ?></b></h4>
                                </div>
                                <!--<div class="row ultimos-blogs-contenido">
                                    <div class="col">
                                        <span class="ultimos-blogs-contenido-interno">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac
                                            laoreet
                                            ante, ut iaculis
                                            purus. Donec nec eleifend ligula, id sollicitudin sem. Phasellus
                                            pharetra
                                            tellus at auctor
                                            faucibus. Cras posuere nec sem a consequat. Phasellus pharetra
                                            tellus at
                                            auctor faucibus. Cras
                                            posuere nec sem a consequat.
                                        </span>
                                    </div>
                                </div>-->
                                <div class="row ultimos-blogs-contenido">
                                    <div class="col">
                                        <span class="ultimos-blogs-contenido-interno">
                                            <h4><span class="label label-tag-cursos"> <span
                                                        class="circle-tag-cursos"></span> Video</span></h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-cursos-listado btn-block">
                        <h4><b>Continuar</b></h4>
                    </button>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/category/category.blade.php ENDPATH**/ ?>