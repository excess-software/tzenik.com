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
            <a href="../" class="float-left" style="text-decoration: none;"><h4 class="text-dark"><- {{{ trans('main.forum_goback') }}}</h4></a>
        </div>        
    </div>

    <br>

    <section class="card">
        <div class="card-body">
            <table class="table table-borderes table-striped mb-none" id="datatable-details">
                <thead>
                    <tr>
                        <th>{{{ trans('main.forum_category_title') }}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lists as $list)
                        <tr>
                            <td><p><a style="text-decoration: none;" href="/user/forum/post/category/{{{ $list->id }}}" class="text-primary">{{{ $list->title }}}</a></p><p clasS="text-secondary">{{{ $list->desc }}}</p></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection

