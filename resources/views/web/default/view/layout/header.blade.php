<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{!! get_option('site_fav','/assets/default/404/images/favicon.png') !!}" type="image/png"
        sizes="32x32">
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{!! get_option('site_description','') !!}">
    <link rel="stylesheet" href="/assets/default/vendor/bootstrap/css/bootstrap.min.css" />
    <!--<link rel="stylesheet" href="/assets/default/vendor/bootstrap/css/bootstrap-3.2.rtl.css" />-->
    <link rel="stylesheet" href="/assets/default/vendor/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/default/vendor/owlcarousel/dist/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="/assets/default/vendor/raty/jquery.raty.css" />
    <link rel="stylesheet" href="/assets/default/view/fluid-player-master/fluidplayer.min.css" />
    <link rel="stylesheet" href="/assets/default/vendor/simplepagination/simplePagination.css" />
    <link rel="stylesheet" href="/assets/default/vendor/easyautocomplete/easy-autocomplete.css" />
    <link rel="stylesheet" href="/assets/default/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="/assets/default/vendor/jquery-te/jquery-te-1.4.0.css" />
    <link rel="stylesheet" href="/assets/default/stylesheets/vendor/mdi/css/materialdesignicons.min.css" />
    @if(get_option('site_rtl','0') == 1)
    <!-- <link rel="stylesheet" href="/assets/default/stylesheets/view-custom-rtl.css"/>-->
    @else
    <!-- <link rel="stylesheet" href="/assets/default/stylesheets/view-custom.css?time={!! time() !!}"/>-->
    @endif
    <link rel="stylesheet" href="/assets/default/stylesheets/tzenik-main.css">
    <link rel="stylesheet" href="/assets/default/stylesheets/view-responsive.css" />
    @if(get_option('main_css')!='')
    <style>
        {
             ! ! get_option('main_css') ! !
        }

    </style>
    @endif
    <script type="application/javascript" src="/assets/default/vendor/jquery/jquery.min.js"></script>
    <title>@yield('title'){!! $title ?? '' !!}</title>
    <script>
        function changeFont() {
            $.post('/user/profile/store', $('#userform').serialize(), function (data) {
                location.reload();
            })
        }

        function changeColor() {
            $.post('/user/profile/store', $('#invertform').serialize(), function (data) {
                location.reload();
            })
        }
    </script>
</head>

<body>
    <div class="container-full">
        <div class="navbar navbar-inverse">
            <div class="container-fluid nav-container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">
                        <img alt="Brand" src="{{ get_option('site_logo') }}" alt="{{ get_option('site_title') }}" />
                        <img alt="Brand" src="{{ get_option('site_logo_type') }}"
                            alt="{{ get_option('site_title') }}" />
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="searchbar">

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown navbar-accesibilidad">
                            <a href="#" class="dropdown-toggle navbar-item-title" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Men&uacute; de Accesibilidad</a>
                            <ul class="dropdown-menu">
                                <li>
                                    @if(isset($user))
                                        <form method="post" id="invertform">
                                            @csrf
                                            <label
                                                class="control-label col-md-1 tab-con">{{ trans('main.invert') }}</label>
                                            <select name="invert" class="form-control" onChange="changeColor();">
                                                @if($user['invert'] == 1)
                                                <option disabled selected>{{ trans('main.inverted') }}</option>
                                                @elseif(!$user['invert'])
                                                <option disabled selected>{{ trans('main.normal') }}</option>
                                                @endif
                                                <option value="1">Invertir</option>
                                                <option value="" style="">Normal</option>

                                            </select>
                                        </form>
                                    @endif
                                </li>
                                <li>
                                    @if(isset($user))
                                        <form method="post" id="userform">
                                            @csrf
                                            <label
                                                class="control-label col-md-1 tab-con">{{ trans('main.fontsize') }}</label>
                                            <select name="fontsize" class="form-control" onChange="changeFont();">
                                                @if($user['fontsize'] == 40)
                                                <option disabled selected>{{ trans('main.biggest') }}</option>
                                                @elseif($user['fontsize'] == 32)
                                                <option disabled selected>{{ trans('main.bigger') }}</option>
                                                @elseif($user['fontsize'] == 24)
                                                <option disabled selected>{{ trans('main.big') }}</option>
                                                @elseif(!$user['fontsize'])
                                                <option disabled selected>{{ trans('main.normal') }}</option>
                                                @endif
                                                <option value="40" style="font-size: 40px">Biggest</option>
                                                <option value="32" style="font-size: 32px">Bigger</option>
                                                <option value="24" style="font-size: 24px">Big</option>
                                                <option value="" style="">Normal</option>

                                            </select>
                                        </form>
                                    @endif
                                </li>
                            </ul>
                        </li>
                        @if(isset($user))
                        <li class="dropdown navbar-perfil">
                            <a href="#" class="dropdown-toggle navbar-item-title" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Perfil</a>
                            <ul class="dropdown-menu">
                                <li><a href="/user/video/buy">
                                        <p>Dashboard</p>
                                    </a></li>
                                <li><a href="/logout">
                                        <p>{{ trans('main.exit') }}</p>
                                    </a></li>
                            </ul>
                        </li>
                        @else
                        <li class="navbar-perfil">
                            <a href="/user?redirect={{ Request::path() }}">Login</a>
                        </li>
                        @endif
                    </ul>

                    <form class="navbar-form">
                        <div class="form-group" style="display:inline;">
                            <div class="input-group" style="display:table;">
                                <span class="input-group-addon" style="width:1%;"><span
                                        class="glyphicon glyphicon-search"></span> Buscar </span>
                                <input class="form-control" name="search" placeholder="Buscar..." autocomplete="off"
                                    autofocus="autofocus" type="text">
                            </div>
                        </div>
                    </form>

                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
