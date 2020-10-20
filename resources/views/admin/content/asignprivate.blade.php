@extends('admin.newlayout.layout',['breadcom'=>['Courses','Latest Courses']])
@section('title')
{{ trans('admin.course_list') }}
@endsection
@section('page')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<section class="card">
    <header class="card-header">
        <h2 class="card-title">Asignar usuarios a cursos privados</h2>
    </header>
    <div class="card-body">
        <form action="/admin/content/asignar" method="post">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <select id="curso" class="form-control populate" name="curso" onChange="getUsers(this.value);">
                            <option>Seleccione curso</option>
                            @foreach($lists as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Usuarios de Fundal</h4>
                    <div id="listado">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="form-group">
                        <button type="submit" class="text-center btn btn-primary w-50">Asignar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<hr>
<section class="card">
    <div class="card-body">
        <table id="tabla" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Usuario</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asignados as $asignado)
                <tr>
                    @foreach($lists as $item)
                        @if($item->id == $asignado[0])
                            <td>{{$item->title}}</td>
                        @endif
                    @endforeach
                    @foreach($users as $user)
                        @if($user->id == $asignado[1])
                            <td>{{$user->username.' - '.$user->name}}</td>
                        @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer text-center">
    </div>
</section>
<script>
    /*function setLink(curso, user) {
        $('#asignar').attr('href', '/admin/content/asignar/' + curso + '/' + user);
    }

    function setData() {
        var curso = $('#curso').val();
        var user = $('#usuario').val();
        console.log(user);
        setLink(curso, user);
    }*/

    function getUsers(curso) {
        $.ajax({
            type: 'GET',
            url: "/admin/content/private/getUsers/" + curso,
            dataType: "json",
            success: function (data) {
                var html = '';
                for (i = 0; i < data.length; i++) {
                    html += '<div class="checkbox">\
                        <label><input type="checkbox" name="usuarios[]" value="' + data[i][0] + '"> ' + data[i][2] +
                        ' - ' + data[i][1] + '</input></label>\
                    </div>';
                }
                $('#listado').html(html);
            }
        });
    }

    $(document).ready(function () {
        $('#tabla').DataTable();
    });

</script>
@endsection
