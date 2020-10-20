@extends(getTemplate().'.view.layout.layout')
@section('title')
{{ !empty($setting['site']['site_title']) ? $setting['site']['site_title'] : '' }}
- {{ $quiz->name }}
@endsection

@section('style')
<link rel="stylesheet" href="/assets/default/clock-counter/flipTimer.css" />
@endsection
@section('content')
<!-- MultiStep Form -->
<div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="btn-cerrar-test">
                    <a href="javascript:history.back()"><i class="fa fa-times-circle-o fa-4x"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="container-fluid">
        <div class="col-md-10 titulo-test">
            <div class="row">
                <div class="col-md-6">
                    <h3><b>{{ $quiz->name }}</b></h3>
                    <br>
                    <b>
                        <p>{{ count($quiz->questions) }} preguntas</p>
                    </b>
                </div>
                <div class="col-md-6">
                    <h1 class="pull-right">15:00</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container-fluid" id="grad1">
    <div class="row">
        <div class="col-xs-12 col-md-8 col-md-offset-2 quiz-wizard">
            <div class="card">

                <div class="row">
                    <div class="col-md-12">
                        <form id="quizForm" action="/user/quizzes/{{ $quiz->id }}/store_results" method="post"
                            class="quiz-form">
                            {{ csrf_field() }}
                            <input type="hidden" name="quiz_result_id" value="{{ $newQuizStart->id }}">
                            @foreach ($quiz->questions as $question)
                            @if($loop->iteration > 1)
                            <fieldset style="display: none;" id="pregunta{{$loop->iteration}}">
                                <input type="hidden" name="question[{{ $question->id }}]" value="{{ $question->id }}">
                                <div class="form-card">
                                    <h1 class="question-title"><b>{{ $loop->iteration }} - {{ $question->title }}</b></h1>
                                    @if ($question->type == 'multiple' and count($question->questionsAnswers))
                                    <div class="answer-items">
                                        @foreach ($question->questionsAnswers as $answer)
                                        @if(empty($answer->image))
                                        <div class="form-radio">
                                            <input id="asw{{ $answer->id }}" type="radio"
                                                name="question[{{ $question->id }}][answer]" value="{{ $answer->id }}">
                                            <label class="answer-label" for="asw{{ $answer->id }}">
                                                <span class="answer-title">{{ $answer->title }}</span>
                                            </label>
                                        </div>
                                        @elseif(!empty($answer->image))
                                        <div class="form-radio">
                                            <input id="asw{{ $answer->id }}" type="radio"
                                                name="question[{{ $question->id }}][answer]" value="{{ $answer->id }}">
                                            <label for="asw{{ $answer->id }}">
                                                <b>
                                                    <h2>{{$answer->title}}</h2>
                                                </b>
                                                <div class="image-container">
                                                    <img src="{{ $answer->image }}" class="fit-image" alt="">
                                                </div>
                                            </label>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    @elseif ($question->type == 'descriptive')
                                    <textarea name="question[{{ $question->id }}][answer]" rows="6"
                                        class="form-control textarea-respuestas-test"></textarea>
                                    @endif
                                </div>
                                <div class="card-actions d-flex align-items-center">
                                    @if ($loop->iteration > 1)
                                    <button type="button" class="action-button previous btn btn-custom" onclick="prev({{$loop->iteration}})">prev
                                        Step</button>
                                    @endif
                                    @if ($loop->iteration < $loop->count)
                                        <button type="button" class="action-button next btn btn-custom" onclick="next({{$loop->iteration}})">Next
                                            Step</button>
                                        @endif
                                        <button type="button"
                                            class="action-button finish btn btn-danger btn-danger-custom">finish</button>
                                </div>
                            </fieldset>
                            @else
                            <fieldset id="pregunta{{$loop->iteration}}">
                                <input type="hidden" name="question[{{ $question->id }}]" value="{{ $question->id }}">
                                <div class="form-card">
                                    <h1 class="question-title"><b>{{ $loop->iteration }} - {{ $question->title }}</b></h1>
                                    @if ($question->type == 'multiple' and count($question->questionsAnswers))
                                    <div class="answer-items">
                                        @foreach ($question->questionsAnswers as $answer)
                                        @if(empty($answer->image))
                                        <div class="form-radio">
                                            <input id="asw{{ $answer->id }}" type="radio"
                                                name="question[{{ $question->id }}][answer]" value="{{ $answer->id }}">
                                            <label class="answer-label" for="asw{{ $answer->id }}">
                                                <span class="answer-title">{{ $answer->title }}</span>
                                            </label>
                                        </div>
                                        @elseif(!empty($answer->image))
                                        <div class="form-radio">
                                            <input id="asw{{ $answer->id }}" type="radio"
                                                name="question[{{ $question->id }}][answer]" value="{{ $answer->id }}">
                                            <label for="asw{{ $answer->id }}">
                                                <b>
                                                    <h2>{{$answer->title}}</h2>
                                                </b>
                                                <div class="image-container">
                                                    <img src="{{ $answer->image }}" class="fit-image" alt="">
                                                </div>
                                            </label>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                    @elseif ($question->type == 'descriptive')
                                    <textarea name="question[{{ $question->id }}][answer]" rows="6"
                                        class="form-control textarea-respuestas-test"></textarea>
                                    @endif
                                </div>
                                <div class="card-actions d-flex align-items-center">
                                    @if ($loop->iteration > 1)
                                    <button type="button" class="action-button previous btn btn-custom" onclick="prev({{$loop->iteration}})">prev
                                        Step</button>
                                    @endif
                                    @if ($loop->iteration < $loop->count)
                                        <button type="button" class="action-button next btn btn-custom" onclick="next({{$loop->iteration}})">Next
                                            Step</button>
                                        @endif
                                        <button type="button"
                                            class="action-button finish btn btn-danger btn-danger-custom">finish</button>
                                </div>
                            </fieldset>
                            @endif
                            @endforeach
                        </form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="finishModal" class="modal fade modal-quiz" role="dialog">
    <div class="modal-dialog zinun modal-quiz-dialog">
        <!-- Modal content-->
        <div class="modal-content modal-sm">
            <div class="modal-body modst2">
                <p>{{ trans('main.finish_quiz_alert') }}</p>
                <div class="d-flex align-items-center qalrt">
                    <button id="SubmitResult" class=" btn btn-custom">
                        {{ trans('main.yes_sure') }}
                    </button>
                    <button type="button" data-dismiss="modal"
                        class="btn btn-danger-custom">{{ trans('main.cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="application/javascript" src="/assets/default/clock-counter/jquery.flipTimer.js"></script>
<script>
    "use strict";
    $(document).ready(function () {
       

        /*$(".previous").on('click', function () {

            current_fs = $(this).parent().parent();
            previous_fs = $(this).parent().parent().prev();

            previous_fs.show();


            current_fs.animate({
                opacity: 0
            }, {
                step: function (now) {
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });*/

        $('body').on('click', '.action-button.finish', function (e) {
            e.preventDefault();
            $('#finishModal').modal('show');
        });

        $('body').on('click', '#SubmitResult', function (e) {
            e.preventDefault();
            $('#quizForm').submit();
        });
    });
    function next(iteration){
        var current_fs = $('#pregunta'+iteration);
        var iterationnext = iteration + 1;
        var next_fs = $('#pregunta'+iterationnext);
        next_fs.show();
        current_fs.hide();
        /*current_fs.animate({
                step: function (now) {
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });*/
    }
    function prev(iteration){
        var current_fs = $('#pregunta'+iteration);
        var iterationprev = iteration - 1;
        var prev_fs = $('#pregunta'+iterationprev);
        prev_fs.show();
        current_fs.hide();
        /*current_fs.animate({
                step: function (now) {
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });*/
    }

</script>
@endsection
