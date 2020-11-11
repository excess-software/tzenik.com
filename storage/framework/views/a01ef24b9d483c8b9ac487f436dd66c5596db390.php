<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="<?php echo get_option('site_fav','/assets/default/404/images/favicon.png'); ?>" type="image/png"
        sizes="32x32">
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="<?php echo get_option('site_description',''); ?>">
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
    <?php if(get_option('site_rtl','0') == 1): ?>
    <!-- <link rel="stylesheet" href="/assets/default/stylesheets/view-custom-rtl.css"/>-->
    <?php else: ?>
    <!-- <link rel="stylesheet" href="/assets/default/stylesheets/view-custom.css?time=<?php echo time(); ?>"/>-->
    <?php endif; ?>
    <?php if(isset($user)): ?>
    <?php if(is_null($user['invert'])): ?>
    <link rel="stylesheet" href="/assets/default/stylesheets/tzenik-main.css?v=<?php echo e(time()); ?>">
    <?php elseif($user['invert'] == 'yellow'): ?>
    <link rel="stylesheet" href="/assets/default/stylesheets/tzenik-yellow.css?v=<?php echo e(time()); ?>">
    <?php elseif($user['invert'] == 'white'): ?>
    <link rel="stylesheet" href="/assets/default/stylesheets/tzenik-white.css?v=<?php echo e(time()); ?>">
    <?php elseif($user['invert'] == 'black'): ?>
    <link rel="stylesheet" href="/assets/default/stylesheets/tzenik-black.css?v=<?php echo e(time()); ?>">
    <?php endif; ?>
    <?php else: ?>
    <script>
        if (localStorage.getItem("color")) {
            if (localStorage.getItem("color") == 'yellow') {
                document.head.innerHTML +=
                    '<link rel="stylesheet" href="/assets/default/stylesheets/tzenik-yellow.css?v=<?php echo e(time()); ?>">';
            } else if (localStorage.getItem("color") == 'white') {
                document.head.innerHTML +=
                '<link rel="stylesheet" href="/assets/default/stylesheets/tzenik-white.css?v=<?php echo e(time()); ?>">';
            } else if (localStorage.getItem("color") == 'black') {
                document.head.innerHTML += '<link rel="stylesheet" href="/assets/default/stylesheets/tzenik-black.css?v=<?php echo e(time()); ?>">';
            } else {
                document.head.innerHTML += '<link rel="stylesheet" href="/assets/default/stylesheets/tzenik-main.css?v=<?php echo e(time()); ?>">';
            }
        } else {
            document.head.innerHTML += '<link rel="stylesheet" href="/assets/default/stylesheets/tzenik-main.css?v=<?php echo e(time()); ?>">';
        }

    </script>
    <?php endif; ?>
    <link rel="stylesheet" href="/assets/default/stylesheets/view-responsive.css" />
    <?php if(get_option('main_css')!=''): ?>
    <style>
        {
             ! ! get_option('main_css') ! !
        }

    </style>
    <?php endif; ?>
    <script type="application/javascript" src="/assets/default/vendor/jquery/jquery.min.js"></script>
    <title><?php echo $__env->yieldContent('title'); ?><?php echo $title ?? ''; ?></title>
    <script>
        function changeFont(font) {
            <?php if(isset($user)): ?>
            $.ajax({
                type: 'POST',
                url: "/user/profile/store",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "fontsize": font
                },
                dataType: "text",
                success: function (data) {
                    location.reload();
                }
            });
            <?php else: ?>
            localStorage.setItem("font", font);
            console.log(localStorage.getItem("font"));
            location.reload();
            <?php endif; ?>
        }

        function changeColor(color) {
            if (color == 'default') {
                color = ''
            }
            <?php if(isset($user)): ?>
            $.ajax({
                type: 'POST',
                url: "/user/profile/store",
                data: {
                    "_token": "<?php echo e(csrf_token()); ?>",
                    "invert": color
                },
                dataType: "text",
                success: function (data) {
                    location.reload();
                }
            });
            <?php else: ?>
            localStorage.setItem("color", color);
            console.log(localStorage.getItem("color"));
            location.reload();
            <?php endif; ?>
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
                        <img alt="Brand" src="<?php echo e(get_option('site_logo')); ?>" alt="<?php echo e(get_option('site_title')); ?>" />
                        <img alt="Brand" src="<?php echo e(get_option('site_logo_type')); ?>"
                            alt="<?php echo e(get_option('site_title')); ?>" />
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
                                                <button class="btn btn-menu-accesibilidad btn-block" onclick="changeFont(24)">
                                                    <b>A</b>
                                                    <br>
                                                    <b>Smaller</b>
                                                </button>
                                            </div>
                                            <div class="col-md-6 text-center">
                                                <button class="btn btn-menu-accesibilidad btn-block" onclick="changeFont(32)">
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
                                                    <b>Black Text</b>
                                                    <br>
                                                    <b>White</b>
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
                                        <div class="col-md-6">
                                                <button class="btn btn-blackTxtWhite btn-block"
                                                    onclick="changeColor('black')">
                                                    <b>White Text</b>
                                                    <br>
                                                    <b>Black</b>
                                                    <br>
                                                    <b>Background</b>
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-menu-accesibilidad btn-block"
                                                    onclick="changeColor('default')">
                                                    <br>
                                                    <b>Default</b>
                                                    <br>
                                                    <br>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <?php if(isset($user)): ?>
                        <li class="dropdown navbar-perfil">
                            <a href="#" class="dropdown-toggle navbar-item-title" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Perfil</a>
                            <ul class="dropdown-menu">
                                <li><a href="/user/video/buy">
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <?php if(isset($user) && isset($user['vendor']) && $user['vendor'] == 1): ?>
                                <li><a href="/user/content/new">
                                        <p>Nuevo curso</p>
                                    </a>
                                </li>
                                <?php endif; ?>
                                <li><a href="/user/profile">
                                        <p>Configuraci&oacute;n</p>
                                    </a>
                                </li>
                                <li><a href="/logout">
                                        <p><?php echo e(trans('main.exit')); ?></p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li class="navbar-perfil">
                            <a href="/user?redirect=<?php echo e(Request::path()); ?>">Login</a>
                        </li>
                        <?php endif; ?>
                    </ul>

                    <form class="navbar-form" action="/search" method="get">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group" style="display:inline;">
                            <div class="input-group" style="display:table;">
                                <span class="input-group-addon" style="width:1%;"><span
                                        class="glyphicon glyphicon-search"></span> Buscar </span>
                                <input class="form-control col-md-11" name="q" placeholder="Buscar..." autocomplete="off"
                                    autofocus="autofocus" type="text">
                            </div>
                        </div>
                    </form>

                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
<?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/layout/header.blade.php ENDPATH**/ ?>