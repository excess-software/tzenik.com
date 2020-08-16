@extends('admin.newlayout.layout',['breadcom'=>['Chat','Messages']])
@section('title')
    {{ trans('admin.chat_messages') }}
@endsection
@section('page')

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th>{{ trans('admin.chat_title') }}</th>
                    <th class="text-center">{{ trans('admin.author') }}</th>
                    <th class="text-center">{{ trans('admin.chat_message') }}</th>
                    <th class="text-center">{{ trans('admin.th_controls') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                    <tr>
                        <td>{{ $message->Chat_Title }}</td>
                        <td class="text-center">{{ $message->name}}</td>
                        <td class="text-center">{{ $message->message }}</td>
                        <td class="text-center">
                            <a href="javascript:void(0);" onclick="deleteMessage('{{ $message->id }}');" title="Delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

<script>
    var socket = io.connect('http://localhost:8890');
    function deleteMessage(id){
        var host = window.location.origin;
        $.get(host+'/admin/chat/delete_Message/'+id, function(data){
            socket.emit('deleteMessage', id);
            location.reload();
        });
    }
</script>

@endsection

