@extends(getTemplate().'.view.layout.layout')

@section('title')
{{ get_option('site_title','') }} - {{ !empty($category->title) ? $category->title : 'Categories' }}
@endsection

@section('content')

<div class="">
    @include(getTemplate() . '.user.parts.navigation')
    <div class="col-md-3">
        <h2 class="titulo-partials">Filtros</h2>
        <ul class="list-group">
            <a href="/user/dashboard/all" style="text-decoration: none;">
                <li class="list-group-item list-content-media"><b>Todos los cursos</b></li>
            </a>
            <br>
            <a href="/user/dashboard/inProcess" style="text-decoration: none;">
                <li class="list-group-item list-content-media"><b>Cursos en proceso</b></li>
            </a>
            <br>
            <a href="/user/dashboard/finished" style="text-decoration: none;">
                <li class="list-group-item list-content-media"><b>Cursos terminados</b></li>
            </a>
            <br>
            <a href="/user/quizzes" style="text-decoration: none;">
                <li class="list-group-item list-content-media list-active"><b>Calificaciones</b></li>
            </a>
        </ul>
    </div>
    <div class="col-md-9">
        <h2 class="titulo-partials">Resultados</h2>
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
                @foreach ($quizzes as $quiz)
                @if($quiz->comprado == true)
                <tr>
                    <td>
                        <a href="/product/{{$quiz->content->id}}">
                            <h4>{{ $quiz->content->title }}</h4>
                        </a>
                    </td>
                    <td>
                        <h4>{{ (!empty($quiz->result) and isset($quiz->result)) ? $quiz->result->user_grade : 'No grade' }}
                        </h4>
                        @if (!empty($quiz->result) and isset($quiz->result))
                        @if ($quiz->result->status == 'pass')
                        <span class="badge badge-success">{{ trans('main.passed') }}</span>
                        @elseif ($quiz->result->status == 'fail')
                        <span class="badge badge-danger">{{ trans('main.failed') }}</span>
                        @else
                        <span class="badge badge-warning">{{ trans('main.waiting') }}</span>
                        @endif
                        @else
                        <span class="badge badge-warning">{{ trans('main.no_term') }}</span>
                        @endif
                    </td>
                    <td>
                        @if(!empty($quiz->result) and isset($quiz->result))
                        @if($quiz->result->status == 'pass')
                        <a class="btn btn-ultimos-blogs btn-block"
                            href="certificates/{{$quiz->result->id}}/download">
                            <button class="btn btn-ultimos-blogs btn-block">
                                <h4><b>Certificado</b></h4>
                            </button>
                        </a>
                        @else
                        <button class="btn btn-ultimos-blogs btn-block" disabled>
                            <h4><b>Certificado</b></h4>
                        </button>
                        @endif
                        @else
                        <button class="btn btn-ultimos-blogs btn-block" disabled>
                            <h4><b>Certificado</b></h4>
                        </button>
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>            
</div>

<div id="quizzesDelete" class="modal fade" role="dialog">
    <div class="modal-dialog zinun">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3>{{ trans('main.delete') }}</h3>
            </div>
            <div class="modal-body modst">
                <p>{{ trans('main.quiz_delete_alert') }}</p>
                <div>
                    <a href="" class=" btn btn-danger delete">
                        {{ trans('main.yes_sure') }}
                    </a>
                    <button type="button" data-dismiss="modal" class="btn btn-info">{{ trans('main.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    "use strict";
    $('body').on('click', '.btn-delete-quiz', function (e) {
        e.preventDefault();
        var quiz_id = $(this).attr('data-id');
        $('#quizzesDelete').modal('show');
        $('#quizzesDelete').find('.delete').attr('href', '/user/quizzes/delete/' + quiz_id);
    })

</script>
@endsection
