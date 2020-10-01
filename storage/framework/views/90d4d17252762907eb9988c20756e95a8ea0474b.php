<div class="footer">
      <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img class="img-responsive pull-right" alt="Brand" src="<?php echo e(get_option('site_logo')); ?>" alt="<?php echo e(get_option('site_title')); ?>"/>
            </div>
            <div class="col-md-6">
                <img class="img-responsive pull-left" alt="Brand" src="<?php echo e(get_option('site_logo_type')); ?>" alt="<?php echo e(get_option('site_title')); ?>"/>
            </div>
        </div>
        <div class="row footer-tzenik">
            <div class="col text-center">
                <span>Tzenik.com 2020</span>
            </div>
        </div>
      </div>
    </div>
<div class="modal fade" id="uploader-modal" role="dialog">
    <div class="modal-dialog modal-dialog-s">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo e(trans('main.file_manager')); ?></h4>
            </div>
            <div class="modal-body">
                
                <iframe src="/laravel-filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
            </div>
        </div>
    </div>
</div>
<?php if(get_option('site_popup',0) == '1'): ?>
    <div class="modal fade" id="site_popup">
        <div class="modal-dialog popup_modal">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <i class="fa fa-close" data-dismiss="modal"></i>
                    <a href="<?php echo e(get_option('popup_url','javascript:void(0);')); ?>"><img src="<?php echo e(get_option('popup_image','')); ?>" class="img-responsive"></a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php if(get_option('triangle-banner-top-image','')!=''): ?>
    <div class="fix-top-banner">
        <a href="<?php echo e(get_option('triangle-banner-top-url','')); ?>"><img src="<?php echo e(get_option('triangle-banner-top-image','')); ?>"></a>
    </div>
<?php endif; ?>
<?php if(get_option('triangle-banner-bottom-image','')!=''): ?>
    <div class="fix-bottom-banner">
        <a href="<?php echo e(get_option('triangle-banner-bottom-url','')); ?>"><img src="<?php echo e(get_option('triangle-banner-bottom-image','')); ?>"></a>
    </div>
<?php endif; ?>
<?php if(get_option('banner-html-box','')!=''): ?>
    <div class="fix-html-bottom">
        <?php echo get_option('banner-html-box',''); ?>

    </div>
<?php endif; ?>
<!-- Scripts -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(), 'guest' => !auth()->check()]); ?>;
</script>
<?php if(!is_null($user['invert'])): ?>
<script>
    $(document).ready(function (){
        $('body').css({"filter": "invert(100%)"});
    });
</script>
<?php endif; ?>
<?php if(!is_null($user['fontsize'])): ?>
<script>
    $(document).ready(function (){
        if(<?php echo e($user['fontsize']); ?> == 40){
            $('h1').css('font-size', '' + 40 + 'px');
            $('h2').css('font-size', '' + 32 + 'px');
            $('h3').css('font-size', '' + 24 + 'px');
            $('h4').css('font-size', '' + 19.78 + 'px');
            $('h5').css('font-size', '' + 18 + 'px');
            $('h6').css('font-size', '' + 15.28 + 'px');
            $('.no-child').css('font-size', '' + 32 + 'px');
            $('.has-child').css('font-size', '' + 32 + 'px');
            $('label').css('font-size', '' + 32 + 'px');
            $('span').css('font-size', '' + 32 + 'px');
            $('p').css('font-size', '' + 32 + 'px');
            $('a').css('font-size', '' + 32 + 'px');
            $('input[type=\'text\']').css('font-size', '', + 32 + 'px');
        }else if(<?php echo e($user['fontsize']); ?> == 32){
            $('h1').css('font-size', '' + 36 + 'px');
            $('h2').css('font-size', '' + 28 + 'px');
            $('h3').css('font-size', '' + 24 + 'px');
            $('h4').css('font-size', '' + 19 + 'px');
            $('h5').css('font-size', '' + 17 + 'px');
            $('h6').css('font-size', '' + 14 + 'px');
            $('.no-child').css('font-size', '' + 28 + 'px');
            $('.has-child').css('font-size', '' + 28 + 'px');
            $('label').css('font-size', '' + 28 + 'px');
            $('span').css('font-size', '' + 28 + 'px');
            $('p').css('font-size', '' + 28 + 'px');
            $('a').css('font-size', '' + 28 + 'px');
            $('input[type=\'text\']').css('font-size', '', + 28 + 'px');
        }else if(<?php echo e($user['fontsize']); ?> == 24){
            $('h1').css('font-size', '' + 30 + 'px');
            $('h2').css('font-size', '' + 24 + 'px');
            $('h3').css('font-size', '' + 20 + 'px');
            $('h4').css('font-size', '' + 18 + 'px');
            $('h5').css('font-size', '' + 16 + 'px');
            $('h6').css('font-size', '' + 13 + 'px');
            $('.no-child').css('font-size', '' + 24 + 'px');
            $('.has-child').css('font-size', '' + 24 + 'px');
            $('label').css('font-size', '' + 24 + 'px');
            $('span').css('font-size', '' + 24 + 'px');
            $('p').css('font-size', '' + 24 + 'px');
            $('a').css('font-size', '' + 24 + 'px');
            $('input[type=\'text\']').css('font-size', '', + 24 + 'px');
        }
    });
