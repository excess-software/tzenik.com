

<?php $__env->startSection('title'); ?>
<?php echo e(get_option('site_title','')); ?> - <?php echo e(!empty($category->title) ? $category->title : 'Categories'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <?php echo $__env->make(getTemplate() . '.user.parts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row ">
        <div class="">
            <div class="col-md-12">
                <h2 class="titulo-partials">Tus Tareas</h2>
                <div class="row">
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!($course->homeworks)->isEmpty()): ?>
                        <div class="card">
                            <div class="card-header" id="heading-<?php echo e($course->id); ?>">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?php echo e($course->id); ?>"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        <?php echo e($course->title); ?>

                                    </button>
                                </h5>
                            </div>
                            <div id="collapse-<?php echo e($course->id); ?>" class="collapse show" aria-labelledby="heading-<?php echo e($course->id); ?>" data-parent="#accordion">
                                <div class="card-body">
                                    <?php $__currentLoopData = $course->homeworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $homework): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a onclick="subir(<?php echo e($course->id); ?>, <?php echo e($homework->part_id); ?>)"><p><?php echo e($homework->part); ?> - <?php echo e($homework->title); ?></p></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($courses->isEmpty()): ?>
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-center" style="margin-top: 15%; margin-bottom: 15%;">
                            <h4>Aún no tienes tareas</h4>
                        </div>
                    </div>
                    <br>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTareas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Subir Tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/user/subirTarea" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
            <input type="hidden" name="course" id="courseDrop" value="">
            <input type="hidden" name="part" id="partDrop" value="">
            <?php echo csrf_field(); ?>
            <div>
                <h3>Sube acá tus tareas</h3>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning">Salir</button>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
function subir(curso, modulo){
    $('#modalTareas').modal('show');
    $('#courseDrop').val(curso);
    $('#partDrop').val(modulo);
    //$('#image-upload').attr('action', '/user/subirTarea/'+curso+'/'+modulo);
}

Dropzone.options.imageUpload = {
    maxFilesize : 100,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    success: function(file, response){
      //Here you can get your response.
      console.log(response);
      this.removeFile(file);
  }
};
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/dashboard/tareas.blade.php ENDPATH**/ ?>