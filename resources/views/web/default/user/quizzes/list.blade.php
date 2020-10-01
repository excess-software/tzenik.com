
@extends(getTemplate().'.view.layout.layout')

@section('title')
{{ get_option('site_title','') }} - {{ !empty($category->title) ? $category->title : 'Categories' }}
@endsection

@section('content')
<!-- @if($user->vendor)
<div class="row">
    <div class="accordion-off col-xs-12">
        <ul id="accordion" class="accordion off-filters-li">
            <li class="open">
                <div class="link">
                    <h2>{{ !empty($quiz) ? trans('main.edit_quizzes') : trans('main.create_new_quizzes') }}</h2>
                    <i class="mdi mdi-chevron-down"></i>
                </div>
                <ul class="submenu submenud">
                    <div class="h-10"></div>
                    <form action="/user/quizzes/{{ !empty($quiz) ? 'update/'.$quiz->id : 'store' }}" method="post"
                        class="form">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6 pull-left">
                                <div class="form-group @error('name') has-error @enderror">
                                    <label class="control-label tab-con">{{ trans('main.quiz_name') }}</label>
                                    <input type="text" name="name"
                                        value="{{ !empty($quiz) ? $quiz->name : old('name') }}" class="form-control">
                                    <div class="help-block">@error('name') {{ $message }} @enderror</div>
                                </div>
                            </div>

                            <div class="col-md-6 pull-left">
                                <div class="form-group @error('content_id') has-error @enderror">
                                    <label class="control-label tab-con">{{ trans('main.course') }}</label>
                                    <select name="content_id" class="form-control font-s">
                                        <option selected disabled>{{ trans('main.select_course') }}</option>
                                        @foreach($user->contents as $content)
                                        <option value="{{ $content->id }}"
                                            {{ (!empty($quiz) and $quiz->content_id == $content->id) ? 'selected' : '' }}>
                                            {{ $content->title }}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block">@error('content_id') {{ $message }} @enderror</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 pull-left">
                                <div class="form-group">
                                    <label class="control-label tab-con">{{ trans('main.quiz_time') }}
                                        ({{ trans('main.minute') }})</label>
                                    <input type="number" name="time"
                                        value="{{ !empty($quiz) ? $quiz->time : old('time') }}"
                                        placeholder="Empty means infinity" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6 pull-left">
                                <div class="form-group">
                                    <label class="control-label tab-con">{{ trans('main.quiz_number_attempt') }}</label>
                                    <input type="number" name="attempt"
                                        value="{{ !empty($quiz) ? $quiz->attempt : old('attempt') }}"
                                        placeholder="Empty means infinity" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 pull-left">
                                <div class="form-group @error('pass_mark') has-error @enderror">
                                    <label class="control-label tab-con">{{ trans('main.quiz_pass_mark') }}</label>
                                    <input type="number" name="pass_mark"
                                        value="{{ !empty($quiz) ? $quiz->pass_mark : old('pass_mark') }}"
                                        class="form-control">
                                    <div class="help-block">@error('pass_mark') {{ $message }} @enderror</div>
                                </div>
                            </div>

                            <div class="col-md-6 pull-left">
                                <div class="form-group">
                                    <label class="control-label tab-con">{{ trans('main.certificate') }}</label>
                                    <div class="switch switch-sm switch-primary swch">
                                        <input type="hidden" value="0" name="certificate">
                                        <input type="checkbox" name="certificate" value="1" data-plugin-ios-switch
                                            {{ (!empty($quiz) and $quiz->certificate) ? 'checked' : '' }} />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 pull-left">
                                <div class="form-group">
                                    <label class="control-label tab-con">{{ trans('main.status') }}</label>
                                    <select name="status" class="form-control font-s">
                                        <option value="disabled"
                                            {{ (!empty($quiz) and $quiz->status == 'disabled') ? 'selected' : '' }}>
                                            {{ trans('main.disabled') }}</option>
                                        <option value="active"
                                            {{ (!empty($quiz) and $quiz->status == 'active') ? 'selected' : '' }}>
                                            {{ trans('main.active') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 pull-left">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-custom mrt20">
                                        <span>{{ trans('main.save_changes') }}</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="h-10"></div>
                </ul>
            </li>

            @if (empty($quiz))
            <li class="open">
                <div class="link">
                    <h2>{{ trans('main.quizzes_list') }}</h2><i class="mdi mdi-chevron-down"></i>
                </div>
                <ul class="submenu dblock">
                    <div class="h-10"></div>
                    {{--count($lists)--}}
                    @if(empty($quizzes))
                    <div class="text-center">
                        <img src="/assets/default/images/empty/Request.png">
                        <div class="h-20"></div>
                        <span class="empty-first-line">{{ trans('main.no_quizzes') }}</span>
                        <div class="h-10"></div>

                        <div class="h-20"></div>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table ucp-table" id="request-table">
                            <thead class="thead-s">
                                <th class="cell-ta">{{ trans('main.name') }}</th>
                                <th class="text-center">{{ trans('main.students') }}</th>
                                <th class="text-center">{{ trans('main.questions') }}</th>
                                <th class="text-center">{{ trans('main.average_grade') }}</th>
                                <th class="text-center">{{ trans('main.review_needs') }}</th>
                                <th class="text-center">{{ trans('main.status') }}</th>
                                <th class="text-center" width="100">{{ trans('main.controls') }}</th>
                            </thead>
                            <tbody>
                                @foreach ($quizzes as $quiz)
                                <tr>
                                    <td class="text-center">
                                        {{ $quiz->name }}
                                        <small class="dblock">({{ $quiz->content->title }})</small>
                                    </td>
                                    <td class="text-center">{{ count($quiz->QuizResults) }}</td>
                                    <td class="text-center">{{ count($quiz->questions) }}</td>
                                    <td class="text-center">{{ $quiz->average_grade }}</td>
                                    <td class="text-center">{{ $quiz->review_needs }}</td>
                                    <td class="text-center">
                                        @if($quiz->status == 'active')
                                        <b class="c-g">{{ trans('admin.active') }}</b>
                                        @else
                                        <span class="c-r">{{ trans('admin.disabled') }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center" width="250">
                                        <a href="/user/quizzes/edit/{{ $quiz->id }}" class="gray-s"
                                            data-toggle="tooltip" title="{{ trans('main.edit_quizzes') }}"><span
                                                class="crticon mdi mdi-lead-pencil"></span></a>
                                        <a href="/user/quizzes/{{ $quiz->id }}/questions" class="gray-s"
                                            data-toggle="tooltip" title="{{ trans('main.questions') }}">
                                            <span class="crticon mdi mdi-account-question"></span>
                                        </a>
                                        <a href="/user/quizzes/{{ $quiz->id }}/results" class="gray-s"
                                            data-toggle="tooltip" title="{{ trans('main.show_results') }}">
                                            <span class="crticon mdi mdi-eye"></span>
                                        </a>
                                        <button data-id="{{ $quiz->id }}" class="gray-s btn-transparent btn-delete-quiz"
                                            data-toggle="tooltip" title="{{ trans('main.delete') }}"><span
                                                class="crticon mdi mdi-delete-forever"></span></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="h-10"></div>
                    @endif
                </ul>
            </li>
            @endif
        </ul>
    </div>
</div>
@else-->
<div class="container-full">
@include(getTemplate() . '.user.parts.navigation')

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
                                @foreach ($quizzes as $quiz)
                                <tr>
                                    <td>
                                        <a href="/product/{{$quiz->content->id}}"><h4>{{ $quiz->content->title }}</h4></a>
                                    </td>
                                    <td>
                                        <h4>{{ (!empty($quiz->result) and isset($quiz->result)) ? $quiz->result->user_grade : 'No grade' }}</h4>
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
                                                <a class="btn btn-ultimos-blogs btn-block" href="certificates/{{$quiz->result->id}}/download">
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
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- @endif -->

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
