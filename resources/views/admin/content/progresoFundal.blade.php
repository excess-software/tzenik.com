@extends('admin.newlayout.layout',['breadcom'=>['Courses','Latest Courses']])
@section('page')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<section class="card">
    <header class="card-header">
        <h2 class="card-title">Progreso de los alumnos</h2>
    </header>
    <div class="card-body">
        <table id="tabla" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Usuario</th>
                    <th>Duraci&oacute;n</th>
                    <th>Progreso</th>
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
                    <td>{{$asignado[2].' / '.$asignado[3]}}</td>
                    <td class="text-center">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="{{$asignado[4]}}" aria-valuemin="0"
                                aria-valuemax="100" style="width:{{$asignado[4]}}%">
                                <b>{{round($asignado[4])}}%</b>
                            </div>
                        </div>
                    </td>
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
