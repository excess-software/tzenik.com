

<?php $__env->startSection('title'); ?>
<?php echo e(get_option('site_title','')); ?> - <?php echo e(!empty($category->title) ? $category->title : 'Categories'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="">
    <?php echo $__env->make(getTemplate() . '.user.parts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row ">
        <div class="">
            <div class="col-md-12">
                <h2 class="titulo-partials">Videoteca</h2>
                <div class="row">

                    <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 dash-content-user">
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
                                                    <h3><?php echo e($content['title']); ?></h3>
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
                                                                        class="circle-tag-cursos"></span> Video</span>
                                                            </h4>
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
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/category/videoteca.blade.php ENDPATH**/ ?>