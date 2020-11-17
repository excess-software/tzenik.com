@extends(getTemplate() . '.user.vendor.layout.layout')
@section('title')
    {{{ trans('admin.edit_post') }}}
@endsection
@section('page')

    <section class="card">
        <div class="card-body">

            <form action="/user/vendor/forum/post/store" class="form-horizontal form-bordered" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id ?? '' }}">
                <input type="hidden" name="user_id" value="{{ $item->user_id ?? '' }}">

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault">{{{ trans('admin.th_title') }}}</label>
                    <div class="col-md-10">
                        <input type="text" value="{{ $item->title ?? '' }}" name="title" class="form-control" required>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault">{{ trans('admin.category') }}</label>
                    <div class="col-md-10">
                        <select name="category_id" class="form-control select2">
                            @foreach($category as $cat)
                                <option value="{{{ $cat->id ?? 0 }}}" @if(!empty($item->category_id) && $item->category_id == $cat->id) {{{ 'selected' }}}  @endif>{{{ $cat->title }}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault">{{{ trans('admin.thumbnail') }}}</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-prepend view-selected cu-p" data-toggle="modal" data-target="#ImageModal" data-whatever="image" >
                                <span class="input-group-text"><i class="fa fa-eye" aria-hidden="true"></i></span>
                            </span>
                            <input type="text" name="image" value="{{{ $item->image ?? '' }}}" dir="ltr" class="form-control">
                            <span class="input-group-append click-for-upload cu-p">
                                <span class="input-group-text"><i class="fa fa-upload" aria-hidden="true"></i></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="pre_content" required>{{{ $item->pre_content ?? '' }}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="content" required>{{{ $item->content ?? '' }}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault">{{{ trans('admin.tags') }}}</label>
                    <div class="col-md-10">
                        <input type="text" name="tags" value="{{{ $item->tags ?? '' }}}" data-role="tagsinput" data-tag-class="label label-primary" class="form-control">
                    </div>
                </div>

                <div class="custom-switches-stacked col-md-12">
                    <label class="custom-switch">
                        <input type="hidden" name="comment" value="disable">
                        <input type="checkbox" name="comment" value="enable" class="custom-switch-input" @if($item->comment == 'enable') {{{ 'checked' }}} @endif />
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description" for="inputDefault">{{{ trans('admin.comments_enabled') }}}</label>
                    </label>
                    <label class="custom-switch">
                        <input type="hidden" name="mode" value="draft">
                        <input type="checkbox" name="mode" value="publish" class="custom-switch-input" @if($item->mode == 'publish') {{{ 'checked' }}} @endif />
                        <span class="custom-switch-indicator"></span>
                        <label class="custom-switch-description" for="inputDefault">{{{ trans('admin.publish') }}}</label>
                    </label>
                </div>

                <div class="h-10"></div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-left" type="submit">{{{ trans('admin.save_changes') }}}</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection
