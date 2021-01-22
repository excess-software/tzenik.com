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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/fafad05c14.js" crossorigin="anonymous"></script>
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
    <!--<link rel="stylesheet" href="/assets/default/stylesheets/view-responsive.css" />-->
    <?php if(get_option('main_css')!=''): ?>
    <style>
        {
             ! ! get_option('main_css') ! !
        }

    </style>
    <?php endif; ?>
    <script type="application/javascript" src="/assets/default/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"
        integrity="sha512-v8ng/uGxkge3d1IJuEo6dJP8JViyvms0cly9pnbfRxT6/31c3dRWxIiwGnMSWwZjHKOuY3EVmijs7k1jz/9bLA=="
        crossorigin="anonymous"></script>
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
    <?php if(isset($user)): ?>
    <script>
        var origin = window.location.origin;
        var socket = io.connect(origin+':8890');
        $(document).ready(function () {
            var host = window.location.origin;
            var message_id = '';

            $.get(host + '/user/chat', function (data) {
                $.each(data, function (key, value) {
                    if (value.published == 'true') {
                        $('.inbox_chat').append(
                            '<a href="javascript:void(0);" onclick="callChat(' + value.id + ');">\
                            <div class="chat_list" id="chatNo_' + value.id + '">\
                                <div class="chat_people">\
                                    <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>\
                                    <div class="chat_ib">\
                                    <h5>' + value.name + '</h5>\
                                    </div>\
                                </div>\
                            </div>\
                        </a>');
                    }
                });
            });

            $('#btn-chat').click(function () {
                $('#chat-test').fadeIn();
            });
            $('#btn-close').click(function () {
                $('#chat-test').fadeOut();
            });

            $('#btn-users').hide();

            //Funciones Socket.io
            $('.msg_send_btn').click(function () {
                var this_chat_id = $('#chat_id').val();
                if ($('.write_msg').val() != '') {
                    $.post(host + '/user/chat/send_Message/' + this_chat_id, $('#sendForm').serialize(),
                        function (id) {
                            message_id = id;
                        });
                    socket.emit('sendMessage', $('.write_msg').val(), '<?php echo e($user['
                        name ']); ?>', this_chat_id, message_id);
                    $('.write_msg').val('');
                } else {
                    $('.write_msg').focus();
                }
                return false;
            });

            socket.on('receiveMessage', function (message, sender, chat_id, message_id) {
                var this_chat_id = $('#chat_id').val();
                if (chat_id == this_chat_id) {
                    if (sessionStorage.ownerid == "<?php echo e($user['id']); ?>") {
                        $('.msg_history').append('<div class="incoming_msg" id="Msg_' + message_id + '">\
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>\
                        <div class="received_msg">\
                            <div class="received_withd_msg">\
                                <p>' + message + '</p>\
                                <span class="time_date">' + sender + '</span>\
                                <a href="javascript:void(0);" onclick="deleteMessage(' + message_id + ');">X</a>\
                            </div>\
                        </div>\
                    <br></div>');
                    } else {
                        $('.msg_history').append('<div class="incoming_msg" id="Msg_' + message_id + '">\
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>\
                        <div class="received_msg">\
                            <div class="received_withd_msg">\
                                <p>' + message + '</p>\
                                <span class="time_date">' + sender + '</span>\
                            </div>\
                        </div>\
                    <br></div>');
                    }
                    $(".msg_history").scrollTop($(".msg_history")[0].scrollHeight);
                }
            })

            socket.on('messageDeleted', function (message_id) {
                $('#Msg_' + message_id).remove();
            });

            socket.on('userDeleted', function (user_id, chat_id) {
                if (user_id == "<?php echo e($user['id']); ?>") {
                    $('#chatNo_' + chat_id).remove();
                    $('.msg_history').html('');
                }
                $('#liUser_' + user_id).remove();
            });

        });

        function callChat(id) {
            var host = window.location.origin;
            var ownerid = '';
            $('.msg_history').html('');
            $('#chat_id').val(id);
            $('.chat_list').removeClass('active_chat');
            $('#chatNo_' + id).addClass('active_chat');

            //Obtener id del creador del chat
            $.get(host + '/user/chat/get_Owner/' + id, function (data) {
                ownerid = data;
                sessionStorage.ownerid = ownerid;
                console.log(sessionStorage.ownerid);
                sessionStorage.chat_id = id;

                if (ownerid == "<?php echo e($user['id']); ?>") {
                    $('#btn-users').show();
                    $('#btn-users').prop('disabled', false);
                }
            });

            $.get(host + '/user/chat/get_Users/' + id, function (data) {
                $.each(data, function (key, value) {
                    if (ownerid == value.id) {
                        $('#UsersInChat-Body').append('<li class="list-group-item">' + value.name +
                            '</li>');
                    } else {
                        $('#UsersInChat-Body').append('<li class="list-group-item" id="liUser_' + value
                            .id + '"><a href="javascript:void(0);" onclick="deleteUser(' + value
                            .id + ', ' + id +
                            ');"><button class="btn btn-warning" id="btn-deleteUser">X</button></a> ' +
                            value.name + '</li>');
                    }
                });
            });


            $.get(host + '/user/chat/Chat/' + id, function (data) {
                $.each(data, function (key, value) {
                    if (ownerid == "<?php echo e($user['id']); ?>") {
                        $('.msg_history').append('<div class="incoming_msg" id="Msg_' + value.id + '">\
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>\
                        <div class="received_msg">\
                            <div class="received_withd_msg">\
                                <p>' + value.message + '</p>\
                                <span class="time_date">' + value.name + '</span>\
                                <a href="javascript:void(0);" onclick="deleteMessage(' + value.id + ');">X</a>\
                            </div>\
                        </div>\
                    <br></div>');
                    } else {
                        $('.msg_history').append('<div class="incoming_msg" id="Msg_' + value.id + '">\
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>\
                        <div class="received_msg">\
                            <div class="received_withd_msg">\
                                <p>' + value.message + '</p>\
                                <span class="time_date">' + value.name + '</span>\
                            </div>\
                        </div>\
                    <br></div>');
                    }
                });
                $('.msg_history').scrollTop($(".msg_history")[0].scrollHeight);
            });

        };

        function deleteMessage(id) {
            var host = window.location.origin;
            $.get(host + '/user/chat/delete_Message/' + id, function (data) {
                socket.emit('deleteMessage', id);
            });
        }

        function deleteUser(id, chat_id) {
            var host = window.location.origin;
            $.get(host + '/user/chat/delete_User/' + id + '/' + chat_id, function (data) {
                socket.emit('deleteUser', id, chat_id);
            });
        }

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
    <?php endif; ?>
