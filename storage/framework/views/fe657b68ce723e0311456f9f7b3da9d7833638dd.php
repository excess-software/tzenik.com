
<?php $__env->startSection('title'); ?>
<?php echo e(!empty($setting['site']['site_title']) ? $setting['site']['site_title'] : 'Website Title'); ?>

<?php echo e(trans('main.user_login')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!--<div class="container-fluid login-s">
    <div class="login-form">
        <div class="login-formulario">
            <form class="form" action="/login" method="post" id="loginForm">
                <h2 class="text-center"><?php echo e(trans('main.login')); ?></h2>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="<?php echo e(trans('main.username_email')); ?>"
                        required="required">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="<?php echo e(trans('main.password')); ?>"
                        required="required">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"><?php echo e(trans('main.login')); ?></button>
                </div>
                <div class="clearfix">
                    <a href="#" class="float-right"><?php echo e(trans('main.forget_password')); ?></a>
                </div>
            </form>
            <p class="text-center"><a href="#"><?php echo e(trans('main.sign_in')); ?></a></p>
        </div>
        <div class="registro-formulario">
            <form class="form" method="post" action="/registerUser">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                    <label><?php echo e(trans('main.username')); ?></label>
                    <input type="text" name="username" valid-title="Fill out this form." class="form-control validate"
                        required>
                </div>

                <div class="form-group">
                    <label><?php echo e(trans('main.password')); ?></label>
                    <input type="password" id="r-password" valid-title="Fill out this form." name="password"
                        class="form-control validate" required>
                    <u></u>
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('main.retype_password')); ?></label>
                    <input type="password" id="r-re-password" name="password_confirmation"
                        valid-title="Fill out this form." class="form-control validate" required>
                    <u></u>
                </div>
                <div class="form-group">
                    <label><?php echo e(trans('main.realname')); ?></label>
                    <input type="name" name="name" class="form-control validate" valid-title="Enter your real name"
                        required>
                    <u></u>
                </div>
                <div class="form-group last" style="margin-bottom: 20px;">
                    <label><?php echo e(trans('main.email')); ?></label>
                    <input type="email" name="email" class="form-control validate" valid-title="Enter your email address"
                        required>
                    <u></u>
                </div>
                <div class="form-group tab-con">
                    <input type="checkbox" class="input-r" name="terms"
                        style="display: block;position: relative;top: 16px;width: auto;height: auto"
                        valid-title="If you want to continue please accept terms and rules" required>
                    <label class="label-r" style="margin-left: 15px;"><?php echo e(trans('main.i_accept')); ?> <a
                            href="/page/pages_terms"><?php echo e(trans('main.term_rules')); ?></a></label>
                </div>
                <?php if(get_option('user_register_captcha') == 1): ?>
                <div class="form-group tab-con">
                    <?php echo NoCaptcha::display(); ?>

                </div>
                <?php endif; ?>
                <button
                    class="btn btn-primary btn-block"><?php echo e(trans('main.register')); ?></button>
            </form>
        </div>
    </div>
