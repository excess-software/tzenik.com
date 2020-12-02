<?php $__env->startSection('pages'); ?>

<div class="container" style="padding-top: 15%; padding-bottom: 15%;">
    <div class="row white-rounded-back">
        <div class="col-md-3">
            <ul class="list-group partes-nuevo-curso">
                <li class="list-group-item active" cstep="1"><a href="javascript:void(0);"><span
                            class="upicon mdi mdi-library-video"></span><span><?php echo e(trans('main.general')); ?></span></a>
                </li>
                <li class="list-group-item" cstep="2"><a href="javascript:void(0);"><span
                            class="upicon mdi mdi-apps"></span><span><?php echo e(trans('main.category')); ?></span></a></li>
                <li class="list-group-item" cstep="3"><a href="javascript:void(0);"><span
                            class="upicon mdi mdi-library-books"></span><span><?php echo e(trans('main.extra_info')); ?></span></a>
                </li>
                <li class="list-group-item" cstep="4"><a href="javascript:void(0);"><span
                            class="upicon mdi mdi-folder-image"></span><span><?php echo e(trans('main.view')); ?></span></a></li>
                <li class="list-group-item" cstep="5"><a href="javascript:void(0);"><span
                            class="upicon mdi mdi-movie-open"></span><span><?php echo e(trans('main.parts')); ?></span></a></li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="steps" id="step1">

                <form method="post" action="/user/content/new/store" class="form-horizontal">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault"><?php echo e(trans('main.course_type')); ?></label>
                        <div class="col-md-10 tab-con">
                            <select name="type" class="form-control font-s">
                                <option value="single"><?php echo e(trans('main.single')); ?></option>
                                <option value="course"><?php echo e(trans('main.course')); ?></option>
                                <option value="webinar"><?php echo e(trans('main.webinar')); ?></option>
                                <option value="course+webinar"><?php echo e(trans('main.course_webinar')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault"><?php echo e(trans('main.publish_type')); ?></label>
                        <div class="col-md-10 tab-con">
                            <select name="private" class="form-control font-s">
                                <option value="2">Fundal</option>
                                <option value="0"><?php echo e(trans('main.open')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault"><?php echo e(trans('main.course_title')); ?></label>
                        <div class="col-md-10 tab-con">
                            <input type="text" name="title" placeholder="30-60 Characters" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault"><?php echo e(trans('main.description')); ?></label>
                        <div class="col-md-10 tab-con">
                            <textarea class="form-control" rows="12" placeholder="Description..."
                                name="content" required></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-12 tab-con">
                            <input type="submit" class="btn btn-custom pull-left" value="Next">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $('.editor-te').jqte({
        format: false
    });

</script>
<script>
    $('document').ready(function () {
        $('input[name="post"]').change(function () {
            if ($(this).prop('checked')) {
                $('input[name="post_price"]').removeAttr('disabled');
            } else {
                $('input[name="post_price"]').attr('disabled', 'disabled');
            }
        });
        $('#free').change(function () {
            if ($(this).prop('checked')) {
                $('input[name="price"]').attr('disabled', 'disabled');
                $('input[name="post_price"]').attr('disabled', 'disabled');
            } else {
                $('input[name="price"]').removeAttr('disabled');
            }
        });
    })

</script>
<script>
    /*$('#category_id').change(function () {
        var id = $(this).val();
        $('.filter-tags').removeAttr('checked');
        $('.filters').not('#filter' + id).each(function () {
            $('.filters').slideUp();
        });
        $('#filter' + id).slideDown(500);
    })/*

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.user.layout.sendvideolayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/content/new.blade.php ENDPATH**/ ?>