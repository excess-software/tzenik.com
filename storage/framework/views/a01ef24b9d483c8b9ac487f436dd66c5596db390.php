<!doctype html>
<html lang="en">
<head>
    <link rel="icon" href="<?php echo get_option('site_fav','/assets/default/404/images/favicon.png'); ?>" type="image/png" sizes="32x32">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="description" content="<?php echo get_option('site_description',''); ?>">
    <link rel="stylesheet" href="/assets/default/vendor/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/bootstrap/css/bootstrap-3.2.rtl.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/owlcarousel/dist/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/raty/jquery.raty.css"/>
    <link rel="stylesheet" href="/assets/default/view/fluid-player-master/fluidplayer.min.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/simplepagination/simplePagination.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/easyautocomplete/easy-autocomplete.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css"/>
    <link rel="stylesheet" href="/assets/default/vendor/jquery-te/jquery-te-1.4.0.css"/>
    <link rel="stylesheet" href="/assets/default/stylesheets/vendor/mdi/css/materialdesignicons.min.css"/>
    <?php if(get_option('site_rtl','0') == 1): ?>
        <link rel="stylesheet" href="/assets/default/stylesheets/view-custom-rtl.css"/>
    <?php else: ?>
        <link rel="stylesheet" href="/assets/default/stylesheets/view-custom.css?time=<?php echo time(); ?>"/>
    <?php endif; ?>
    
    <link rel="stylesheet" href="/assets/default/stylesheets/view-responsive.css"/>
    <?php if(get_option('main_css')!=''): ?>
        <style>
            <?php echo get_option('main_css'); ?>

        </style>
    <?php endif; ?>
    <script type="application/javascript" src="/assets/default/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" integrity="sha512-v8ng/uGxkge3d1IJuEo6dJP8JViyvms0cly9pnbfRxT6/31c3dRWxIiwGnMSWwZjHKOuY3EVmijs7k1jz/9bLA==" crossorigin="anonymous"></script>
    <title><?php echo $__env->yieldContent('title'); ?><?php echo $title ?? ''; ?></title>
    <?php echo $__env->yieldContent('style'); ?>
    <style>
        #btn-chat {
            width: 70px;
            height: 70px;
            padding: 10px 16px;
            border-radius: 35px;
            font-size: 24px;
            line-height: 1.33;
            position: fixed;
            bottom: 15px;
            right: 15px;
        }
        #chat-test{
            position: fixed;
            bottom: 25px;
            right: 0px;
            z-index: 9999;
            display: none;
        }
        #btn-close{
            width: 20px;
            height: 20px;
            padding: 0;
            margin: 0;
            float: right;
        }
        #btn-users{
            width: 20px;
            height: 20px;
            padding: 0;
            margin: 0;
            margin-right: 5px;
            float: left;
        }
        #btn-deleteUser{
            width: 20px;
            height: 20px;
            padding: 0;
            margin: 0;
        }
    </style>
    <style>
    .container{max-width:1170px; margin:auto;}
    img{ max-width:100%;}
    .inbox_people {
    background: #f8f8f8 none repeat scroll 0 0;
    float: left;
    overflow: hidden;
    width: 35%; 
    border-right:1px solid #c4c4c4;
    }
    .inbox_msg {
    clear: both;
    overflow: hidden;
    }
    .top_spac{ margin: 20px 0 0;}


    .recent_heading {float: left; width:40%;}
    .srch_bar {
    display: inline-block;
    text-align: right;
    width: 60%; padding:
    }
    .headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

    .recent_heading h4 {
    color: #05728f;
    font-size: 21px;
    margin: auto;
    }
    .srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
    .srch_bar .input-group-addon button {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    padding: 0;
    color: #707070;
    font-size: 18px;
    }
    .srch_bar .input-group-addon { margin: 0 0 0 -27px;}

    .chat_ib h5{ font-size:25px; color:#464646; margin:0 0 8px 0;}
    .chat_ib h5 span{ font-size:13px; float:right;}
    .chat_ib p{ font-size:14px; color:#989898; margin:auto;}
    .chat_img {
    float: left;
    width: 11%;
    }
    .chat_ib {
    float: left;
    padding: 0 0 0 15px;
    width: 88%;
    overflow:hidden;
    white-space: nowrap; 
    text-overflow: ellipsis;
    }

    .chat_people{ overflow:hidden; clear:both;}
    .chat_list {
    border-bottom: 1px solid #c4c4c4;
    margin: 0;
    padding: 18px 16px 10px;
    }
    .inbox_chat { height: 550px; overflow-y: scroll;}

    .active_chat{ background:#ebebeb;}

    .incoming_msg_img {
    display: inline-block;
    width: 6%;
    }
    .received_msg {
    display: inline-block;
    padding: 0 0 0 10px;
    vertical-align: top;
    width: 92%;
    }
    .received_withd_msg p {
    background: #ebebeb none repeat scroll 0 0;
    border-radius: 3px;
    color: #646464;
    font-size: 14px;
    margin: 0;
    padding: 5px 10px 5px 12px;
    width: 100%;
    }
    .time_date {
    color: #747474;
    display: block;
    font-size: 12px;
    margin: 8px 0 0;
    }
    .received_withd_msg { width: 57%;}
    .mesgs {
    float: left;
    padding: 30px 15px 0 25px;
    width: 60%;
    background-color: white;
    }

    .sent_msg p {
    background: #05728f none repeat scroll 0 0;
    border-radius: 3px;
    font-size: 14px;
    margin: 0; color:#fff;
    padding: 5px 10px 5px 12px;
    width:100%;
    }
    .outgoing_msg{ overflow:hidden; margin:26px 0 26px;}
    .sent_msg {
    float: right;
    width: 46%;
    }
    .input_msg_write input {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: medium none;
    color: #4c4c4c;
    font-size: 15px;
    min-height: 48px;
    width: 100%;
    }

    .type_msg {border-top: 1px solid #c4c4c4;position: relative;}
    .msg_send_btn {
    background: #05728f none repeat scroll 0 0;
    border: medium none;
    border-radius: 50%;
    color: #fff;
    cursor: pointer;
    font-size: 17px;
    height: 33px;
    position: absolute;
    right: 0;
    top: 11px;
    width: 33px;
    }
    .messaging { padding: 0 0 15px |;}
    .msg_history {
    height: 516px;
    overflow-y: auto;
    }
    .participants_header{
        margin: 0;
        padding: 0;
    }
</style>
    <script>
        var socket = io.connect('http://localhost:8890');
        $(document).ready(function(){
            var host = window.location.origin;
            var message_id = '';

            $.get(host+'/user/chat', function(data){
                $.each(data, function(key, value){
                    if(value.published == 'true'){
                        $('.inbox_chat').append('<a href="javascript:void(0);" onclick="callChat('+value.id+');">\
                            <div class="chat_list" id="chatNo_'+value.id+'">\
                                <div class="chat_people">\
                                    <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>\
                                    <div class="chat_ib">\
                                    <h5>'+value.name+'</h5>\
                                    </div>\
                                </div>\
                            </div>\
                        </a>');
                    }
                });
            });

            $('#btn-chat').click(function(){
                $('#chat-test').fadeIn();
            });
            $('#btn-close').click(function(){
                $('#chat-test').fadeOut();
            });

            $('#btn-users').hide();

            //Funciones Socket.io
            $('.msg_send_btn').click(function(){
                var this_chat_id = $('#chat_id').val();
                if($('.write_msg').val() != ''){
                    $.post(host+'/user/chat/send_Message/'+this_chat_id, $('#sendForm').serialize(), function(id){
                        message_id = id;
                    });
                    socket.emit('sendMessage', $('.write_msg').val(), '<?php echo e($user['name']); ?>', this_chat_id, message_id);
                    $('.write_msg').val('');
                }else{
                    $('.write_msg').focus();
                }
                return false;
            });

            socket.on('receiveMessage', function(message, sender, chat_id, message_id){
                var this_chat_id = $('#chat_id').val();
                if(chat_id == this_chat_id){
                    if(sessionStorage.ownerid == "<?php echo e($user['id']); ?>"){
                        $('.msg_history').append('<div class="incoming_msg" id="Msg_'+message_id+'">\
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>\
                        <div class="received_msg">\
                            <div class="received_withd_msg">\
                                <p>'+message+'</p>\
                                <span class="time_date">'+sender+'</span>\
                                <a href="javascript:void(0);" onclick="deleteMessage('+message_id+');">X</a>\
                            </div>\
                        </div>\
                    <br></div>');
                    }else{
                        $('.msg_history').append('<div class="incoming_msg" id="Msg_'+message_id+'">\
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>\
                        <div class="received_msg">\
                            <div class="received_withd_msg">\
                                <p>'+message+'</p>\
                                <span class="time_date">'+sender+'</span>\
                            </div>\
                        </div>\
                    <br></div>');
                    }
                    $(".msg_history").scrollTop($(".msg_history")[0].scrollHeight);
                }            
            })
            
            socket.on('messageDeleted', function(message_id){
                $('#Msg_'+message_id).remove();     
            });

            socket.on('userDeleted', function(user_id, chat_id){
                if(user_id == "<?php echo e($user['id']); ?>"){
                    $('#chatNo_'+chat_id).remove();
                    $('.msg_history').html('');
                }
                $('#liUser_'+user_id).remove();
            });

        });

        function callChat(id){
            var host = window.location.origin;
            var ownerid = '';
            $('.msg_history').html('');
            $('#chat_id').val(id);
            $('.chat_list').removeClass('active_chat');
            $('#chatNo_'+id).addClass('active_chat');

            //Obtener id del creador del chat
            $.get(host+'/user/chat/get_Owner/'+id, function(data){
                ownerid = data;
                sessionStorage.ownerid = ownerid;
                console.log(sessionStorage.ownerid);
                sessionStorage.chat_id = id;

                if(ownerid == "<?php echo e($user['id']); ?>"){
                    $('#btn-users').show();
                    $('#btn-users').prop('disabled', false);     
                }
            });

            $.get(host+'/user/chat/get_Users/'+id, function(data){
                $.each(data, function(key, value){
                    if(ownerid == value.id){
                        $('#UsersInChat-Body').append('<li class="list-group-item">'+value.name+'</li>');
                    }else{
                        $('#UsersInChat-Body').append('<li class="list-group-item" id="liUser_'+value.id+'"><a href="javascript:void(0);" onclick="deleteUser('+value.id+', '+id+');"><button class="btn btn-warning" id="btn-deleteUser">X</button></a> '+value.name+'</li>');
                    }
                    });
            });


            $.get(host+'/user/chat/Chat/'+id, function(data){
                $.each(data, function(key, value){
                    if(ownerid == "<?php echo e($user['id']); ?>"){
                        $('.msg_history').append('<div class="incoming_msg" id="Msg_'+value.id+'">\
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>\
                        <div class="received_msg">\
                            <div class="received_withd_msg">\
                                <p>'+value.message+'</p>\
                                <span class="time_date">'+value.name+'</span>\
                                <a href="javascript:void(0);" onclick="deleteMessage('+value.id+');">X</a>\
                            </div>\
                        </div>\
                    <br></div>');
                    }else{
                        $('.msg_history').append('<div class="incoming_msg" id="Msg_'+value.id+'">\
                        <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>\
                        <div class="received_msg">\
                            <div class="received_withd_msg">\
                                <p>'+value.message+'</p>\
                                <span class="time_date">'+value.name+'</span>\
                            </div>\
                        </div>\
                    <br></div>');
                    }
                });
            $('.msg_history').scrollTop($(".msg_history")[0].scrollHeight);
            });

        };

        function deleteMessage(id){
            var host = window.location.origin;
            $.get(host+'/user/chat/delete_Message/'+id, function(data){
                socket.emit('deleteMessage', id);
            });
        }

        function deleteUser(id, chat_id){
            var host = window.location.origin;
            $.get(host+'/user/chat/delete_User/'+id+'/'+chat_id, function(data){
                socket.emit('deleteUser', id, chat_id);
            });
        }
    </script>
</head>
<body>

<!-- Modal -->
<div class="modal fade" id="UsersInChat" tabindex="-1" role="dialog" aria-labelledby="UsersInChat" aria-hidden="true">
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
            <button type="button" id="btn-users" class="btn btn-warning" data-toggle="modal" data-target="#UsersInChat" disabled><i class="fa fa-users"></i></button>
            <button type="button" id="btn-close" class="btn btn-warning">X
            </button>
            <div class="msg_history">
            </div>
          <div class="type_msg">
            <div class="input_msg_write">
                <form method="post" id="sendForm">
                    <?php echo csrf_field(); ?>
                    <input type="text" class="write_msg" placeholder="Type a message" name="message">
                    <button class="msg_send_btn" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<button type="button" id="btn-chat" class="btn btn-warning btn-circle btn-xl"><i class="fa fa-comment"></i>
</button>
<div class="container-fluid">
    <div class="row line-header"></div>
    <div class="col-md-10 col-md-offset-1">
        <div class="row middle-header">
            <div class="col-md-3 col-xs-12 tab-con">
                <div class="row">
                    <a href="/">
                        <img src="<?php echo e(get_option('site_logo')); ?>" alt="<?php echo e(get_option('site_title')); ?>" class="logo-icon"/>
                        <img src="<?php echo e(get_option('site_logo_type')); ?>" alt="<?php echo e(get_option('site_title')); ?>" class="logo-type"/>
                    </a>
                </div>
            </div>
            <div class="col-md-5 col-xs-12 tab-con">
                <div class="row search-box">
                    <form action="/search">
                        <?php echo e(csrf_field()); ?>

                        <input type="text" name="q" class="col-md-11 provider-json" placeholder="Search..."/>
                        <button type="submit" name="search" class="pull-left col-md-1"><span class="homeicon mdi mdi-magnify"></span></button>
                    </form>
                </div>
            </div>
            <div class="col-md-4 col-xs-12 text-center tab-con">
                <div class="row">
                    <?php if(isset($user) && isset($user['vendor']) && $user['vendor'] == 1): ?>
                        <a href="/user/content/new" class="header-upload-button pulse"><span class="headericon mdi mdi-arrow-up-bold"></span><?php echo e(trans('main.upload_course')); ?></a>
                    <?php endif; ?>
                    <?php if(isset($user)): ?>
                        <a href="/user" class="header-login-in-button">
                            <img src="<?php echo e($userMeta['avatar'] ?? get_option('default_user_avatar','')); ?>" class="user-header-avatar">
                            <span class="header-title-caption"><?php echo e($user['name']); ?></span>
                            <span class="headericon mdi mdi-chevron-down"></span>
                            <label class="alert">
                                <?php if(isset($alert['all']) && $alert['all']>0): ?>
                                    <span class="noti-holder"><?php echo e($alert['all']); ?></span>
                                <?php endif; ?>
                                <span class="noti-icon headericon mdi mdi-bell-alert"></span>
                            </label>
                            <label class="alert alert-f">
                                <?php if(isset($alert['ticket']) && $alert['ticket']>0): ?>
                                    <span><?php echo e($alert['ticket']); ?></span>
                                <?php endif; ?>
                                <i class="headericon mdi mdi-email"></i>
                            </label>
                            <div class="animated user-overlap sbox3">
                                <div class="overlap-profile-viewer">
                                    <?php if(isset($user) && isset($user['vendor']) && $user['vendor'] == 1): ?>
                                        <a href="/user/dashboard">
                                            <img src="<?php echo e(!empty($userMeta['avatar']) ? $userMeta['avatar'] : '/assets/default/images/user.png'); ?>" class="dash-s">
                                        </a>
                                    <?php else: ?>
                                        <a href="/user/content"><img src="<?php echo e(!empty($userMeta['avatar']) ? $userMeta['avatar'] : '/assets/default/images/user.png'); ?>" class="dash-s"></a>
                                    <?php endif; ?>
                                    <?php if(isset($user) && isset($user['vendor']) && $user['vendor'] == 1): ?>
                                        <div class="overlap-profile-viewer-info">
                                            <a href="/user/dashboard" class="dash-s2"><span><?php echo e(!empty($user['category']['title']) ? $user['category']['title'] : 'General User'); ?></span></a>
                                            <a href="/user/dashboard" class="btn btn-danger"><?php echo e(trans('main.user_panel')); ?></a>
                                        </div>
                                    <?php else: ?>
                                        <div class="overlap-profile-viewer-info">
                                            <a href="/user/video/buy" class="dash-s2"><span><?php echo e(!empty($user['category']['title']) ? $user['category']['title'] : 'General User'); ?></span></a>
                                            <a href="/user/video/buy" class="btn btn-danger"><?php echo e(trans('main.user_panel')); ?></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <ul>
                                    <li><a href="/profile/<?php echo e($user['id']); ?>"><span class="headericon mdi mdi-account"></span>
                                            <p><?php echo e(trans('main.profile')); ?></p></a></li>
                                    <li><a href="/user/ticket"><span class="headericon mdi mdi-headset"></span>
                                            <p><?php echo e(trans('main.support')); ?></p></a></li>
                                    <li><a href="/user/profile"><span class="headericon mdi mdi-settings"></span>
                                            <p><?php echo e(trans('main.settings')); ?></p></a></li>
                                    <li><a href="/logout"><span class="headericon mdi mdi-power"></span>
                                            <p><?php echo e(trans('main.exit')); ?></p></a></li>
                                </ul>
                            </div>
                        </a>
                    <?php else: ?>
                        <a href="/user?redirect=<?php echo e(Request::path()); ?>" class="header-login-button"><span class="headericon mdi mdi-account"></span><?php echo e(trans('main.login_signup')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row sep"></div>
    <div class="hidden-xs" id="header-menu-section">
        <div class="row">
            <div class="menu-header">

                <div class="col-md-1 text-center tab-con">
                    <a href="/"><img src="<?php echo e(get_option('site_logo')); ?>" class="menu-logo"/></a>
                </div>
                <div class="col-md-10 col-xs-12 tab-con">
                    <ul id="accordion" class="cat-filters-li accordion accordion-s">
                        <?php $__currentLoopData = $setting['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(count($mainCategory->childs)>0): ?>
                                <li class="has-child" onmouseover="this.style.borderColor='<?php echo e($mainCategory->color); ?>'" onmouseleave="this.style.borderColor='transparent'">
                                    <a href="javascript:void(0);">
                                        <img src="<?php echo e($mainCategory->image); ?>"/>
                                        <?php echo e($mainCategory->title); ?>

                                    </a>
                                    <ul>
                                        <?php $__currentLoopData = $mainCategory->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li onmouseover="this.style.borderColor='<?php echo e($child->color); ?>'" onmouseleave="this.style.borderColor='transparent'">
                                                <a href="/category/<?php echo e($child->class); ?>">
                                                    <img src="<?php echo e($child->image); ?>"/>
                                                    <?php echo e($child->title); ?>

                                                </a>
                                            </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <?php if($mainCategory->title == 'Forum' || $mainCategory->title == 'forum'): ?>
                                    <li class="no-child" onmouseover="this.style.borderColor='<?php echo e($mainCategory->color); ?>'" onmouseleave="this.style.borderColor='transparent'">
                                        <a href="/user/forum">
                                            <img src="<?php echo e($mainCategory->image); ?>"/>
                                            <?php echo e($mainCategory->title); ?>

                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li class="no-child" onmouseover="this.style.borderColor='<?php echo e($mainCategory->color); ?>'" onmouseleave="this.style.borderColor='transparent'">
                                        <a href="/category/<?php echo e($mainCategory->class); ?>">
                                            <img src="<?php echo e($mainCategory->image); ?>"/>
                                            <?php echo e($mainCategory->title); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

            </div>
            <div class="sep-green"></div>
            <div class="menu-header menu-header-child">

                <div class="col-md-10 col-xs-12 col-md-offset-1">
                    <ul>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="hidden-md hidden-lg hidden-sm mobile-menu">
        <div class="row h-20"></div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><b><?php echo e(trans('main.category')); ?></b></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <?php $__currentLoopData = $setting['category']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(count($mainCategory->childs)>0): ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo e($mainCategory->title); ?><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <?php $__currentLoopData = $mainCategory->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><a href="/category/<?php echo e($child->class); ?>"><?php echo e($child->title); ?></a></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php else: ?>
                                <li><a href="/category/<?php echo e($mainCategory->class); ?>"><?php echo e($mainCategory->title); ?></a></li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</div>


<?php /**PATH C:\Users\Samuel\Local Sites\proacademydos\app\resources\views/web/default/view/layout/header.blade.php ENDPATH**/ ?>