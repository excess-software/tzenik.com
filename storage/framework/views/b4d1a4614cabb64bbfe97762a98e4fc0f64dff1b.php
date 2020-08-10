<?php $__env->startSection('title'); ?>
    <?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : ''); ?>

    <?php echo e(trans('main.blog')); ?> -
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>

    <div class="container-fluid">
        <div class="container">

            <div class="blog-section">
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row blog-post-box">
                        <div class="col-md-3 col-xs-12">
                            <img src="<?php echo e($post->image); ?>" class="img-responsive">
                        </div>
                        <div class="col-md-9 col-xs-12 text-section">
                            <a href="/blog/post/<?php echo e($post->id); ?>"><h3><?php echo e($post->title); ?></h3></a>
                            <?php echo $post->pre_content; ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="h-10"></div>
            <div class="pagi text-center center-block col-xs-12"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(function () {
            pagination('.blog-section',<?php echo e(!empty($setting['site']['blog_post_count']) ? $setting['site']['blog_post_count'] : 4); ?>, 0);
            $('.pagi').pagination({
                items: <?php echo count($posts); ?>,
                itemsOnPage:<?php echo e(!empty($setting['site']['blog_post_count']) ? $setting['site']['blog_post_count'] : 4); ?>,
                cssStyle: 'light-theme',
                prevText: 'Pre.',
                nextText: 'Next',
                onPageClick: function (pageNumber, event) {
                    pagination('.blog-section',<?php echo e(!empty($setting['site']['blog_post_count']) ? $setting['site']['blog_post_count'] : 4); ?>, pageNumber - 1);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/view/blog/blog.blade.php ENDPATH**/ ?>