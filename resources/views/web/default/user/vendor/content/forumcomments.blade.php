@extends(getTemplate() . '.user.vendor.layout.layout')
@section('title')
    {{{ trans('admin.edit_post') }}}
@endsection
@section('page')

    <section class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped mb-none" id="datatable-details">
                <thead>
                <tr>
                    <th width="120">{{{ trans('admin.text') }}}</th>
                    <th class="text-center" width="120">{{{ trans('admin.username') }}}</th>
                    <th class="text-center" width="200">{{{ trans('admin.created_date') }}}</th>
                    <th class="text-center" width="200">{{{ trans('admin.post') }}}</th>
                    <th class="text-center" width="150">{{{ trans('admin.th_controls') }}}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($comments as $item)

                        <tr>
                            <td>{!! $item->comment !!}</td>
                            <td class="text-center"><a target="_blank" href="javascript:void(0);">{{{ $item->user->name ?? '' }}}</a></td>
                            <td class="text-center">{!! date('d F Y / H:i',$item->create_at) !!}</td>
                            <td class="text-center">{{{ $item->post->title ?? '' }}}</td>
                            <td class="text-center">
                                <a href="#" data-href="/user/vendor/forum/comment/delete/{{{ $item->id }}}" title="Delete" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
