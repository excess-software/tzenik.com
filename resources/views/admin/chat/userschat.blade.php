@extends('admin.newlayout.layout',['breadcom'=>['Chat','Messages']])
@section('title')
    {{ trans('admin.chat_users_chat') }}
@endsection
@section('page')

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th>{{ trans('admin.chat_title') }}</th>
                    <th class="text-center">{{ trans('admin.chat_user') }}</th>
                    <th class="text-center">{{ trans('admin.th_controls') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($chat_users as $chat_u)
                    <tr>
                        <td>{{ $chat_u->Chat_Name }}</td>
                        <td class="text-center">{{ $chat_u->name}}</td>
                        <td class="text-center">
                            <a href="javascript:void(0);" onclick="deleteUser('{{ $chat_u->id }}', '{{ $chat_u->Chat_Id }}');" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

<script>
    var socket = io.connect('https://tzenik.com:8890');
    function deleteUser(id, chat_id){
            var host = window.location.origin;
            $.get(host+'/admin/chat/delete_User/'+id+'/'+chat_id, function(data){
                socket.emit('deleteUser', id, chat_id);
                location.reload();
            });
        }
</script>

@endsection

