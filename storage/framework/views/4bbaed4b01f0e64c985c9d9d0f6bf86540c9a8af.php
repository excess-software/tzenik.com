<?php $__env->startSection('title'); ?>
    <?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : ''); ?>

    - <?php echo e(!empty($post->title) ? $post->title : ''); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>

    <div class="container-fluid">
        <div class="container">
            <div class="blog-section">
                <div class="col-xs-12 row blog-post-box blog-post-box-s">
                    <div class="col-md-4 col-xs-12">
                        <img src="<?php echo e($post->image); ?>" class="img-responsive">
                        <span class="date-section"><?php echo e(date('d F Y',$post->created_at)); ?></span>
                        <span class="date-section date-section-s">
                                <img src="<?php echo e(!empty($post->category->image) ? $post->category->image : ''); ?>" class="img-responsive pull-left">
                                <a href="/category/<?php echo e(!empty($post->category->class) ? $post->category->class : ''); ?>" class="pull-left a-link-s"><?php echo e($post->category->title ?? ''); ?></a>
                            </span>
                        <div class="product-user-box">
                            <img class="img-box" src="<?php echo e(!empty($userMeta['avatar']) ? $userMeta['avatar'] : get_option('default_user_avatar','')); ?>" class="img-responsive"/>
                            <span><?php echo e($post->user->name); ?></span>
                            <div class="user-description-box">
                                <?php echo e(!empty($userMeta['short_biography']) ? $userMeta['short_biography'] : ''); ?>

                            </div>
                            <div class="text-center">
                                <?php $__currentLoopData = $rates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img class="img-icon img-icon-s" src="<?php echo e(!empty($rate['image']) ? $rate['image'] : ''); ?>" title="<?php echo e(!empty($rate['description']) ? $rate['description'] : ''); ?>"/>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="h-10"></div>
                            <div class="product-user-box-footer">
                                <a href="/profile/<?php echo e($post->user->id); ?>"><?php echo e(trans('main.user_profile')); ?></a>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8 col-xs-12 text-section">
                        <h1 class="text-section-s1"><?php echo e($post->title); ?></h1>
                        <br>
                        <?php echo !empty($post->pre_text) ? $post->pre_text : ''; ?>

                        <hr>
                        <?php echo !empty($post->text) ? $post->text : ''; ?>

                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="col-xs-12 col-md-12 article-tabs">
                <div class="user-tabs article-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#vtab1" role="tab" data-toggle="tab"><?php echo e(trans('main.related_courses')); ?></a></li>
                        <li><a href="#vtab2" role="tab" data-toggle="tab"><?php echo e(trans('main.user_courses')); ?></a></li>
                    </ul>
                    <!-- TAB CONTENT -->
                    <div class="tab-content articlec">
                        <div class="active tab-pane fade in tab-body" id="vtab1">
                            <?php $__currentLoopData = $relContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $meta = arrayToList($new->metas, 'option', 'value'); ?>
                                <div class="col-md-3 col-sm-6 col-xs-12 tab-con">
                                    <a href="/product/<?php echo e($new->id); ?>" title="<?php echo e($new->title); ?>" class="content-box">
                                        <img src="<?php echo e($meta['thumbnail']); ?>"/>
                                        <h3><?php echo truncate($new->title,35); ?></h3>
                                        <div class="footer">
                                            <label class="pull-right"><?php if(isset($meta['duration'])): ?><?php echo e(convertToHoursMins($meta['duration'])); ?><?php else: ?> <?php echo e(trans('main.not_defined')); ?> <?php endif; ?> </label>
                                            <span class="boxicon mdi mdi-clock pull-right"></span>
                                            <span class="boxicon mdi mdi-wallet pull-left"></span>
                                            <label class="pull-left"><?php if(isset($meta['price']) && $meta['price']>0): ?> <?php echo e(currencySign()); ?><?php echo e($meta['price']); ?> <?php else: ?> <?php echo e(trans('main.free')); ?> <?php endif; ?></label>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="tab-pane fade tab-body" id="vtab2">
                            <?php $__currentLoopData = $userContent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $meta = arrayToList($new->metas, 'option', 'value'); ?>
                                <div class="col-md-3 col-sm-6 col-xs-12 tab-con">
                                    <a href="/product/<?php echo e($new->id); ?>" title="<?php echo e($new->title); ?>" class="content-box">
                                        <img src="<?php echo e($meta['thumbnail']); ?>"/>
                                        <h3><?php echo truncate($new->title,35); ?></h3>
                                        <div class="footer">
                                            <label class="pull-right"><?php if(isset($meta['duration'])): ?><?php echo e(convertToHoursMins($meta['duration'])); ?><?php else: ?> <?php echo e(trans('main.not_defined')); ?> <?php endif; ?> </label>
                                            <span class="boxicon mdi mdi-clock pull-right"></span>
                                            <span class="boxicon mdi mdi-wallet pull-left"></span>
                                            <label class="pull-left"><?php if(isset($meta['price']) && $meta['price']>0): ?> <?php echo e(currencySign()); ?><?php echo e($meta['price']); ?> <?php else: ?> <?php echo e(trans('main.free')); ?> <?php endif; ?></label>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="h-30"></div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/view/article/article.blade.php ENDPATH**/ ?>