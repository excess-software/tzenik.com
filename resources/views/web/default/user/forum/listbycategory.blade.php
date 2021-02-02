@extends(getTemplate().'.view.layout.layout')
@section('title')
    {{{ trans('main.forum_title') }}}
@endsection
@section('content')
@include(getTemplate() . '.user.parts.navigation')

    <div class="row">
        <div class="col-lg-12 col-xs-12 col-md-12">
            <h2 class="titulo-partials"></h2>
            <a href="/user/forum" class="float-left" style="text-decoration: none;"><h4 class="text-dark"><i class="fas fa-arrow-left"></i> Regresar</h4></a>
        </div>
        <div class="col-lg-6 col-xs-6 col-md-6">
            
        </div>        
    </div>
    <br>

    <section class="card">
        <div class="card-body">
            <table class="table table-dark" id="datatable-details">
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
</div>
@endsection
