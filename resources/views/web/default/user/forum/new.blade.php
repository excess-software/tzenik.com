@extends(getTemplate().'.view.layout.layout')
@section('title')
    {{{ trans('admin.new_post') }}}
@endsection
@section('content')
@include(getTemplate() . '.user.parts.navigation')
<div class="row">
    <div class="col-lg-12 col-xs-6">
        <h2 class="titulo-partials"></h2>
        <a href="../" class="float-left" style="text-decoration: none;"><h4 class="text-dark"><i class="fas fa-arrow-left"></i> Regresar</h4></a>
    </div>        
</div>
<div class="row">
    <div class="col-lg-12">
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
                        <option>-- Seleccione --</option>
                        @foreach($category as $cat)
                            <option value="{{{ $cat->id }}}">{{{ $cat->title }}}</option>
                        @endforeach
                        @if($private)
                            <option disabled><b> -- Categor&iacute;as privadas --</b></option>
                            @foreach($private as $cat)
                            <option value="{{{ $cat['id'] }}}">{{{ $cat['title'] }}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="inputDefault" style="float: left; margin-left: 0px; padding-left: 0px;">{{{ trans('admin.description') }}}</label>
                <div class="col-md-10">
                    <textarea name="content" class="form-control" id="" rows="3"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <button class="btn btn-custom pull-right" type="submit">{{{ trans('admin.save_changes') }}}</button>
                </div>
            </div>
        </form>
    </div>         
</div>
@endsection
@section('script')
    <script>$(".inputtags").tagsinput('items');</script>
@endsection
