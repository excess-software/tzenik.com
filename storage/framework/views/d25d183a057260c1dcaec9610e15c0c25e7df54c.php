<?php $__env->startSection('page'); ?>

<div class="cards">
    <div class="card-body">
        <div class="tabs">
            <ul class="nav nav-pills partes-nuevo-curso">
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link active" cstep="1" data-toggle="tab"> <?php echo e(trans('main.general')); ?> </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link disabled" cstep="2" data-toggle="tab"><?php echo e(trans('main.category')); ?></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link disabled" cstep="3" data-toggle="tab"><?php echo e(trans('main.extra_info')); ?></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link disabled" cstep="4" data-toggle="tab"><?php echo e(trans('main.view')); ?></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link disabled" cstep="5" data-toggle="tab"><?php echo e(trans('main.parts')); ?></a>
                </li>
            </ul>
        </div>
        <br>
        <div class="tab-content">
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
                            <input type="submit" class="btn btn-primary pull-left" value="Next">
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

<?php echo $__env->make(getTemplate() . '.user.vendor.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/content/new.blade.php ENDPATH**/ ?>