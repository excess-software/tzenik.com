<div class="container-fluid" id="footer">
    <div class="container">
        <div class="col-md-3 col-xs-12 tab-con login-container">
            <h4>{{ get_option('footer_col1_title') }}</h4>
            <p>{!! get_option('footer_col1_content') !!}</p>
        </div>
        <div class="col-md-3 col-xs-12 tab-con">
            <h4>{{ get_option('footer_col2_title') }}</h4>
            <p>{!! get_option('footer_col2_content') !!}</p>
        </div>
        <div class="col-md-3 col-xs-6 tab-con">
            <h4>{{ get_option('footer_col3_title') }}</h4>
            <p>{!! get_option('footer_col3_content') !!}</p>
        </div>
        <div class="col-md-3 col-xs-6 ab-con">
            <h4>{{ get_option('footer_col4_title') }}</h4>
            <p>{!! get_option('footer_col4_content') !!}</p>
        </div>
    </div>
</div>
<div class="container-fluid footer-blow">
    <div class="col-md-3 col-xs-12 text-center">
        <span class="social-text">{{ trans('main.social_footer') }}</span>
        <ul>
            @if(!empty($socials))
                @foreach($socials as $social)
                    <li>
                        <a href="{{ $social->link }}" target="_blank" title="{{ $social->title }}">
                            <img src="{{ $social->icon }}" alt="{{ $social->title }}"/>
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    <div class="col-md-9 col-xs-12">
        <span class="copyright">
            {{ trans('main.copyright') }}
        </span>
        <span class="copyright">
             {{ trans('main.copyright2') }}
        </span>
    </div>
</div>
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
<!-- Scripts -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(), 'guest' => !auth()->check()]); ?>;
</script>
@if(!is_null($user['invert']))
<script>
    $(document).ready(function (){
        $('body').css({"filter": "invert(100%)"});
    });
</script>
@endif
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
            $('input[type=\'text\']').css('font-size', '', + 32 + 'px');
        }else if({{$user['fontsize']}} == 32){
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
        }else if({{$user['fontsize']}} == 24){
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
@endif

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
