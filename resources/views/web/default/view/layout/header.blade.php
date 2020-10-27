<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="{!! get_option('site_fav','/assets/default/404/images/favicon.png') !!}" type="image/png"
        sizes="32x32">
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
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
    @if(isset($user))
    @if(is_null($user['invert']))
    <link rel="stylesheet" href="/assets/default/stylesheets/tzenik-main.css">
    @elseif($user['invert'] == 'yellow')
    <link rel="stylesheet" href="/assets/default/stylesheets/tzenik-yellow.css">
    @elseif($user['invert'] == 'white')
    <link rel="stylesheet" href="/assets/default/stylesheets/tzenik-white.css">
    @endif
    @else
    <script>
        if (localStorage.getItem("color")) {
            if (localStorage.getItem("color") == 'yellow') {
                document.head.innerHTML +=
                    '<link rel="stylesheet" href="/assets/default/stylesheets/tzenik-yellow.css">';
            } else if (localStorage.getItem("color") == 'white') {
                document.head.innerHTML +=
                '<link rel="stylesheet" href="/assets/default/stylesheets/tzenik-white.css">';
            } else {
                document.head.innerHTML += '<link rel="stylesheet" href="/assets/default/stylesheets/tzenik-main.css">';
            }
        } else {
            document.head.innerHTML += '<link rel="stylesheet" href="/assets/default/stylesheets/tzenik-main.css">';
        }

    </script>
    @endif
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
        function changeFont(font) {
            $.ajax({
                type: 'POST',
                url: "/user/profile/store",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "fontsize": font
                },
                dataType: "text",
                success: function (data) {
                    location.reload();
                }
            });
        }

        function changeColor(color) {
            if (color == 'default') {
                color = ''
            }
            @if(isset($user))
            $.ajax({
                type: 'POST',
                url: "/user/profile/store",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "invert": color
                },
                dataType: "text",
                success: function (data) {
                    location.reload();
                }
            });
            @else
            localStorage.setItem("color", color);
            console.log(localStorage.getItem("color"));
            location.reload();
            @endif
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
                            <ul class="dropdown-menu accesibilidad-menu">
                                <li>
                                    <div class="container" style="width: 100%;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3><b>Text Size:</b></h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 text-center">
                                                <button class="btn btn-primary btn-block" onclick="changeFont(24)">
                                                    <b>A</b>
                                                    <br>
                                                    <b>Smaller</b>
                                                </button>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <button class="btn btn-primary btn-block" onclick="changeFont(32)">
                                                    <b>A</b>
                                                    <br>
                                                    <b>Larger</b>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="container" style="width: 100%;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3><b>Contrast:</b></h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-whiteTxtBlack btn-block"
                                                    onclick="changeColor('white')">
                                                    <b>White Text</b>
                                                    <br>
                                                    <b>Black</b>
                                                    <br>
                                                    <b>Background</b>
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-yellowTxtBlack btn-block"
                                                    onclick="changeColor('yellow')">
                                                    <b>Yellow Text</b>
                                                    <br>
                                                    <b>Black</b>
                                                    <br>
                                                    <b>Background</b>
                                                </button>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-12 text-center">
                                                <button class="btn btn-primary btn-block"
                                                    onclick="changeColor('default')">
                                                    <b>Default</b>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
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
                                    </a>
                                </li>
                                @if(isset($user) && isset($user['vendor']) && $user['vendor'] == 1)
                                <li><a href="/user/content/new">
                                        <p>Nuevo curso</p>
                                    </a>
                                </li>
                                @endif
                                <li><a href="/user/profile">
                                        <p>Configuraci&oacute;n</p>
                                    </a>
                                </li>
                                <li><a href="/logout">
                                        <p>{{ trans('main.exit') }}</p>
                                    </a>
                                </li>
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