</head>

<body>
    <?php if(isset($user)): ?>
    <div class="modal fade" id="UsersInChat" tabindex="-1" role="dialog" aria-labelledby="UsersInChat"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Users in chat</h5>
                </div>
                <div class="modal-body">
                    <ul class="list-group" id="UsersInChat-Body">
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="chat-test">
        <input type="hidden" value="" id="chat_id">
        <div class="messaging">
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Recent</h4>
                        </div>
                    </div>
                    <div class="inbox_chat">
                    </div>
                </div>
                <div class="mesgs">
                    <button type="button" id="btn-users" class="btn btn-warning" data-toggle="modal"
                        data-target="#UsersInChat" disabled><i class="fa fa-users"></i></button>
                    <button type="button" id="btn-close" class="btn btn-warning">X
                    </button>
                    <div class="msg_history">
                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <form method="post" id="sendForm">
                                <?php echo csrf_field(); ?>
                                <input type="text" class="write_msg" placeholder="Type a message" name="message">
                                <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o"
                                        aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button type="button" id="btn-chat" class="btn btn-warning btn-circle btn-xl"><i class="fa fa-comment"></i>
    </button>
    <?php endif; ?>
    <div class="navbar navbar-inverse">
        <div class=" nav-container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img alt="Brand" src="<?php echo e(get_option('site_logo')); ?>" alt="<?php echo e(get_option('site_title')); ?>" />
                    <img alt="Brand" src="<?php echo e(get_option('site_logo_type')); ?>" alt="<?php echo e(get_option('site_title')); ?>" />
                </a>
            </div>
            <div class="navbar-collapse collapse" id="searchbar">

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown navbar-accesibilidad">
                        <a href="#" class="dropdown-toggle navbar-item-title" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false"><i class="fas fa-universal-access"> </i> <i class="fas fa-angle-down"></i></a>
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
                            <li><a href="/user/vendor">
                                    <p>Panel de instructor</p>
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
                        <a href="/user?redirect=<?php echo e(Request::path()); ?>"><i class="far fa-user"></i></a>
                    </li>
                    <?php endif; ?>
                </ul>

                <form class="navbar-form" action="/search" method="get">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group" style="display:inline;">
                        <div class="input-group" style="display:table;">
                            <span class="input-group-addon" style="width:1%;"><span
                                    class="glyphicon glyphicon-search"></span> Buscar </span>
                            <input class="form-control " name="q" placeholder="" autocomplete="off"
                                autofocus="autofocus" type="text">
                        </div>
                    </div>
                </form>

            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
<?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/layout/header.blade.php ENDPATH**/ ?>