
<?php $__env->startSection('page'); ?>

<div class="cards">
    <div class="card-body">
        <div class="tabs">
            <ul class="nav nav-pills partes-nuevo-curso">
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link active" cstep="1" data-toggle="tab"> <?php echo e(trans('main.general')); ?> </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" cstep="2" data-toggle="tab"><?php echo e(trans('main.category')); ?></a>
                </li>
                <!--<li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" cstep="3" data-toggle="tab"><?php echo e(trans('main.extra_info')); ?></a>
                </li>-->
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" cstep="4" data-toggle="tab"><?php echo e(trans('main.view')); ?></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" cstep="5" data-toggle="tab"><?php echo e(trans('main.parts')); ?></a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" cstep="6" data-toggle="tab"><?php echo e(trans('main.parts')); ?> - Zoom</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" cstep="7" data-toggle="tab">Guías</a>
                </li>
            </ul>
        </div>
        <br>
        <div class="tab-content">
        <input type="hidden" value="1" id="current_step">
            <input type="hidden" value="<?php echo e($item->id); ?>" id="edit_id">

            <div class="steps" id="step1">

                <form method="post" action="/user/content/new/store" class="form-horizontal" id="step-1-form">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault"><?php echo e(trans('main.course_type')); ?></label>
                        <div class="col-md-10 tab-con">
                            <select name="type" class="form-control font-s">
                                <option value="single" <?php if(isset($item) && $item->type == 'single'): ?> selected
                                    <?php endif; ?>><?php echo e(trans('main.single')); ?></option>
                                <option value="course" <?php if(isset($item) && $item->type == 'course'): ?> selected
                                    <?php endif; ?>><?php echo e(trans('main.course')); ?></option>
                                <option value="webinar" <?php if(isset($item) && $item->type == 'webinar'): ?> selected
                                    <?php endif; ?>><?php echo e(trans('main.webinar')); ?></option>
                                <option value="course+webinar" <?php if(isset($item) && $item->type == 'course+webinar'): ?>
                                    selected <?php endif; ?>><?php echo e(trans('main.course+webinar')); ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault"><?php echo e(trans('main.publish_type')); ?></label>
                        <div class="col-md-10 tab-con">
                            <select name="private" class="form-control font-s">
                                <option value="2" <?php echo e($item->private == 2 ? 'selected' : ''); ?>>Fundal</option>
                                <option value="0" <?php echo e($item->private == 0 ? 'selected' : ''); ?>><?php echo e(trans('main.open')); ?></option>
                                <option value="3" <?php echo e($item->private == 3 ? 'selected' : ''); ?>>Videoteca</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault"><?php echo e(trans('main.course_title')); ?></label>
                        <div class="col-md-10 tab-con">
                            <input type="text" name="title" placeholder="30-60 Characters" class="form-control"
                                value="<?php echo e($item->title); ?>" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault"><?php echo e(trans('main.description')); ?></label>
                        <div class="col-md-10 tab-con">
                            <textarea class="form-control" rows="12" placeholder="Description..."
                                name="content" required><?php echo $item->content; ?></textarea>
                        </div>
                    </div>
                </form>
                <form method="post" class="form-horizontal" id="step-1-form-meta">
                    <?php echo e(csrf_field()); ?>

                </form>
            </div>

            <div class="steps dnone" id="step2">
                <form method="post" id="step-2-form" class="form-horizontal">
                    <?php echo e(csrf_field()); ?>

                    <!--<div class="alert alert-success">
                        <p><?php echo e(trans('main.tags_header')); ?></p>
                    </div>-->
                    <div class="form-group">
                        <label class="col-md-2 control-label tab-con"
                            for="inputDefault"><?php echo e(trans('main.tags')); ?></label>
                        <div class="col-md-10 tab-con">
                            <input type="text" data-role="tagsinput" placeholder="Press enter to save tag." name="tag"
                                value="<?php echo e($item->tag); ?>" class="form-control text-center">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label tab-con"
                            for="inputDefault"><?php echo e(trans('main.category')); ?></label>
                        <div class="col-md-10 tab-con">
                            <select name="category_id" id="category_id" class="form-control font-s" required>
                                <option value="0"><?php echo e(trans('main.select_category')); ?></option>
                                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($menu->parent_id == 0): ?>
                                <optgroup label="<?php echo e($menu->title); ?>">
                                    <?php if(count($menu->childs) > 0): ?>
                                    <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($sub->id); ?>" <?php if($sub->id == $item->category_id): ?> selected
                                        <?php endif; ?>><?php echo e($sub->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <option value="<?php echo e($menu->id); ?>" <?php if($menu->id == $item->category_id): ?> selected
                                        <?php endif; ?>><?php echo e($menu->title); ?></option>
                                    <?php endif; ?>
                                </optgroup>
                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="h-15"></div>
                    <!--<div class="alert alert-success">
                        <p><?php echo e(trans('main.filters_header')); ?></p>
                    </div>-->
                    <div class="h-15"></div>
                    <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!--<div class="col-md-11 col-md-offset-1 tab-con filters <?php if($menu->id != $item->category_id): ?> dnone <?php endif; ?>"
                        id="filter<?php echo e($menu->id ?? 0); ?>">
                        <?php $__currentLoopData = $menu->filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $filter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 col-xs-12 tab-con">
                            <h5><?php echo e($filter->filter); ?></h5>
                            <hr>
                            <ul class="cat-filters-li pamaz">
                                <ul class="submenu submenu-s">
                                    <?php $__currentLoopData = $filter->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="second-input"><input type="checkbox" class="filter-tags dblock"
                                            id="tag<?php echo e($tag->id); ?>" name="filters[]" value="<?php echo e($tag->id); ?>"
                                            <?php if(isset($item->filters) &&
                                        in_array($tag->id,$item->filters->pluck('id')->toArray())): ?> checked
                                        <?php endif; ?>><label for="tag<?php echo e($tag->id); ?>"><span></span><?php echo e($tag->tag); ?></label>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </ul>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>-->
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </form>
            </div>

            <div class="steps dnone" id="step3">
                <form method="post" id="step-3-form" class="form-horizontal">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="control-label col-md-5 tab-con col-md-offset-1 dinb"
                            for="inputDefault"><?php echo e(trans('main.free_course')); ?></label>
                        <div class="col-md-6 tab-con">
                            <div class="switch switch-sm switch-primary pull-left">
                                <input type="hidden" value="1" name="price">
                                <input type="checkbox" name="price" id="free" value="0" data-plugin-ios-switch
                                    <?php if($item->price != null && $item->price == 0): ?> checked="checked" <?php endif; ?> />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label
                            class="control-label col-md-5 tab-con col-md-offset-1 dinb"><?php echo e(trans('main.vendor_postal_sale')); ?></label>
                        <div class="col-md-6 tab-con">
                            <div class="switch switch-sm switch-primary pull-left" id="post_toggle">
                                <input type="hidden" value="0" name="post">
                                <input type="checkbox" name="post" value="1" data-plugin-ios-switch <?php if($item->post
                                == 1): ?> checked="checked" <?php endif; ?> />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label tab-con col-md-5 col-md-offset-1 dinb"
                            for="inputDefault"><?php echo e(trans('main.support')); ?></label>
                        <div class="col-md-6 tab-con">
                            <div class="switch switch-sm switch-primary pull-left">
                                <input type="hidden" value="0" name="support">
                                <input type="checkbox" name="support" value="1" data-plugin-ios-switch
                                    <?php if($item->support == 1): ?> checked="checked" <?php endif; ?> />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label tab-con col-md-5 col-md-offset-1 dinb"
                            for="inputDefault"><?php echo e(trans('main.download')); ?></label>
                        <div class="col-md-6 tab-con">
                            <div class="switch switch-sm switch-primary pull-left">
                                <input type="hidden" value="0" name="download">
                                <input type="checkbox" name="download" value="1" data-plugin-ios-switch
                                    <?php if($item->download == 1): ?> checked="checked" <?php endif; ?> />
                            </div>
                        </div>
                    </div>
                </form>
                <form method="post" id="step-3-form-meta" class="form-horizontal">
                    <?php echo e(csrf_field()); ?>

                    <div class="h-10"></div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con"><?php echo e(trans('main.price')); ?></label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price" onkeypress="validate(event)"
                                    value="<?php echo e($meta['price'] ?? ''); ?>" class="form-control text-center numtostr"
                                    <?php if($item->price === 0): ?> disabled <?php endif; ?>>
                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <?php echo e(currencySign()); ?>

                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con"><?php echo e(trans('main.postal_price')); ?></label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="post_price" onkeypress="validate(event)"
                                    value="<?php echo e($meta['post_price'] ?? ''); ?>" class="form-control text-center numtostr"
                                    <?php if($item->post != 1): ?> disabled <?php endif; ?>>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <?php echo e(currencySign()); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form method="post" id="step-3-form-subscribe" class="form-horizontal">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">3 Months Subscribe Price</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price_3" onkeypress="validate(event)"
                                    value="<?php echo e($item->price_3); ?>" class="form-control text-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <?php echo e(currencySign()); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">6 Months Subscribe Price</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price_6" onkeypress="validate(event)"
                                    value="<?php echo e($item->price_6); ?>" class="form-control text-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <?php echo e(currencySign()); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">9 Months Subscribe Price</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price_9" onkeypress="validate(event)"
                                    value="<?php echo e($item->price_9); ?>" class="form-control text-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <?php echo e(currencySign()); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">12 Months Subscribe Price</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price_12" onkeypress="validate(event)"
                                    value="<?php echo e($item->price_12); ?>" class="form-control text-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <?php echo e(currencySign()); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--<div class="h-15"></div>
                <div class="alert alert-success">
                    <p><?php echo e(trans('main.prerequisites_desc')); ?></p>
                </div>
                <a class="btn btn-custom pull-left" data-toggle="modal"
                    href="#modal-pre-course"><span><?php echo e(trans('main.select_prerequisites')); ?></span></a>-->
                <div class="modal fade" id="modal-pre-course">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title"><?php echo e(trans('main.select_prerequisites')); ?></h4>
                            </div>
                            <div class="modal-body no-absolute-content">
                                <form method="post" id="step-3-form-precourse">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="precourse" id="precourse"
                                        value="<?php echo e($meta['precourse'] ?? ''); ?>">
                                </form>
                                <ul class="pre-course-title-container">
                                    <?php if(isset($preCourse)): ?>
                                    <?php $__currentLoopData = $preCourse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($prec->title); ?>&nbsp;(VT-<?php echo e($prec->id); ?>)<i class="fa fa-times delete-course"
                                            cid="<?php echo e($prec->id); ?>"></i></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </ul>
                                <input type="text" class="form-control provider-json-pre-course"
                                    placeholder="Type 3 characters to load courses list.">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-custom pull-left"
                                    data-dismiss="modal"><?php echo e(trans('main.close')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="steps dnone" id="step4">
                <form method="post" class="form-horizontal" id="step-4-form-meta">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"><?php echo e(trans('main.course_cover')); ?></label>
                        <div class="col-md-10 tab-con">
                            <div class="input-group" style="display: flex">
                                <button type="button" id="lfm_cover" data-input="cover" data-preview="holder"
                                    class="btn btn-primary">
                                    Choose
                                </button>
                                <input id="cover" class="form-control" dir="ltr" type="text" name="cover"
                                    value="<?php echo e(!empty($meta['cover']) ? $meta['cover'] : ''); ?>">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal"
                                    data-target="#ImageModal" data-whatever="cover">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"><?php echo e(trans('main.course_thumbnail')); ?></label>
                        <div class="col-md-10 tab-con">
                            <div class="input-group" style="display: flex">
                                <button type="button" id="lfm_thumbnail" data-input="thumbnail" data-preview="holder"
                                    class="btn btn-primary">
                                    Choose
                                </button>
                                <input id="thumbnail" class="form-control" dir="ltr" type="text" name="thumbnail"
                                    value="<?php echo e(!empty($meta['thumbnail']) ? $meta['thumbnail'] : ''); ?>">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal"
                                    data-target="#ImageModal" data-whatever="thumbnail">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label class="control-label col-md-2 tab-con"><?php echo e(trans('main.demo')); ?></label>
                        <div class="col-md-10 tab-con">
                            <div class="input-group" style="display: flex">
                                <button type="button" id="lfm_video" data-input="video" data-preview="holder"
                                    class="btn btn-primary">
                                    Choose
                                </button>
                                <input id="video" class="form-control" dir="ltr" type="text" name="video"
                                    value="<?php echo e(!empty($meta['video']) ? $meta['video'] : ''); ?>">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal"
                                    data-target="#ImageModal" data-whatever="video">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"><?php echo e(trans('main.documents')); ?></label>
                        <div class="col-md-10 tab-con">
                            <div class="input-group" style="display: flex">
                                <button type="button" id="lfm_document" data-input="document" data-preview="holder"
                                    class="btn btn-primary">
                                    Choose
                                </button>
                                <input id="document" class="form-control" dir="ltr" type="text" name="document"
                                    value="<?php echo e(!empty($meta['document']) ? $meta['document'] : ''); ?>">
                                <div class="input-group-prepend view-selected cu-p"
                                    onclick="window.open($('#document-addon').val(),'_balnk');">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </form>

            </div>
            <div class="steps dnone" id="step5">
                <div class="accordion-off">
                    <ul id="accordion" class="accordion off-filters-li">
                        <li class="open edit-part-section dnone">
                            <div class="link edit-part-click">
                                <h2><?php echo e(trans('main.edit_part')); ?></h2><i class="mdi mdi-chevron-down"></i>
                            </div>
                            <div class="submenu dblock">
                                <div class="h-15"></div>
                                <input type="hidden" id="part-edit-id">
                                <form action="/user/content/part/edit/store/" id="step-5-form-edit-part" method="post"
                                    class="form-horizontal">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="content_id" value="<?php echo e($item->id); ?>">

                                    <div class="form-group">

                                        <label
                                            class="control-label tab-con col-md-2"><?php echo e(trans('main.video_file')); ?></label>
                                        <div class="col-md-7 tab-con">
                                            <div class="input-group asdf">
                                                <span class="input-group-addon view-selected img-icon-s"
                                                    data-toggle="modal" data-target="#VideoModal"
                                                    data-whatever="upload_video"><span
                                                        class="formicon mdi mdi-eye"></span></span>
                                                <input type="text" name="upload_video" dir="ltr" class="form-control" required>
                                                <button type="button" id="lfm_upload_video" data-input="upload_video"
                                                    data-preview="holder" class="btn btn-primary">
                                                    Choose
                                                </button>
                                            </div>
                                        </div>


                                        <!--<label class="control-label col-md-1 tab-con"><?php echo e(trans('main.sort')); ?></label>
                                        <div class="col-md-2 tab-con">
                                            <input name="sort" type="number" class="spinner-input form-control"
                                                maxlength="3" min="0" max="100" required>
                                        </div>-->
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-2 tab-con"
                                            for="inputDefault"><?php echo e(trans('main.description')); ?></label>
                                        <div class="col-md-10 tab-con te-10">
                                            <textarea class="form-control editor-te oflows" rows="12"
                                                placeholder="Description..." name="description" required></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <!--<label class="control-label col-md-2 tab-con"><?php echo e(trans('main.volume')); ?></label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="number" min="0" name="size"
                                                    class="form-control text-center">
                                                <span class="input-group-addon img-icon-s"><?php echo e(trans('main.mb')); ?></span>
                                            </div>
                                        </div>-->
                                        <label
                                            class="control-label col-md-1 tab-con"><?php echo e(trans('main.duration')); ?></label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="number" min="0" name="duration"
                                                    class="form-control text-center">
                                                <span
                                                    class="input-group-addon img-icon-s"><?php echo e(trans('main.minute')); ?></span>
                                            </div>
                                        </div>
                                        <label class="control-label col-md-1 tab-con"><?php echo e(trans('main.free')); ?></label>
                                        <div class="col-md-2 tab-con">
                                            <div
                                                class="switch switch-sm switch-primary pull-left free-edit-check-state">
                                                <input type="hidden" value="0" name="free">
                                                <input type="checkbox" name="free" value="1" data-plugin-ios-switch />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">

                                        <label class="control-label tab-con col-md-2"
                                            for="inputDefault"><?php echo e(trans('main.title')); ?></label>
                                        <div class="col-md-8 tab-con">
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-3">Fecha de inicio</label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="date" name="initial_date"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <label
                                            class="control-label tab-con col-md-3">Fecha de finalizaci&oacute;n</label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="date" name="limit_date"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-2 tab-con">
                                            <button class="btn btn-custom pull-left" id="edit-part-submit"
                                                type="submit"><?php echo e(trans('main.edit_part')); ?></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="h-15"></div>
                            </div>
                        </li>
                        <li class="open">
                            <div class="link new-part-click">
                                <h2><?php echo e(trans('main.new_part')); ?></h2><i class="mdi mdi-chevron-down"></i>
                            </div>
                            <div class="submenu dblock">
                                <div class="h-15"></div>
                                <form action="/user/content/part/store" enctype="multipart/form-data" id="step-5-form-new-part" method="post"
                                    class="form-horizontal">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="content_id" value="<?php echo e($item->id); ?>">

                                    <div class="form-group">
                                        <label class="control-label col-md-2 tab-con"><?php echo e(trans('main.video_file')); ?></label>
                                        <div class="col-md-7 tab-con">
                                            <style>
                                                .asdf span {
                                                    width: 44px;
                                                    height: 44px;
                                                }

                                                .asdf input {
                                                    height: 44px;
                                                }

                                            </style>
                                            <div class="input-group asdf">

                                            <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#VideoModal" data-whatever="upload_video2">
                                                <span class="input-group-text">
                                                    <a id="video_preview" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                </span>
                                            </div>
                                                <input type="text" id="upload_video2" name="upload_video" dir="ltr"
                                                    class="form-control" onchange='$("#video_preview").attr("href", $(this).val())' required>
                                                <button type="button" id="lfm_upload_video" data-input="upload_video2"
                                                    data-preview="holder" class="btn btn-primary">
                                                    <span class="formicon mdi mdi-arrow-up-thick"></span>
                                                </button>
                                            </div>
                                        </div>
                                        <!--<label class="control-label tab-con col-md-1"><?php echo e(trans('main.sort')); ?></label>
                                        <div class="col-md-2 tab-con">
                                            <input type="number" name="sort" class="spinner-input form-control"
                                                maxlength="3" min="0" max="100" required>
                                        </div>-->
                                    </div>

                                    

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-2"
                                            for="inputDefault"><?php echo e(trans('main.description')); ?></label>
                                        <div class="col-md-10 tab-con">
                                            <textarea class="form-control" rows="4" name="description"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <!--<label class="control-label tab-con col-md-2"><?php echo e(trans('main.volume')); ?></label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="number" min="0" name="size"
                                                    class="form-control text-center" required>
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <?php echo e(trans('main.mb')); ?>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>-->
                                        <label
                                            class="control-label tab-con col-md-1"><?php echo e(trans('main.duration')); ?></label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="number" min="0" name="duration"
                                                    class="form-control text-center" required>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <?php echo e(trans('main.minute')); ?>

                                                        </span>
                                                    </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="free" value="0">            
                                        <!-- <label class="control-label tab-con col-md-1"><?php echo e(trans('main.free')); ?></label>      
                                        <br>      
                                        <label class="custom-switch col-md-2 tab-con">
                                            <input type="hidden" name="free" value="1">
                                            <input type="checkbox" name="free" value="1" class="custom-switch-input"/>
                                            <span class="custom-switch-indicator"></span>
                                        </label>-->
                                    </div>           
                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-2"
                                            for="inputDefault"><?php echo e(trans('main.title')); ?></label>
                                        <div class="col-md-8 tab-con">
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-3">Fecha de inicio</label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="date" name="initial_date"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <label
                                            class="control-label tab-con col-md-3">Fecha de finalizaci&oacute;n</label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="date" name="limit_date"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-2"
                                            for="inputDefault">Materiales del módulo</label>
                                        <div class="col-md-8 tab-con">
                                            <input type="file" name="material" id="material-modulo" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 tab-con">
                                            <button class="btn btn-primary tab-con pull-right" id="new-part"
                                                type="submit"><?php echo e(trans('main.save_changes')); ?></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="h-15"></div>
                            </div>
                        </li>
                        <li>
                            <div class="link list-part-click">
                                <h2><?php echo e(trans('main.parts')); ?></h2><i class="mdi mdi-chevron-down"></i>
                            </div>
                            <div class="submenu">
                                <div class="table-responsive">
                                    <table class="table ucp-table">
                                        <thead class="thead-s">
                                            <th class="cell-ta"><?php echo e(trans('main.title')); ?></th>
                                            <th class="text-center" width="50"><?php echo e(trans('main.volume')); ?></th>
                                            <th class="text-center" width="100"><?php echo e(trans('main.duration')); ?></th>
                                            <th class="text-center" width="150"><?php echo e(trans('main.upload_date')); ?></th>
                                            <th class="text-center" width="50"><?php echo e(trans('main.status')); ?></th>
                                            <th class="text-center" width="100"><?php echo e(trans('main.controls')); ?></th>
                                        </thead>
                                        <tbody id="part-video-table-body"></tbody>
                                    </table>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="steps dnone" id="step6">
                <div class="accordion-off">
                    <ul id="accordion" class="accordion off-filters-li">
                        <li class="open edit-part-section dnone">
                            <div class="link edit-part-click">
                                <h2><?php echo e(trans('main.edit_part')); ?></h2><i class="mdi mdi-chevron-down"></i>
                            </div>
                            <div class="submenu dblock">
                                <div class="h-15"></div>
                                <input type="hidden" id="part-edit-id">
                                <form action="/user/content_web_coach/part/edit/store/" id="step-5-form-edit-part"
                                    method="post" class="form-horizontal">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="content_id" value="<?php echo e($item->id ?? ''); ?>">

                                    <div class="form-group">
                                        <label
                                            class="control-label col-md-2 tab-con"><?php echo e(trans('main.date_webinar_coach')); ?></label>
                                        <div class="col-md-3 tab-con">
                                            <input type="date" class="form-control"
                                                id="datetimepicker_date_edit" name="date" />
                                        </div>
                                        <label
                                            class="control-label tab-con col-md-1"><?php echo e(trans('main.time_webinar_coach')); ?></label>
                                        <div class="col-md-2 tab-con">
                                            <input type="time" class="form-control"
                                                id="datetimepicker_time_edit" name="time" />
                                        </div>

                                        <label
                                            class="control-label tab-con col-md-1"><?php echo e(trans('main.duration')); ?></label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="number" min="0" name="duration"
                                                    class="form-control text-center" required>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <?php echo e(trans('main.minute')); ?>

                                                        </span>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label
                                            class="control-label tab-con col-md-2"><?php echo e(trans('main.webinar_coach_mail')); ?></label>
                                        <div class="col-md-3 tab-con">
                                            <input class="form-control" type="text" name="mail">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-2"
                                            for="inputDefault"><?php echo e(trans('main.description')); ?></label>
                                        <div class="col-md-10 tab-con">
                                            <textarea class="form-control" rows="4" name="description"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-2"
                                            for="inputDefault"><?php echo e(trans('main.title')); ?></label>
                                        <div class="col-md-8 tab-con">
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                        <div class="col-md-2 tab-con">
                                            <button class="btn btn-custom tab-con pull-left" id="edit-part-submit"
                                                type="submit"><?php echo e(trans('main.save_changes')); ?></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="h-15"></div>
                            </div>
                        </li>
                        <li class="open">
                            <div class="link new-part-click">
                                <h2><?php echo e(trans('main.new_part')); ?></h2><i class="mdi mdi-chevron-down"></i>
                            </div>
                            <div class="submenu dblock">
                                <div class="h-15"></div>
                                <form action="/user/content/web_coach/part/store" id="step-5-form-new-part"
                                    method="post" class="form-horizontal">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="content_id" value="<?php echo e($item->id ?? ''); ?>">

                                    <div class="form-group">
                                        <label
                                            class="control-label col-md-2 tab-con"><?php echo e(trans('main.date_webinar_coach')); ?></label>
                                        <div class="col-md-3 tab-con">
                                            <input type="date" class="form-control"
                                                id="datetimepicker_date_create" name="date" />
                                        </div>
                                        <label
                                            class="control-label tab-con col-md-1"><?php echo e(trans('main.time_webinar_coach')); ?></label>
                                        <div class="col-md-2 tab-con">
                                            <input type="time" class="form-control"
                                                id="datetimepicker_time_create" name="time" />
                                        </div>
                                        <label
                                            class="control-label tab-con col-md-1"><?php echo e(trans('main.duration')); ?></label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="number" min="0" name="duration"
                                                    class="form-control text-center" required>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <?php echo e(trans('main.minute')); ?>

                                                        </span>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label
                                            class="control-label tab-con col-md-2"><?php echo e(trans('main.webinar_coach_mail')); ?></label>
                                        <div class="col-md-3 tab-con">
                                            <input class="form-control" type="text" name="mail">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-2"
                                            for="inputDefault"><?php echo e(trans('main.description')); ?></label>
                                        <div class="col-md-10 tab-con">
                                            <textarea class="form-control" rows="4" name="description"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-2"
                                            for="inputDefault"><?php echo e(trans('main.title')); ?></label>
                                        <div class="col-md-10 tab-con">
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 tab-con">
                                            <button class="btn btn-custom tab-con pull-right" id="new-part"
                                                type="submit"><?php echo e(trans('main.save_changes')); ?></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="h-15"></div>
                            </div>
                        </li>
                        <li>
                            <div class="link list-part-click-zoom">
                                <h2><?php echo e(trans('main.parts')); ?></h2><i class="mdi mdi-chevron-down"></i>
                            </div>
                            <div class="submenu">
                                <div class="table-responsive">
                                    <table class="table ucp-table">
                                        <thead class="thead-s">
                                            <th class="text-center" width="50"></th>
                                            <th class="cell-ta"><?php echo e(trans('main.title')); ?></th>
                                            <th class="text-center" width="50"><?php echo e(trans('main.volume')); ?></th>
                                            <th class="text-center" width="100"><?php echo e(trans('main.duration')); ?></th>
                                            <th class="text-center" width="150"><?php echo e(trans('main.upload_date')); ?>

                                            </th>
                                            <th class="text-center" width="50"><?php echo e(trans('main.status')); ?></th>
                                            <th class="text-center" width="100"><?php echo e(trans('main.controls')); ?></th>
                                        </thead>
                                        <tbody id="part-video-table-body-zoom"></tbody>
                                    </table>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="steps dnone" id="step7">
                <div class="accordion-off">
                    <ul id="accordion" class="accordion off-filters-li">
                        <li class="open">
                            <div class="link new-part-click">
                                <h2>Guías </h2><i class="mdi mdi-chevron-down"></i>
                            </div>
                            <div class="submenu dblock">
                                <div class="h-15"></div>
                                <form action="/user/content/guide/store" enctype="multipart/form-data" id="step-7-form-new-part"
                                    method="post" class="form-horizontal">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="content_id" value="<?php echo e($item->id ?? ''); ?>">

                                    <div class="form-group">
                                        <label class="control-label col-md-2 tab-con"
                                            for="inputDefault">Guía de trabajo</label>
                                        <input type="file" name="guia_trabajo" id="guia_trabajo" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-3">Fecha de inicio</label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="date" name="fecha_inicio"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <label
                                            class="control-label tab-con col-md-3">Fecha de finalizaci&oacute;n</label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="date" name="fecha_fin"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 tab-con">
                                            <button class="btn btn-custom tab-con pull-left" id="new-guide"
                                                type="submit"><?php echo e(trans('main.save_changes')); ?></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="h-15"></div>
                            </div>
                        </li>
                        <li>
                            <div class="link list-part-click-zoom">
                                <h2>Guías</h2><i class="mdi mdi-chevron-down"></i>
                            </div>
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
        </div>
        <hr>
        <div class="row">
                <div class="col-md-12 btn-toolbar">
                    <?php if($item->mode != 'publish'): ?>
                    <a href="#publish-modal" data-toggle="modal"
                        class="btn btn-primary pull-left tab-con marl-s-10"><?php echo e(trans('main.publish')); ?></a>
                    <?php else: ?>
                    <a href="#re-publish-modal" data-toggle="modal"
                        class="btn btn-primary pull-left tab-con marl-s-10"><?php echo e(trans('main.save_changes')); ?></a>
                    <?php endif; ?>
                    <?php if($item->mode != 'publish'): ?>
                    <input type="submit" class="btn btn-primary pull-left tab-con marl-s-10" id="draft-btn" value="Save">
                    <?php endif; ?>
                </div>
            </div>
    </div>
</div>

<div class="h-30" id="scrollId"></div>
<div class="container-fluid">
    <input type="hidden" value="1" id="current_step">
    <input type="hidden" value="<?php echo e($item->id); ?>" id="edit_id">
    <div class="container n-padding-xs current-s">
        <div class="h-30"></div>
        <div class="multi-steps">
            <div class="col-md-9 col-xs-12 col-sm-8 tab-con left-side">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="vimeo-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Vimeo</h4>
            </div>
            <div class="modal-body" dir="ltr">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon click-to-upload-vimeo" style="cursor: pointer;"><label
                                class="mdi mdi-download img-icon-s" style="position: relative;top: 6px;"></label></span>
                        <input type="text" id="vimeo_url" class="form-control text-left" placeholder="Vimeo Url"
                            name="vimeo_url">
                    </div>
                </div>
                <style>
                    .blink {
                        animation: blinker 0.6s linear infinite;
                        color: #1c87c9;
                        font-size: 15px;
                        font-weight: bold;
                        font-family: sans-serif;
                    }

                    @keyframes  blinker {
                        50% {
                            opacity: 0;
                        }
                    }

                    .blink-one {
                        animation: blinker-one 1s linear infinite;
                    }

                    @keyframes  blinker-one {
                        0% {
                            opacity: 0;
                        }
                    }

                    .blink-two {
                        animation: blinker-two 1.4s linear infinite;
                    }

                    @keyframes  blinker-two {
                        100% {
                            opacity: 0;
                        }
                    }

                </style>
                <span class="blink vimeo-waiting" style="display: none;">waiting...</span>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="publish-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(trans('main.publish')); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p><?php echo e(trans('main.publish_alert')); ?> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(trans('main.cancel')); ?></button>
                <button type="button" class="btn btn-success btn-publish-final"><?php echo e(trans('main.publish')); ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="re-publish-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo e(trans('main.edit_course')); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p><?php echo e(trans('main.edit_course_alert')); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo e(trans('main.cancel')); ?></button>
                <button type="button" class="btn btn-success btn-publish-final"><?php echo e(trans('main.yes_sure')); ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-part-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo e(trans('main.delete_course')); ?></h4>
            </div>
            <div class="modal-body">
                <p><?php echo e(trans('main.delete_alert')); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-dismiss="modal"><?php echo e(trans('main.cancel')); ?></button>
                <input type="hidden" id="delete-part-id">
                <button type="button" class="btn btn-custom pull-left"
                    id="delete-request"><?php echo e(trans('main.yes_sure')); ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm_document,#lfm_video,#lfm_thumbnail,#lfm_cover,#lfm_upload_video').filemanager('file', {prefix: '/user/laravel-filemanager'});
    </script>
<script>
    $('.partes-nuevo-curso li a').click(function () {
        $('.partes-nuevo-curso li a').removeClass('active');
        $(this).addClass('active');
        var current_step = $('#current_step').val();
        $('#step' + current_step).slideUp(500);
        var step = $(this).attr('cstep');
        //$('.steps').not(this).each(function () {
        //    $(this).slideUp(500);
        //});
        $('#step' + step).slideDown(1000);
        $('#current_step').val(step);

    })

</script>
<script>
    $('document').ready(function () {
        $('input[name="post"]').change(function () {
            if ($(this).prop('checked')) {
                $('input[name="post_price"]').removeAttr('disabled');
            } else {
                $('input[name="post_price"]').attr('disabled', 'disabled');
            }
        });
        $('#free').change(function () {
            if ($(this).prop('checked')) {
                $('input[name="price"]').attr('readonly', 'readonly').val('0');
                $('input[name="post_price"]').attr('readonly', 'readonly');
            } else {
                $('input[name="price"]').removeAttr('readonly').val('');
            }
        });
    })

</script>
<script>
    /*$('#category_id').change(function () {
        var id = $(this).val();
        $('.filter-tags').removeAttr('checked');
        $('.filters').not('#filter' + id).each(function () {
            $('.filters').slideUp();
        });
        $('#filter' + id).slideDown(500);
    })/*

</script>
<script>
    $('#next-btn').click(function () {
        var step = $('#current_step').val();
        step = parseInt(step) + 1;
        $("li[cstep=" + step + "]").click();
    });
    $('#prev-btn').click(function () {
        var step = $('#current_step').val();
        step = parseInt(step) - 1;
        $("li[cstep=" + step + "]").click();
    });
    $('#draft-btn').click(function () {
        var id = $('#edit_id').val();
        $.post('/user/content/edit/store/' + id, $('#step-1-form').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-1-form-meta').serialize());
        $.post('/user/content/edit/store/' + id, $('#step-2-form').serializeArray());
        $.post('/user/content/edit/store/' + id, $('#step-3-form').serialize());
        $.post('/user/content/edit/store/' + id, $('#step-3-form-subscribe').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-3-form-meta').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-3-form-precourse').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-4-form-meta').serialize());

        console.log($('#step-1-form').serialize());
        /* Notify */
        $.notify({
            message: 'Your changes saved successfully'
        }, {
            type: 'success',
            allow_dismiss: false,
            z_index: '99999999',
            placement: {
                from: "top",
                align: "right"
            },
            position: 'fixed'
        });
    });
    $('.btn-publish-final').click(function () {
        var id = $('#edit_id').val();
        $.post('/user/content/edit/meta/store/' + id, $('#step-1-form-meta').serialize());
        $.post('/user/content/edit/store/' + id, $('#step-2-form').serializeArray());
        $.post('/user/content/edit/store/' + id, $('#step-3-form').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-3-form-meta').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-3-form-precourse').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-4-form-meta').serialize());
        $.get('/user/content/edit/store/request/' + id, $('#step-1-form').serialize());

        /* Notify */
        $.notify({
            message: 'Your course sent to content review department.'
        }, {
            type: 'success',
            allow_dismiss: false,
            z_index: '99999999',
            placement: {
                from: "bottom",
                align: "right"
            },
            position: 'fixed'
        });
        $('.modal').modal('hide');
    })

