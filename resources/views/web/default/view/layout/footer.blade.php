<footer>
    <section id="footer">
		<div class="container">
			<div class="row text-left">
				<div class="col-xs-12 col-sm-3 col-md-3">
					
					<ul class="list-unstyled quick-links">
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Get Started</a></li>
						<li><a href="#">Videos</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3">
					
					<ul class="list-unstyled quick-links">
						<li><a href="#">Home</a></li>
						<li><a href="#">About</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Get Started</a></li>
						<li><a href="#">Videos</a></li>
					</ul>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3">
					
					<ul class="list-unstyled quick-links">
						<li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">FAQ</a></li>
					</ul>
				</div>
				<div class="col-xs-12 col-sm-3 col-md-3">
					<ul class="list-unstyled text-center">
                        <li><a href="#"><img class="img-responsive " alt="Brand" src="{{ get_option('site_logo_type') }}" alt="{{ get_option('site_title') }}"/></a></li>
                    </ul>
                    <ul class="list-unstyled list-inline social">
						<li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="#" target="_blank"><i class="fa fa-envelope"></i></a></li>
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
                    <img class="img-responsive " alt="Brand" src="{{ get_option('site_logo_type') }}" alt="{{ get_option('site_title') }}"/>
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
                        <h4 class="modal-title">{{ trans('main.file_manager') }}</h4>
                    </div>
                    <div class="modal-body">
                        {{--<iframe class="modal-body-s" width="100%" height="400" src="/assets/default/filemanager/dialog.php?type=2&field_id=upload-id-fill&relative_url=1" frameborder="0"></iframe>--}}
                        <iframe src="/laravel-filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
        @if(get_option('site_popup',0) == '1')
            <div class="modal fade" id="site_popup">
                <div class="modal-dialog popup_modal">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <i class="fa fa-close" data-dismiss="modal"></i>
                            <a href="{{ get_option('popup_url','javascript:void(0);') }}"><img src="{{ get_option('popup_image','') }}" class="img-responsive"></a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if(get_option('triangle-banner-top-image','')!='')
            <div class="fix-top-banner">
                <a href="{{ get_option('triangle-banner-top-url','') }}"><img src="{{ get_option('triangle-banner-top-image','') }}"></a>
            </div>
        @endif
        @if(get_option('triangle-banner-bottom-image','')!='')
            <div class="fix-bottom-banner">
                <a href="{{ get_option('triangle-banner-bottom-url','') }}"><img src="{{ get_option('triangle-banner-bottom-image','') }}"></a>
            </div>
        @endif
        @if(get_option('banner-html-box','')!='')
            <div class="fix-html-bottom">
                {!! get_option('banner-html-box','') !!}
            </div>
        @endif
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
        var preloader = {!! get_option('site_preloader',0) !!};
    </script>
    <script type="application/javascript" src="/assets/default/javascripts/view-custom.js"></script>
    @if(isset($user))

    @if(!is_null($user['fontsize']))
    <script>
        $(document).ready(function (){
            if({{$user['fontsize']}} == 40){
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
                $('#btn-bigFont').prop('disabled', true);
            }else if({{$user['fontsize']}} == 32){
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
                $('#btn-bigFont').prop('disabled', true);
            }else if({{$user['fontsize']}} == 24){
                $('#btn-smallFont').prop('disabled', true);
            }
        });
    </script>
    @endif
    @else
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
                        $('#btn-bigFont').prop('disabled', true);
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
                    $('#btn-bigFont').prop('disabled', true);
                } else {
                    $('#btn-smallFont').prop('disabled', true);
                }
            } else {
                
            }
    </script>
    @endif


    @if(isset($user))
        <script>login({!! $user['id'] !!})</script>
    @endif
    @if(get_option('site_popup',0) == '1' && session('popup') == 0)
        <script>
            $(function () {
                $('#site_popup').modal();
            })
        </script>
        @php session(['popup'=>1]) @endphp
    @endif
    @yield('script')
    @if(session('msg') != null)
        <script>
            $.notify({
                message: '{{ session('msg')}}'
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
        @endif
        {!! get_option('main_js') !!}
</body>
</html>