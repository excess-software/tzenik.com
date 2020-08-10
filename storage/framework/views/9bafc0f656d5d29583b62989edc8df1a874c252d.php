<?php $__env->startSection('title'); ?>
    <?php echo $setting['site']['site_title'].'Channel- '.$chanel->title; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="container-fluid profile-top-background" style="background: url('<?php echo e($chanel->image ?? ''); ?>');">
        <div class="col-md-3 col-xs-12">

        </div>
        <div class="col-md-9 col-xs-12 bottom-section">
            <span>
                <label class="profile-name"><?php echo e($chanel->title); ?></label>
            <?php if($follow == 0): ?>
                    <a class="btn btn-red btn-hover-animate" href="/chanel/follow/<?php echo e($chanel->user_id); ?>"><span class="homeicon mdi mdi-plus"></span> <?php echo e(trans('main.follow')); ?></a>
                <?php else: ?>
                    <a class="btn btn-red btn-hover-animate" href="/chanel/unfollow/<?php echo e($chanel->user_id); ?>"><span class="homeicon mdi mdi-close"></span><?php echo e(trans('main.unfollow')); ?></a>
                <?php endif; ?>
                <label class="buttons"><span class="homeicon mdi mdi-account-heart"></span><p><?php echo e(!empty($follow) ? $follow : '0'); ?> <?php echo e(trans('main.followers')); ?></p></label>
                <label class="buttons"><span class="homeicon mdi mdi-library-video"></span><p><?php echo e(!empty($chanel->contents_count) ? $chanel->contents_count : 0); ?> <?php echo e(trans('main.courses')); ?></p></label>
                <label class="buttons"><span class="homeicon mdi mdi-clock"></span><p class="duration-f"><?php echo e(!empty($duration) ? $duration : '0'); ?>&nbsp;<?php echo e(trans('main.minutes_stat')); ?></p></label>
        </div>
    </div>

    <div class="container-fluid profile-middle-background">
        <div class="container">
            <div class="col-md-2 col-xs-12 tab-con">
                <?php if($chanel->formal == 'ok'): ?>
                    <label title="Formal" class="formal-chanel"><i class="mdi mdi-check-circle"></i></label>
                <?php endif; ?>
                <img class="sbox3" src="<?php echo e($chanel->avatar); ?>"/>
                <div class="rate-section raty"></div>
            </div>
            <div class="location-section col-md-10 col-xs-12">
                <div><b><?php echo $chanel->description; ?></b></div>
                <div><b><a href="<?=url('/') . '/' . Request::path();?>" class="uname-f"><?php echo e($chanel->username); ?></a></b></div>
            </div>
        </div>
    </div>

    <div class="h-10"></div>

    <div class="container-fluid cont-box-bg">

        <div class="container remove-padding-xs">

            <div class="col-xs-12">

                <div class="h-20"></div>
                <div class="h-10"></div>

                <div class="profile-section-fade newest-container remove-padding-xs remove-bg-xs newest-container-r">
                    <div class="body body-target-s">
                        <div class="row">
                            <?php $__currentLoopData = $chanel->contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vid): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($vid->content != null): ?>
                                    <?php $meta = arrayToList($vid->content->metas,'option','value'); ?>
                                    <div class="col-md-3 col-sm-6 col-xs-6 tab-con">
                                        <a href="/product/<?php echo e($vid->content->id); ?>" title="<?php echo e($vid->content->title); ?>" class="content-box">
                                            <img src="<?php echo e(!empty($meta['thumbnail']) ? $meta['thumbnail'] : ''); ?>"/>
                                            <h3><?php echo truncate($vid->content->title,35); ?></h3>
                                            <div class="footer">
                                                <label class="pull-right"><?php echo e(!empty($meta['duration']) ? $meta['duration'] : ''); ?> <?php echo e(trans('main.min')); ?></label>
                                                <span class="boxicon mdi mdi-clock pull-right"></span>
                                                <span class="boxicon mdi mdi-wallet pull-left"></span>
                                                <label class="pull-left"><?php echo e(currencySign()); ?><?php echo e(!empty($meta['price']) ? $meta['price'] : '0'); ?></label>
                                            </div>
                                        </a>
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
<?php $__env->startSection('script'); ?>
    <script>
        $('.raty').raty({starType: 'i'});
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/chanel/chanel.blade.php ENDPATH**/ ?>