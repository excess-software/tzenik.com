

<?php $__env->startSection('pages'); ?>
    <div class="h-30"></div>
    <div class="conteiner-fluid">
        <div class="container cont-10">
            <div class="h-30"></div>
            <div class="multi-steps">
                <div class="row">
                    <div class="col-md-6"><a href="/user/content/new_course"><button class="btn btn-primary btn-lg btn-block"><?php echo e(trans('main.select_course')); ?></button></a></div>
                    <div class="col-md-6"><a href="/user/content/new_webinar"><button class="btn btn-primary btn-lg btn-block"><?php echo e(trans('main.select_webinar_or_coaching')); ?></button></a></div>
                </div>
            </div>
            <div class="h-30"></div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $('.editor-te').jqte({format: false});
    </script>
    <script>
        $('document').ready(function () {
            $('input[name="post"]').change(function () {
                if($(this).prop('checked')){
                    $('input[name="post_price"]').removeAttr('disabled');
                }else{
                    $('input[name="post_price"]').attr('disabled','disabled');
                }
            });
            $('#free').change(function () {
                if($(this).prop('checked')){
                    $('input[name="price"]').attr('disabled','disabled');
                    $('input[name="post_price"]').attr('disabled','disabled');
                }else{
                    $('input[name="price"]').removeAttr('disabled');
                }
            });
        })
    </script>
    <script>
        $('#category_id').change(function () {
            var id = $(this).val();
            $('.filter-tags').removeAttr('checked');
            $('.filters').not('#filter'+id).each(function(){
                $('.filters').slideUp();
            });
            $('#filter'+id).slideDown(500);
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.user.layout.sendvideolayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/content/selectnew.blade.php ENDPATH**/ ?>