</script>
<script>
    var options = {
        url: function (phrase) {
            return "/jsonsearch/?q=" + phrase;
        },
        getValue: "title",

        template: {
            type: "custom",
            method: function (value, item) {
                return "<span data-id='" + item.id + "' id='course-" + item.id + "'>" + item.title + item.code +
                    "</span>";
            }
        },
        list: {

            onClickEvent: function () {
                var code = $(".provider-json-pre-course").getSelectedItemData().code;
                var id = $(".provider-json-pre-course").getSelectedItemData().id;
                var title = $(".provider-json-pre-course").getSelectedItemData().title;
                var countArray = $('#precourse').val().split(',');
                if (countArray.length < 4) {
                    $('#precourse').val($('#precourse').val() + id + ',');
                    $('.pre-course-title-container').append('<li>' + title + '&nbsp;' + code +
                        '<i class="fa fa-times delete-course" cid="' + id + '"></i></li>');
                }
            },

            showAnimation: {
                type: "fade", //normal|slide|fade
                time: 400,
                callback: function () {}
            },

            hideAnimation: {
                type: "slide", //normal|slide|fade
                time: 400,
                callback: function () {}
            }
        }
    };

    $('body').on('click', 'i.delete-course', function () {
        $(this).parent('li').remove();
        var id = $(this).attr('cid');
        $('#precourse').val($('#precourse').val().replace(id + ',', ''));
    });

