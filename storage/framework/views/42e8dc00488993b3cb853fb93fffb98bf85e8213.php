<?php $__env->startSection('title'); ?>
    <?php echo e(trans('admin.th_edit')); ?> <?php echo e(trans('admin.employees')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page'); ?>
    <div class="card">
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
                        <a href="#information" class="nav-link" data-toggle="tab"><?php echo e(trans('admin.extra_info')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="#capatibility" class="nav-link" data-toggle="tab"><?php echo e(trans('admin.permissions')); ?></a>
                    </li>
                    <li class="nav-item">
                        <a href="#document" class="nav-link" data-toggle="tab"><?php echo e(trans('admin.identity')); ?></a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="main" class="tab-pane active">
                        <form action="/admin/user/edit/<?php echo e($user->id); ?>" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.real_name')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="name" value="<?php echo e($user->name); ?>" class="form-control" id="inputDefault">
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
                                        <option value="active" <?php echo e($user->mode=='active' ? 'selected="selected"':''); ?>><?php echo e(trans('admin.active')); ?></option>
                                        <option value="deactive" <?php echo e($user->mode=='deactive' ? 'selected="selected"':''); ?>><?php echo e(trans('admin.banned')); ?></option>
                                    </select>
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
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.profile_pic')); ?></label>
                                <div class="col-md-6">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="avatar" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="avatar" class="form-control" type="text" name="avatar" dir="ltr" value="<?php echo e($meta['avatar'] ?? ''); ?>">
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="avatar">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.birthday')); ?></label>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="date" name="birthday" id="birthday" value="<?php echo e($meta['birthday'] ?? ''); ?>" class="form-control text-center" id="inputDefault">
                                        <span class="input-group-append fdatebtn" id="fdatebtn">
                                            <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.bank_name')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="bank_name" value="<?php echo e($meta['bank_name'] ?? ''); ?>" class="form-control text-center" id="inputDefault">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.account_number')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="bank_account" value="<?php echo e($meta['bank_account'] ?? ''); ?>" class="form-control text-center" id="inputDefault">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.creditcard_number')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="bank_card" value="<?php echo e($meta['bank_card'] ?? ''); ?>" class="form-control text-center" id="inputDefault">
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
                    <div id="information" class="tab-pane">
                        <form action="/admin/user/editprofile/<?php echo e($user->id); ?>" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.passport_id')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="meli_code" value="<?php echo e($meta['meli_code'] ?? ''); ?>" class="form-control text-center" id="inputDefault">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.mobile_number')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="mobile" value="<?php echo e($meta['mobile'] ?? ''); ?>" class="form-control text-center" id="inputDefault">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.Telephone')); ?></label>
                                <div class="col-md-6">
                                    <input type="text" name="phone" value="<?php echo e($meta['phone'] ?? ''); ?>" class="form-control text-center" id="inputDefault">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault"><?php echo e(trans('admin.address')); ?></label>
                                <div class="col-md-9">
                                    <input type="text" name="address" value="<?php echo e($meta['address'] ?? ''); ?>" class="form-control text-center" id="inputDefault">
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
                    <div id="capatibility" class="tab-pane">
                        <form action="/admin/manager/capatibility/<?php echo e($user->id); ?>" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>


                            <div class="custom-switches-stacked">
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="report" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('report',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.reports_breadcom')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="user" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('user',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.users')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="channel" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('channel',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.channels')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="quizzes" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('quizzes',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.quizzes')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="content" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('content',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.courses')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="manager" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('manager',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.employees')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="request" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('request',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.course_requests')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="ads" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('ads',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.advertising')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="blog" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('blog',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.blog_articles')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="balance" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('balance',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.financial')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="buysell" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('buysell',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.sales')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="ticket" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('ticket',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.support')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="notification" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('notification',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.notifications')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="email" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('email',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.emails')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="discount" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('discount',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.promotions_discounts')); ?></label>
                                </label>
                                <label class="custom-switch">
                                    <input type="checkbox" name="capatibility[]" value="setting" class="custom-switch-input" <?php if(!empty($meta['capatibility'])): ?> <?php echo e(checkedInArray('setting',$meta['capatibility'],true)); ?> <?php endif; ?> />
                                    <span class="custom-switch-indicator"></span>
                                    <label class="custom-switch-description" for="inputDefault"><?php echo e(trans('admin.settings')); ?></label>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit"><?php echo e(trans('admin.save_changes')); ?></button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div id="document" class="tab-pane">
                        <form action="/admin/user/editprofile/<?php echo e($user->id); ?>" class="form-horizontal form-bordered" method="post">
                            <?php echo e(csrf_field()); ?>


                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.identity_scan')); ?></label>
                                <div class="col-md-6">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="upload_certificate" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="upload_certificate" class="form-control" type="text" name="upload_certificate" dir="ltr" value="<?php echo e($meta['upload_certificate'] ?? ''); ?>" >
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="upload_certificate">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.contract')); ?></label>
                                <div class="col-md-6">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="upload_deal" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="upload_deal" class="form-control" type="text" name="upload_deal" dir="ltr" value="<?php echo e($meta['upload_deal'] ?? ''); ?>" >
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="upload_deal">
                                                <span class="input-group-text">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><?php echo e(trans('admin.payslip')); ?></label>
                                <div class="col-md-6">
                                    <div class="input-group" style="display: flex">
                                        <button type="button" data-input="upload_payroll" data-preview="holder" class="lfm_image btn btn-primary">
                                            Choose
                                        </button>
                                        <input id="upload_payroll" class="form-control" type="text" name="upload_payroll" dir="ltr" value="<?php echo e($meta['upload_payroll'] ?? ''); ?>" >
                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="upload_payroll">
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
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        $(function () {
            $('select[name="mode"]').change(function () {
                if ($(this).val() == 'block') {
                    $('.birthday-group').removeClass('hidden');
                } else {
                    $('.birthday-group').addClass('hidden');
                }
            })
        })
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.newlayout.layout',['breadcom'=>['Employees','Edit Employee',$user->name]], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/gardoon1/domains/academybusiness.ir/next/resources/views/admin/manager/item.blade.php ENDPATH**/ ?>