<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.blog_article_settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#main" data-toggle="tab"> <?php echo e(trans('admin.blog_settings')); ?> </a></li>
                    <li class="nav-item"><a class="nav-link" href="#article" data-toggle="tab"> <?php echo e(trans('admin.article_settings')); ?> </a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="main" class="tab-pane active">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" name="blog_comment" value="0">
                                        <input type="checkbox" name="blog_comment" value="1" class="custom-switch-input" <?php if(isset($_setting['blog_comment']) and $_setting['blog_comment'] == 1): ?>) checked <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.comments_enabled')); ?></label>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.contents_in_each_page')); ?></label>
                            <div class="col-md-3">
                                <input type="number" class="spinner-input form-control" name="blog_post_count" value="<?php echo e($_setting['blog_post_count'] ?? 0); ?>" maxlength="3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.contents_in_homepage')); ?></label>
                            <div class="col-md-3">
                                <input type="number" class="spinner-input form-control" name="main_page_blog_post_count" value="<?php echo e($_setting['main_page_blog_post_count'] ?? 0); ?>" maxlength="3">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="article" class="tab-pane">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.contents_in_each_page')); ?></label>
                            <div class="col-md-3">
                                <input type="number" class="spinner-input form-control" name="article_post_count" value="<?php echo e($_setting['article_post_count'] ?? 0); ?>" maxlength="3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><?php echo e(trans('admin.contents_in_homepage')); ?></label>
                            <div class="col-md-3">
                                <input type="number" class="spinner-input form-control" name="main_page_article_post_count" value="<?php echo e($_setting['main_page_article_post_count'] ?? 0); ?>" maxlength="3">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Settings','Blog & Articles']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/setting/blog.blade.php ENDPATH**/ ?>