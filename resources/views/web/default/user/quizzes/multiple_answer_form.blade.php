<div
    class="{{ (empty($answer) or (!empty($loop) and $loop->iteration == 1)) ? 'main-row-answer' : '' }} answer-box ans-b">
    <div class="col-md-12 answer-card">
        <div class="form-group">
            <label class="control-label tab-con">{{ trans('main.answer') }}</label>
            <a type="button"
                class="mrb12 btn btn-xs remove-btn btn-transparent pull-right {{ !empty($answer) ? 'show' : '' }}"
                style="color: red;"><i class="fa fa-minus"></i></a>

            <input type="text"
                name="answers[{{ (empty($answer) or (!empty($loop) and $loop->iteration == 1)) ? 'record' : $answer->id }}][title]"
                value="{{ !empty($answer) ? $answer->title : '' }}" placeholder="{{ trans('main.add_answer') }}"
                class="form-control">
            <div class="help-block"></div>
        </div>
        <div class="row">
            <div class="col-md-12 pull-left">
                <div class="form-group">
                    <label class="control-label">{{ trans('main.images') }}</label>
                    <div class="dflx">
                        <button type="button" data-input="answer_image" data-preview="holder"
                            class="lfm-btn btn btn-primary add-btn">
                            Choose
                        </button>
                        <input
                            name="answers[{{ (empty($answer) or (!empty($loop) and $loop->iteration == 1)) ? 'record' : $answer->id }}][image]"
                            value="{{ !empty($answer) ? $answer->image : '' }}" id="answer_image"
                            class="form-control lfm-input" dir="ltr" type="hidden">
                    </div>
                </div>
            </div>

            <div class="custom-switches-stacked col-md-12 pull-left">
                <label class="control-label tab-con">{{ trans('main.correct') }}</label>
                <label class="custom-switch">
                    <input type="hidden"
                        name="answers[{{ (empty($answer) or (!empty($loop) and $loop->iteration == 1)) ? 'record' : $answer->id }}][correct]"
                        value="0">
                    <input type="checkbox"
                        name="answers[{{ (empty($answer) or (!empty($loop) and $loop->iteration == 1)) ? 'record' : $answer->id }}][correct]"
                        value="1" class="custom-switch-input"
                        {{ (!empty($answer) and $answer->correct) ? 'checked' : '' }} />
                    <span class="custom-switch-indicator"></span>
                </label>
            </div>

        </div>
    </div>
</div>
