<form id="multipleAnswer" action="@if (!empty($question_edit)) /user/questions/{{ $question_edit->id }}/update @else /user/quizzes/{{ $quiz->id }}/questions @endif" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="type" value="multiple">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group @error('title') has-error @enderror">
                <label class="control-label tab-con">{{ trans('main.question_title') }}</label>
                <input type="text" name="title" value="{{ !empty($question_edit) ? $question_edit->title : '' }}" placeholder="{{ trans('main.question_title') }}" class="form-control">
                <div class="help-block">@error('title') {{ $message }} @enderror</div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group @error('grade') has-error @enderror">
                <label class="control-label tab-con">{{ trans('main.question_grade') }}</label>
                <input type="number" name="grade" value="{{ !empty($question_edit) ? $question_edit->grade : '' }}" placeholder="{{ trans('main.question_grade') }}" class="form-control">
                <div class="help-block">@error('grade') {{ $message }} @enderror</div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="ansalrt">
                <p>{{ trans('main.answer_alert') }}</p>
                <button type="button" class="btn add-btn btn-info marl-16 btn-block"><i class="fa fa-plus"></i></button>
            </div>
            <br>

            @if (!empty($question_edit))
                @foreach ($question_edit->questionsAnswers as $answer)
                    @include(getTemplate() .'.user.quizzes.multiple_answer_form',['answer' => $answer])
                @endforeach

            @else
                @include(getTemplate() .'.user.quizzes.multiple_answer_form')
            @endif
        </div>
    </div>
</form>
