<footer>
    <section id="footer">
		<div class="container">
			<div class="row text-left">
				<div class="col-xs-12 col-sm-3 col-md-3">
					
					<ul class="list-unstyled quick-links">
						<li><a href="https://www.fiverr.com/share/qb8D02">Home</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02">About</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02">FAQ</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02">Get Started</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02">Videos</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3">
					
					<ul class="list-unstyled quick-links">
						<li><a href="https://www.fiverr.com/share/qb8D02">Home</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02">About</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02">FAQ</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02">Get Started</a></li>
						<li><a href="https://www.fiverr.com/share/qb8D02">Videos</a></li>
					</ul>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
					
					<ul class="list-unstyled quick-links">
						<li><a href="https://www.fiverr.com/share/qb8D02">Home</a></li>
                        <li><a href="https://www.fiverr.com/share/qb8D02">About</a></li>
                        <li><a href="https://www.fiverr.com/share/qb8D02">FAQ</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3">
					<ul class="list-unstyled text-center">
                        <li><a href="https://www.fiverr.com/share/qb8D02"><img class="img-responsive " alt="Brand" src="<?php echo e(get_option('site_logo_type')); ?>" alt="<?php echo e(get_option('site_title')); ?>"/></a></li>
                    </ul>
                    <ul class="list-unstyled list-inline social">
						<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-facebook"></i></a></li>
						<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02"><i class="fa fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="https://www.fiverr.com/share/qb8D02" target="_blank"><i class="fa fa-envelope"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
    </section>
    <div id="footer-bar">
        <div class="container">
			<div class="row text-left">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-left rights">
                    <p>Tzenik.com © Derechos Reservados. <u><a href="https://www.fundal.org.gt/">|  Fundal Guatemala</a></u></p>
                </div>
            <hr>
        </div>	
    </div>
    
    <!--<div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img class="img-responsive " alt="Brand" src="<?php echo e(get_option('site_logo_type')); ?>" alt="<?php echo e(get_option('site_title')); ?>"/>
                    asdf
                </div>
                <div class="col-md-3">
                    <p>Patrocinado por:</p>
                </div>
                <div class="col-3">
                    <img src="/bin/admin/lavelle_logo.png" class="img-responsive " width="100px" alt="">
                    adf
                </div>
                <div class="col-md-3">
                    <p>Tzenik.com 2020</p>
                </div>
            </div>
        </div>
    </div>-->
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
    </div>
</footer>
    <!-- Scripts -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(), 'guest' => !auth()->check()]); ?>;
    </script>


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
                $('.at-label').css('font-size', '' + 24 + 'px');
                $('input[type=\'text\']').css('font-size', '', + 32 + 'px');
            }else if(<?php echo e($user['fontsize']); ?> == 32){
                $('h1').css('font-size', '' + 32 + 'px');
                $('h2').css('font-size', '' + 28 + 'px');
                $('h3').css('font-size', '' + 24 + 'px');
                $('h4').css('font-size', '' + 22 + 'px');
                $('h5').css('font-size', '' + 18 + 'px');
                $('h6').css('font-size', '' + 15 + 'px');
                $('.no-child').css('font-size', '' + 24 + 'px');
                $('.has-child').css('font-size', '' + 24 + 'px');
                $('label').css('font-size', '' + 24 + 'px');
                $('span').css('font-size', '' + 24 + 'px');
                $('p').css('font-size', '' + 24 + 'px');
                $('a').css('font-size', '' + 24 + 'px');
                $('.at-label').css('font-size', '' + 24 + 'px');
                $('input[type=\'text\']').css('font-size', '', + 24 + 'px');
            }else if(<?php echo e($user['fontsize']); ?> == 24){
                
            }
        });
    </script>
    <?php endif; ?>
    <?php else: ?>
    <script>
    if (localStorage.getItem("font")) {
                if (localStorage.getItem("font") == 40) {
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
                        $('.at-label').css('font-size', '' + 24 + 'px');
                        $('input[type=\'text\']').css('font-size', '', + 32 + 'px');
                } else if (localStorage.getItem("font") == 32) {
                    $('h1').css('font-size', '' + 32 + 'px');
                    $('h2').css('font-size', '' + 28 + 'px');
                    $('h3').css('font-size', '' + 24 + 'px');
                    $('h4').css('font-size', '' + 22 + 'px');
                    $('h5').css('font-size', '' + 18 + 'px');
                    $('h6').css('font-size', '' + 15 + 'px');
                    $('.no-child').css('font-size', '' + 24 + 'px');
                    $('.has-child').css('font-size', '' + 24 + 'px');
                    $('label').css('font-size', '' + 24 + 'px');
                    $('span').css('font-size', '' + 24 + 'px');
                    $('p').css('font-size', '' + 24 + 'px');
                    $('a').css('font-size', '' + 24 + 'px');
                    $('.at-label').css('font-size', '' + 24 + 'px');
                    $('input[type=\'text\']').css('font-size', '', + 24 + 'px');
                } else {
                
                }
            } else {
                
            }
    </script>
    <?php endif; ?>


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