<?php $__env->startSection('title'); ?>
    <?php echo e(get_option('site_title','')); ?> Search - <?php echo e(!empty(request()->get('q')) ? request()->get('q') : ''); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <div class="container-fluid">
        <div class="row cat-search-section">
            <div class="container">
                <div class="col-md-6 col-sm-6 col-xs-12 cat-icon-container">
                    <span> <?php echo e(!empty($search_title) ? $search_title : 'Search'); ?> "<?php echo e(!empty(request()->get('q')) ? request()->get('q') : ''); ?>"</span>
                </div>
                <div class="col-md-3">
                    <div class="h-10"></div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <form>
                        <?php echo e(csrf_field()); ?>

                        <select class="form-control font-s" name="search_type">
                            <?php $__currentLoopData = $searchTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $searchType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="content_title" <?php if(!empty(request()->get('type')) && request()->get('type') == $index): ?> selected <?php endif; ?>><?php echo e($searchType); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="h-10"></div>
    <div class="h-20"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="container">
                <div class="col-md-12 col-xs-12">
                    <?php if(empty(request()->get('type')) or (!empty(request()->get('type')) and request()->get('type') !== 'user_name')): ?>
                        <div class="newest-container newest-container-b">
                            <div class="row body body-target body-target-s">
                                <?php if($contents): ?>
                                    <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-3 col-sm-6 col-xs-12 pagi-content tab-con">
                                            <a href="/product/<?php echo e($content['id']); ?>" title="<?php echo e($content['title'] ?? ''); ?>" class="content-box">
                                                <img src="<?php echo e($content['metas']['thumbnail'] ?? ''); ?>"/>
                                                <h3><?php echo truncate($content['title'],30); ?></h3>
                                                <div class="footer">
                                                    <label class="pull-right"><?php echo contentDuration($content['id']); ?></label>
                                                    <span class="boxicon mdi mdi-clock pull-right"></span>
                                                    <span class="boxicon mdi mdi-wallet pull-left"></span>
                                                    <?php if(isset($content['metas']['price']) and $content['metas']['price'] > 0): ?>
                                                        <label class="pull-left"><?php echo e(currencySign()); ?><?php echo e($content['metas']['price']); ?></label>
                                                    <?php else: ?>
                                                        <label class="pull-left"><?php echo e(trans('main.free_item')); ?></label>
                                                    <?php endif; ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <h3><?php echo e(trans('main.no_search_result')); ?></h3>
                                <?php endif; ?>
                            </div>
                            <div class="h-10"></div>
                            <?php if($contents): ?>
                                <div class="pagi text-center center-block col-xs-12"></div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="newest-container newest-container-b">
                            <div class="row body body-target body-target-s">
                                <?php if($contents): ?>
                                    <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-2 col-sm-3 col-xs-6 pagi-content">
                                            <a href="/prfile/<?php echo e($content['id']); ?>" title="<?php echo e($content['name']); ?>" class="user-box pagi-content-box">
                                                <img src="<?php echo e($content['metas']['avatar']); ?>"/>
                                                <h3><?php echo $content['name']; ?></h3>
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <h3><?php echo e(trans('main.no_search_result')); ?></h3>
                                <?php endif; ?>
                            </div>
                            <div class="h-10"></div>
                            <?php if($contents): ?>
                                <div class="pagi text-center center-block col-xs-12"></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
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
                items: <?php echo count($contents); ?>,
                itemsOnPage: category_content_count,
                cssStyle: 'light-theme',
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>',
                onPageClick: function (pageNumber, event) {
                    pagination('.body-target', category_content_count, pageNumber - 1);
                }
            });
        });
    </script>
    <script type="application/javascript" src="/assets/default/javascripts/category-page-custom.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/view/search/search.blade.php ENDPATH**/ ?>