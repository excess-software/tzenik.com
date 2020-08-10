<?php $__env->startSection('title'); ?>
    <?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : ''); ?>

    <?php echo e(trans('main.articles')); ?> -
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page'); ?>
    <div class="container-fluid">
        <div class="row cat-tag-section">
            <div class="container">
                <div class="col-md-2 col-xs-12 col-md-offset-10 text-left">
                    <div class="form-group pull-left">
                        <select class="form-control" id="order order-s">
                            <option value="new" <?php if(isset($order) && $order == 'new'): ?> selected <?php endif; ?>><?php echo e(trans('main.newest')); ?></option>
                            <option value="old" <?php if(isset($order) && $order == 'old'): ?> selected <?php endif; ?>><?php echo e(trans('main.oldest')); ?></option>
                            <option value="view" <?php if(isset($order) && $order == 'view'): ?> selected <?php endif; ?>><?php echo e(trans('main.most_viewed')); ?></option>
                            <option value="popular" <?php if(isset($order) && $order == 'popular'): ?> selected <?php endif; ?>><?php echo e(trans('main.most_popular')); ?></option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-xs-12 tab-con">
                    <div class="h-20"></div>
                    <div class="ucp-section-box sbox3" id="ucp-section-article">
                        <div class="header back-orange header-new"><span><?php echo e(trans('main.category')); ?></span></div>
                        <div class="body">
                            <ul>
                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <input type="checkbox" name="category" id="category<?php echo e($cat->id); ?>" value="<?php echo e($cat->id); ?>" <?php if(isset($cats) && in_array($cat->id,$cats)): ?> checked <?php endif; ?>/>
                                        <label for="category<?php echo e($cat->id); ?>"><span></span><?php echo e($cat->title); ?></label>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="row blog-section blog-section-s">
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 col-xs-12 article-post-count tab-con">
                                <div class="post-module">
                                    <div class="thumbnail">
                                        <div class="date">
                                            <div class="day"><?php echo e(date('d',$post->created_at)); ?></div>
                                            <div class="month"><?php echo e(date('F',$post->created_at)); ?></div>
                                        </div>
                                        <img src="<?php echo e($post->image); ?>">
                                    </div>
                                    <div class="post-content">
                                        <h1 class="title">
                                            <a href="/article/item/<?php echo e($post->id); ?>">
                                                <h3><?php echo e($post->title); ?></h3>
                                            </a>
                                        </h1>
                                        <p class="description">
                                            <?php echo e(mb_strimwidth(strip_tags($post->pre_text),0,250,'...')); ?>

                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="h-10"></div>
                    <div class="pagi text-center center-block col-xs-12"></div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(function () {
            pagination('.blog-section',<?php echo e(!empty($setting['site']['article_post_count']) ? $setting['site']['article_post_count'] : 6); ?>, 0);
            $('.pagi').pagination({
                items: <?php echo count($posts); ?>,
                itemsOnPage:<?php echo e(!empty($setting['site']['article_post_count']) ? $setting['site']['article_post_count'] : 6); ?>,
                cssStyle: 'light-theme',
                prevText: 'Pre.',
                nextText: 'Next',
                onPageClick: function (pageNumber, event) {
                    pagination('.blog-section',<?php echo e(!empty($setting['site']['article_post_count']) ? $setting['site']['article_post_count'] : 6); ?>, pageNumber - 1);
                }
            });
        });
    </script>
    <script>
        $(function () {
            $('#order').change(function () {
                var url = window.location.href.replace(/#.*$/, "");
                if (url.indexOf('?') != -1)
                    var addon = '&order=' + $(this).val();
                else
                    var addon = '?order=' + $(this).val();
                window.location.href = url + addon;
            })
        })
    </script>
    <script>
        $(function () {
            $('input[type="checkbox"][name="category"]').change(function () {
                var url = window.location.href.replace(/#.*$/, "");
                var state = $(this).val();
                if (this.checked) {

                    if (url.indexOf('?') != -1)
                        var addon = '&cat[]=' + state;
                    else
                        var addon = '?cat[]=' + state;
                    window.location.href = url + addon;
                } else {
                    window.location.href = url.replace('cat[]=' + state, '');
                }
            })
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/web/default/view/article/list.blade.php ENDPATH**/ ?>