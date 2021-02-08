<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Panel - <?php echo $__env->yieldContent('title', ''); ?></title>

    <link rel="stylesheet" href="/assets/default/stylesheets/tzenik-main.css?v=<?php echo e(time()); ?>">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="/assets/admin/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/admin/modules/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="/assets/default/vendor/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/assets/default/stylesheets/vendor/mdi/css/materialdesignicons.min.css" />
    <link rel="stylesheet" href="/assets/default/stylesheets/view-responsive.css" />
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/assets/admin/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="/assets/admin/modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="/assets/admin/modules/jquery-selectric/selectric.css">
    <link rel="stylesheet" href="/assets/admin/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/assets/admin/css/style.css">
    <link rel="stylesheet" href="/assets/admin/css/components.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/admin/css/admin-custom.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"
        integrity="sha512-v8ng/uGxkge3d1IJuEo6dJP8JViyvms0cly9pnbfRxT6/31c3dRWxIiwGnMSWwZjHKOuY3EVmijs7k1jz/9bLA=="
        crossorigin="anonymous"></script>
    <style>
        .custom-switch-input:checked~.custom-switch-description {
            position: relative;
            top: 4px;
        }

        .modal-backdrop {
            /* bug fix - no overlay */
            display: none;
        }

    </style>
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-94034622-3');

    </script>
    <!-- /END GA -->
</head>

<body>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <?php echo e(csrf_field()); ?>

                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="/assets/admin/img/avatar/avatar-1.png" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?php echo $Admin['username'] ?? ''; ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="/" class="dropdown-item has-icon">
                                <i class="fas fa-user"></i> Volver
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="/vendor">Admin Panel</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="/vendor">AP</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Content</li>
                        <li class="dropdown" id="content">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-video"></i>
                                <span><?php echo e(trans('admin.courses')); ?></span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/user/vendor/content/list"><?php echo e(trans('admin.list')); ?></a>
                                </li>
                                <li><a class="nav-link" href="/user/vendor/content/private/asignar">Usuarios en tus
                                        cursos</a></li>
                                <li><a class="nav-link" href="/user/vendor/content/private/progreso">Progreso de tus alumnos</a></li>
                                <li><a class="nav-link" href="/user/vendor/content/tareas">Tareas</a></li>      
                                <li><a class="nav-link" href="/user/content/new">Crear nuevo curso</a></li>
                            </ul>
                        </li>

                        <li class="dropdown" id="content">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-video"></i>
                                <span>Exámenes</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/user/vendor/quizzes/newQuiz">Nuevo examen</a>
                                </li>
                                <li><a class="nav-link" href="/user/vendor/quizzes">Examenes disponibles</a></li>
                            </ul>
                        </li>

                        <li class="dropdown" id="forum">
                            <a href="#" class="nav-link has-dropdown"><i class="fas fa-file-word"></i>
                                <span>Forum</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="/user/vendor/forum/posts">Posts</a></li>
                                <li><a class="nav-link" href="/user/vendor/forum/comments">Comments</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>
            <div class="main-content">
                <div class="section">
                    <div class="section-header">
                        <h1><?php echo $__env->yieldContent('title', ''); ?></h1>
                        <?php if(isset($breadcom) and count($breadcom)): ?>
                        <div class="section-header-breadcrumb">
                            <?php $__currentLoopData = $breadcom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="breadcrumb-item"><?php echo $bread; ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="section-body">
                        <?php echo $__env->yieldContent('page'); ?>
                    </div>
                </div>
            </div>
            <?php echo $__env->make('admin.newlayout.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make(getTemplate().'.user.layout.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('modals'); ?>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="/assets/admin/modules/jquery.min.js"></script>
    <script src="/assets/admin/modules/popper.js"></script>
    <script src="/assets/admin/modules/tooltip.js"></script>
    <script src="/assets/admin/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/admin/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/assets/admin/modules/moment.min.js"></script>
    <script src="/assets/admin/js/stisla.js"></script>
    <script src="/assets/admin/modules/cleave-js/dist/cleave.min.js"></script>
    <script src="/assets/admin/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
    <script src="/assets/admin/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="/assets/admin/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/assets/admin/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <script src="/assets/admin/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
    <script src="/assets/admin/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="/assets/admin/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="/assets/admin/modules/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="/assets/admin/modules/jquery.sparkline.min.js"></script>
    <script src="/assets/admin/modules/chart.min.js"></script>
    <script src="/assets/admin/modules/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="/assets/admin/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/assets/admin/modules/jqvmap/dist/maps/jquery.vmap.indonesia.js"></script>
    <script src="/assets/admin/modules/datatables/datatables.min.js"></script>
    <script src="/assets/admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <script src="/assets/admin/modules/jquery-ui/jquery-ui.min.js"></script>
    <script src="/assets/admin/modules/summernote/summernote.min.js"></script>
    <script src="/assets/admin/modules/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="/assets/admin/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
    <script src="/assets/admin/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="/assets/admin/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="/assets/admin/modules/jquery-selectric/jquery.selectric.min.js"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script type="application/javascript" src="/assets/default/vendor/bootstrap-notify-master/bootstrap-notify.min.js"></script>

    <script src="/assets/admin/js/scripts.js"></script>
    <script src="/assets/admin/js/custom.js"></script>
    <script>
        $('.lfm_image').filemanager('file', {
            prefix: '/admin/laravel-filemanager'
        });
        <?php if(isset($menu)): ?>
        $(function () {
            $('#<?php echo $menu; ?>').addClass('active');
        });
        <?php endif; ?>
        <?php if(isset($url)): ?>
        $(function () {
            $('.nav-link').each(function () {
                if ('<?php echo url(' / '); ?>' + $(this).attr('href') == '<?php echo $url; ?>') {
                    $(this).parent().addClass('active');
                }
            })
        });
        <?php endif; ?>

    </script>
    <?php echo $__env->yieldContent('script'); ?>
</body>

</html>
<?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/user/vendor/layout/layout.blade.php ENDPATH**/ ?>