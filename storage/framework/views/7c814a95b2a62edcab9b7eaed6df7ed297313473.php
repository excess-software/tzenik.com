<?php $__env->startSection('title'); ?>
<?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : ''); ?>

- <?php echo e($post->title ?? ''); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 volver-atras-blog">
                <br>
                <div class="row">
                    <h4><i class="fa fa-arrow-left"> </i><span> Blogs</span></h4>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 content-blog">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <img class="img-responsive media-blog"
                                src="<?php echo e($post->image); ?>">
                        </div>
                        <div class="row">
                            <h2><b><?php echo e($post->title); ?></b></h2>
                        </div>
                        <br>
                        <div class="row">
                        <?php echo $post->content; ?>

                        </div>
                        <hr class="hr-blog">
                        <br>    
                        <div class="row">
                            <h2>Otros Art&iacute;culos Similares</h2>
                        </div>
                        <br>
                        <div class="row">
                            <img class="img-responsive media-blog"
                                src="https://www.start-business-online.com/images/article_manager_uploads/blog.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/blog/post.blade.php ENDPATH**/ ?>