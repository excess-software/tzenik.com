@extends('web.default.user.layout.forum',['breadcom'=>['Forum','Posts']])
@section('title')
    {{{ trans('main.forum_title') }}}
@endsection
@section('page')

    <div class="row">
        <div class="col-lg-6 col-xs-6 col-md-6">
            <a href="/user/forum/post/new" class="float-right" style="float: right"><button class="btn btn-info">{{{ trans('main.forum_btn_new_thread') }}}</button></a>
        </div>
        <div class="col-lg-6 col-xs-6 col-md-6">
            <a href="/user/forum" class="float-left" style="text-decoration: none;"><h4 class="text-dark"><- {{{ trans('main.forum_goback') }}}</h4></a>
        </div>        
    </div>
    <br>

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th style="" >{{{ trans('admin.th_title') }}}</th>
                    <th style="width: 15%" class="text-center">{{{ trans('admin.author') }}}</th>
                    <th style="width: 15%" class="text-center" width="150">{{{ trans('admin.th_date') }}}</th>
                    <!--<th style="width: 10%" class="text-center">{{{ trans('admin.comments') }}}</th>-->
                </tr>
                </thead>
                <tbody>
                    @foreach($posts as $item)
                        <tr>
                            <td><p><a style="text-decoration: none;" href="/user/forum/post/read/{{{ $item->id }}}">{{{ $item->title }}}</a></p></td>
                            <td class="text-center" title="{{{ $item->username or '' }}}">{{{ $item->name or '' }}}</td>
                            <td class="text-center" width="150">{{{ date('d F Y : H:i',$item->create_at) }}}</td>
                            <!--<td class="text-center">{{{ count($item->comments) or '0' }}}</td>-->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection

