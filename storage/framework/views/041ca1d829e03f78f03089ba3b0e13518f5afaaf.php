<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.edit_course')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <div class="card">
        <div class="card-body">
            <div class="tabs">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="#main" data-toggle="tab"> <?php echo e(trans('admin.general')); ?> </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#meta" data-toggle="tab"><?php echo e(trans('admin.extra_info')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#filter" data-toggle="tab">Tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#parts" data-toggle="tab"><?php echo e(trans('admin.parts')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#guides" data-toggle="tab">Guías</a>
                    </li>
                    <!--<li class="nav-item">
                        <a class="nav-link" href="#subscribe" data-toggle="tab"><?php echo e(trans('admin.subscribe')); ?></a>
                    </li>-->
                </ul>
                <div class="tab-content">
                    <div id="main" class="tab-pane active">
                        <form action="/admin/content/store/<?php echo e($item->id); ?>/main" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                                <div class="col-md-10">
                                    <input type="text" value="<?php echo e($item->title); ?>" name="title" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.course_type')); ?></label>
                                <div class="col-md-10">
                                    <select name="type" class="form-control" required>
                                        <option value="single" <?php if($item->type == 'single'): ?> selected <?php endif; ?>><?php echo e(trans('admin.single')); ?></option>
                                        <option value="course" <?php if($item->type == 'course'): ?> selected <?php endif; ?>><?php echo e(trans('admin.course')); ?></option>
                                        <option value="webinar" <?php if($item->type == 'webinar'): ?> selected <?php endif; ?>><?php echo e(trans('admin.webinar')); ?></option>
                                        <option value="course+webinar" <?php if($item->type == 'course+webinar'): ?> selected <?php endif; ?>><?php echo e(trans('admin.course_webinar')); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.th_status')); ?></label>
                                <div class="col-md-10">
                                    <select name="mode" class="form-control" required>
                                        <option value="publish" <?php if($item->mode=='publish'): ?> selected <?php endif; ?>><?php echo e(trans('admin.published')); ?></option>
                                        <option value="request" <?php if($item->mode=='request'): ?> selected <?php endif; ?>><?php echo e(trans('admin.review_request')); ?></option>
                                        <option value="waiting" <?php if($item->mode=='delete'): ?> selected <?php endif; ?>><?php echo e(trans('admin.unpublish_request')); ?></option>
                                        <option value="draft" <?php if($item->mode=='draft'): ?> selected <?php endif; ?>><?php echo e(trans('admin.pending')); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea class="summernote" name="content" required><?php echo e($item->content); ?></textarea>
                                </div>
                            </div>

                            <div class="col-12">
                                <!--<div class="form-group">
                                    <label class="custom-switch">
                                        <input type="hidden" value="0" name="document">
                                        <input type="checkbox" name="document" value="1" class="custom-switch-input" <?php if($item->document == 1): ?> checked="checked" <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.item_doc')); ?></label>
                                    </label>
                                </div>-->
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input type="hidden" name="price" value="1">
                                        <input type="checkbox" name="price" id="free_course" value="0" class="custom-switch-input" <?php if($item->price == 0): ?> checked="checked" <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.free_course')); ?></label>
                                    </label>
                                </div>
                                <!--<div class="form-group">
                                    <label class="custom-switch">
                                        <input type="hidden" name="support" value="0">
                                        <input type="checkbox" name="support" value="1" class="custom-switch-input" <?php if($item->support == 1): ?> checked="checked" <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.vendor_supports_item')); ?></label>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input type="hidden" name="post" value="0">
                                        <input type="checkbox" name="post" value="1" class="custom-switch-input" <?php if($item->post == 1): ?> checked="checked" <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.vendor_postal_sale')); ?></label>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label class="custom-switch">
                                        <input type="hidden" name="download" value="0">
                                        <input type="checkbox" name="download" value="1" class="custom-switch-input" <?php if($item->download == 1): ?> checked="checked" <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.download')); ?></label>
                                    </label>
                                </div>-->
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-9">
                                    <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="meta" class="tab-pane ">
                        <form action="/admin/content/store/<?php echo e($item->id); ?>/meta" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.course_cover')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="cover" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="cover" class="form-control" type="text" name="cover" dir="ltr" required value="<?php echo e(!empty($meta['cover']) ? $meta['cover'] : ''); ?>">
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="cover">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.course_thumbnail')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="thumbnail" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="thumbnail" class="form-control" type="text" name="thumbnail" dir="ltr" required value="<?php echo e(!empty($meta['thumbnail']) ? $meta['thumbnail'] : ''); ?>">
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="thumbnail">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.demo')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="video" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="video" class="form-control" type="text" name="video" dir="ltr" required value="<?php echo e(!empty($meta['video']) ? $meta['video'] : ''); ?>">
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="video">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>-->

                        <!--
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.duration')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="number" min="0" name="duration" value="<?php echo e(!empty($meta['duration']) ? $meta['duration'] : ''); ?>" class="form-control text-center">
                                        <span class="input-group-append click-for-upload cu-p">
                                            <span class="input-group-text"><?php echo e(trans('admin.minutes')); ?></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            -->

                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.price')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" name="price" value="<?php echo e(!empty($meta['price']) ? $meta['price'] : ''); ?>" class="form-control text-center" id="product_price" <?php if($item->price == 0): ?> disabled="disabled" <?php endif; ?>>
                                        <span class="input-group-append click-for-upload cu-p">
                                            <span class="input-group-text"><?php if(!empty($meta['price'])): ?> <?php echo e(num2str($meta['price'])); ?> <?php endif; ?> <?php echo e(trans('admin.cur_dollar')); ?></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.postal_price')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" name="post_price" value="<?php echo e(!empty($meta['post_price']) ? $meta['post_price'] : ''); ?>" class="form-control text-center numtostr">
                                        <span class="input-group-append click-for-upload cu-p">
                                            <span class="input-group-text"><?php if(!empty($meta['post_price'])): ?> <?php echo e(num2str($meta['post_price'])); ?> <?php endif; ?> <?php echo e(trans('admin.cur_dollar')); ?></span>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <?php
                            if (isset($meta['precourse']) and $meta['precourse'] != '')
                                $preCourseArray = explode(',', rtrim($meta['precourse'], ','));
                            else
                                $preCourseArray = [];
                            ?>
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.prerequisites')); ?></label>
                                <div class="col-md-8">
                                    <select name="precourse[]" multiple="multiple" class="form-control selectric">
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($product->id); ?>" <?php if(in_array($product->id,$preCourseArray)): ?> selected="selected" <?php endif; ?>><?php echo e($product->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>-->

                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8">
                                    <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="filter" class="tab-pane ">
                        <form action="/admin/content/store/<?php echo e($item->id); ?>/tags" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>

                            <?php if(!empty($filters)): ?>
                                <?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3 col-xs-12">
                                        <fieldset>
                                            <legend class="custom-legend" style="font-weight: bold;"><?php echo e($filter->filter); ?></legend>
                                            <?php $__currentLoopData = $filter->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                &nbsp;&nbsp;&nbsp;<input type="checkbox" value="<?php echo e($tag->id); ?>" name="tags[]" style="position: relative;top: 2px;" <?php echo e(checkedInObject($tag->id,'tag_id',$item->tags)); ?>>&nbsp;<?php echo e($tag->tag); ?><br>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </fieldset>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <div class="row h-25"></div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-10">
                                    <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="parts" class="tab-pane ">
                        <table class="table table-bordered table-striped mb-none" id="datatable-details">
                            <thead>
                            <tr>
                                <th><?php echo e(trans('admin.th_title')); ?></th>
                                <th class="text-center" width="150"><?php echo e(trans('admin.th_date')); ?></th>
                                <th class="text-center" width="50"><?php echo e(trans('admin.convert_status')); ?></th>
                                <th class="text-center" width="50"><?php echo e(trans('admin.volume')); ?> (MB)</th>
                                <th class="text-center" width="50"><?php echo e(trans('admin.duration')); ?> (<?php echo e(trans('admin.minute')); ?>)</th>
                                <th class="text-center" width="50"><?php echo e(trans('admin.th_status')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('admin.th_controls')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $item->parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $part): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($part->title); ?>&nbsp;<?php if($part->free == 1 || $item->price == 0): ?>(Free)<?php endif; ?></td>
                                    <td class="text-center" width="150"><?php echo e(date('d F Y : H:i',$item->created_at)); ?></td>
                                    <td class="text-center" width="50">
                                        <?php
                                            $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                                            $file = $storagePath.'source/content-'.$part->content->id.'/video/part-'.$part->id.'.mp4';
                                        ?>
                                        <?php if(file_exists($file)): ?>
                                            <i class="fa fa-check c-g"></i>
                                        <?php else: ?>
                                            <i class="fa fa-times c-r"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center"><?php echo e(!empty($part->size) ? $part->size : '0'); ?></td>
                                    <td class="text-center"><?php echo e(!empty($part->duration) ? $part->duration : '0'); ?></td>
                                    <td class="text-center" width="100">
                                        <?php if($part->mode == 'publish'): ?>
                                            <b class="c-b"><?php echo e(trans('admin.published')); ?></b>
                                        <?php elseif($part->mode == 'draft'): ?>
                                            <b class="c-g"><?php echo e(trans('admin.draft')); ?></b>
                                        <?php elseif($part->mode == 'request'): ?>
                                            <span class="c-g"><?php echo e(trans('admin.review_request')); ?></span>
                                        <?php elseif($part->mode == 'delete'): ?>
                                            <span class="c-r"><?php echo e(trans('admin.unpublish_request')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/admin/content/edit/<?php echo e($item->id); ?>/part/<?php echo e($part->id); ?>#part" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        <a href="#" data-href="/admin/content/part/delete/<?php echo e($part->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="guides">
                        <div class="accordion-off">
                            <ul id="accordion" class="accordion off-filters-li">
                                <li>
                                    <div class="submenu">
                                        <div class="table-responsive">
                                            <table class="table ucp-table">
                                                <thead class="thead-s">
                                                    <th class="text-center" width="50">Fecha Inicio</th>
                                                    <th class="text-center" width="50">Fecha Fin</th>
                                                    <th class="text-center" width="50">Ver</th>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td class="text-center" width="50"><?php echo e($guide->initial_date); ?></td>
                                                        <td class="text-center" width="50"><?php echo e($guide->final_date); ?></td>
                                                        <td class="text-center" width="50"><a href="<?php echo e($guide->route); ?>" target="_blank"><b>Ver</b></a></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="subscribe" class="tab-pane">
                        <form action="/admin/content/store/<?php echo e($item->id); ?>/subscribe" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">3 Months Subscribe Price</label>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" name="price_3" value="<?php echo e($item->price_3); ?>" class="form-control text-center">
                                                <span class="input-group-append click-for-upload cu-p">
                                                    <span class="input-group-text"><?php echo e(currencySign()); ?></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">PayPal Product Code</label>
                                        <div class="col-md-12">
                                            <input type="text" name="subscribe_3" value="<?php echo e($item->subscribe_3); ?>" class="form-control text-center">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">6 Months Subscribe Price</label>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" name="price_6" value="<?php echo e($item->price_6); ?>" class="form-control text-center">
                                                <span class="input-group-append click-for-upload cu-p">
                                                    <span class="input-group-text"><?php echo e(currencySign()); ?></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">PayPal Product Code</label>
                                        <div class="col-md-12">
                                            <input type="text" name="subscribe_6" value="<?php echo e($item->subscribe_6); ?>" class="form-control text-center">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">6 Months Subscribe Price</label>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" name="price_9" value="<?php echo e($item->price_9); ?>" class="form-control text-center">
                                                <span class="input-group-append click-for-upload cu-p">
                                                    <span class="input-group-text"><?php echo e(currencySign()); ?></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">PayPal Product Code</label>
                                        <div class="col-md-12">
                                            <input type="text" name="subscribe_9" value="<?php echo e($item->subscribe_9); ?>" class="form-control text-center">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">6 Months Subscribe Price</label>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <input type="text" name="price_12" value="<?php echo e($item->price_12); ?>" class="form-control text-center">
                                                <span class="input-group-append click-for-upload cu-p">
                                                    <span class="input-group-text"><?php echo e(currencySign()); ?></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="col-md-12 control-label">PayPal Product Code</label>
                                        <div class="col-md-12">
                                            <input type="text" name="subscribe_12" value="<?php echo e($item->subscribe_12); ?>" class="form-control text-center">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label"></label>
                                <div class="col-md-8">
                                    <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $('#free_course').change(function () {
            if ($(this).is(':checked')) {
                $('#product_price').attr('disabled', 'disabled');
            } else {
                $('#product_price').removeAttr('disabled');
            }
        });
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Courses','Edit',$item->title]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/content/edit.blade.php ENDPATH**/ ?>