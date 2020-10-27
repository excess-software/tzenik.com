@extends('admin.newlayout.layout',['breadcom'=>['Users','Edit']])
@section('title')
    Nuevo Usuario
@endsection
@section('page')
    <div class="cards">
        <div class="card-body">
            <div class="tabs">
                <div class="tab-content">
                    <div id="main" class="tab-pane active">
                        <form action="/admin/user/guardar" class="form-horizontal form-bordered" method="post">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputDefault">{{ trans('admin.real_name') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" value="" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputReadOnly">{{ trans('admin.username') }}</label>
                                <div class="col-md-6">
                                    <input type="text" value="" name="username" id="inputReadOnly" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="inputReadOnly">{{ trans('admin.email') }}</label>
                                <div class="col-md-6">
                                    <input type="text" value="" name="email" id="inputReadOnly" class="form-control text-left" dir="ltr">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">{{ trans('admin.th_status') }}</label>
                                <div class="col-md-6">
                                    <select name="mode" class="form-control populate">
                                        <option value="active">Activo</option>
                                        <option value="block">Inactivo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">{{ trans('admin.user_groups') }}</label>
                                <div class="col-md-6">
                                    <select name="category_id" class="form-control populate">
                                        @foreach($categorias as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="submit">{{ trans('admin.save_changes') }}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
