<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="<?php echo get_option('site_fav','/assets/default/404/images/favicon.png'); ?>" type="image/png"
        sizes="32x32">
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    <link rel="stylesheet" href="/assets/default/stylesheets/tzenik-main.css">
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
</head>

<body>
    <div class="container-full">
        <div class="navbar navbar-inverse">
            <div class="container-fluid">
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
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </li>
                        <li class="dropdown navbar-perfil">
                            <a href="#" class="dropdown-toggle navbar-item-title" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Perfil</a>
                            <ul class="dropdown-menu">
                                <li><a href="/user/video/buy">
                                        <p>Dashboard</p>
                                    </a></li>
                                <li><a href="/logout">
                                        <p><?php echo e(trans('main.exit')); ?></p>
                                    </a></li>
                            </ul>
                        </li>
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
<?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/layout/header.blade.php ENDPATH**/ ?>