@extends(getTemplate() . '.user.vendor.layout.layout')
@section('title')
{{{ trans('Edit quiz') }}}
@endsection
@section('page')

<section class="card">
    <div class="card-body">

        <form action="/user/quizzes/{{ !empty($quiz) ? 'update/'.$quiz->id : 'store' }}" method="post" class="form">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-6 pull-left">
                    <div class="form-group @error('name') has-error @enderror">
                        <label class="control-label tab-con">{{ trans('main.quiz_name') }}</label>
                        <input type="text" name="name" value="{{ !empty($quiz) ? $quiz->name : old('name') }}"
                            class="form-control">
                        <div class="help-block">@error('name') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>

            <div class="row">
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
                        <input type="number" name="time" value="{{ !empty($quiz) ? $quiz->time : old('time') }}"
                            placeholder="Empty means infinity" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
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
                            value="{{ !empty($quiz) ? $quiz->pass_mark : old('pass_mark') }}" class="form-control">
                        <div class="help-block">@error('pass_mark') {{ $message }} @enderror</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="custom-switches-stacked col-md-6">
                    <label class="control-label tab-con">{{ trans('main.certificate') }}</label>
                    <label class="custom-switch">
                        <input type="hidden" name="certificate" value="0">
                        <input type="checkbox" name="certificate" value="1" class="custom-switch-input"
                            {{ (!empty($quiz) and $quiz->certificate) ? 'checked' : '' }} />
                        <span class="custom-switch-indicator"></span>
                    </label>
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
            </div>

            <div class="row">
                <div class="col-md-6 pull-left">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <span>{{ trans('main.save_changes') }}</span>
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</section>
@endsection
