@extends(getTemplate().'.user.layout.sendvideolayout')

@section('pages')
<style>
    #loadingImage {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('/assets/images/loading.gif') 50% 50% no-repeat;
    }

</style>
<input type="hidden" value="1" id="current_step">
<input type="hidden" value="{{{ $item->id ?? 0 }}}" id="edit_id">
<div class="container" style="padding-top: 15%; padding-bottom: 15%;">
    <div class="row white-rounded-back">
        <div class="col-md-3">
            <ul class="list-group partes-nuevo-curso">
                <li class="list-group-item active" cstep="1"><a href="javascript:void(0);"><span
                            class="upicon mdi mdi-library-video"></span><span>
                            {{ trans('main.general') }}</span></a>
                </li>
                <li class="list-group-item" cstep="2"><a href="javascript:void(0);"><span
                            class="upicon mdi mdi-apps"></span><span> {{ trans('main.category') }}</span></a></li>
                <li class="list-group-item" cstep="3"><a href="javascript:void(0);"><span
                            class="upicon mdi mdi-library-books"></span><span>
                            {{ trans('main.extra_info') }}</span></a>
                </li>
                <li class="list-group-item" cstep="4"><a href="javascript:void(0);"><span
                            class="upicon mdi mdi-folder-image"></span><span> {{ trans('main.view') }}</span></a>
                </li>
                <li class="list-group-item" cstep="5"><a href="javascript:void(0);"><span
                            class="upicon mdi mdi-movie-open"></span><span> {{ trans('main.parts') }}</span></a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            <div class="steps" id="step1">
                <form method="post" id="step-1-form" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault">{{{ trans('main.course_type') }}}</label>
                        <div class="col-md-10 tab-con">
                            <select name="type" class="form-control font-s">
                                <option value="webinar" @if(isset($item) && $item->type == 'webinar') selected
                                    @endif>{{{ trans('main.webinar') }}}</option>
                                <option value="coaching" @if(isset($item) && $item->type == 'coaching') selected
                                    @endif>{{{ trans('main.coaching') }}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault">Suscritos</label>
                        <div class="col-md-2 tab-con">
                            <input type="text" name="subs_limit" class="form-control" value="{{ $item->subs_limit ?? '' }}"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault">{{{ trans('main.course_title') }}}</label>
                        <div class="col-md-10 tab-con">
                            <input type="text" name="title" placeholder="Course Title..." class="form-control"
                                value="{{{ $item->title ?? '' }}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault">{{{ trans('main.description') }}}</label>
                        <div class="col-md-10 tab-con">
                            <textarea class="form-control" placeholder="You can import HTML..."
                                name="content" required>{!! $item->content ?? '' !!}</textarea>
                        </div>
                    </div>
                </form>
                <form method="post" class="form-horizontal" id="step-1-form-meta">
                    {{ csrf_field() }}
                </form>
            </div>
            <div class="steps dnone" id="step2">
                <form method="post" id="step-2-form" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="alert alert-success">
                        <p>{{{ trans('main.tags_header') }}}</p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label tab-con"
                            for="inputDefault">{{{ trans('main.tags') }}}</label>
                        <div class="col-md-10 tab-con">
                            <input type="text" data-role="tagsinput" placeholder="Press enter to save tag." name="tag"
                                value="{{{ $item->tag ?? ''}}}" class="form-control text-center">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label tab-con"
                            for="inputDefault">{{{ trans('main.category') }}}</label>
                        <div class="col-md-10 tab-con">
                            <select name="category_id" id="category_id" class="form-control font-s" required>
                                @if($item->type == 'webinar')
                                <option value="35" selected>{{{ trans('main.webinar') }}}</option>
                                @elseif($item->type == 'coaching')
                                <option value="36" selected>{{{ trans('main.coaching') }}}</option>
                                @endif
                                @foreach($menus as $menu)
                                @if($menu->parent_id == 0)
                                <optgroup label="{{{ $menu->title ?? '' }}}">
                                    @if(count($menu->childs)>0)
                                    @foreach($menu->childs as $sub)
                                    <option value="{{{ $sub->id ?? '' }}}" @if($sub->id == $item->category_id)
                                        selected @endif>{{{ $sub->title ?? '' }}}</option>
                                    @endforeach
                                    @else
                                    <option value="{{{ $menu->id ?? '' }}}" @if($menu->id == $item->category_id)
                                        selected @endif>{{{ $menu->title ?? '' }}}</option>
                                    @endif
                                </optgroup>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="h-15"></div>
                    <div class="alert alert-success">
                        <p>{{{ trans('main.filters_header') }}}</p>
                    </div>
                    <div class="h-15"></div>
                    @foreach($menus as $menu)
                    <div class="col-md-11 col-md-offset-1 tab-con filters dnone" @if($menu->id !=
                        $item->category_id) class="dnone" @endif id="filter{{{ $menu->id ?? 0 }}}">
                        @foreach($menu->filters as $filter)
                        <div class="col-md-3 col-xs-12 tab-con">
                            <h5>{{{ $filter->filter ?? '' }}}</h5>
                            <hr>
                            <ul class="cat-filters-li pamaz">
                                <ul class="submenu submenu-s">
                                    @foreach($filter->tags as $tag)
                                    <li class="second-input"><input type="checkbox" class="filter-tags dblock"
                                            id="tag{{{ $tag->id ?? '' }}}" name="filters[]"
                                            value="{{{ $tag->id ?? 0 }}}" @if(isset($item->filters) &&
                                        in_array($tag->id,$item->filters->pluck('id')->toArray())) checked
                                        @endif><label
                                            for="tag{{{ $tag->id ?? '' }}}"><span></span>{{{ $tag->tag ?? '' }}}</label>
                                    </li>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </form>
            </div>
            <div class="steps dnone" id="step3">
                <form method="post" id="step-3-form" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-5 tab-con col-md-offset-1 dinb" " for="
                            inputDefault">{{{ trans('main.free_course') }}}</label>
                        <div class="col-md-6 tab-con">
                            <div class="switch switch-sm switch-primary pull-left">
                                <input type="hidden" value="1" name="price">
                                <input type="checkbox" name="price" id="free" value="0" data-plugin-ios-switch
                                    @if($item->price != null && $item->price == 0) checked="checked" @endif />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label
                            class="control-label col-md-5 tab-con col-md-offset-1 dinb">{{{ trans('main.vendor_postal_sale') }}}</label>
                        <div class="col-md-6 tab-con">
                            <div class="switch switch-sm switch-primary pull-left" id="post_toggle">
                                <input type="hidden" value="0" name="post">
                                <input type="checkbox" name="post" value="1" data-plugin-ios-switch @if($item->post
                                == 1) checked="checked" @endif />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label tab-con col-md-5 col-md-offset-1 dinb"
                            for="inputDefault">{{{ trans('main.support') }}}</label>
                        <div class="col-md-6 tab-con">
                            <div class="switch switch-sm switch-primary pull-left">
                                <input type="hidden" value="0" name="support">
                                <input type="checkbox" name="support" value="1" data-plugin-ios-switch
                                    @if($item->support == 1) checked="checked" @endif />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label tab-con col-md-5 col-md-offset-1 dinb"
                            for="inputDefault">{{{ trans('main.download') }}}</label>
                        <div class="col-md-6 tab-con">
                            <div class="switch switch-sm switch-primary pull-left">
                                <input type="hidden" value="0" name="download">
                                <input type="checkbox" name="download" value="1" data-plugin-ios-switch
                                    @if($item->download == 1) checked="checked" @endif />
                            </div>
                        </div>
                    </div>
                </form>
                <form method="post" id="step-3-form-meta" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="h-10"></div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">{{{ trans('main.price') }}}</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price" onkeypress="validate(event)"
                                    value="{{{$meta['price'] ?? ''}}}" class="form-control text-center numtostr"
                                    @if($item->price === 0) disabled @endif>
                                <span
                                    class="input-group-addon click-for-upload img-icon-s">{{{ currencySign() }}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">{{{ trans('main.postal_price') }}}</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="post_price" onkeypress="validate(event)"
                                    value="{{{$meta['post_price'] ?? ''}}}" class="form-control text-center numtostr"
                                    @if($item->post != 1) disabled @endif>
                                <span
                                    class="input-group-addon click-for-upload img-icon-s">{{{ currencySign() }}}</span>
                            </div>
                        </div>
                    </div>
                </form>
                <form method="post" id="step-3-form-subscribe" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">3 Months Subscribe Price</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price_3" onkeypress="validate(event)"
                                    value="{{{ $item->price_3 ?? ''}}}" class="form-control text-center">
                                <span
                                    class="input-group-addon click-for-upload img-icon-s">{{{ currencySign() }}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">6 Months Subscribe Price</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price_6" onkeypress="validate(event)"
                                    value="{{{ $item->price_6 ?? ''}}}" class="form-control text-center">
                                <span
                                    class="input-group-addon click-for-upload img-icon-s">{{{ currencySign() }}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">9 Months Subscribe Price</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price_9" onkeypress="validate(event)"
                                    value="{{{ $item->price_9 ?? ''}}}" class="form-control text-center">
                                <span
                                    class="input-group-addon click-for-upload img-icon-s">{{{ currencySign() }}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">12 Months Subscribe Price</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price_12" onkeypress="validate(event)"
                                    value="{{{ $item->price_12 ?? ''}}}" class="form-control text-center">
                                <span
                                    class="input-group-addon click-for-upload img-icon-s">{{{ currencySign() }}}</span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="h-15"></div>
                <div class="alert alert-success">
                    <p>{{{ trans('main.prerequisites_desc') }}}</p>
                </div>
                <a class="btn btn-custom pull-left" data-toggle="modal"
                    href="#modal-pre-course"><span>{{{ trans('main.select_prerequisites') }}}</span></a>
                <div class="modal fade" id="modal-pre-course">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title">{{{ trans('main.select_prerequisites') }}}</h4>
                            </div>
                            <div class="modal-body no-absolute-content">
                                <form method="post" id="step-3-form-precourse">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="precourse" id="precourse"
                                        value="{{{ $meta['precourse'] ?? '' }}}">
                                </form>
                                <ul class="pre-course-title-container">
                                    @foreach($preCourse as $prec)
                                    <li>{{{ $prec->title ?? '' }}}&nbsp;(VT-{{{ $prec->id ?? 0 }}})<i
                                            class="fa fa-times delete-course" cid="{{{ $prec->id ?? 0 }}}"></i></li>
                                    @endforeach
                                </ul>
                                <input type="text" class="form-control provider-json-pre-course"
                                    placeholder="Type 3 characters to load courses list.">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-custom pull-left"
                                    data-dismiss="modal">{{{ trans('main.close') }}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="steps dnone" id="step4">
                <form method="post" class="form-horizontal" id="step-4-form-meta">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con">{{{ trans('main.course_cover') }}}</label>
                        <div class="col-md-10 tab-con">
                            <div class="input-group">
                                <span class="input-group-addon view-selected img-icon-s" data-toggle="modal"
                                    data-target="#ImageModal" data-whatever="cover" "><span class=" formicon mdi
                                    mdi-eye"></span></span>
                                <input type="text" name="cover" placeholder="Prefered :410*730px" dir="ltr"
                                    value="{{{$meta['cover'] ?? ''}}}" class="form-control">
                                <span class="input-group-addon click-for-upload img-icon-s"><span
                                        class="formicon mdi mdi-arrow-up-thick"></span></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con">{{{ trans('main.course_thumbnail') }}}</label>
                        <div class="col-md-10 tab-con">
                            <div class="input-group">
                                <span class="input-group-addon view-selected img-icon-s" data-toggle="modal"
                                    data-target="#ImageModal" data-whatever="thumbnail"><span
                                        class="formicon mdi mdi-eye"></span></span>
                                <input type="text" name="thumbnail" placeholder="Prefered :155*263px" dir="ltr"
                                    value="{{{$meta['thumbnail'] ?? ''}}}" class="form-control">
                                <span class="input-group-addon click-for-upload img-icon-s"><span
                                        class="formicon mdi mdi-arrow-up-thick"></span></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con">{{{ trans('main.demo') }}}</label>
                        <div class="col-md-10 tab-con">
                            <div class="input-group">
                                <span class="input-group-addon view-selected img-icon-s" data-toggle="modal"
                                    data-target="#VideoModal" data-whatever="video"><span
                                        class="formicon mdi mdi-eye"></span></span>
                                <input type="text" name="video" placeholder="Prefered :1-3 mins" dir="ltr"
                                    value="{{{$meta['video'] ?? ''}}}" class="form-control">
                                <span class="input-group-addon click-for-upload img-icon-s"><span
                                        class="formicon mdi mdi-arrow-up-thick"></span></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con">{{{ trans('main.documents') }}}</label>
                        <div class="col-md-10 tab-con">
                            <div class="input-group document-input">
                                <span class="input-group-addon view-selected img-icon-s"
                                    onclick="window.open($('#document-addon').val(),'_balnk');"><span
                                        class="formicon mdi mdi-eye"></span></span>
                                <input type="text" name="document" id="document-addon" dir="ltr"
                                    value="{{{$meta['document'] ?? ''}}}" class="form-control">
                                <span class="input-group-addon click-for-upload document-input-icon img-icon-s"><span
                                        class="formicon mdi mdi-arrow-up-thick"></span></span>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="steps dnone" id="step5">
                <div class="accordion-off">
                    <ul id="accordion" class="accordion off-filters-li">
                        <li class="open edit-part-section dnone">
                            <div class="link edit-part-click">
                                <h2>{{{ trans('main.edit_part') }}}</h2><i class="mdi mdi-chevron-down"></i>
                            </div>
                            <div class="submenu dblock">
                                <div class="h-15"></div>
                                <input type="hidden" id="part-edit-id">
                                <form action="/user/content_web_coach/part/edit/store/" id="step-5-form-edit-part"
                                    method="post" class="form-horizontal">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="content_id" value="{{{ $item->id ?? '' }}}">

                                    <div class="form-group">
                                        <label
                                            class="control-label col-md-2 tab-con">{{{ trans('main.date_webinar_coach') }}}</label>
                                        <div class="col-md-3 tab-con">
                                            <input type="text" class="form-control datetimepicker-input"
                                                id="datetimepicker_date_edit" data-toggle="datetimepicker"
                                                data-target="#datetimepicker_date_edit" name="date" />
                                        </div>
                                        <label
                                            class="control-label tab-con col-md-1">{{{ trans('main.time_webinar_coach') }}}</label>
                                        <div class="col-md-2 tab-con">
                                            <input type="text" class="form-control datetimepicker-input"
                                                id="datetimepicker_time_edit" data-toggle="datetimepicker"
                                                data-target="#datetimepicker_time_edit" name="time" />
                                        </div>
                                        <label
                                            class="control-label tab-con col-md-1">{{{ trans('main.duration') }}}</label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="number" min="0" name="duration"
                                                    class="form-control text-center" required>
                                                <span
                                                    class="input-group-addon img-icon-s">{{{ trans('main.minute') }}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label
                                            class="control-label tab-con col-md-2">{{{ trans('main.webinar_coach_mail') }}}</label>
                                        <div class="col-md-3 tab-con">
                                            <input class="form-control" type="text" name="mail">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-2"
                                            for="inputDefault">{{{ trans('main.description') }}}</label>
                                        <div class="col-md-10 tab-con">
                                            <textarea class="form-control" rows="4" name="description"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-2"
                                            for="inputDefault">{{{ trans('main.title') }}}</label>
                                        <div class="col-md-8 tab-con">
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                        <div class="col-md-2 tab-con">
                                            <button class="btn btn-custom tab-con pull-left" id="edit-part-submit"
                                                type="submit">{{{ trans('main.save_changes') }}}</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="h-15"></div>
                            </div>
                        </li>
                        <li class="open">
                            <div class="link new-part-click">
                                <h2>{{{ trans('main.new_part') }}}</h2><i class="mdi mdi-chevron-down"></i>
                            </div>
                            <div class="submenu dblock">
                                <div class="h-15"></div>
                                <form action="/user/content/web_coach/part/store" id="step-5-form-new-part"
                                    method="post" class="form-horizontal">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="content_id" value="{{{ $item->id ?? '' }}}">

                                    <div class="form-group">
                                        <label
                                            class="control-label col-md-2 tab-con">{{{ trans('main.date_webinar_coach') }}}</label>
                                        <div class="col-md-3 tab-con">
                                            <input type="text" class="form-control datetimepicker-input"
                                                id="datetimepicker_date_create" data-toggle="datetimepicker"
                                                data-target="#datetimepicker_date_create" name="date" />
                                        </div>
                                        <label
                                            class="control-label tab-con col-md-1">{{{ trans('main.time_webinar_coach') }}}</label>
                                        <div class="col-md-2 tab-con">
                                            <input type="text" class="form-control datetimepicker-input"
                                                id="datetimepicker_time_create" data-toggle="datetimepicker"
                                                data-target="#datetimepicker_time_create" name="time" />
                                        </div>
                                        <label
                                            class="control-label tab-con col-md-1">{{{ trans('main.duration') }}}</label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="number" min="0" name="duration"
                                                    class="form-control text-center" required>
                                                <span
                                                    class="input-group-addon img-icon-s">{{{ trans('main.minute') }}}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label
                                            class="control-label tab-con col-md-2">{{{ trans('main.webinar_coach_mail') }}}</label>
                                        <div class="col-md-3 tab-con">
                                            <input class="form-control" type="text" name="mail">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-2"
                                            for="inputDefault">{{{ trans('main.description') }}}</label>
                                        <div class="col-md-10 tab-con">
                                            <textarea class="form-control" rows="4" name="description"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-2"
                                            for="inputDefault">{{{ trans('main.title') }}}</label>
                                        <div class="col-md-10 tab-con">
                                            <input type="text" name="title" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 tab-con">
                                            <button class="btn btn-custom tab-con pull-right" id="new-part"
                                                type="submit">{{ trans('main.save_changes') }}</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="h-15"></div>
                            </div>
                        </li>
                        <li>
                            <div class="link list-part-click">
                                <h2>{{{ trans('main.parts') }}}</h2><i class="mdi mdi-chevron-down"></i>
                            </div>
                            <div class="submenu">
                                <div class="table-responsive">
                                    <table class="table ucp-table">
                                        <thead class="thead-s">
                                            <th class="text-center" width="50"></th>
                                            <th class="cell-ta">{{{ trans('main.title') }}}</th>
                                            <th class="text-center" width="50">{{{ trans('main.volume') }}}</th>
                                            <th class="text-center" width="100">{{{ trans('main.duration') }}}</th>
                                            <th class="text-center" width="150">{{{ trans('main.upload_date') }}}
                                            </th>
                                            <th class="text-center" width="50">{{{ trans('main.status') }}}</th>
                                            <th class="text-center" width="100">{{{ trans('main.controls') }}}</th>
                                        </thead>
                                        <tbody id="part-video-table-body"></tbody>
                                    </table>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 btn-toolbar">
                    <a href="javascript:void(0);" class="btn btn-custom pull-left tab-con marl-s-10"
                        id="prev-btn">{{ trans('main.previous') }}</a>
                    <a href="javascript:void(0);" class="btn btn-custom tab-con pull-left marl-s-10"
                        id="next-btn">{{ trans('main.next') }}</a>

                    @if($item->mode != 'publish')
                    <a href="#publish-modal" data-toggle="modal"
                        class="btn btn-custom pull-left tab-con marl-s-10">{{ trans('main.publish') }}</a>
                    @else
                    <a href="#re-publish-modal" data-toggle="modal"
                        class="btn btn-custom pull-left tab-con marl-s-10">{{ trans('main.save_changes') }}</a>
                    @endif
                    @if($item->mode != 'publish')
                    <input type="submit" class="btn btn-custom pull-left tab-con marl-s-10" id="draft-btn" value="Save">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div id='loadingImage' style='display: none;'>
</div>

<div class="modal fade" id="publish-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{{ trans('main.publish') }}}</h4>
            </div>
            <div class="modal-body">
                <p>{{{ trans('main.publish_alert') }}} </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{{ trans('main.cancel') }}}</button>
                <button type="button" class="btn btn-default btn-publish-final">{{{ trans('main.publish') }}}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="re-publish-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{{ trans('main.edit_course') }}}</h4>
            </div>
            <div class="modal-body">
                <p>{{{ trans('main.edit_course_alert') }}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{{ trans('main.cancel') }}}</button>
                <button type="button" class="btn btn-default btn-publish-final">{{{ trans('main.yes_sure') }}}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-part-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{{ trans('main.delete_course') }}}</h4>
            </div>
            <div class="modal-body">
                <p>{{{ trans('main.delete_alert') }}}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-dismiss="modal">{{{ trans('main.cancel') }}}</button>
                <input type="hidden" id="delete-part-id">
                <button type="button" class="btn btn-custom pull-left"
                    id="delete-request">{{{ trans('main.yes_sure') }}}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js">
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker_date_create').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#datetimepicker_time_create').datetimepicker({
            format: 'HH:mm'
        });
        $('#datetimepicker_date_edit').datetimepicker({
            format: 'DD/MM/YYYY'
        });
        $('#datetimepicker_time_edit').datetimepicker({
            format: 'HH:mm'
        });
    })
    $('document').ready(function () {});

</script>
<script>
    $('.editor-te').jqte({
        format: false
    });

</script>
<script>
    $('.partes-nuevo-curso li').click(function () {
        $('.partes-nuevo-curso li').removeClass('active');
        $(this).addClass('active');
        var current_step = $('#current_step').val();
        $('#step' + current_step).slideUp(500);
        var step = $(this).attr('cstep');
        //$('.steps').not(this).each(function () {
        //    $(this).slideUp(500);
        //});
        $('#step' + step).slideDown(1000);
        $('#current_step').val(step);

    })

</script>
<script>
    $('document').ready(function () {
        $('input[name="post"]').change(function () {
            if ($(this).prop('checked')) {
                $('input[name="post_price"]').removeAttr('disabled');
            } else {
                $('input[name="post_price"]').attr('disabled', 'disabled');
            }
        });
        $('#free').change(function () {
            if ($(this).prop('checked')) {
                $('input[name="price"]').attr('disabled', 'disabled');
                $('input[name="post_price"]').attr('disabled', 'disabled');
            } else {
                $('input[name="price"]').removeAttr('disabled');
            }
        });
    })

</script>
<script>
    $('#category_id').change(function () {
        var id = $(this).val();
        $('.filter-tags').removeAttr('checked');
        $('.filters').not('#filter' + id).each(function () {
            $('.filters').slideUp();
        });
        $('#filter' + id).slideDown(500);
    })

</script>
<script>
    $('#next-btn').click(function () {
        var step = $('#current_step').val();
        step = parseInt(step) + 1;
        $("li[cstep=" + step + "]").click();
    });
    $('#prev-btn').click(function () {
        var step = $('#current_step').val();
        step = parseInt(step) - 1;
        $("li[cstep=" + step + "]").click();
    });
    $('#draft-btn').click(function () {
        var id = $('#edit_id').val();
        $.post('/user/content/edit/store/' + id, $('#step-1-form').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-1-form-meta').serialize());
        $.post('/user/content/edit/store/' + id, $('#step-2-form').serializeArray());
        $.post('/user/content/edit/store/' + id, $('#step-3-form').serialize());
        $.post('/user/content/edit/store/' + id, $('#step-3-form-subscribe').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-3-form-meta').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-3-form-precourse').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-4-form-meta').serialize());

        /* Notify */
        $.notify({
            message: 'Your changes saved successfully'
        }, {
            type: 'danger',
            allow_dismiss: false,
            z_index: '99999999',
            placement: {
                from: "bottom",
                align: "right"
            },
            position: 'fixed'
        });
    });
    $('.btn-publish-final').click(function () {
        var id = $('#edit_id').val();
        $.post('/user/content/edit/meta/store/' + id, $('#step-1-form-meta').serialize());
        $.post('/user/content/edit/store/' + id, $('#step-2-form').serializeArray());
        $.post('/user/content/edit/store/' + id, $('#step-3-form').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-3-form-meta').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-3-form-precourse').serialize());
        $.post('/user/content/edit/meta/store/' + id, $('#step-4-form-meta').serialize());
        $.get('/user/content/edit/store/request/' + id, $('#step-1-form').serialize());

        /* Notify */
        $.notify({
            message: 'Your course sent to content review department.'
        }, {
            type: 'danger',
            allow_dismiss: false,
            z_index: '99999999',
            placement: {
                from: "bottom",
                align: "right"
            },
            position: 'fixed'
        });
        $('.modal').modal('hide');
    })

</script>
<script>
    var options = {
        url: function (phrase) {
            return "/jsonsearch/?q=" + phrase;
        },
        getValue: "title",

        template: {
            type: "custom",
            method: function (value, item) {
                return "<span data-id='" + item.id + "' id='course-" + item.id + "'>" + item.title + item.code +
                    "</span>";
            }
        },
        list: {

            onClickEvent: function () {
                var code = $(".provider-json-pre-course").getSelectedItemData().code;
                var id = $(".provider-json-pre-course").getSelectedItemData().id;
                var title = $(".provider-json-pre-course").getSelectedItemData().title;
                var countArray = $('#precourse').val().split(',');
                if (countArray.length < 4) {
                    $('#precourse').val($('#precourse').val() + id + ',');
                    $('.pre-course-title-container').append('<li>' + title + '&nbsp;' + code +
                        '<i class="fa fa-times delete-course" cid="' + id + '"></i></li>');
                }
            },

            showAnimation: {
                type: "fade", //normal|slide|fade
                time: 400,
                callback: function () {}
            },

            hideAnimation: {
                type: "slide", //normal|slide|fade
                time: 400,
                callback: function () {}
            }
        }
    };
    $(".provider-json-pre-course").easyAutocomplete(options);

    $('body').on('click', 'i.delete-course', function () {
        $(this).parent('li').remove();
        var id = $(this).attr('cid');
        $('#precourse').val($('#precourse').val().replace(id + ',', ''));
    });

</script>
<script>
    $('#new-part').click(function (e) {
        $("#loadingImage").show();
        e.preventDefault();
        if (!$('#step-5-form-new-part')[0].checkValidity()) {
            $('#step-5-form-new-part input').filter('[required]:visible').css('border-color', 'red');
        } else {
            $('#step-5-form-new-part input').filter('[required]:visible').css('border-color', '#CCCCCC');
            $.post('/user/content/web_coach/part/store', $('#step-5-form-new-part').serialize(), function (
                data) {
                $('#step-5-form-new-part')[0].reset();
                refreshContent();
                $.notify({
                    message: 'Part sent to content review department.'
                }, {
                    type: 'danger',
                    allow_dismiss: false,
                    z_index: '99999999',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    position: 'fixed'
                });
            })
        }
        $("#loadingImage").fadeOut("slow");
    })

</script>
<script>
    $('document').ready(function () {
        refreshContent();
    })

    function refreshContent() {
        var id = $('#edit_id').val();
        $('#part-video-table-body').html('');
        $.get('/user/content/part/json/' + id, function (data) {
            $('#part-video-table-body').html('');
            $.each(data, function (index, item) {
                $('#part-video-table-body').append('<tr class="text-center"><td>' + item.price +
                    '</td><td class="cell-ta">' + item.title + '</td><td>' + item.size +
                    'MB</td><td>' + item.duration + '&nbsp;Minutes</td><td>' + item.created_at +
                    '</td><td>' + item.mode +
                    '</td><td><span class="crticon mdi mdi-lead-pencil i-part-edit img-icon-s" pid="' +
                    item.id +
                    '" title="Edit"></span>&nbsp;<span class="crticon mdi mdi-delete-forever" data-toggle="modal" data-target="#delete-part-modal img-icon-s" onclick="$(\'#delete-part-id\').val($(this).attr(\'pid\'));" pid="' +
                    item.id + '" title="Delete"></span></td></tr>');
            })
        })
    }

</script>
<script>
    $('#delete-request').click(function () {
        $('#delete-part-modal').modal('hide');
        var id = $('#delete-part-id').val();
        $.get('/user/content/part/delete/' + id);
        refreshContent();
    })

</script>
<script>
    $('body').on('click', 'span.i-part-edit', function () {
        console.log('editar');
        var id = $(this).attr('pid');
        $.get('/user/content/part/edit/' + id, function (data) {
            $('.edit-part-section').show();
            var efrom = '#step-5-form-edit-part ';
            $('#part-edit-id').val(id);
            $(efrom + 'input[name="date"]').val(data.date);
            $(efrom + 'input[name="time"]').val(data.time);
            $(efrom + 'input[name="duration"]').val(data.duration);
            $(efrom + 'input[name="mail"]').val(data.mail);
            $(efrom + 'input[name="title"]').val(data.title);
            $(efrom + 'textarea[name="description"]').html(data.description);
            if (data.free == 1) {
                $('.free-edit-check-state .ios-switch').removeClass('off');
                $('.free-edit-check-state .ios-switch').addClass('on');
            } else {
                $('.free-edit-check-state .ios-switch').removeClass('on');
                $('.free-edit-check-state .ios-switch').addClass('off');
            }
        })
        if ($('.new-part-click').next('.submenu').css('display') == 'block') {
            $('.new-part-click').click();
        }
        if ($('.edit-part-click').next('.submenu').css('display') == 'none') {
            $('.new-part-click').click();
        }
    })

</script>
<script>
    $('#edit-part-submit').click(function (e) {
        $("#loadingImage").show();
        e.preventDefault();
        var id = $('#part-edit-id').val();
        $.post('/user/content/web_coach/part/edit/store/' + id, $('#step-5-form-edit-part').serialize(),
            function (data) {
                console.log(data);
            });
        refreshContent();
        $.notify({
            message: 'Part changes saved successfully.'
        }, {
            type: 'danger',
            allow_dismiss: false,
            z_index: '99999999',
            placement: {
                from: "bottom",
                align: "right"
            },
            position: 'fixed'
        });
        $("#loadingImage").fadeOut("slow");
    })

</script>
@endsection
