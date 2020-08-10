<?php $__env->startSection('title'); ?>
    <?php echo e(get_option('site_title','')); ?> - <?php echo e(trans('main.soon')); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <div class="container-fluid">
        <div class="row cat-tag-section">
            <div class="container">
                <div class="col-md-5 col-xs-12 tab-con">
                    <a href="/user/video/record" class="btn btn-custom pull-left"><span><?php echo e(trans('main.new_soon')); ?></span></a>
                    <div class="btn-group soon-btngp ptopz" data-toggle="buttons">
                        <label class="btn btn-primary <?php if(empty(request()->get('mode')) or request()->get('mode') == 'all'): ?> active <?php endif; ?>">
                            <input type="radio" name="mode" value="all" <?php if(!empty(request()->get('mode')) and request()->get('mode') == 'all'): ?> checked <?php endif; ?>> <?php echo e(trans('main.all')); ?>

                        </label>
                        <label class="btn btn-primary <?php if(!empty(request()->get('mode')) and request()->get('mode')=='publish'): ?> active <?php endif; ?>">
                            <input type="radio" name="mode" value="publish" <?php if(!empty(request()->get('mode')) and request()->get('mode') == 'publish'): ?> checked <?php endif; ?>><?php echo e(trans('main.soon')); ?>

                        </label>
                        <label class="btn btn-primary <?php if(!empty(request()->get('mode')) and request()->get('mode')=='accept'): ?> active <?php endif; ?>">
                            <input type="radio" name="mode" value="accept" <?php if(!empty(request()->get('mode')) and request()->get('mode')=='accept'): ?> checked <?php endif; ?>><?php echo e(trans('main.published')); ?>

                        </label>
                    </div>
                </div>
                <div class="col-md-4 col-xs-12 text-left tab-con"></div>
                <div class="col-md-3 col-xs-12 text-left tab-con">
                    <div class="box marz">
                        <div class="container-2">
                            <form>
                                <?php echo e(csrf_field()); ?>

                                <input type="search" id="search" name="q" value="<?php echo e(!empty(request()->get('q')) ? request()->get('q') : ''); ?>" placeholder="Search in coming soon courses"/>
                                <span class="icon"><i class="homeicon mdi mdi-magnify"></i></span>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="h-20"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="col-md-3 col-xs-12 tab-con">
                    <div class="ucp-section-box sbox3">
                        <div class="header back-orange text-center header-f"><span><?php echo e(trans('main.category')); ?></span></div>
                        <div class="body">
                            <ul id="accordion" class="cat-filters-li accordion">
                                <?php $__currentLoopData = $setting['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <?php if(count($mainCategory->childs) > 0): ?>
                                            <div class="link"><?php echo e($mainCategory->title); ?><i class="mdi mdi-chevron-down"></i></div>
                                            <ul class="submenu">
                                                <?php $__currentLoopData = $mainCategory->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li><input name="category" type="checkbox" id="cat<?php echo e($child->id); ?>" value="<?php echo e($child->id); ?>" class="category-item" <?php if(!empty(request()->get('cat')) && in_array($child->id,request()->get('cat'))): ?> checked <?php endif; ?>><label for="cat<?php echo e($child->id); ?>"><span></span><?php echo e($child->title); ?></label></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php else: ?>
                                            <div class="link"><?php echo e($mainCategory->title); ?><i class="mdi mdi-chevron-down"></i></div>
                                            <ul class="submenu">
                                                <li><input name="category" type="checkbox" id="cat<?php echo e($mainCategory->id); ?>" value="<?php echo e($mainCategory->id); ?>" class="category-item" <?php if(!empty(request()->get('cat')) && in_array($mainCategory->id,request()->get('cat'))): ?> checked <?php endif; ?>><label for="cat<?php echo e($mainCategory->id); ?>"><span></span><?php echo e($mainCategory->title); ?></label></li>
                                            </ul>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="newest-container newest-container-b">
                        <div class="row body body-target body-target-s">
                            <?php if(!empty($list)): ?>
                                <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-4 col-sm-6 col-xs-12 pagi-content tab-con">
                                        <a href="<?php echo e(!empty($content->content_id) ? '/product/'. $content->content_id : 'javascript:void(0);'); ?>" title="<?php echo e($content->title); ?>" class="content-box pagi-content-box">
                                            <div class="img-container text-center center-block">
                                                <img src="<?php echo e($content->image); ?>"/>
                                            </div>
                                            <h3><?php echo truncate($content->title,30); ?></h3>
                                            <div class="footer">
                                                <?php if($content->content_id == null): ?>
                                                    <span class="pull-right mod-r" data-toggle="modal" data-target="#dModal<?php echo e($content->id); ?>"><b><?php echo e(trans('main.description')); ?></b></span>
                                                <?php else: ?>
                                                    <span class="pull-right mod-r"><b class="green-s"><?php echo e(trans('main.published')); ?></b></span>
                                                <?php endif; ?>
                                                <?php if($content->mode == 'publish'): ?>
                                                    <?php if(count($content->fans)==1): ?>
                                                        <span class="boxicon mdi mdi-heart pull-left"></span>
                                                        <span class="pull-left request-unfollow-icon" title="Unfollow" onclick="window.location.href ='/record/unfollow/<?php echo e($content->id); ?>'"><?php echo e($content->fans_count); ?><?php echo e(trans('main.followers')); ?></span>
                                                    <?php else: ?>
                                                        <span class="boxicon mdi mdi-heart-outline pull-left"></span>
                                                        <span class="pull-left request-follow-icon" title="Follow" onclick="window.location.href ='/record/follow/<?php echo e($content->id); ?>'"><?php echo e($content->fans_count); ?><?php echo e(trans('main.followers')); ?></span>
                                                    <?php endif; ?>
                                                <?php elseif($content->content_id != null): ?>
                                                    <span class="boxicon mdi mdi-check-bold pull-left"></span>
                                                    <span class="pull-left request-accept-icon"><?php echo e(trans('main.published')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </a>

                                        <div id="dModal<?php echo e($content->id); ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title"><?php echo e(trans('main.extra_info')); ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><?php echo e($content->description ?? 'Description not found.'); ?></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-custom pull-left" data-dismiss="modal"><?php echo e(trans('main.close')); ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <div class="h-10"></div>
                        <div class="pagi text-center center-block col-xs-12"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        var category_content_count = <?php echo e(!empty($setting['site']['category_content_count']) ? $setting['site']['category_content_count'] : 6); ?>

        $(function () {
            pagination('.body-target', category_content_count, 0);
            $('.pagi').pagination({
                items: <?php echo count($list); ?>,
                itemsOnPage: category_content_count,
                cssStyle: 'light-theme',
                prevText: 'Pre.',
                nextText: 'Next',
                onPageClick: function (pageNumber, event) {
                    pagination('.body-target', category_content_count, pageNumber - 1);
                }
            });
        });
    </script>
    <script type="application/javascript" src="/assets/default/javascripts/category-page-custom.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/view/record/record.blade.php ENDPATH**/ ?>