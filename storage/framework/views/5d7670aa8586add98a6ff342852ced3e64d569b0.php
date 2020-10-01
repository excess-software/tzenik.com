<?php $__env->startSection('title'); ?>
<?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : ''); ?>

<?php $__env->stopSection(); ?>
<!-- <?php $__env->startSection('page'); ?>
    <?php echo $__env->make(getTemplate() . '.view.parts.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make(getTemplate() . '.view.parts.container', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(isset($setting['site']['main_page_newest_container']) and $setting['site']['main_page_newest_container'] == 1): ?>
        <?php echo $__env->make(getTemplate() . '.view.parts.newest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(isset($setting['site']['main_page_popular_container']) and $setting['site']['main_page_popular_container'] == 1): ?>
        <?php echo $__env->make(getTemplate() . '.view.parts.popular', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make(getTemplate() . '.view.parts.most_sell', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php if(isset($setting['site']['main_page_vip_container']) and $setting['site']['main_page_vip_container'] == 1): ?>
        <?php echo $__env->make(getTemplate() . '.view.parts.vip', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <?php echo $__env->make(getTemplate() . '.view.parts.news', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make(getTemplate(). '.view.parts.pills', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?> -->
<?php $__env->startSection('content'); ?>
<?php echo $__env->make(getTemplate() . '.view.parts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<hr>

<div class="banner-tzenik">
    <div class="row">
        <div class="col">
            <img class="img-responsive center-block d-block mx-auto" alt="Brand" src="<?php echo e(get_option('site_logo')); ?>"
                alt="<?php echo e(get_option('site_title')); ?>" />
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            <span>
                <h1><b>Alegr&iacute;a de Aprender</b></h1>
            </span>
        </div>
    </div>
    <div class="row text-center">
        <div class="col banner-descripcion">
            <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac laoreet ante, ut iaculis
                purus. Donec nec eleifend ligula, id sollicitudin sem. Phasellus pharetra tellus at auctor
                faucibus. Cras posuere nec sem a consequat. Phasellus pharetra tellus at auctor faucibus. Cras
                posuere nec sem a consequat.</h3>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="container-fluid">
        <div class="col titulo-cursos-destacados">
            <span>
                <h2><b>Cursos Destacados</b></h2>
            </span>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="container-fluid">
        <div class="col-md-9 cursos-destacados">
            <?php
            $contador_cursos_nuevos = 1;
            ?>
            <?php $__currentLoopData = $popular_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $popular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $meta = arrayToList($popular->metas, 'option', 'value'); ?>
            <?php if($popular->type == 'course'): ?>
            <?php if($contador_cursos_nuevos <= 5): ?>
            <a href="/product/<?php echo e($popular->id); ?>">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel-description vertical-center">
                                <div class="row curso-destacado-titulo black-text">
                                    <h3><b><?php echo e($popular->title); ?></b></h3>
                                </div>
                                <div class="row curso-destacado-contenido">
                                    <div class="col">
                                        <span class="curso-destacado-contenido-interno black-text">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img class="img-responsive" src="<?php echo e(!empty($meta['thumbnail']) ? $meta['thumbnail'] : ''); ?>"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-cursos-destacados btn-block">
                        <h4><b>Continuar</b></h4>
                    </button>
                </div>
            </div>
            </a>  
            <?php
            $contador_cursos_nuevos++;
            ?>
            <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="container-fluid">
        <div class="col titulo-proximos-webinars">
            <span>
                <h2><b>Pr&oacute;ximos Webinars</b></h2>
            </span>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="container-fluid">
        <div class="col-md-9 proximos-webinars">
        <?php
            $contador_webinars = 1;
            ?>
            <?php $__currentLoopData = $new_content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $meta = arrayToList($new->metas, 'option', 'value'); ?>
            <?php if($new->type == 'webinar'): ?>
            <?php if($contador_webinars <= 5): ?>
            <a href="/product/<?php echo e($new->id); ?>">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img-responsive center-block img-proximos-webinars"
                                src="<?php echo e(!empty($meta['thumbnail']) ? $meta['thumbnail'] : ''); ?>" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="panel-description vertical-center">
                                <div class="row proximos-webinars-titulo">
                                    <h3><b><?php echo e($new->title); ?></b></h3>
                                </div>
                                <div class="row proximos-webinars-contenido">
                                    <div class="col">
                                        <span class="proximos-webinars-contenido-interno">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-proximos-webinars btn-block">
                        <h4><b>Continuar</b></h4>
                    </button>
                </div>
            </div>
            </a>  
            <?php
            $contador_webinars++;
            ?>
            <?php endif; ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="container-fluid">
        <div class="col titulo-ultimos-blogs">
            <span>
                <h2><b>&Uacute;ltimos Blogs</b></h2>
            </span>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="container-fluid ultimos-blogs">
    <?php
            $contador_blog = 1;
            ?>
            <?php $__currentLoopData = $blog_post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $meta = arrayToList($post->metas, 'option', 'value'); ?>
            <?php if($contador_blog <= 2): ?>
            <a href="/blog/post/<?php echo e($post->id); ?>">
            <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img class="img-responsive img-ultimos-blogs center-block"
                                src="<?php echo e($post->image); ?>" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-description vertical-center">
                                <div class="row ultimos-blogs-titulo">
                                    <h2><b><?php echo e($post->title); ?></b></h2>
                                </div>
                                <div class="row ultimos-blogs-contenido">
                                    <div class="col">
                                        <span class="ultimos-blogs-contenido-interno">
                                        <?php echo Str::limit($post->pre_content, 100); ?>

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-ultimos-blogs btn-block">
                        <h4><b>Continuar</b></h4>
                    </button>
                </div>
            </div>
        </div>
            </a>  
            <?php
            $contador_blog++;
            ?>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/main.blade.php ENDPATH**/ ?>