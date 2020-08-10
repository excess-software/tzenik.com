<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.custom_pages')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <div class="card">
        <div class="card-body">
            <div class="col-md-12">
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#terms" data-toggle="tab"><?php echo e(trans('admin.rules')); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact" data-toggle="tab"><?php echo e(trans('admin.contact')); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#about" data-toggle="tab"><?php echo e(trans('admin.about')); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#help" data-toggle="tab"><?php echo e(trans('admin.help')); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#update" data-toggle="tab"><?php echo e(trans('admin.extra1')); ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="#delete" data-toggle="tab"><?php echo e(trans('admin.extra2')); ?></a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="terms" class="tab-pane active">
                    <form method="post" action="/admin/setting/store" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea class="summernote" name="pages_terms"><?php echo $_setting['pages_terms'] ?? ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                <a href="/page/pages_terms" target="_blank" class="btn btn-danger" type="submit"><?php echo e(trans('admin.preview')); ?></a>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="contact" class="tab-pane fade">
                    <form method="post" action="/admin/setting/store/contact" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea class="summernote" name="pages_contact"><?php echo $_setting['pages_contact'] ?? ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                <a href="/page/pages_contact" target="_blank" class="btn btn-danger" type="submit"><?php echo e(trans('admin.preview')); ?></a>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="about" class="tab-pane fade">
                    <form method="post" action="/admin/setting/store/about" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea class="summernote" name="pages_about"><?php echo $_setting['pages_about'] ?? ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                <a href="/page/pages_about" target="_blank" class="btn btn-danger" type="submit"><?php echo e(trans('admin.preview')); ?></a>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="help" class="tab-pane fade">
                    <form method="post" action="/admin/setting/store/help" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea class="summernote" name="pages_help"><?php echo $_setting['pages_help'] ?? ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                <a href="/page/pages_help" target="_blank" class="btn btn-danger" type="submit"><?php echo e(trans('admin.preview')); ?></a>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="update" class="tab-pane fade">
                    <form method="post" action="/admin/setting/store/update" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea class="summernote" name="pages_content_update"><?php echo $_setting['pages_content_update'] ?? ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                <a href="/page/pages_content_update" target="_blank" class="btn btn-danger" type="submit"><?php echo e(trans('admin.preview')); ?></a>
                            </div>
                        </div>

                    </form>
                </div>
                <div id="delete" class="tab-pane fade">
                    <form method="post" action="/admin/setting/store/delete" class="form-horizontal form-bordered">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea class="summernote" name="pages_content_delete"><?php echo $_setting['pages_content_delete'] ?? ''; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                <a href="/page/pages_content_delete" target="_blank" class="btn btn-danger" type="submit"><?php echo e(trans('admin.preview')); ?></a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Settings','Pages']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/setting/pages.blade.php ENDPATH**/ ?>