@extends('web.default.user.layout.forum',['breadcom'=>[trans('admin.blog_posts'),trans('admin.new_post')]])
@section('title')
    {{{ trans('admin.new_post') }}}
@endsection
@section('page')

    <div class="row">
        <div class="col-lg-12 col-xs-6">
        <a href="../" class="float-left" style="text-decoration: none;"><h4 class="text-dark"><- {{{ trans('main.forum_goback') }}}</h4></a>
        </div>        
    </div>

    <section class="card">
        <div class="card-body">

            <form action="/user/forum/post/store" class="form-horizontal form-bordered" method="post">
            @csrf
                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault" style="float: left;">{{{ trans('admin.th_title') }}}</label>
                    <div class="col-md-10">
                        <input type="text" name="title" class="form-control" required>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault" style="float: left;">{{{ trans('admin.category') }}}</label>
                    <div class="col-md-10">
                        <select id="category_id" name="category_id" class="form-control">
                            <option value=""></option>
                            @foreach($category as $cat)
                                <option value="{{{ $cat->id }}}">{{{ $cat->title }}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <label class="col-md-2 control-label" for="inputDefault" style="float: left; margin-left: 0px; padding-left: 0px;">{{{ trans('admin.description') }}}</label>
                <br>
                <div class="form-group">
                    <div class="col-md-12">
                        <textarea class="summernote" name="content" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-left" type="submit">{{{ trans('admin.save_changes') }}}</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
@endsection
@section('script')
    <script>$(".inputtags").tagsinput('items');</script>
@endsection

