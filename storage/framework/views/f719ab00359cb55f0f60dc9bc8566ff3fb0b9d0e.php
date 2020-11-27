<?php $__env->startSection('title'); ?>
<?php echo e(get_option('site_title','')); ?> - <?php echo e(!empty($category->title) ? $category->title : 'Categories'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-full">
    <?php echo $__env->make(getTemplate() . '.user.parts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row contenido-cursos-dash">
        <div class="container-fluid">
            <div class="col-md-10">
                <div class="row">
                    <div class="col">
                        <h2><b>Tus Cursos</b></h2>
                    </div>
                </div>
                <div class="row">
                    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(isset($item->content)): ?>
                    <div class="col-md-6 dash-content-user">
                        <a href="/product/<?php echo e($item->content->id); ?>" title="<?php echo e($item->content->title); ?>" class="enlace-tabs">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <?php
                                        $meta = arrayToList($item->content['metas'], 'option', 'value')
                                        ?>
                                            <img class="img-responsive img-ultimos-blogs"
                                                src="<?php echo e(isset($meta['thumbnail']) ? $meta['thumbnail'] : ''); ?>"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel-description vertical-center">
                                                <div class="row ultimos-blogs-titulo">
                                                    <h4><b><?php echo e($item->content->title); ?></b></h4>
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
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($list->isEmpty()): ?>
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-center" style="margin-top: 15%; margin-bottom: 15%;">
                            <h1><b>Aún no has comprado cursos</b></h1>
                            <a href="/"><h1><b>Explorar</b></h1></a>
                        </div>
                    </div>
                    <br>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $('.star-rate').raty({
        starType: 'i',
        score: function () {
            return $(this).attr('data-score');
        },
        click: function (rate) {
            var id = $(this).attr('data-id');
            $.get('/user/video/buy/rate/' + id + '/' + rate, function (data) {
                if (data == 0) {
                    $.notify({
                        message: 'Sorry feedback not send. Try again.'
                    }, {
                        type: 'danger',
                        allow_dismiss: false,
                        z_index: '99999999',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        position: 'fixed'
                    });
                }
                if (data == 1) {
                    $('.btn-submit-confirm').removeAttr('disabled');
                    $.notify({
                        message: 'Your feedback sent successfully.'
                    }, {
                        type: 'danger',
                        allow_dismiss: false,
                        z_index: '99999999',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        position: 'fixed'
                    });
                }
            })
        }
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/sell/buy.blade.php ENDPATH**/ ?>