</script>
<script>
    /*$('#new-part').click(function (e) {
        e.preventDefault();
        if (!$('#step-5-form-new-part')[0].checkValidity()) {
            $('#step-5-form-new-part input').filter('[required]:visible').css('border-color', 'red');
        } else {
            $('#step-5-form-new-part input').filter('[required]:visible').css('border-color', '#CCCCCC');
            $.get('/user/content/part/store', $('#step-5-form-new-part').serialize(), function (data) {
                $('#step-5-form-new-part')[0].reset();
                refreshContent();
                $.notify({
                    message: 'Part sent to content review department.'
                }, {
                    type: 'danger',
                    allow_dismiss: false,
                    z_index: '99999999',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    position: 'fixed'
                });
            })
        }
    })*/

</script>
<script>
    $('document').ready(function () {
        refreshContent();
    })

    function refreshContent() {
        var id = $('#edit_id').val();
        $('#part-video-table-body').html('');
        $.get('/user/content/part/json/' + id, function (data) {
            $('#part-video-table-body').html('');
            $.each(data, function (index, item) {
                if(!item.zoom_meeting){
                    $('#part-video-table-body').append('<tr class="text-center"><td class="cell-ta">' + item.title + '</td><td>' + item.size +
                    'MB</td><td>' + item.duration + '&nbsp;Minutes</td><td>' + item.created_at +
                    '</td><td>' + item.mode +
                    '</td><td><span class="crticon mdi mdi-lead-pencil i-part-edit img-icon-s" pid="' +
                    item.id +
                    '" title="Edit"></span>&nbsp;<span class="crticon mdi mdi-delete-forever" data-toggle="modal" data-target="#delete-part-modal img-icon-s" onclick="$(\'#delete-part-id\').val($(this).attr(\'pid\'));" pid="' +
                    item.id + '" title="Delete"></span></td></tr>');
                }else{
                    $('#part-video-table-body-zoom').append('<tr class="text-center"><td class="cell-ta">' + item.title + '</td><td>' + item.size +
                    'MB</td><td>' + item.duration + '&nbsp;Minutes</td><td>' + item.created_at +
                    '</td><td>' + item.mode +
                    '</td><td><span class="crticon mdi mdi-lead-pencil i-part-edit img-icon-s" pid="' +
                    item.id +
                    '" title="Edit"></span>&nbsp;<span class="crticon mdi mdi-delete-forever" data-toggle="modal" data-target="#delete-part-modal img-icon-s" onclick="$(\'#delete-part-id\').val($(this).attr(\'pid\'));" pid="' +
                    item.id + '" title="Delete"></span></td></tr>');
                }
            })
        })
    }

