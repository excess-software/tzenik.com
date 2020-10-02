
<?php $__env->startSection('title'); ?>
<?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : ''); ?>

- <?php echo e($product->title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row visualizador-media">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 volver-atras-media">
                <br>
                <div class="row">
                    <a href="javascript:history.back()">
                        <h4><i class="fa fa-arrow-left"> </i><span> Cursos</span></h4>
                    </a>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-8">
                        <h2><b><?php echo e($product->title); ?></b></h2>
                    </div>
                    <!--<div class="col-md-4">
                        <?php if($product->support == 1): ?>
                        <button class="btn btn-next-media pull-right">
                            <h5><b>Soporte</b></h5>
                        </button>
                        <?php endif; ?>
                    </div>-->
                </div>
                <br>
                <div class="row">
            <div class="col-md-9 media-cursos">
                <iframe style="height: 700px; width: 100%;"
                    src="https://zoom.us/wc/<?php echo e($meeting->zoom_meeting ?? $meeting); ?>/join?prefer=0&un=TWluZGF1Z2Fz"
                    sandbox="allow-forms allow-scripts allow-same-origin" allow="microphone; camera" allowfullscreen
                    scrolling="no"></iframe>
            </div>
        </div>
                <!-- <br>
                <div class="row">
                    <button class="btn btn-next-media pull-right">
                        <h4>Siguiente <i class="fa fa-arrow-right"></i></h4>
                    </button>
                </div>-->
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 content-media-curso">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row text-content-media-curso">
                            <h2><?php echo e(!empty($partDesc->title) ? $partDesc->title : $partDesc[0]->title); ?></h2>
                            <br>
                            <span><?php echo !empty($partDesc->description) ? $partDesc->description :
                                $partDesc[0]->description; ?></span>
                        </div>
                        <br>
                        <div class="row text-content-media-curso">
                            <h2>Enlace de Zoom:</h2>
                            <br>
                            <span><a href="https://zoom.us/wc/<?php echo e($meeting->zoom_meeting ?? $meeting); ?>/join?prefer=0&un=TWluZGF1Z2Fz">https://zoom.us/wc/<?php echo e($meeting->zoom_meeting ?? $meeting); ?>/join?prefer=0&un=TWluZGF1Z2Fz</a></span>
                        </div>
                        <br>
                        <div class="row">
                            <h2>Etiquetas</h2>
                            <br>
                            <?php $__currentLoopData = explode(',', $product->tag); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($tag): ?>
                            <h4><span class="label label-tag-cursos"> <span class="circle-tag-cursos"></span>
                                    <?php echo e($tag); ?></span></h4>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!$product->tag): ?>
                            <h4><span>Sin etiquetas</span></h4>
                            <?php endif; ?>
                        </div>
                        <br>
                        <div class="row">
                            <h2>Categor&iacute;a</h2>
                            <br>
                            <?php if($product->category->title): ?>
                            <h4><span class="label label-tag-media-categoria"> <span
                                        class="circle-tag-media-categoria"></span>
                                    <?php echo e($product->category->title); ?></span></h4>
                            <?php else: ?>
                            <h4><span>Sin categor&iacute;a</span></h4>
                            <?php endif; ?>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
                            </div>
                            </div>
            <?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/product/productWeb.blade.php ENDPATH**/ ?>