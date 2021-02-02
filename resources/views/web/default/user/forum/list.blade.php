@extends(getTemplate().'.view.layout.layout')
@section('title')
    {{{ trans('main.forum_title') }}}
@endsection
@section('content')
@include(getTemplate() . '.user.parts.navigation')

    <div class="row">
        <div class="col-md-12 ">
            <h2 class="titulo-partials-forum ">{{{ trans('main.forum_category_title') }}}</h2>
            <a href="/user/forum/post/new" class="">
                <button class="btn btn-custom-forum ">Crear Nueva Discución</button>
            </a>
        </div>
    </div> 
    
    <div class="row">
        @foreach($lists as $list)
        @if($loop->index%2==0)
    </div>
    <div class="row">
        @endif
            <div class="col-md-6">    
                <a style="text-decoration: none;" href="/user/forum/post/category/{{{ $list->id }}}">
                    <section class="panel panel-default">
                        <div class="panel-body-forum">
                            <div class="row ultimos-blogs-titulo">
                                <h3> {{{ $list->title }}}</h3>
                                <p class="text-secondary">{{{ $list->desc }}}</p>
                            </div>
                        </div>    
                    </section>
                </a>
            </div>    
        @endforeach
    </div>

    @if($private)
        <h3>Cursos Privados</h3>
        <div class="row">
            @foreach($private as $list)
                @if($loop->index%2==0)
                    </div>
                    <div class="row">
                @endif
                <div class="col-md-6">    
                    <section class="panel panel-default">
                        <div class="panel-body-forum">
                            <div class="row ultimos-blogs-titulo">
                                <h3><a style="text-decoration: none;" href="/user/forum/post/category/{{{ $list['id'] }}}" class="text-primary">{{{ $list['title'] }}}</a></h3>
                                <p class="text-secondary">{{{ $list['desc'] }}}</p>
                            </div>
                        </div>    
                    </section>
                </div>    
            @endforeach
        </div>
    @endif    
            <!--<table class="table table-borderes table-striped mb-none" id="datatable-details">
                <thead>
                    <tr>
                        <th>{{{ trans('main.forum_category_title') }}}</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <tr>
                            <td><p><a style="text-decoration: none;" href="/user/forum/post/category/{{{ $list->id }}}" class="text-primary">{{{ $list->title }}}</a></p><p clasS="text-secondary">{{{ $list->desc }}}</p></td>
                        </tr>
                    
                </tbody>
            </table>-->
        
        
        <!--<div class="card-body">
            
            <table class="table table-borderes table-striped mb-none" id="datatable-details">
                <thead>
                    <tr>
                        <th>{{{ trans('main.forum_category_title') }}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($private as $list)
                        <tr>
                            <td><p><a style="text-decoration: none;" href="/user/forum/post/category/{{{ $list['id'] }}}" class="text-primary">{{{ $list['title'] }}}</a></p><p clasS="text-secondary">{{{ $list['desc'] }}}</p></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>-->
        
    </section>
</div>
@endsection