</script>
<script>
    $('#delete-request').click(function () {
        $('#delete-part-modal').modal('hide');
        var id = $('#delete-part-id').val();
        $.get('/user/content/part/delete/' + id);
        refreshContent();
    })

</script>
<script>
    $('body').on('click', 'span.i-part-edit', function () {
        console.log('edit');
        var id = $(this).attr('pid');
        $.get('/user/content/part/edit/' + id, function (data) {
            $('.edit-part-section').show();
            var efrom = '#step-5-form-edit-part ';
            $('#part-edit-id').val(id);
            $(efrom + 'input[name="upload_video"]').val(data.upload_video);
            $(efrom + 'input[name="sort"]').val(data.sort);
            $(efrom + 'input[name="size"]').val(data.size);
            $(efrom + 'input[name="duration"]').val(data.duration);
            $(efrom + 'input[name="title"]').val(data.title);
            $(efrom + 'textarea[name="description"]').html(data.description);
            $(efrom + 'input[name="initial_date"]').val(data.initial_date);
            $(efrom + 'input[name="limit_date"]').val(data.limit_date);
            if (data.free == 1) {
                $('.free-edit-check-state .ios-switch').removeClass('off');
                $('.free-edit-check-state .ios-switch').addClass('on');
            } else {
                $('.free-edit-check-state .ios-switch').removeClass('on');
                $('.free-edit-check-state .ios-switch').addClass('off');
            }
        })
        if ($('.new-part-click').next('.submenu').css('display') == 'block') {
            $('.new-part-click').click();
        }
        if ($('.edit-part-click').next('.submenu').css('display') == 'none') {
            $('.new-part-click').click();
        }
    })

</script>
<script>
    $('#edit-part-submit').click(function (e) {
        e.preventDefault();
        var id = $('#part-edit-id').val();
        $.post('/user/content/part/edit/store/' + id, $('#step-5-form-edit-part').serialize(), function (data) {
            //console.log(data);
        });
        refreshContent();
        $.notify({
            message: 'Part changes saved successfully.'
        }, {
            type: 'info',
            allow_dismiss: false,
            z_index: '99999999',
            placement: {
                from: "bottom",
                align: "right"
            },
            position: 'fixed'
        });
    })

</script>
<script>
    $('.click-to-upload-vimeo').click(function () {
        let url = $('#vimeo_url').val();
        if (url == '' || url == null) {
            return $('#vimeo_url').css('background-color', '#FDA09B');
        }
        $('#vimeo_url').css('background-color', 'white');
        $('.vimeo-waiting').show();
        $.get('/user/vimeo/download?link=' + url, function (data) {
            if (data == 'ok') {
                $('.vimeo-waiting').removeClass('blink').text('ok');
            }
        });
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate() . '.user.vendor.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/content/edit.blade.php ENDPATH**/ ?>