</div>-->
<div class="container-fluid login-s">
<br>
<br>
    <div class="h-25"></div>
    <div class="h-25"></div>
    <div class="container text-center login-box">
    <a href="#" class="regTag">
                <h3><strong class="fos-s">Registrarse</strong></h3>
            </a>
            <br>
        <div class="formBox level-login" dir="ltr">
            <div class="box boxShaddow"></div>
            <div class="box loginBox">
                <h2><?php echo e(trans('main.login')); ?></h2>
                <form class="form" action="/login" method="post" id="loginForm" style="text-align: left;direction: ltr">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label><?php echo e(trans('main.username_email')); ?></label>
                        <input type="text" name="username" class="form-control input-field validate" autocomplete="new-password"
                            valid-title="Fill out this form" required>
                        <u></u>
                    </div>
                    <div class="form-group last">
                        <label><?php echo e(trans('main.password')); ?></label>
                        <input type="password" name="password" class="form-control input-field validate"
                            valid-title="Fill out this form" autocomplete="new-password" required>
                        <u></u>
                    </div>
                    <input type="hidden" name="remember" value="0">
                    <!--<input class="input-rem" type="checkbox" name="remember" value="1" style="display:block;position: relative;top: 16px;width: auto;height: auto"><label style="margin-left: 15px;"><?php echo e(trans('main.remember')); ?></label>-->
                    <button
                        class="btn btn-custom pull-left btn-register-user btn-register-user-r"><span><?php echo e(trans('main.login')); ?></span></button>
                    <div class="h-10"></div>
                    <div class="f_link">
                        <a href="" class="resetTag restag pull-right"
                            ><?php echo e(trans('main.forget_password')); ?></a>
                        <!-- <a href="/user/sociliate/google" class="btn btn-custom btn-check-form pull-left"><i class="fa fa-google-plus icon-rs"></i><span><?php echo e(trans('main.sign_in_google')); ?></span></a> -->
                    </div>
                </form>
            </div>
            <div class="box forgetbox">
                <a href="#" class="back icon-back">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 199.404 199.404"
                        style="enable-background:new 0 0 199.404 199.404;" xml:space="preserve">
                        <polygon points="199.404,81.529 74.742,81.529 127.987,28.285 99.701,0 0,99.702 99.701,199.404 127.987,171.119 74.742,117.876
                                199.404,117.876 " />
                    </svg>
                </a>
                <h2><?php echo e(trans('main.reset_password')); ?></h2>
                <form class="form" action="/user/reset" method="post">
                    <?php echo e(csrf_field()); ?>

                    <p><?php echo e(trans('main.enter_email_reset_password')); ?> </p>
                    <div class="f_row last">
                        <label><?php echo e(trans('main.email')); ?></label>
                        <input type="text" name="email" class="input-field validate"
                            valid-title="Enter your email address" required>
                        <u></u>
                    </div>
                    <button class="btn btn-primary pull-left white-c"><span><?php echo e(trans('main.reset')); ?></span></button>
                </form>
            </div>
            <div class="box registerBox" style="height: 650px">
                <span class="reg_bg"></span>
                <form class="form" method="post" action="/registerUser" style="text-align: left">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <label><?php echo e(trans('main.username')); ?></label>
                        <input type="text" name="username" valid-title="Fill out this form."
                            class="form-control validate" required>
                        <u></u>
                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('main.password')); ?></label>
                        <input type="password" id="r-password" valid-title="Fill out this form." name="password"
                            class="form-control validate" required>
                        <u></u>
                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('main.retype_password')); ?></label>
                        <input type="password" id="r-re-password" name="password_confirmation"
                            valid-title="Fill out this form." class="form-control validate" required>
                        <u></u>
                    </div>
                    <div class="form-group">
                        <label><?php echo e(trans('main.realname')); ?></label>
                        <input type="name" name="name" class="form-control validate" valid-title="Enter your real name"
                            required>
                        <u></u>
                    </div>
                    <div class="form-group last" style="margin-bottom: 20px;">
                        <label><?php echo e(trans('main.email')); ?></label>
                        <input type="email" name="email" class="form-control validate"
                            valid-title="Enter your email address" required>
                        <u></u>
                    </div>
                    <div class="form-group tab-con">
                        <input type="checkbox" class="input-r" name="terms"
                            style="display: block;position: relative;top: 16px;width: auto;height: auto"
                            valid-title="If you want to continue please accept terms and rules" required>
                        <label class="label-r" style="margin-left: 15px;"><?php echo e(trans('main.i_accept')); ?> <a
                                href="/page/pages_terms"><?php echo e(trans('main.term_rules')); ?></a></label>
                    </div>
                    <?php if(get_option('user_register_captcha') == 1): ?>
                    <div class="form-group tab-con">
                        <?php echo NoCaptcha::display(); ?>

                    </div>
                    <?php endif; ?>
                    <button
                        class="btn btn-custom pull-left btn-register-user btn-register-user-r"><?php echo e(trans('main.register')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
    $(document).keypress(function (e) {
        if (e.which == 13) {
            $('#loginForm').submit();
        }
    });

</script>
<script>
    $('.btn-register-user').on('click', function (e) {
        if ($('#r-password').val() != $('#r-re-password').val()) {
            $.notify({
                message: 'Password & its confirmation are not the same.'
            }, {
                type: 'info',
                allow_dismiss: false,
                z_index: '99999999',
                placement: {
                    from: "top",
                    align: "right"
                },
                position: 'fixed'
            });
            e.preventDefault();
        }
    })

</script>
<script>
    $('.regTag').click(function () {
        if ($('.regTag strong').text() == 'Registrarse') {
            $('.regTag strong').text('Iniciar Sesión');
        } else {
            $('.regTag strong').text('Registrarse');
        }
    })

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(getTemplate().'.view.layout.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/auth/login.blade.php ENDPATH**/ ?>