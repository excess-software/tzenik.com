@extends(getTemplate() . '.user.vendor.layout.layout')
@section('page')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<section class="card">
    <header class="card-header">
        <h2 class="card-title">{{$content_title}} - {{$part_title}} - {{$title}}</h2>
    </header>
    <div class="card-body">
        <table id="tabla" class="display" style="width:100%">
            <thead class="text-center">
                <tr>
                    <th>Usuario</th>
                    <th>Ver tarea</th>
                    <th>Marcar de recibido</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($homeworks as $homework)
                <tr>
                    <td>{{$homework->user}}</td>
                    <td><a class="btn block-btn btn-info" href="{{$homework->route}}" target="_blank">Abrir</a></td>
                    <td id="btn-recibida-{{$homework->id}}">
                    @if(!isset($homework->viewed))
                        <button class="btn btn-warning" onclick="recibir({{$homework->id}})">Marcar Recibida</button>
                    @else
                        <button class="btn btn-success" disabled>Recibida</button>
                    @endif
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

    function recibir(tarea) {
        console.log('ejecutada');
        $.ajax({
            type: 'GET',
            url: "/user/vendor/content/tarea/" + tarea + "/recibir" ,
            dataType: "json",
            success: function (data) {
                $('#btn-recibida-' + tarea).html('<button class="btn btn-success" disabled>Recibida</button>');
                console.log(tarea);
            }
        });
    }

    $(document).ready(function () {
        $('#tabla').DataTable();
    });

</script>
@endsection
