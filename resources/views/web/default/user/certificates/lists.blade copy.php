@extends(getTemplate() . '.user.layout_user.quizzes')

@section('content')
    <div class="h-20"></div>
    <div class="off-filters-li" style="padding: 15px">
        <div class="table-responsive">
            <table class="table ucp-table" id="request-table">
                <thead class="thead-s">
                <th class="cell-ta">{{ trans('main.name') }}</th>
                <th class="text-center">{{ trans('main.course') }}</th>
                <th class="text-center">{{ trans('main.you_grade') }}</th>
                <th class="text-center">{{ trans('main.quiz_grade') }}</th>
                <th class="text-center">{{ trans('main.time_and_date') }}</th>
                <th class="text-center">{{ trans('main.controls') }}</th>
                </thead>
                <tbody>
                @foreach ($certificates as $certificate)
                    <tr>
                        <td class="text-center">{{ $certificate->quiz->name }}</td>
                        <td class="text-center">{{ $certificate->quiz->content->title }}</td>
                        <td class="text-center">{{ $certificate->user_grade }}</td>
                        <td class="text-center">{{ $certificate->quiz->pass_mark }}</td>
                        <td class="text-center">{{ date('Y-m-d | H:i', $certificate->created_at) }}</td>
                        <td class="text-center">
                            <a href="/user/certificates/{{ $certificate->id }}/download" class="btn btn-success btn-round">{{ trans('main.download') }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="container-full">
    <ul class="nav nav-tabs nav-justified">
        <li role="presentation"><a class="nav-home" href="#"><i class="fa fa-home"></i> Tablero</a></li>
        <li role="presentation" class="active"><a class="nav-home" href="#"><i class="fa fa-book"></i> Cursos</a>
        </li>
        <li role="presentation"><a class="nav-home" href="#"><i class="fa fa-calendar"></i> Calendario</a></li>
    </ul>

    <br>

    <div class="row contenido-cursos-dash">
        <div class="container-fluid">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3">
                        <h2><b>Filtros</b></h2>
                        <ul class="list-group">
                            <li class="list-group-item list-content-media"><b>Todos los cursos</b></li>
                            <br>
                            <li class="list-group-item list-content-media"><b>Cursos en proceso</b></li>
                            <br>
                            <li class="list-group-item list-content-media"><b>Cursos terminados</b></li>
                            <br>
                            <li class="list-group-item list-content-media list-active"><b>Calificaciones</b></li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <h2><b>Resultados</b></h2>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <h3><b>Curso</b> </h3>
                                    </th>
                                    <th scope="col">
                                        <h3><b>Nota</b> </h3>
                                    </th>
                                    <th scope="col">
                                        <h3><b>Extras</b> </h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h4></h4>
                                    </td>
                                    <td>
                                        <h4></h4>
                                    </td>
                                    <td><button class="btn btn-ultimos-blogs btn-block" disabled>
                                            <h4><b>Certificado</b></h4>
                                        </button></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
