<?php $__env->startSection('title'); ?>
<?php echo e(get_option('site_title','')); ?> Search - <?php echo e(!empty(request()->get('q')) ? request()->get('q') : ''); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<style>
    .bottom-column {
        float: none;
        display: table-cell;
        vertical-align: bottom;
    }

</style>
<div class="container">
    <div class="row cat-search-section">
        <div class="container">
            <div class="col-md-6 col-sm-6 col-xs-12 cat-icon-container">
                <span> <?php echo e(!empty($search_title) ? $search_title : 'Search'); ?>

                    "<?php echo e(!empty(request()->get('q')) ? request()->get('q') : ''); ?>"</span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <form>
                    <?php echo e(csrf_field()); ?>

                    <select class="form-control font-s" name="search_type">
                        <?php $__currentLoopData = $searchTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $searchType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($searchType); ?>" <?php if(!empty(request()->get('type')) && request()->get('type') ==
                            $index): ?> selected <?php endif; ?>><?php echo e($searchType); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<?php if($contents): ?>
<div class="row">
    <div class="container">
        <div class="col-md-12 cursos-destacados">
            <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if(empty(request()->get('type')) or (!empty(request()->get('type')) and request()->get('type') !==
            'user_name')): ?>
            <a href="/product/<?php echo e($content['id']); ?>">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel-description vertical-center">
                                    <div class="row curso-destacado-titulo black-text">
                                        <h3><b><?php echo e($content['title']); ?></b></h3>
                                    </div>
                                    <div class="row curso-destacado-contenido">
                                        <div class="col">
                                            <span class="curso-destacado-contenido-interno black-text">
                                                <?php echo Str::limit($content['content'], 250); ?>

                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <?php if(isset($content->category->title)): ?>
                                <div class="row curso-destacado-contenido .bottom-column">
                                    <h4><span class="label label-tag-media-categoria"> <span
                                                class="circle-tag-media-categoria"></span>
                                            <?php echo e($content->category->title ? $content->category->title : ''); ?></span></h4>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6">
                                <img class="img-responsive" style="max-height: 300px !important; width: auto;"
                                    src="<?php echo e(!empty($content['metas']['thumbnail']) ? $content['metas']['thumbnail'] : 'https://cdn-a.william-reed.com/var/wrbm_gb_food_pharma/storage/images/1/8/6/0/230681-6-eng-GB/IB3-Limited-SIC-Pharma-April-20142_news_large.jpg'); ?>"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-cursos-destacados btn-block">
                            <h4><b>Continuar</b></h4>
                        </button>
                    </div>
                </div>
            </a>
            <?php else: ?>

            <a href="/profile/<?php echo e($content['id']); ?>" title="<?php echo e($content['name']); ?>" class="text-center">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel-description vertical-center">
                                    <div class="row curso-destacado-titulo black-text">
                                        <h3><b><?php echo $content['name']; ?></b></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <img class="img-responsive" style="max-height: 300px !important; width: auto;"
                                    src="<?php echo e(!empty($content['metas']['thumbnail']) ? $content['metas']['thumbnail'] : 'https://cdn-a.william-reed.com/var/wrbm_gb_food_pharma/storage/images/1/8/6/0/230681-6-eng-GB/IB3-Limited-SIC-Pharma-April-20142_news_large.jpg'); ?>"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-cursos-destacados btn-block">
                            <h4><b>Continuar</b></h4>
                        </button>
                    </div>
                </div>
            </a>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php else: ?>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <h1><?php echo e(trans('main.no_search_result')); ?></h1>
        </div>
    </div>
</div>
<br>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    var category_content_count = {
        {
            !empty($setting['site']['category_content_count']) ? $setting['site']['category_content_count'] : 6
        }
    }
    $(function () {
        pagination('.body-target', category_content_count, 0);
        $('.pagi').pagination({
            items: {
                !!count($contents) !!
            },
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

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/search/search.blade.php ENDPATH**/ ?>