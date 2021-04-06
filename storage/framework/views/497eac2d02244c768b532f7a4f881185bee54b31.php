

<?php $__env->startSection('title'); ?>
<?php echo e(get_option('site_title','')); ?> - <?php echo e(!empty($category->title) ? $category->title : 'Categories'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="">
    <?php echo $__env->make(getTemplate() . '.user.parts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="col-md-3">
                        <h2 class="titulo-partials">Filtros</h2>
                        <ul class="list-group">
                            <a href="/user/dashboard/all" style="text-decoration: none;">
                                <li class="list-group-item list-content-media"><b>Todos los cursos</b></li>
                            </a>
                            <br>
                            <a href="/user/dashboard/inProcess" style="text-decoration: none;">
                                <li class="list-group-item list-content-media list-active"><b>Cursos en proceso</b></li>
                            </a>
                            <br>
                            <a href="/user/dashboard/finished" style="text-decoration: none;">
                                <li class="list-group-item list-content-media"><b>Cursos terminados</b></li>
                            </a>
                            <br>
                            <a href="/user/quizzes" style="text-decoration: none;">
                                <li class="list-group-item list-content-media"><b>Calificaciones</b></li>
                            </a>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col">
                                <h2 class="titulo-partials">Tus Cursos</h2>
                            </div>
                        </div>
                        <div class="row">
                            <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($item[0]->content)): ?>
                            <div class="col-md-6 dash-content-user">
                                <a href="/product/<?php echo e($item[0]->content->id); ?>" title="<?php echo e($item[0]->content->title); ?>"
                                    class="enlace-tabs">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php
                                                    $meta = arrayToList($item[0]->content['metas'], 'option', 'value')
                                                    ?>
                                                    <img class="img-responsive img-ultimos-blogs"
                                                        src="<?php echo e($meta['thumbnail']); ?>" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel-description vertical-center">
                                                        <div class="row ultimos-blogs-titulo">
                                                            <h3><?php echo e($item[0]->content->title); ?></h3>
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
                                                                                class="circle-tag-cursos"></span>
                                                                            Video</span>
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
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!$list): ?>
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4><b>Aún no has iniciado un curso.</b></h4>
                                </div>
                            </div>
                            <br>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/dashboard/process.blade.php ENDPATH**/ ?>