</script>
<?php endif; ?>

<script type="application/javascript" src="/assets/default/vendor/jquery-ui/js/jquery-1.10.2.js"></script>
<script type="application/javascript" src="/assets/default/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="application/javascript" src="/assets/default/vendor/justgage/raphael-2.1.4.min.js"></script>
<script type="application/javascript" src="/assets/default/vendor/justgage/justgage.js"></script>
<script type="application/javascript" src="/assets/default/vendor/simplepagination/jquery.simplePagination.js"></script>
<script type="application/javascript" src="/assets/default/vendor/onloader/js/jquery.oLoader.min.js"></script>
<script type="application/javascript" src="/assets/default/vendor/ios7-switch/ios7-switch.js"></script>
<script type="application/javascript" src="/assets/default/vendor/sticky/jquery.sticky.js"></script>
<script type="application/javascript" src="/assets/default/vendor/chartjs/Chart.min.js"></script>
<script type="application/javascript" src="/assets/default/vendor/bootstrap-notify-master/bootstrap-notify.min.js"></script>
<script type="application/javascript" src="/assets/default/vendor/auto-numeric/autoNumeric.js"></script>
<script type="application/javascript" src="/assets/default/vendor/raty/jquery.raty.js"></script>
<script type="application/javascript" src="/assets/default/vendor/easyautocomplete/jquery.easy-autocomplete.min.js"></script>
<script type="application/javascript" src="/assets/default/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
<script type="application/javascript" src="/assets/default/vendor/owlcarousel/dist/owl.carousel.min.js"></script>
<script type="application/javascript" src="/assets/default/vendor/jquery-te/jquery-te-1.4.0.min.js"></script>
<script type="application/javascript">var sliderTimer = <?=get_option('main_page_slider_timer', 10000);?>;</script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    var preloader = <?php echo get_option('site_preloader',0); ?>;
</script>
<script type="application/javascript" src="/assets/default/javascripts/view-custom.js"></script>
<?php if(isset($user)): ?>
    <script>login(<?php echo $user['id']; ?>)</script>
<?php endif; ?>
<?php if(get_option('site_popup',0) == '1' && session('popup') == 0): ?>
    <script>
        $(function () {
            $('#site_popup').modal();
        })
    </script>
    <?php session(['popup'=>1]) ?>
<?php endif; ?>
<?php echo $__env->yieldContent('script'); ?>
<?php if(session('msg') != null): ?>
    <script>
        $.notify({
            message: '<?php echo e(session('msg')); ?>'
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
    </script>
    <?php endif; ?>
    <?php echo get_option('main_js'); ?>

    </body>
    </html>
<?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/layout/footer.blade.php ENDPATH**/ ?>