@extends(getTemplate().'.view.layout.layout')

@section('title')
    {{ get_option('site_title','chats') }} - {{ !empty($category->title) ? $category->title : 'Categories' }}
@endsection
@section('content')

    <div class="">
        @include(getTemplate() . '.user.parts.navigation')

        <div class="row ">
            <div class="">
                <div class="col-md-12">
                    <h2 class="titulo-partials">Chat</h2>
                    <div class="row">
                        <div id="chat-test2">
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
                                        <button type="button" id="btn-users" class="btn btn-chatCustom" data-toggle="modal"
                                                data-target="#UsersInChat" disabled><i class="fa fa-users"></i></button>
                                        <button type="button" id="btn-close" class="btn btn-chatCustom">X
                                        </button>
                                        <div class="msg_history">
                                        </div>
                                        <div class="type_msg">
                                            <div class="input_msg_write">
                                                <form method="post" id="sendForm">
                                                    @csrf
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
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
@section('script')
            <script src="https://cdn.socket.io/socket.io-3.0.1.min.js"></script>
            @if(isset($user))
                <script>
                    var socket = io.connect('https://www.tzenik.com/', {path: '/socket.io/'});
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

                        $('#btn-users').hide();
                        //Funciones Socket.io
                        $('.msg_send_btn').click(function () {
                            var this_chat_id = $('#chat_id').val();
                            if ($('.write_msg').val() != '') {
                                var message = $('.write_msg').val();
                                $.post(host + '/user/chat/send_Message/' + this_chat_id, $('#sendForm').serialize(),
                                    function (id) {
                                        message_id = id;
                                        console.log(message);
                                        console.log('message_id='+id);
                                        socket.emit('sendMessage', message, "{{ $user['name'] }}", this_chat_id, id);
                                    });
                                $('.write_msg').val('');
                            } else {
                                $('.write_msg').focus();
                            }
                            return false;
                        });
                        socket.on('receiveMessage', function (message, sender, chat_id, message_id) {
                            var this_chat_id = $('#chat_id').val();
                            if (chat_id == this_chat_id) {
                                if (sessionStorage.ownerid == "{{ $user['id'] }}") {
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
                            if (user_id == "{{ $user['id'] }}") {
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
                            if (ownerid == "{{ $user['id'] }}") {
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
                                if (ownerid == "{{ $user['id'] }}") {
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
    @endif
@endsection
