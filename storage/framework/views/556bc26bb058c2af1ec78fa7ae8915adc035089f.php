<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.th_edit')); ?><?php echo e(trans('admin.parts')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>

    <div class="tabs">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a href="#main" class="nav-link active" data-toggle="tab"> <?php echo e(trans('admin.general')); ?> </a>
            </li>
            <li class="nav-item">
                <a href="#meta" class="nav-link" data-toggle="tab"><?php echo e(trans('admin.extra_info')); ?></a>
            </li>
            <li class="nav-item">
                <a href="#parts" class="nav-link" data-toggle="tab"><?php echo e(trans('admin.parts')); ?></a>
            </li>
            <li class="nav-item">
                <a href="#part" class="nav-link" data-toggle="tab"><?php echo e($part->title); ?></a>
            </li>
            <li class="nav-item">
                <a href="#convert" class="nav-link" data-toggle="tab"><?php echo e(trans('admin.convert_shot')); ?>  <?php echo e($part->title); ?></a>
            </li>
        </ul>
        <div class="card">
            <div class="card-body">
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

                            <div class="col-md-12">
                                <div class="custom-switches-stacked">
                                    <label class="custom-switch">
                                        <input type="hidden" value="0" name="support">
                                        <input type="checkbox" name="support" value="1" class="custom-switch-input" <?php if($item->support == 1): ?> checked="checked" }} <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.vendor_supports_item')); ?></label>
                                    </label>
                                    <label class="custom-switch">
                                        <input type="hidden" value="0" name="document">
                                        <input type="checkbox" name="document" value="1" class="custom-switch-input" <?php if($item->document == 1): ?> checked="checked" }} <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.item_doc')); ?></label>
                                    </label>
                                    <label class="custom-switch">
                                        <input type="hidden" value="0" name="post">
                                        <input type="checkbox" name="post" value="1" class="custom-switch-input" <?php if($item->post == 1): ?> checked="checked" }} <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.vendor_postal_sale')); ?></label>
                                    </label>
                                    <label class="custom-switch">
                                        <input type="hidden" value="draft" name="mode">
                                        <input type="checkbox" name="mode" value="publish" class="custom-switch-input" <?php if($item->mode == 1): ?> checked="checked" }} <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.publish_item')); ?></label>
                                    </label>
                                    <label class="custom-switch">
                                        <input type="hidden" name="download" value="0">
                                        <input type="checkbox" name="download" value="1" class="custom-switch-input" <?php if($item->download == 1): ?> checked="checked" }} <?php endif; ?> />
                                        <span class="custom-switch-indicator"></span>
                                        <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.download')); ?></label>
                                    </label>
                                </div>
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
                                    <div class="input-group">
                                <span class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="cover">
                                    <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                </span>
                                        <input type="text" name="cover" dir="ltr" value="<?php echo e($meta['cover'] ?? ''); ?>" class="form-control">
                                        <span class="input-group-append click-for-upload cu-p">
                                    <span class="input-group-text"><i class="fa fa-upload" aria-hidden="true"></i></span>
                                </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.course_thumbnail')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                <span class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="thumbnail">
                                    <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                </span>
                                        <input type="text" name="thumbnail" dir="ltr" value="<?php echo e($meta['thumbnail'] ?? ''); ?>" class="form-control">
                                        <span class="input-group-append click-for-upload cu-p">
                                    <span class="input-group-text"><i class="fa fa-upload" aria-hidden="true"></i></span>
                                </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.demo')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                <span class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#VideoModal" data-whatever="video">
                                    <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                </span>
                                        <input type="text" name="video" dir="ltr" value="<?php echo e($meta['video'] ?? ''); ?>" class="form-control">
                                        <span class="input-group-append click-for-upload cu-p">
                                    <span class="input-group-text"><i class="fa fa-upload" aria-hidden="true"></i></span>
                                </span>
                                    </div>
                                </div>
                            </div>

                        <!--
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.duration')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="number" min="0" name="duration" value="<?php echo e($meta['duration'] ?? ''); ?>" class="form-control text-center">
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
                                        <input type="text" name="price" value="<?php echo e($meta['price'] ?? ''); ?>" class="form-control text-center numtostr">
                                        <span class="input-group-append click-for-upload cu-p">
                                    <span class="input-group-text"><?php echo e(currencySign()); ?></span>
                                </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.postal_price')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="text" name="post_price" value="<?php echo e($meta['post_price'] ?? ''); ?>" class="form-control text-center numtostr">
                                        <span class="input-group-append click-for-upload cu-p">
                                    <span class="input-group-text"><?php echo e(currencySign()); ?></span>
                                </span>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if (isset($meta['precourse']) && $meta['precourse'] != '')
                                $preCourseArray = explode(',', rtrim($meta['precourse'], ','));
                            else
                                $preCourseArray = [];
                            ?>
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.prerequisites')); ?></label>
                                <div class="col-md-8">
                                    <select name="precourse[]" multiple="multiple" class="form-control selectric">
                                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($product->id); ?>" <?php if(in_array($product->id,$preCourseArray)): ?> selected="selected" <?php endif; ?>><?php echo e($product->title ?? ''); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
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
                    <div id="parts" class="tab-pane ">
                        <table class="table table-bordered table-striped mb-none" id="datatable-details">
                            <thead>
                            <tr>
                                <th><?php echo e(trans('admin.th_title')); ?></th>
                                <th class="text-center" width="150"><?php echo e(trans('admin.th_date')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('admin.convert_status')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('admin.volume')); ?>(MB)</th>
                                <th class="text-center" width="100"><?php echo e(trans('admin.duration')); ?>(<?php echo e(trans('admin.minute')); ?>)</th>
                                <th class="text-center" width="100"><?php echo e(trans('admin.th_status')); ?></th>
                                <th class="text-center" width="100"><?php echo e(trans('admin.th_controls')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $item->parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($parts->title); ?>&nbsp;<?php if($parts->free == 1 || $item->price == 0): ?>(<?php echo e(trans('admin.free')); ?>)<?php endif; ?></td>
                                    <td class="text-center" width="150"><?php echo e(date('d F Y : H:i',$parts->created_at)); ?></td>
                                    <td class="text-center" width="100">
                                        <?php
                                            $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                                            $file = $storagePath.'source/content-'.$parts->content->id.'/video/part-'.$parts->id.'.mp4';
                                        ?>
                                        <?php if(file_exists($file)): ?>
                                            <i class="fa fa-check c-g"></i>
                                        <?php else: ?>
                                            <i class="fa fa-times c-r"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center"><?php echo e($parts->size ?? '0'); ?></td>
                                    <td class="text-center"><?php echo e($parts->duration ?? '0'); ?></td>
                                    <td class="text-center" width="100">
                                        <?php if($parts->mode == 'publish'): ?>
                                            <b class="c-b"><?php echo e(trans('admin.published')); ?></b>
                                        <?php elseif($parts->mode == 'draft'): ?>
                                            <b class="c-o"><?php echo e(trans('admin.draft')); ?></b>
                                        <?php elseif($parts->mode == 'request'): ?>
                                            <span class="c-g"><?php echo e(trans('admin.review_request')); ?></span>
                                        <?php elseif($parts->mode == 'delete'): ?>
                                            <span class="c-r"><?php echo e(trans('admin.unpublish_request')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="/admin/content/edit/<?php echo e($item->id); ?>/part/<?php echo e($parts->id); ?>#part" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        <a href="#" data-href="/admin/content/part/delete/<?php echo e($parts->id); ?>" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="part" class="tab-pane ">
                        <form action="/admin/content/partstore/<?php echo e($part->id); ?>" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.th_title')); ?></label>
                                <div class="col-md-10">
                                    <input type="text" value="<?php echo e($part->title); ?>" name="title" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea class="summernote" name="description"><?php echo e($part->description); ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.volume')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="number" min="0" name="size" value="<?php echo e($part->size); ?>" class="form-control text-center">
                                        <span class="input-group-append click-for-upload cu-p">
                                    <span class="input-group-text">MB</span>
                                </span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.duration')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="number" min="0" name="duration" value="<?php echo e($part->duration); ?>" class="form-control text-center">
                                        <span class="input-group-append click-for-upload cu-p">
                                    <span class="input-group-text"><?php echo e(trans('admin.minute')); ?></span>
                                </span>
                                    </div>
                                </div>
                            </div>

                            <!--
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.course_cover')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                <span class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="upload_screen">
                                    <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                </span>
                                        <input type="text" name="upload_screen" dir="ltr" value="<?php echo e($part->upload_screen); ?>" class="form-control">
                                        <span class="input-group-append click-for-upload cu-p">
                                    <span class="input-group-text"><i class="fa fa-upload" aria-hidden="true"></i></span>
                                </span>
                                    </div>
                                </div>
                            </div>
                            -->
                            <!--
                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.course_thumbnail')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                <span class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="upload_image">
                                    <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                </span>
                                        <input type="text" name="upload_image" dir="ltr" value="<?php echo e($part->upload_image); ?>" class="form-control">
                                        <span class="input-group-append click-for-upload cu-p">
                                    <span class="input-group-text"><i class="fa fa-upload" aria-hidden="true"></i></span>
                                </span>
                                    </div>
                                </div>
                            </div>
                            -->

                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.video')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                <span class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#VideoModal" data-whatever="upload_video">
                                    <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                </span>
                                        <input type="text" name="upload_video" dir="ltr" value="<?php echo e($part->upload_video); ?>" class="form-control">
                                        <span class="input-group-append click-for-upload cu-p">
                                    <span class="input-group-text"><i class="fa fa-upload" aria-hidden="true"></i></span>
                                </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-2 control-label"><?php echo e(trans('admin.th_status')); ?></label>
                                <div class="col-md-8">
                                    <select name="mode" class="form-control">
                                        <option value="publish" <?php if($part->mode == 'publish'): ?> selected <?php endif; ?>><?php echo e(trans('admin.published')); ?></option>
                                        <option value="draft" <?php if($part->mode == 'draft'): ?> selected <?php endif; ?>><?php echo e(trans('admin.draft')); ?></option>
                                        <option value="request" <?php if($part->mode == 'request'): ?> selected <?php endif; ?>><?php echo e(trans('admin.review_request')); ?></option>
                                        <option value="delete" <?php if($part->mode == 'delete'): ?> selected <?php endif; ?>><?php echo e(trans('admin.unpublish_request')); ?></option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-md-2 control-label"><?php echo e(trans('admin.sort')); ?></label>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control text-center" maxlength="3">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="h-40"></div>
                                        <label class="custom-switch">
                                            <input type="hidden" name="free" value="0">
                                            <input type="checkbox" name="free" value="1" class="custom-switch-input" <?php if($part->free == 1): ?> checked="checked" }} <?php endif; ?> />
                                            <span class="custom-switch-indicator"></span>
                                            <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.free_course')); ?></label>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-9">
                                    <button class="btn btn-primary pull-left" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="convert" class="tab-pane">

                        <div class="alert alert-success">
                            <p><?php echo e(trans('admin.convert_alert_1')); ?></p>
                            <p><?php echo e(trans('admin.convert_alert_2')); ?></p>
                            <p><?php echo e(trans('admin.convert_alert_3')); ?></p>
                        </div>

                        <form method="post" action="/admin/video/screenshot" class="form-horizontal form-bordered">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="upload_video" dir="ltr" value="<?php echo e($part->upload_video); ?>">
                            <input type="hidden" name="id" dir="ltr" value="<?php echo e($part->id); ?>">
                            <input type="hidden" name="content_id" dir="ltr" value="<?php echo e($part->content_id); ?>">

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.second_screenshot')); ?></label>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="number" min="0" name="intval" value="" class="form-control text-center">
                                        <span class="input-group-append click-for-upload cu-p">
                                    <span class="input-group-text"><?php echo e(trans('admin.second')); ?></span>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.resolution')); ?></label>
                                <div class="col-md-8">
                                    <select name="resolution" class="form-control populate">
                                        <option value="320x240">320x240</option>
                                        <option value="640x480">640x480</option>
                                        <option value="720x480">720x480</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <a href="/admin/video/preconvert/<?php echo e($part->id); ?>" onclick="runProgressbar();" class="btn btn-danger pull-left"><?php echo e(trans('admin.primary_convert')); ?></a>
                                    <a href="/admin/video/convert/<?php echo e($part->id); ?>" onclick="runProgressbar();" class="btn btn-primary pull-left m-l-5"><?php echo e(trans('admin.final_convert')); ?></a>
                                    <a href="/admin/video/copy/<?php echo e($part->id); ?>" class="btn btn-primary pull-left m-l-5">Copy Without Covert</a>
                                    <?php if($convert): ?>
                                        <a data-toggle="modal" data-target="#stream-modal" class="btn btn-success pull-right"><i class="fa fa-check"></i>&nbsp;<?php echo e(trans('admin.converted')); ?>&nbsp;</a>
                                        <div class="modal fade" id="stream-modal">
                                            <div class="modal-dialog z-i-99999">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" onclick="$('video').trigger('pause');"
                                                                aria-hidden="true">&times;
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <video class="w-100 h-a" controls>
                                                            <source src="/admin/video/stream/<?php echo e($part->id); ?>" type="video/mp4">
                                                            Your browser does not support HTML5 video.
                                                        </video>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" onclick="$('video').trigger('pause');" class="btn btn-default" data-dismiss="modal">
                                                            <?php echo e(trans('admin.close')); ?>

                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>

                    </div>


                    <div id="progressbar" class="row progressprogress-striped progress-sm m-md hidden">
                        <div class="progress-bar w-0" role="progre ssbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <span class="sr-only">0%</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Part','Edit',$item->title]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/content/partedit.blade.php ENDPATH**/ ?>