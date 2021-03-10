@extends(getTemplate().'.view.layout.layout')
@section('title')
{{ !empty($setting['site']['site_title']) ? $setting['site']['site_title'] : 'Website Title' }}
{{ trans('main.user_login') }}
@endsection
@section('content')
<div class="container-fluid login-s">
<br>
<br>
    <div class="h-25"></div>
    <div class="h-25"></div>
    <div class="text-center login-box">
        <div class="formBox level-login level-reg-revers level-forget" dir="ltr">
            <div class="box forgetbox">
                <h2>{{ trans('main.reset_password') }}</h2>
                <form class="form" action="/password/reset" method="post">
                    {{ csrf_field() }}
                    <p>{{ trans('main.enter_email_reset_password') }} </p>
                    <div class="f_row last">
                        <label>{{ trans('main.email') }}</label>
                        <input type="text" name="email" class="input-field validate"
                            valid-title="Enter your email address" required>
                        <u></u>
                    </div>
                    <button class="btn btn-primary pull-left white-c"><span>{{ trans('main.reset') }}</span></button>
                </form>
                
            </div>
        </div>
        
    </div>
</div>

@endsection
@section('script')
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
                type: 'danger',
                allow_dismiss: false,
                z_index: '99999999',
                placement: {
                    from: "bottom",
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
        } else if {
            $('.regTag strong').text('Iniciar Sesión');
        }
    })
    
</script>
@endsection