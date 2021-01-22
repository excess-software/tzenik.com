@extends('admin.newlayout.layout',['breadcom'=>['Chat','Messages']])
@section('title')
{{ trans('admin.chat_messages') }}
@endsection
@section('page')
<link rel="stylesheet" href="/assets/default/vendor/font-awesome/css/font-awesome.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js" integrity="sha512-v8ng/uGxkge3d1IJuEo6dJP8JViyvms0cly9pnbfRxT6/31c3dRWxIiwGnMSWwZjHKOuY3EVmijs7k1jz/9bLA==" crossorigin="anonymous"></script>
<style>
    <style>

    #chat-test {
        bottom: 25px;
        right: 0px;
    }

    #btn-close {
        width: 20px;
        height: 20px;
        padding: 0;
        margin: 0;
        float: right;
    }

    #btn-users {
        width: 20px;
        height: 20px;
        padding: 0;
        margin: 0;
        margin-right: 5px;
        float: left;
    }

    #btn-deleteUser {
        width: 20px;
        height: 20px;
        padding: 0;
        margin: 0;
    }

</style>
<style>
    .container {
        max-width: 1170px;
        margin: auto;
    }

    img {
        max-width: 100%;
    }

    .inbox_people {
        background: #f8f8f8 none repeat scroll 0 0;
        float: left;
        overflow: hidden;
        width: 35%;
        border-right: 1px solid #c4c4c4;
    }

    .inbox_msg {
        clear: both;
        overflow: hidden;
    }

    .top_spac {
        margin: 20px 0 0;
    }


    .recent_heading {
        float: left;
        width: 40%;
    }

    .srch_bar {
        display: inline-block;
        text-align: right;
        width: 60%;
        padding:
    }

    .headind_srch {
        padding: 10px 29px 10px 20px;
        overflow: hidden;
        border-bottom: 1px solid #c4c4c4;
    }

    .recent_heading h4 {
        color: #05728f;
        font-size: 21px;
        margin: auto;
    }

    .srch_bar input {
        border: 1px solid #cdcdcd;
        border-width: 0 0 1px 0;
        width: 80%;
        padding: 2px 0 4px 6px;
        background: none;
    }

    .srch_bar .input-group-addon button {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: medium none;
        padding: 0;
        color: #707070;
        font-size: 18px;
    }

    .srch_bar .input-group-addon {
        margin: 0 0 0 -27px;
    }

    .chat_ib h5 {
        font-size: 25px;
        color: #464646;
        margin: 0 0 8px 0;
    }

    .chat_ib h5 span {
        font-size: 13px;
        float: right;
    }

    .chat_ib p {
        font-size: 14px;
        color: #989898;
        margin: auto;
    }

    .chat_img {
        float: left;
        width: 11%;
    }

    .chat_ib {
        float: left;
        padding: 0 0 0 15px;
        width: 88%;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .chat_people {
        overflow: hidden;
        clear: both;
    }

    .chat_list {
        border-bottom: 1px solid #c4c4c4;
        margin: 0;
        padding: 18px 16px 10px;
    }

    .inbox_chat {
        height: 550px;
        overflow-y: scroll;
    }

    .active_chat {
        background: #ebebeb;
    }

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

    .received_withd_msg {
        width: 57%;
    }

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
        margin: 0;
        color: #fff;
        padding: 5px 10px 5px 12px;
        width: 100%;
    }

    .outgoing_msg {
        overflow: hidden;
        margin: 26px 0 26px;
    }

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

    .type_msg {
        border-top: 1px solid #c4c4c4;
        position: relative;
    }

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

    .messaging {
        padding: 0 0 15px |;
    }

    .msg_history {
        height: 516px;
        overflow-y: auto;
    }

    .participants_header {
        margin: 0;
        padding: 0;
    }

</style>

<section class="card">
    <div class="card-body">
        <div id="chat-test">
            <input type="hidden" value="" id="chat_id">
            <div class="messaging">
                <div class="inbox_msg">
                    <div class="inbox_people">
                        <div class="headind_srch">
                            <div class="recent_heading">
                                <h4>Chats</h4>
                            </div>
                        </div>
                        <div class="inbox_chat">
                        </div>
                    </div>
                    <div class="mesgs">
                        <button type="button" id="btn-users" class="btn btn-warning" data-toggle="modal"
                            data-target="#UsersInChat"><i class="fa fa-users"></i></button>
                        </button>
                        <div class="msg_history">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="application/javascript" src="/assets/default/vendor/jquery/jquery.min.js"></script>
<script type="application/javascript" src="/assets/default/vendor/bootstrap/js/bootstrap.min.js"></script>
<script>
    var socket = io.connect('https://tzenik.com:8890');
    var host = window.location.origin;

    //Recepción desde Socket.io
    socket.on('messageDeleted', function(message_id){
        $('#Msg_'+message_id).remove();     
    });

    socket.on('userDeleted', function(user_id, chat_id){
        $('#liUser_'+user_id).remove();
    });

    $.get(host+'/admin/chat', function(data){
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

    function callChat(id){
        var host = window.location.origin;
        var ownerid = '';
        $('.msg_history').html('');
        $('#chat_id').val(id);
        $('.chat_list').removeClass('active_chat');
        $('#chatNo_'+id).addClass('active_chat');

        //Obtener id del creador del chat
        $.get(host+'/admin/chat/get_Owner/'+id, function(data){
            ownerid = data;
            sessionStorage.ownerid = ownerid;
            console.log(sessionStorage.ownerid);
            sessionStorage.chat_id = id;
        });

        $.get(host+'/admin/chat/get_Users/'+id, function(data){
            $('#UsersInChat-Body').html('');
            $.each(data, function(key, value){
                if(ownerid == value.id){
                    $('#UsersInChat-Body').append('<li class="list-group-item">'+value.name+'</li>');
                }else{
                    $('#UsersInChat-Body').append('<li class="list-group-item" id="liUser_'+value.id+'"><a href="javascript:void(0);" onclick="deleteUser('+value.id+', '+id+');"><button class="btn btn-warning" id="btn-deleteUser">X</button></a> '+value.name+'</li>');
                }
            });
        });


        $.get(host+'/admin/chat/Chat/'+id, function(data){
            $.each(data, function(key, value){
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
            });
        $('.msg_history').scrollTop($(".msg_history")[0].scrollHeight);
        });

    };

    function deleteMessage(id) {
        $.get(host + '/admin/chat/delete_Message/' + id, function (data) {
            socket.emit('deleteMessage', id);
        });
    }

    function deleteUser(id, chat_id){
            var host = window.location.origin;
            $.get(host+'/admin/chat/delete_User/'+id+'/'+chat_id, function(data){
                socket.emit('deleteUser', id, chat_id);
            });
        }

</script>

@endsection
