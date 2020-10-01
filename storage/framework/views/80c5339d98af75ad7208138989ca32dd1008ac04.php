<?php $__env->startSection('title'); ?>
<?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : ''); ?>

<?php echo e(trans('main.blog')); ?> -
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<ul class="nav nav-tabs nav-justified">
    <li role="presentation"><a class="nav-home" href="#">Home</a></li>
    <li role="presentation"><a class="nav-home" href="#">Categoria 1</a></li>
    <li role="presentation"><a class="nav-home" href="#">Categoria 2</a></li>
    <li role="presentation"><a class="nav-home" href="#">Categoria 3</a></li>
    <li role="presentation"><a class="nav-home" href="#">Webinars</a></li>
    <li role="presentation"><a class="nav-home" href="#">Contacto</a></li>
    <li role="presentation" class="active"><a class="nav-home" href="#">Blog</a></li>
</ul>
<br>
<div class="row">
    <div class="container-fluid">
        <div class="col titulo-blog">
            <span>
                <h2><b>Blog</b></h2>
            </span>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="container-fluid ultimos-blogs">
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="/blog/post/<?php echo e($post->id); ?>">
            <div class="col-md-5">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <img class="img-responsive img-ultimos-blogs center-block" src="<?php echo e($post->image); ?>" alt="">
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
                            <h4><b>Leer m&aacute;s</b></h4>
                        </button>
                    </div>
                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/blog/blog.blade.php ENDPATH**/ ?>