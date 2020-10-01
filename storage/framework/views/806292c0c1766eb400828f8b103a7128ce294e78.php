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
                    <a href="javascript:history.back()"><h4><i class="fa fa-arrow-left"> </i><span> Cursos</span></h4></a>
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
                    <video id="myDiv" class="media-cursos" controls>
                        <source src="<?php echo e(!empty($partVideo) ? $partVideo : $meta['video']); ?>" type="video/mp4" />
                    </video>
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
                    <div class="col-md-5">
                        <div class="row text-content-media-curso">
                            <h2><?php echo e(!empty($partDesc->title) ? $partDesc->title : $partDesc[0]->title); ?></h2>
                            <br>
                            <span><?php echo !empty($partDesc->description) ? $partDesc->description : $partDesc[0]->description; ?></span>
                        </div>
                        <br>
                        <div class="row">
                            <h2>Materiales</h2>
                            <br>
                            <button class="btn btn-media-descargar-leccion">
                                <h4>Descargar Materiales de Lecci&oacute;n</h4>
                            </button>
                            <br>
                            <button class="btn btn-media-descargar-curso">
                                <h4>Descargar Materiales del Curso</h4>
                            </button>
                        </div>
                        <br>
                        <div class="row">
                            <h2>Etiquetas</h2>
                            <br>
                            <?php $__currentLoopData = explode(',', $product->tag); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <h4><span class="label label-tag-cursos"> <span class="circle-tag-cursos"></span>
                                    <?php echo e($tag); ?></span></h4>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <br>
                        <div class="row">
                            <h2>Categor&iacute;a</h2>
                            <br>
                            <h4><span class="label label-tag-media-categoria"> <span
                                        class="circle-tag-media-categoria"></span>
                                    <?php echo e($product->category->title); ?></span></h4>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-5">
                        <h2>Lista</h2>
                        <ul class="list-group partes-curso">
                            <!--<?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="part-links">
                                    <a href="/product/part/<?php echo e($product->id); ?>/<?php echo e($part['id']); ?>">
                                        <div class="col-md-1 hidden-xs tab-con">
                                            <?php if($buy or $part['free'] == 1): ?>
                                            <span class="playicon mdi mdi-play-circle"></span>
                                            <?php else: ?>
                                            <span class="playicon mdi mdi-lock"></span>
                                            <?php endif; ?>
                                        </div>
                                        <div
                                            class="<?php if($product->download == 1): ?> col-md-4 <?php else: ?> col-md-5 <?php endif; ?> col-xs-10 tab-con">
                                            <label><?php echo e($part['title']); ?></label>
                                        </div>
                                    </a>
                                    <div class="col-md-2 tab-con">
                                        <span class="btn btn-gray btn-description hidden-xs" data-toggle="modal"
                                            href="#description-<?php echo e($part['id']); ?>"><?php echo e(trans('main.description')); ?></span>
                                        <div class="modal fade" id="description-<?php echo e($part['id']); ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">
                                                            &times;
                                                        </button>
                                                        <h4 class="modal-title"><?php echo e(trans('main.description')); ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo $part['description']; ?>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-custom pull-left"
                                                            data-dismiss="modal"><?php echo e(trans('main.close')); ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center hidden-xs tab-con">
                                        <span><?php echo e($part['size']); ?> <?php echo e(trans('main.mb')); ?></span>
                                    </div>
                                    <div class="col-md-2 hidden-xs tab-con">
                                        <span><?php echo e($part['duration']); ?> <?php echo e(trans('main.minute')); ?></span>
                                    </div>
                                    <?php if($product->download == 1): ?>
                                    <div class="col-md-1 col-xs-2 tab-con">
                                        <span class="download-part" data-href="/video/download/<?php echo e($part['id']); ?>"><span
                                                class="mdi mdi-arrow-down-bold"></span></span>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                            <?php $__currentLoopData = $parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="/product/part/<?php echo e($product->id); ?>/<?php echo e($part['id']); ?>">
                                <li class="list-group-item list-content-media">
                                    <?php if($buy or $part['free'] == 1): ?>
                                    <span class="playicon mdi mdi-play-circle"></span>
                                    <?php else: ?>
                                    <span class="playicon mdi mdi-lock"></span>
                                    <?php endif; ?>
                                    <b>
                                        <?php echo e($part['title']); ?>

                                    </b>
                                </li>
                            </a>
                            <br>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($buy): ?>
                            <?php if(!empty($product->quizzes) and !$product->quizzes->isEmpty()): ?>
                            <?php $__currentLoopData = $product->quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($quiz->can_try): ?>
                            <a href="<?php echo e('/user/quizzes/'. $quiz->id .'/start'); ?>">
                                <li class="list-group-item list-content-media">
                                    <b>Quiz Final</b>
                                </li>
                            </a>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </ul>
                        <?php $__currentLoopData = $product->quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($quiz->user_grade)): ?>
                        <?php if($quiz->result_status == 'pass'): ?>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="resultado-quiz" style="background-color: #3ED2B8">
                                    <p><b>Calificaci&oacute;n</b></p>
                                    <br>
                                    <p>
                                        <h3><b>¡<?php echo e($quiz->user_grade); ?>!</b></h3>
                                    </p>
                                    <br>
                                    <p>
                                        <h4><b>¡Felicidades!</b></h4>
                                    </p>
                                </div>
                            </div>
                            <?php elseif($quiz->result_status == 'fail'): ?>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="resultado-quiz" style="background-color: red">
                                        <p><b>Calificaci&oacute;n</b></p>
                                        <br>
                                        <p>
                                            <h3><b>¡<?php echo e($quiz->user_grade); ?>!</b></h3>
                                        </p>
                                    </div>
                                </div>
                                <?php else: ?>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="resultado-quiz" style="background-color: lightgray">
                                            <p><b>Calificaci&oacute;n</b></p>
                                            <br>
                                            <p>
                                                <h3><b>Pendiente</b></h3>
                                            </p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php else: ?>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="resultado-quiz" style="background-color: lightgray">
                                            <p><b>Calificaci&oacute;n</b></p>
                                            <br>
                                            <p>
                                                <h3><b>Pendiente</b></h3>
                                            </p>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/product/product.blade.php ENDPATH**/ ?>