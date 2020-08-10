<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.edit_user')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="cards">
        <div class="card-body">
            <div class="tabs">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a href="#main" class="nav-link active" data-toggle="tab"> <?php echo e(trans('admin.general')); ?> </a>
                    </li>
                    <li class="nav-item">
                        <a href="#profile" class="nav-link" data-toggle="tab"><?php echo e(trans('admin.profile')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="#images" class="nav-link" data-toggle="tab"><?php echo e(trans('admin.image')); ?>/<?php echo e(trans('admin.video')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="#seller" class="nav-link" data-toggle="tab"><?php echo e(trans('admin.vendor_info')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="#rate" class="nav-link" data-toggle="tab"><?php echo e(trans('admin.users_badges')); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="main" class="tab-pane active">
                        <form action="/admin/user/edit/<?php echo e($user->id); ?>" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.real_name')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputReadOnly"><?php echo e(trans('admin.username')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" value="<?php echo e($user->username); ?>" id="inputReadOnly" class="form-control" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputReadOnly"><?php echo e(trans('admin.email')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" value="<?php echo e($user->email); ?>" id="inputReadOnly" class="form-control text-left" dir="ltr" readonly="readonly">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.th_status')); ?></label>
                                <div class="col-md-6">
                                    <select name="mode" class="form-control populate">
                                        <option value="active" <?php echo e($user->mode=='active' ? 'selected="selected"' : ''); ?>><?php echo e(trans('admin.active')); ?></option>
                                        <option value="block" <?php echo e($user->mode=='block' ? 'selected="selected"' : ''); ?>><?php echo e(trans('admin.banned')); ?></option>
                                    </select>
                                </div>
                                <div class="col-md-3 birthday-group <?php if($user->mode == 'active'): ?> hidden <?php endif; ?>">
                                    <div class="input-group">
                                        <input type="date" name="blockDate" class="form-control" id="blockDate" value="<?php if(isset($meta['blockDate'])): ?> <?php echo e(date('d-m-Y',$meta['blockDate'])); ?> <?php endif; ?>">
                                        <span class="input-group-append bdatebtn" id="bdatebtn">
                                            <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.user_groups')); ?></label>
                                <div class="col-md-6">
                                    <select name="category_id" class="form-control populate">
                                        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($cat->id); ?>" <?php echo e($user->category_id == $cat->id ? 'selected="selected"' : ''); ?>><?php echo e($cat->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 switch switch-sm switch-primary">
                                    <input type="hidden" value="0" name="vendor">
                                    <input type="checkbox" name="vendor" value="1" data-plugin-ios-switch <?php if(isset($user->vendor) and $user->vendor == 1): ?> <?php echo e('checked="checked"'); ?> <?php endif; ?>/>&nbsp;&nbsp;Vendor
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
                    <div id="profile" class="tab-pane">
                        <form action="/admin/user/editprofile/<?php echo e($user->id); ?>" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.birthday')); ?></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="date" name="birthday" id="birthday" value="<?php echo e($meta['birthday'] ?? ''); ?>" class="form-control text-center" >
                                        <span class="input-group-append fdatebtn" id="fdatebtn"><span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.gender')); ?></label>
                                <div class="col-md-6">
                                    <select name="sex" class="form-control">
                                        <option value="male" <?php if(isset($meta['sex']) and $meta['sex'] == 'male'): ?> selected <?php endif; ?>><?php echo e(trans('admin.male')); ?></option>
                                        <option value="female" <?php if(isset($meta['sex']) and $meta['sex'] == 'female'): ?> selected <?php endif; ?>><?php echo e(trans('admin.female')); ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.biography')); ?></label>
                                <div class="col-md-6">
                                    <textarea name="biography" class="form-control" rows="10" ><?php echo e($meta['biography'] ?? ''); ?></textarea>
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
                    <div id="images" class="tab-pane">
                        <form action="/admin/user/editprofile/<?php echo e($user->id); ?>" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.profile_pic')); ?></label>
                                <div class="col-md-6">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="avatar" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="avatar" class="form-control" type="text" name="avatar" dir="ltr" value="<?php echo e($meta['avatar'] ?? ''); ?>" >
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="avatar">
                                            <span class="input-group-text">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.profile_pic')); ?></label>
                                <div class="col-md-6">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="profile_image" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="profile_image" class="form-control" type="text" name="profile_image" dir="ltr" value="<?php echo e($meta['profile_image'] ?? ''); ?>" >
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="profile_image">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.video_biography')); ?></label>
                                <div class="col-md-6">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="videography" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="videography" class="form-control" type="text" name="videography" dir="ltr" value="<?php echo e($meta['videography'] ?? ''); ?>" >
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="videography">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                        </div>
                                    </div>
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
                    <div id="rate" class="tab-pane ow-h">
                        <div class="col-xs-12 custom-item">
                            <b><?php echo e(trans('admin.autimatic_badges')); ?></b>
                            <hr>
                            <div class="col-xs-12 h-15"></div>
                            <div class="col-xs-12">
                                <?php if(!empty($getrate)): ?>
                                    <?php $__currentLoopData = $getrate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-1 col-xs-1 text-center">
                                            <img title="<?php echo e($rate['description'] ?? ''); ?>" src="<?php echo e($rate['image'] ?? ''); ?>" class="img-responsive">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-xs-12 h-15"></div>
                        </div>
                        <div class="col-xs-12 h-15"></div>
                        <form action="/admin/user/ratesection/<?php echo e($user->id); ?>" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label class="col-md-2 control-label" for="inputDefault"><?php echo e(trans('admin.select_item')); ?></label>
                                <div class="col-md-8">
                                    <select name="rate" class="form-control">
                                        <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($list['id'] ?? 0); ?>"><?php echo e($list['description'] ?? ''); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-2 text-left">
                                    <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.add_to_user')); ?></button>
                                </div>
                            </div>
                        </form>
                        <div class="col-xs-12 h-15"></div>
                        <div class="col-md-12 custom-item">
                            <b><?php echo e(trans('admin.add_badge_to_user')); ?></b>
                            <hr>
                            <?php if(!empty($mrates)): ?>
                                <?php $__currentLoopData = $mrates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mrate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-1 text-center col-xs-1">
                                        <a href="#" data-href="/admin/user/ratesection/delete/<?php echo e($mrate->id); ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times"></i></a>
                                        <br>
                                        <img src="<?php echo e($mrate->rate->image ?? ''); ?>" title="<?php echo e($mrate->rate->description ?? ''); ?>" class="img-responsive m-0-0">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="seller" class="tab-pane">
                        <form class="form-horizontal form-bordered" method="post" action="/admin/user/editprofile/<?php echo e($user->id); ?>">
                            <?php echo e(csrf_field()); ?>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.bank_name')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="bank_name" value="<?php echo e($meta['bank_name'] ?? ''); ?>" class="form-control text-center" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.account_number')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="bank_account" value="<?php echo e($meta['bank_account'] ?? ''); ?>" class="form-control text-center" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.creditcard_number')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="bank_card" value="<?php echo e($meta['bank_card'] ?? ''); ?>" class="form-control text-center" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.passport_id')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="melli_code" value="<?php echo e($meta['melli_code'] ?? ''); ?>" class="form-control text-center" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.identity_scan')); ?></label>
                                <div class="col-md-6">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="melli_card" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="melli_card" class="form-control" type="text" name="melli_card" dir="ltr" value="<?php echo e($meta['melli_card'] ?? ''); ?>" >
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="melli_card">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 switch switch-sm switch-primary">
                                    <input type="hidden" value="0" name="seller_apply">
                                    <input type="checkbox" name="seller_apply" value="1" data-plugin-ios-switch <?php if(isset($meta['seller_apply']) and $meta['seller_apply'] == 1): ?> <?php echo e('checked="checked"'); ?> <?php endif; ?>/>&nbsp;&nbsp;<?php echo e(trans('admin.verified_vendor')); ?>

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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Users','Edit',$user->name]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/admin/user/item.blade.php ENDPATH**/ ?>