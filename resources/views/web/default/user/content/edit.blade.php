@extends(getTemplate() . '.user.vendor.layout.layout')
@section('page')

<div class="cards">
    <div class="card-body">
        <div class="tabs">
            <ul class="nav nav-pills partes-nuevo-curso">
                <li class="nav-item" onclick="saveCourse();">
                    <a href="#main" class="nav-link active" cstep="1" data-toggle="tab"> {{ trans('main.general') }} </a>
                </li>
                <li class="nav-item" onclick="saveCourse();">
                    <a href="#category" class="nav-link" cstep="2" data-toggle="tab">{{ trans('main.category') }}</a>
                </li>
                <!--<li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link" cstep="3" data-toggle="tab">{{ trans('main.extra_info') }}</a>
                </li>-->
                <li class="nav-item" onclick="saveCourse();">
                    <a href="#view" class="nav-link" cstep="4" data-toggle="tab">{{ trans('main.view') }}</a>
                </li>
                <li class="nav-item" onclick="saveCourse();">
                    <a href="#parts" class="nav-link" cstep="5" data-toggle="tab">{{ trans('main.parts') }}</a>
                </li>
                <li class="nav-item" onclick="saveCourse();">
                    <a href="#zoom" class="nav-link" cstep="6" data-toggle="tab">{{ trans('main.parts') }} - Zoom</a>
                </li>
                <li class="nav-item" onclick="saveCourse();">
                    <a href="#guides" class="nav-link" cstep="7" data-toggle="tab">Weekly Guides</a>
                </li>
            </ul>
        </div>
        <br>
        <div class="tab-content">
        <input type="hidden" value="1" id="current_step">
            <input type="hidden" value="{{ $item->id }}" id="edit_id">

            <div class="steps" id="step1">

                <form method="post" action="/user/content/new/store" class="form-horizontal" id="step-1-form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault">{{ trans('main.course_type') }}</label>
                        <div class="col-md-10 tab-con">
                            <select name="type" class="form-control font-s">
                                <!--<option value="single" @if(isset($item) && $item->type == 'single') selected
                                    @endif>{{ trans('main.single') }}</option>-->
                                <option value="course" @if(isset($item) && $item->type == 'course') selected
                                    @endif>{{ trans('main.course') }}</option>
                                <option value="webinar" @if(isset($item) && $item->type == 'webinar') selected
                                    @endif>{{ trans('main.webinar') }}</option>
                                <option value="course+webinar" @if(isset($item) && $item->type == 'course+webinar')
                                    selected @endif>{{ trans('main.course+webinar') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault">{{ trans('main.publish_type') }}</label>
                        <div class="col-md-10 tab-con">
                            <select name="private" class="form-control font-s">
                                <option value="2" {{$item->private == 2 ? 'selected' : ''}}>Fundal students</option>
                                <option value="0" {{$item->private == 0 ? 'selected' : ''}}>External trainings<!-- {{ trans('main.open') }} --></option>
                                <option value="3" {{$item->private == 3 ? 'selected' : ''}}>I learn +</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault">{{ trans('main.course_title') }}</label>
                        <div class="col-md-10 tab-con">
                            <input type="text" name="title" placeholder="30-60 Characters" class="form-control"
                                value="{{ $item->title }}" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault">{{ trans('main.description') }}</label>
                        <div class="col-md-10 tab-con">
                            <textarea class="form-control" rows="12" placeholder="Description..."
                                name="content" required>{!! $item->content !!}</textarea>
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
                    <!--<div class="alert alert-success">
                        <p>{{ trans('main.tags_header') }}</p>
                    </div>-->
                    <div class="form-group">
                        <label class="col-md-4 control-label tab-con"
                            for="inputDefault">{{ trans('main.tags') }} (optional)</label>
                        <div class="col-md-8 tab-con">
                            <input type="text" data-role="tagsinput" placeholder="Press enter to save tag." name="tag"
                                value="{{ $item->tag}}" class="form-control text-center">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label tab-con"
                            for="inputDefault">{{ trans('main.category') }}  (optional)</label>
                        <div class="col-md-8 tab-con">
                            <select name="category_id" id="category_id" class="form-control font-s" required>
                                <option value="0">{{ trans('main.select_category') }}</option>
                                @foreach($menus as $menu)
                                @if($menu->parent_id == 0)
                                <optgroup label="{{ $menu->title }}">
                                    @if(count($menu->childs) > 0)
                                    @foreach($menu->childs as $sub)
                                    <option value="{{ $sub->id }}" @if($sub->id == $item->category_id) selected
                                        @endif>{{ $sub->title }}</option>
                                    @endforeach
                                    @else
                                    <option value="{{ $menu->id }}" @if($menu->id == $item->category_id) selected
                                        @endif>{{ $menu->title }}</option>
                                    @endif
                                </optgroup>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="h-15"></div>
                    <!--<div class="alert alert-success">
                        <p>{{ trans('main.filters_header') }}</p>
                    </div>-->
                    <div class="h-15"></div>
                    @foreach($menus as $menu)
                    <!--<div class="col-md-11 col-md-offset-1 tab-con filters @if($menu->id != $item->category_id) dnone @endif"
                        id="filter{{{ $menu->id ?? 0 }}}">
                        @foreach($menu->filters as $filter)
                        <div class="col-md-3 col-xs-12 tab-con">
                            <h5>{{ $filter->filter }}</h5>
                            <hr>
                            <ul class="cat-filters-li pamaz">
                                <ul class="submenu submenu-s">
                                    @foreach($filter->tags as $tag)
                                    <li class="second-input"><input type="checkbox" class="filter-tags dblock"
                                            id="tag{{ $tag->id }}" name="filters[]" value="{{ $tag->id }}"
                                            @if(isset($item->filters) &&
                                        in_array($tag->id,$item->filters->pluck('id')->toArray())) checked
                                        @endif><label for="tag{{ $tag->id }}"><span></span>{{ $tag->tag }}</label>
                                    </li>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                        @endforeach
                    </div>-->
                    @endforeach
                </form>
            </div>

            <div class="steps dnone" id="step3">
                <form method="post" id="step-3-form" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-5 tab-con col-md-offset-1 dinb"
                            for="inputDefault">{{ trans('main.free_course') }}</label>
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
                            class="control-label col-md-5 tab-con col-md-offset-1 dinb">{{ trans('main.vendor_postal_sale') }}</label>
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
                            for="inputDefault">{{ trans('main.support') }}</label>
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
                            for="inputDefault">{{ trans('main.download') }}</label>
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
                        <label class="control-label col-md-4 tab-con">{{ trans('main.price') }}</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price" onkeypress="validate(event)"
                                    value="{{{$meta['price'] ?? ''}}}" class="form-control text-center numtostr"
                                    @if($item->price === 0) disabled @endif>
                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ currencySign() }}
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">{{ trans('main.postal_price') }}</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="post_price" onkeypress="validate(event)"
                                    value="{{$meta['post_price'] ?? ''}}" class="form-control text-center numtostr"
                                    @if($item->post != 1) disabled @endif>
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ currencySign() }}
                                    </span>
                                </div>
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
                                    value="{{ $item->price_3}}" class="form-control text-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ currencySign() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">6 Months Subscribe Price</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price_6" onkeypress="validate(event)"
                                    value="{{ $item->price_6 }}" class="form-control text-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ currencySign() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">9 Months Subscribe Price</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price_9" onkeypress="validate(event)"
                                    value="{{ $item->price_9 }}" class="form-control text-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ currencySign() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 tab-con">12 Months Subscribe Price</label>
                        <div class="col-md-8 tab-con">
                            <div class="input-group">
                                <input type="number" name="price_12" onkeypress="validate(event)"
                                    value="{{ $item->price_12 }}" class="form-control text-center">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ currencySign() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--<div class="h-15"></div>
                <div class="alert alert-success">
                    <p>{{ trans('main.prerequisites_desc') }}</p>
                </div>
                <a class="btn btn-custom pull-left" data-toggle="modal"
                    href="#modal-pre-course"><span>{{ trans('main.select_prerequisites') }}</span></a>-->
                <div class="modal fade" id="modal-pre-course">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                    &times;
                                </button>
                                <h4 class="modal-title">{{ trans('main.select_prerequisites') }}</h4>
                            </div>
                            <div class="modal-body no-absolute-content">
                                <form method="post" id="step-3-form-precourse">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="precourse" id="precourse"
                                        value="{{ $meta['precourse'] ?? '' }}">
                                </form>
                                <ul class="pre-course-title-container">
                                    @if(isset($preCourse))
                                    @foreach($preCourse as $prec)
                                    <li>{{ $prec->title }}&nbsp;(VT-{{ $prec->id }})<i class="fa fa-times delete-course"
                                            cid="{{ $prec->id }}"></i></li>
                                    @endforeach
                                    @endif
                                </ul>
                                <input type="text" class="form-control provider-json-pre-course"
                                    placeholder="Type 3 characters to load courses list.">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-custom pull-left"
                                    data-dismiss="modal">{{ trans('main.close') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="steps dnone" id="step4">
                <form method="post" class="form-horizontal" id="step-4-form-meta">
                    {{ csrf_field() }}
                    <!-- <div class="form-group">
                        <label class="control-label col-md-2 tab-con">{{ trans('main.course_cover') }}</label>
                        <div class="col-md-10 tab-con">
                            <div class="input-group" style="display: flex">
                                <button type="button" id="lfm_cover" data-input="cover" data-preview="holder"
                                    class="btn btn-primary">
                                    Choose
                                </button>
                                <input id="cover" class="form-control" dir="ltr" type="text" name="cover"
                                    value="{{ !empty($meta['cover']) ? $meta['cover'] : '' }}" onchange="checkcover($(this).val());">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal"
                                    data-target="#ImageModal" data-whatever="cover">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label class="control-label col-md-3 tab-con">{{ trans('main.course_thumbnail') }}</label>
                        <div class="col-md-9 tab-con">
                            <div class="input-group" style="display: flex">
                                <button type="button" id="lfm_thumbnail" data-input="thumbnail" data-preview="holder"
                                    class="btn btn-primary">
                                    Choose
                                </button>
                                <input id="thumbnail" class="form-control" dir="ltr" type="text" name="thumbnail"
                                    value="{{ !empty($meta['thumbnail']) ? $meta['thumbnail'] : '' }}" onchange="checkmini($(this).val());">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal"
                                    data-target="#ImageModal" data-whatever="thumbnail">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="form-group">
                        <label class="control-label col-md-2 tab-con">{{ trans('main.demo') }}</label>
                        <div class="col-md-10 tab-con">
                            <div class="input-group" style="display: flex">
                                <button type="button" id="lfm_video" data-input="video" data-preview="holder"
                                    class="btn btn-primary">
                                    Choose
                                </button>
                                <input id="video" class="form-control" dir="ltr" type="text" name="video"
                                    value="{{ !empty($meta['video']) ? $meta['video'] : '' }}">
                                <div class="input-group-prepend view-selected cu-p" data-toggle="modal"
                                    data-target="#ImageModal" data-whatever="video">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con">{{ trans('main.documents') }}</label>
                        <div class="col-md-10 tab-con">
                            <div class="input-group" style="display: flex">
                                <button type="button" id="lfm_document" data-input="document" data-preview="holder"
                                    class="btn btn-primary">
                                    Choose
                                </button>
                                <input id="document" class="form-control" dir="ltr" type="text" name="document"
                                    value="{{ !empty($meta['document']) ? $meta['document'] : '' }}">
                                <div class="input-group-prepend view-selected cu-p"
                                    onclick="window.open($('#document-addon').val(),'_balnk');">
                                    <span class="input-group-text">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </form>

            </div>
            <div class="steps dnone" id="step5">
                <div class="row">
                    <div class="col-md-5 col-xs-12 border-right">
                        <div class="accordion-off">
                            <ul id="accordion" class="accordion off-filters-li">
                                <li class="open edit-part-section dnone">
                                    <div class="link edit-part-click">
                                        <h2>{{ trans('main.edit_part') }}</h2><i class="mdi mdi-chevron-down"></i>
                                    </div>
                                    <div class="submenu dblock">
                                        <div class="h-15"></div>
                                        <input type="hidden" id="part-edit-id">
                                        <form action="/user/content/part/edit/store/" id="step-5-form-edit-part" method="post"
                                            class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="content_id" value="{{ $item->id }}">

                                            <div class="form-group">

                                                <label
                                                    class="control-label tab-con col-md-2">{{ trans('main.video_file') }}</label>
                                                <div class="col-md-7 tab-con">
                                                    <style>
                                                        .asdf span {
                                                            width: 44px;
                                                            height: 44px;
                                                        }

                                                        .asdf input {
                                                            height: 44px;
                                                        }

                                                    </style>
                                                    <div class="input-group asdf">

                                                            <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#VideoModal" data-whatever="upload_video">
                                                                <span class="input-group-text">
                                                                    <a id="video_preview" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                </span>
                                                            </div>
                                                                <input type="text" id="upload_video" name="upload_video" dir="ltr"
                                                                    class="form-control" onchange='$("#video_preview").attr("href", $(this).val()); checkmedia($(this).val());' required>
                                                                <button type="button" id="lfm_upload_video" data-input="upload_video"
                                                                    data-preview="holder" class="btn btn-primary">
                                                                    <span class="formicon mdi mdi-arrow-up-thick"></span>
                                                                </button>
                                                            </div>
                                                    </div>


                                                <!--<label class="control-label col-md-1 tab-con">{{ trans('main.sort') }}</label>
                                                <div class="col-md-2 tab-con">
                                                    <input name="sort" type="number" class="spinner-input form-control"
                                                        maxlength="3" min="0" max="100" required>
                                                </div>-->
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2 tab-con"
                                                    for="inputDefault">{{ trans('main.description') }}bbb</label>
                                                <div class="col-md-10 tab-con te-10">
                                                    <textarea class="form-control editor-te oflows" rows="12"
                                                        placeholder="Description..." name="description" required></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <!--<label class="control-label tab-con col-md-2">{{ trans('main.volume') }}</label>
                                                <div class="col-md-3 tab-con">
                                                    <div class="input-group">
                                                        <input type="number" min="0" name="size"
                                                            class="form-control text-center" required>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                {{ trans('main.mb') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <label
                                                    class="control-label tab-con col-md-1">{{ trans('main.duration') }}</label>
                                                <div class="col-md-3 tab-con">
                                                    <div class="input-group">
                                                        <input type="number" min="0" name="duration"
                                                            class="form-control text-center" required>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    {{ trans('main.minute') }}
                                                                </span>
                                                            </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="free" value="0">            
                                                <!-- <label class="control-label tab-con col-md-1">{{ trans('main.free') }}</label>      
                                                <br>      
                                                <label class="custom-switch col-md-2 tab-con">
                                                    <input type="hidden" name="free" value="1">
                                                    <input type="checkbox" name="free" value="1" class="custom-switch-input"/>
                                                    <span class="custom-switch-indicator"></span>
                                                </label>-->
                                            </div>    

                                            <div class="form-group">

                                                <label class="control-label tab-con col-md-2"
                                                    for="inputDefault">{{ trans('main.title') }}</label>
                                                <div class="col-md-8 tab-con">
                                                    <input type="text" name="title" class="form-control" required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label tab-con col-md-3">Fecha de inicio</label>
                                                <div class="col-md-3 tab-con">
                                                    <div class="input-group">
                                                        <input type="date" name="initial_date"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <label
                                                    class="control-label tab-con col-md-3">Fecha de finalizaci&oacute;n</label>
                                                <div class="col-md-3 tab-con">
                                                    <div class="input-group">
                                                        <input type="date" name="limit_date"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-2 tab-con">
                                                    <button class="btn btn-custom pull-left" id="edit-part-submit"
                                                        type="submit">{{ trans('main.edit_part') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="h-15"></div>
                                    </div>
                                </li>
                                <li class="open">
                                    <div class="link new-part-click">
                                        <h2>{{ trans('main.new_part') }}</h2><i class="mdi mdi-chevron-down"></i>
                                    </div>
                                    <div class="submenu dblock">
                                        <div class="h-15"></div>
                                        <form action="/user/content/part/store" enctype="multipart/form-data" id="step-5-form-new-part" method="post"
                                            class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="content_id" value="{{ $item->id }}">


                                            <div class="form-group">
                                                <label class="control-label tab-con col-md-2"
                                                    for="inputDefault">{{ trans('main.title') }}</label>
                                                <div class="col-md-10 tab-con">
                                                    <input type="text" name="title" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label tab-con col-md-2"
                                                    for="inputDefault">{{ trans('main.description') }}</label>
                                                <div class="col-md-10 tab-con">
                                                    <textarea class="form-control" rows="4" name="description"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-4 tab-con">{{ trans('main.video_file') }}</label>
                                                <div class="col-md-10 tab-con">
                                                    <style>
                                                        .asdf span {
                                                            width: 44px;
                                                            height: 44px;
                                                        }

                                                        .asdf input {
                                                            height: 44px;
                                                        }

                                                    </style>



                                                    <div class="input-group asdf">

                                                        <div class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#VideoModal" data-whatever="upload_video2">
                                                            <span class="input-group-text">
                                                                <a id="video_preview2" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                            </span>
                                                        </div>
                                                            <input type="text" id="upload_video2" name="upload_video" dir="ltr"
                                                                class="form-control" onchange='$("#video_preview2").attr("href", $(this).val()); checkmedia($(this).val());' required>
                                                            <button type="button" id="lfm_upload_video" data-input="upload_video2"
                                                                data-preview="holder" class="btn btn-primary">
                                                                <span class="formicon mdi mdi-arrow-up-thick"></span>
                                                            </button>
                                                        </div>
                                                </div>
                                                <!--<label class="control-label tab-con col-md-1">{{ trans('main.sort') }}</label>
                                                <div class="col-md-2 tab-con">
                                                    <input type="number" name="sort" class="spinner-input form-control"
                                                        maxlength="3" min="0" max="100" required>
                                                </div>-->
                                            </div>

                                            


                                            <div class="form-group">
                                                <!--<label class="control-label tab-con col-md-2">{{ trans('main.volume') }}</label>
                                                <div class="col-md-3 tab-con">
                                                    <div class="input-group">
                                                        <input type="number" min="0" name="size"
                                                            class="form-control text-center" required>
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                {{ trans('main.mb') }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                <label
                                                    class="control-label tab-con col-md-2">{{ trans('main.duration') }}</label>
                                                <div class="col-md-10 tab-con">
                                                    <div class="input-group">
                                                        <input type="number" min="0" name="duration"
                                                            class="form-control text-center" required>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    {{ trans('main.minute') }}
                                                                </span>
                                                            </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="free" value="0">            
                                                <!-- <label class="control-label tab-con col-md-1">{{ trans('main.free') }}</label>      
                                                <br>      
                                                <label class="custom-switch col-md-2 tab-con">
                                                    <input type="hidden" name="free" value="1">
                                                    <input type="checkbox" name="free" value="1" class="custom-switch-input"/>
                                                    <span class="custom-switch-indicator"></span>
                                                </label>-->
                                            </div>           
                                            
                                            <div class="form-group">
                                                <label class="control-label tab-con col-md-4"
                                                    for="inputDefault">Materiales del módulo</label>
                                                <div class="col-md-10 tab-con">
                                                    <input type="file" name="material" id="material-modulo" class="form-control">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="control-label tab-con col-md-3">Fecha de inicio</label>
                                                <div class="col-md-10 tab-con">
                                                    <div class="input-group">
                                                        <input type="date" name="initial_date"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <label
                                                    class="control-label tab-con col-md-3">Fecha de finalizaci&oacute;n</label>
                                                <div class="col-md-10 tab-con">
                                                    <div class="input-group">
                                                        <input type="date" name="limit_date"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            

                                            <div class="row">
                                                <div class="col-md-12 tab-con">
                                                    <button class="btn btn-primary tab-con pull-right" id="new-part"
                                                        type="submit">Guardar módulo</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="h-15"></div>
                                    </div>
                                </li>
                                <li>
                                    <!-- <div class="link list-part-click">
                                        <h2>{{ trans('main.parts') }}</h2><i class="mdi mdi-chevron-down"></i>
                                    </div>
                                    <div class="submenu">
                                        <div class="table-responsive">
                                            <table class="table ucp-table">
                                                <thead class="thead-s">
                                                    <th class="cell-ta">{{ trans('main.title') }}</th>
                                                    <th class="text-center" width="50">{{ trans('main.volume') }}</th>
                                                    <th class="text-center" width="100">{{ trans('main.duration') }}</th>
                                                    <th class="text-center" width="150">{{ trans('main.upload_date') }}</th>
                                                    <th class="text-center" width="50">{{ trans('main.status') }}</th>
                                                    <th class="text-center" width="100">{{ trans('main.controls') }}</th>
                                                </thead>
                                                <tbody id="part-video-table-body"></tbody>
                                            </table>
                                        </div>
                                    </div> -->
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-7 col-xs-12">
                        <!-- Right part table -->
                        <div class="link list-part-click">
                            <h2>{{ trans('main.parts') }}</h2><i class="mdi mdi-chevron-down"></i>
                        </div>
                        <div class="submenu">
                            <div class="table-responsive">
                                <table class="table ucp-table">
                                    <thead class="thead-s">
                                        <th class="cell-ta">{{ trans('main.title') }}</th>
                                        <th class="text-center" width="50">{{ trans('main.volume') }}</th>
                                        <th class="text-center" width="100">{{ trans('main.duration') }}</th>
                                        <th class="text-center" width="150">{{ trans('main.upload_date') }}</th>
                                        <th class="text-center" width="50">{{ trans('main.status') }}</th>
                                        <th class="text-center" width="100">{{ trans('main.controls') }}</th>
                                    </thead>
                                    <tbody id="part-video-table-body"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="steps dnone" id="step6">
                <div class="row">
                    <div class="col-md-5 col-xs-12 border-right">
                        <div class="accordion-off">
                            <ul id="accordion" class="accordion off-filters-li">
                                <li class="open edit-part-section-zoom dnone">
                                    <div class="link edit-part-click">
                                        <h2>{{{ trans('main.edit_part') }}}</h2><i class="mdi mdi-chevron-down"></i>
                                    </div>
                                    <div class="submenu_zoom dblock">
                                        <div class="h-15"></div>
                                        <input type="hidden" id="part-edit-id">
                                        <form action="/user/content/web_coach/part/edit/store/" id="step-6-form-edit-part"
                                            method="post" class="form-horizontal">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="content_id" value="{{{ $item->id ?? '' }}}">
                                            <input type="hidden" name="part_id">

                                            <div class="form-group">
                                                <label
                                                    class="control-label col-md-2 tab-con">{{{ trans('main.date_webinar_coach') }}}</label>
                                                <div class="col-md-3 tab-con">
                                                    <input type="date" class="form-control"
                                                        id="datetimepicker_date_edit" name="date" required>
                                                </div>
                                                <label
                                                    class="control-label tab-con col-md-1">{{{ trans('main.time_webinar_coach') }}}</label>
                                                <div class="col-md-2 tab-con">
                                                    <input type="time" class="form-control"
                                                        id="datetimepicker_time_edit" name="time" required>
                                                </div>

                                                <label
                                                    class="control-label tab-con col-md-1">{{ trans('main.duration') }}</label>
                                                <div class="col-md-3 tab-con">
                                                    <div class="input-group">
                                                        <input type="number" min="0" name="duration"
                                                            class="form-control text-center" required>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    {{ trans('main.minute') }}
                                                                </span>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label
                                                    class="control-label tab-con col-md-2">{{{ trans('main.webinar_coach_mail') }}}</label>
                                                <div class="col-md-3 tab-con">
                                                    <input class="form-control" type="text" name="mail" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label
                                                    class="control-label tab-con col-md-2">{{{ trans('main.webinar_zoom_link') }}}</label>
                                                <div class="col-md-3 tab-con">
                                                    <input class="form-control" type="text" name="zoom_link" required>
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
                                                    <div class="clearfix">&nbsp;</div>
                                                    <button class="btn btn-custom  btn-warning tab-con pull-left" id="edit-part-submit"
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
                                                <div class="col-md-10 tab-con">
                                                    <input type="date" class="form-control"
                                                        id="datetimepicker_date_create" name="date" required>
                                                </div>
                                                <label
                                                    class="control-label tab-con col-md-1">{{{ trans('main.time_webinar_coach') }}}</label>
                                                <div class="col-md-10 tab-con">
                                                    <input type="time" class="form-control"
                                                        id="datetimepicker_time_create" name="time" required>
                                                </div>
                                                <label
                                                    class="control-label tab-con col-md-1">{{ trans('main.duration') }}</label>
                                                <div class="col-md-10 tab-con">
                                                    <div class="input-group">
                                                        <input type="number" min="0" name="duration"
                                                            class="form-control text-center" required>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    {{ trans('main.minute') }}
                                                                </span>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label
                                                    class="control-label tab-con col-md-4">{{{ trans('main.webinar_coach_mail') }}}</label>
                                                <div class="col-md-10 tab-con">
                                                    <input class="form-control" type="text" name="mail" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label
                                                    class="control-label tab-con col-md-4">{{{ trans('main.webinar_zoom_link') }}}</label>
                                                <div class="col-md-10 tab-con">
                                                    <input class="form-control" type="text" name="zoom_link" required>
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
                                                    <button class="btn btn-warning tab-con pull-right" id="new-part"
                                                        type="submit">{{ trans('main.save_changes') }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="h-15"></div>
                                    </div>
                                </li>
                                <li>
<!--                                     <div class="link list-part-click-zoom">
                                        <h2>{{{ trans('main.parts') }}}</h2><i class="mdi mdi-chevron-down"></i>
                                    </div>
                                    <div class="submenu">
                                        <div class="table-responsive">
                                            <table class="table ucp-table">
                                                <thead class="thead-s">
                                                    <th class="cell-ta">{{{ trans('main.title') }}}</th>
                                                    <th class="text-center" width="100">{{{ trans('main.duration') }}}</th>
                                                    <th class="text-center" width="150">{{{ trans('main.upload_date') }}}
                                                    </th>
                                                    <th class="text-center" width="50">{{{ trans('main.status') }}}</th>
                                                    <th class="text-center" width="100">{{{ trans('main.controls') }}}</th>
                                                </thead>
                                                <tbody id="part-video-table-body-zoom"></tbody>
                                            </table>
                                        </div>
                                    </div> -->
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-7 col-xs-12">
                        <!-- New part right side -->
                                <div class="link list-part-click-zoom">
                                    <h2>{{{ trans('main.parts') }}}</h2><i class="mdi mdi-chevron-down"></i>
                                </div>
                                <div class="submenu">
                                    <div class="table-responsive">
                                        <table class="table ucp-table">
                                            <thead class="thead-s">
                                                <th class="cell-ta">{{{ trans('main.title') }}}</th>
                                                <th class="text-center" width="100">{{{ trans('main.duration') }}}</th>
                                                <th class="text-center" width="150">{{{ trans('main.upload_date') }}}
                                                </th>
                                                <th class="text-center" width="50">{{{ trans('main.status') }}}</th>
                                                <th class="text-center" width="100">{{{ trans('main.controls') }}}</th>
                                            </thead>
                                            <tbody id="part-video-table-body-zoom"></tbody>
                                        </table>
                                    </div>
                                </div>

                    </div>
                </div>
            </div>
            <div class="steps dnone" id="step7">
                <div class="accordion-off">
                    <ul id="accordion" class="accordion off-filters-li">
                        <li class="open">
                            <div class="link new-part-click">
                                <h2>Weekly Guides </h2><i class="mdi mdi-chevron-down"></i>
                            </div>
                            <div class="submenu dblock">
                                <div class="h-15"></div>
                                <form action="/user/content/guide/store" enctype="multipart/form-data" id="step-7-form-new-part"
                                    method="post" class="form-horizontal">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="content_id" value="{{{ $item->id ?? '' }}}">

                                    <div class="form-group">
                                        <label class="control-label col-md-2 tab-con"
                                            for="inputDefault">Guía de trabajo</label>
                                            <input type="file" name="guia_trabajo" id="guia_trabajo" class="form-control" accept="application/pdf,application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label tab-con col-md-3">Fecha de inicio</label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="date" name="fecha_inicio"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <label
                                            class="control-label tab-con col-md-3">Fecha de finalizaci&oacute;n</label>
                                        <div class="col-md-3 tab-con">
                                            <div class="input-group">
                                                <input type="date" name="fecha_fin"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 tab-con">
                                            <button class="btn btn-custom btn-warning tab-con pull-left" id="new-guide" onclick="return confirm('Are you sure, you want overwrite?')"
                                                type="submit">{{ trans('main.save_changes') }}</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="h-15"></div>
                            </div>
                        </li>
                        <li>
                            <div class="link list-part-click-zoom">
                                <h2>Weekly Guides</h2><i class="mdi mdi-chevron-down"></i>
                            </div>
                            <div class="submenu">
                                <div class="table-responsive">
                                    <table class="table ucp-table">
                                        <thead class="thead-s">
                                            <th class="text-center" width="50">Fecha Inicio</th>
                                            <th class="text-center" width="50">Fecha Fin</th>
                                            <th class="text-center" width="50">Ver</th>
                                        </thead>
                                        <tbody>
                                            @foreach($guides as $guide)
                                             <tr>
                                                <td class="text-center" width="50">{{$guide->initial_date}}</td>
                                                <td class="text-center" width="50">{{$guide->final_date}}</td>
                                                <td class="text-center" width="50"><a href="{{$guide->route}}" target="_blank"><b>Ver</b></a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
                <div class="col-md-12 btn-toolbar">
                    <button class="btn btn-primary btn-lg previous"><- Anterior</button>
                    @if($item->mode != 'publish')
                    &nbsp;<a href="#publish-modal" data-toggle="modal"
                        class="btn btn-primary pull-left tab-con marl-s-10">{{ trans('main.publish') }}</a>
                    @else
                    &nbsp;<a href="#re-publish-modal" data-toggle="modal"
                        class="btn btn-primary pull-left tab-con marl-s-10">{{ trans('main.save_changes') }}</a>
                    @endif
                    @if($item->mode != 'publish')
                    <input type="submit" class="btn btn-primary pull-left tab-con marl-s-10" id="draft-btn" value="Save" style="display: none;">
                    @endif
                    &nbsp;<button class="btn btn-primary btn-lg next">Siguiente -></button>
                </div>
            </div>
    </div>
</div>

<div class="h-30" id="scrollId"></div>
<div class="container-fluid">
    <input type="hidden" value="1" id="current_step">
    <input type="hidden" value="{{ $item->id }}" id="edit_id">
    <div class="container n-padding-xs current-s">
        <div class="h-30"></div>
        <div class="multi-steps">
            <div class="col-md-9 col-xs-12 col-sm-8 tab-con left-side">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="vimeo-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Vimeo</h4>
            </div>
            <div class="modal-body" dir="ltr">
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon click-to-upload-vimeo" style="cursor: pointer;"><label
                                class="mdi mdi-download img-icon-s" style="position: relative;top: 6px;"></label></span>
                        <input type="text" id="vimeo_url" class="form-control text-left" placeholder="Vimeo Url"
                            name="vimeo_url">
                    </div>
                </div>
                <style>
                    .blink {
                        animation: blinker 0.6s linear infinite;
                        color: #1c87c9;
                        font-size: 15px;
                        font-weight: bold;
                        font-family: sans-serif;
                    }

                    @keyframes blinker {
                        50% {
                            opacity: 0;
                        }
                    }

                    .blink-one {
                        animation: blinker-one 1s linear infinite;
                    }

                    @keyframes blinker-one {
                        0% {
                            opacity: 0;
                        }
                    }

                    .blink-two {
                        animation: blinker-two 1.4s linear infinite;
                    }

                    @keyframes blinker-two {
                        100% {
                            opacity: 0;
                        }
                    }

                </style>
                <span class="blink vimeo-waiting" style="display: none;">waiting...</span>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="publish-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('main.publish') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>{{ trans('main.publish_alert') }} </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('main.cancel') }}</button>
                <button type="button" class="btn btn-success btn-publish-final">{{ trans('main.publish') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" id="re-publish-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('main.edit_course') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>{{ trans('main.edit_course_alert') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{ trans('main.cancel') }}</button>
                <button type="button" class="btn btn-success btn-publish-final">{{ trans('main.yes_sure') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="delete-part-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <input type="hidden" name="hnd_temp_part_id" id="hnd_temp_part_id">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ trans('main.delete_course') }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ trans('main.delete_alert') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-custom" data-dismiss="modal">{{ trans('main.cancel') }}</button>
                <input type="hidden" id="delete-part-id">
                <button type="button" class="btn btn-custom pull-left"
                    id="delete-request">{{ trans('main.yes_sure') }}</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('script')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $('#lfm_document,#lfm_video,#lfm_thumbnail,#lfm_cover,#lfm_upload_video').filemanager('file', {prefix: '/user/laravel-filemanager'});
    </script>
<script>

    $('.partes-nuevo-curso li a').click(function () {
        $('.partes-nuevo-curso li a').removeClass('active');
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

    function saveCourse(){
        $('#draft-btn').click();
    }

    function checkmedia(media){
        var str = media;
        var newstr = str.replace('///', '/');
        var n = str.lastIndexOf('.');
        var result = str.substring(n + 1);
        console.log(result);

        if(result != 'mp4'){
            $('#upload_video').val('');
            $('#upload_video2').val('');

            $.notify({
                message: 'Tipo de archivo no admitido. Se admite MP4.'
            }, {
                type: 'danger',
                allow_dismiss: true,
                z_index: '99999999',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                position: 'fixed'
            });
        }else{
            $('#upload_video').val(newstr);
            $('#upload_video2').val(newstr);
        }
    }

    function checkcover(media){
        var str = media;
        var n = str.lastIndexOf('.');
        var result = str.substring(n + 1);
        console.log(result);

        if(result == 'jpg' || result == 'png'){
            
        }else{
            $('#cover').val('');

            $.notify({
                message: 'Tipo de archivo no admitido. Se admite JPG y PNG.'
            }, {
                type: 'danger',
                allow_dismiss: true,
                z_index: '99999999',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                position: 'fixed'
            });
        }
    }

    function checkmini(media){
        var str = media;
        var newstr = str.replace('///', '/');
        var n = str.lastIndexOf('.');
        var result = str.substring(n + 1);
        console.log(result);

        if(result == 'jpg' || result == 'png'){
            $('#thumbnail').val(newstr);
        }else{
            $('#thumbnail').val('');

            $.notify({
                message: 'Tipo de archivo no admitido. Se admite JPG y PNG.'
            }, {
                type: 'danger',
                allow_dismiss: true,
                z_index: '99999999',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                position: 'fixed'
            });
        }
    }

    $('.next').click(function () {
    $('.nav-pills > .nav-item > .active').parent().next('li').find('a').trigger('click');
    });

    $('.previous').click(function () {
        $('.nav-pills > .nav-item > .active').parent().prev('li').find('a').trigger('click');
    });

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
                $('input[name="price"]').attr('readonly', 'readonly').val('0');
                $('input[name="post_price"]').attr('readonly', 'readonly');
            } else {
                $('input[name="price"]').removeAttr('readonly').val('');
            }
        });
    })

</script>
<!-- <script>
   $('#category_id').change(function () {
        var id = $(this).val();
        $('.filter-tags').removeAttr('checked');
        $('.filters').not('#filter' + id).each(function () {
            $('.filters').slideUp();
        });
        $('#filter' + id).slideDown(500);
    })

</script> -->
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

        console.log($('#step-1-form').serialize());
        /* Notify */
        $.notify({
            message: 'Your changes saved successfully'
        }, {
            type: 'success',
            allow_dismiss: false,
            z_index: '99999999',
            placement: {
                from: "top",
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
            type: 'success',
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

    $('body').on('click', 'i.delete-course', function () {
        $(this).parent('li').remove();
        var id = $(this).attr('cid');
        $('#precourse').val($('#precourse').val().replace(id + ',', ''));
    });

</script>
<!-- <script>
   $('#new-part').click(function (e) {
        e.preventDefault();
        if (!$('#step-5-form-new-part')[0].checkValidity()) {
            $('#step-5-form-new-part input').filter('[required]:visible').css('border-color', 'red');
        } else {
            $('#step-5-form-new-part input').filter('[required]:visible').css('border-color', '#CCCCCC');
            $.get('/user/content/part/store', $('#step-5-form-new-part').serialize(), function (data) {
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
    })

</script> -->
<script>
    $('document').ready(function () {
        refreshContent();

        var hash = location.hash.replace(/^#/, '');  // ^ means starting, meaning only match the first hash
        if (hash) {
            $('.nav-pills a[href="#' + hash + '"]').tab('show');
            console.log(hash)

            var current_step = $('#current_step').val();
            $('#step' + current_step).slideUp(500);
            var step = $('.nav-pills a[href="#' + hash + '"]').attr('cstep');
            //$('.steps').not(this).each(function () {
            //    $(this).slideUp(500);
            //});
            $('#step' + step).slideDown(1000);
            $('#current_step').val(step);
        } 

        // Change hash for page-reload
        $('.nav-pills a').on('click', function (e) {
            window.location.hash = e.target.hash;
        })
    })

    function refreshContent() {
        var id = $('#edit_id').val();
        $('#part-video-table-body').html('');
        $.get('/user/content/part/json/' + id, function (data) {
            $('#part-video-table-body').html('');
            $.each(data, function (index, item) {
                if(!item.zoom_meeting){
                    $('#part-video-table-body').append('<tr class="text-center"><td class="cell-ta">' + item.title + '</td><td>' + item.size +
                    'MB</td><td>' + item.duration + '&nbsp;Minutes</td><td>' + item.created_at +
                    '</td><td>' + item.mode +
                    '</td><td><span class="crticon mdi mdi-lead-pencil i-part-edit img-icon-s" pid="' +
                    item.id +
                    '" title="Edit"></span>&nbsp;<a href="javascript:void(0)" onclick="deletPartModal('+item.id+')" data-toggle="modal" data-target="#delete-part-modal img-icon-s"><span class="crticon mdi mdi-delete-forever delete_part_class"   pid="' +
                    item.id + '" title="Delete"></span></a></td></tr>');
                }else{
                    $('#part-video-table-body-zoom').append('<tr class="text-center"><td class="cell-ta">' + item.title + '</td><td>' + item.duration + '&nbsp;Minutes</td><td>' + item.created_at +
                    '</td><td>' + item.mode +
                    '</td><td><span class="crticon mdi mdi-lead-pencil i-part-edit-zoom img-icon-s" pid="' +
                    item.id +
                    '" title="Edit"></span>&nbsp;<a href="javascript:void(0)" onclick="deletPartModal('+item.id+')" data-toggle="modal" data-target="#delete-part-modal img-icon-s"><span class="crticon mdi mdi-delete-forever" pid="' +
                    item.id + '" title="Delete"></span></a></td></tr>');
                }
            })
        })
    }

</script>
<script>

   function deletPartModal(part_id){
    $("#hnd_temp_part_id").val(part_id);
        $('#delete-part-modal').modal('show');

    }
    $('#delete-request').click(function () {
         // var id = $(this).attr('pid');
          var id = $("#hnd_temp_part_id").val();
        $('#delete-part-modal').modal('hide');
        // var id = $('#delete-part-id').val();
        $.get('/user/content/part/delete/' + id);
       window.location.reload(true)
        // refreshContent();
    })

</script>
<script>
    

    $('body').on('click', 'span.i-part-edit', function () {
        console.log('edit');
        var id = $(this).attr('pid');
        $.get('/user/content/part/edit/' + id, function (data) {
            $('.edit-part-section').show();
            var efrom = '#step-5-form-edit-part ';
            $('#part-edit-id').val(id);
            $(efrom + 'a#video_preview').attr("href", data.upload_video);
            $(efrom + 'input[name="upload_video"]').val(data.upload_video);
            $(efrom + 'input[name="sort"]').val(data.sort);
            $(efrom + 'input[name="size"]').val(data.size);
            $(efrom + 'input[name="duration"]').val(data.duration);
            $(efrom + 'input[name="title"]').val(data.title);
            $(efrom + 'textarea[name="description"]').html(data.description);
            $(efrom + 'input[name="initial_date"]').val(data.initial_date);
            $(efrom + 'input[name="limit_date"]').val(data.limit_date);
            if (data.free == 1) {
                $('.free-edit-check-state .ios-switch').removeClass('off');
                $('.free-edit-check-state .ios-switch').addClass('on');
            } else {
                $('.free-edit-check-state .ios-switch').removeClass('on');
                $('.free-edit-check-state .ios-switch').addClass('off');
            }

            $('html, body').animate({
                scrollTop: $('.edit-part-section').offset().top
            }, 2000);
        })
        if ($('.new-part-click').next('.submenu').css('display') == 'block') {
            $('.new-part-click').click();
        }
        if ($('.edit-part-click').next('.submenu').css('display') == 'none') {
            $('.new-part-click').click();
        }
    })

    $('body').on('click', 'span.i-part-edit-zoom', function () {
        console.log('edit');
        var id = $(this).attr('pid');
        $.get('/user/content/part/edit/' + id, function (data) {
            $('.edit-part-section-zoom').show();
            var efrom = '#step-6-form-edit-part ';
            $('#part-edit-id').val(id);
            $(efrom + 'input[name="part_id"]').val(data.id);
            $(efrom + 'input[name="date"]').val(data.date);
            $(efrom + 'input[name="time"]').val(data.time);
            $(efrom + 'input[name="duration"]').val(data.duration);
            $(efrom + 'input[name="mail"]').val(data.mail);
            $(efrom + 'input[name="zoom_link"]').val(data.zoom_link);
            $(efrom + 'input[name="title"]').val(data.title);
            $(efrom + 'textarea[name="description"]').html(data.description);
            if (data.free == 1) {
                $('.free-edit-check-state .ios-switch').removeClass('off');
                $('.free-edit-check-state .ios-switch').addClass('on');
            } else {
                $('.free-edit-check-state .ios-switch').removeClass('on');
                $('.free-edit-check-state .ios-switch').addClass('off');
            }

            $('html, body').animate({
                scrollTop: $('.edit-part-section-zoom').offset().top
            }, 2000);
        })
        if ($('.new-part-click').next('.submenu_zoom').css('display') == 'block') {
            $('.new-part-click').click();
        }
        if ($('.edit-part-click').next('.submenu_zoom').css('display') == 'none') {
            $('.new-part-click').click();
        }
    })

</script>
<script>
    $('#edit-part-submit').click(function (e) {
        e.preventDefault();
        var id = $('#part-edit-id').val();
        $.post('/user/content/part/edit/store/' + id, $('#step-5-form-edit-part').serialize(), function (data) {
            //console.log(data);
        });
        refreshContent();
        $.notify({
            message: 'Part changes saved successfully.'
        }, {
            type: 'info',
            allow_dismiss: false,
            z_index: '99999999',
            placement: {
                from: "bottom",
                align: "right"
            },
            position: 'fixed'
        });
    })

</script>
<script>
    $('.click-to-upload-vimeo').click(function () {
        let url = $('#vimeo_url').val();
        if (url == '' || url == null) {
            return $('#vimeo_url').css('background-color', '#FDA09B');
        }
        $('#vimeo_url').css('background-color', 'white');
        $('.vimeo-waiting').show();
        $.get('/user/vimeo/download?link=' + url, function (data) {
            if (data == 'ok') {
                $('.vimeo-waiting').removeClass('blink').text('ok');
            }
        });
    });

</script>
@endsection
