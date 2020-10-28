@extends('admin.newlayout.layout',['breadcom'=>['Blog','Posts']])
@section('title')
    {{{ trans('main.forum_title') }}}
@endsection
@section('page')

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th >{{{ trans('admin.th_title') }}}</th>
                    <th class="text-center" width="150">{{{ trans('admin.th_date') }}}</th>
                    <th class="text-center">{{{ trans('admin.author') }}}</th>
                    <th class="text-center">{{{ trans('admin.comments') }}}</th>
                    <th class="text-center">{{{ trans('admin.category') }}}</th>
                    <th class="text-center">{{{ trans('admin.th_status') }}}</th>
                    <th class="text-center">{{{ trans('admin.th_controls') }}}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($posts as $item)
                        <tr>
                            <td>{{{ $item->title }}}</td>
                            <td class="text-center" width="150">{{{ date('d F Y : H:i',$item->create_at) }}}</td>
                            <td class="text-center" title="{{{ $item->user->username ?? '' }}}">{{{ $item->user->name ?? '' }}}</td>
                            <td class="text-center">{{{ count($item->comments) ?? '0' }}}</td>
                            <td class="text-center">{{{ $item->category->title ?? '' }}}</td>
                            <td class="text-center">
                                @if($item->mode == 'publish')
                                    <i class="fa fa-check c-g" aria-hidden="true" title="Publish" ></i>
                                @else
                                    <i class="fa fa-times c-r" aria-hidden="true" title="Draft" ></i>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="/admin/forum/post/edit/{{{ $item->id }}}" title="Edit"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a href="#" data-href="/admin/forum/post/delete/{{{ $item->id }}}" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
