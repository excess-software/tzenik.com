@extends(getTemplate().'.view.layout.layout')
@section('title')
    {{{ trans('main.forum_title') }}}
@endsection
@section('content')
@include(getTemplate() . '.user.parts.navigation')
<div class="container">    
    <div class="row">
        <div class="col-md-12">
            
            <a href="/user/forum/post/new" class="pull-right"><button class="btn btn-custom">{{{ trans('main.forum_btn_new_thread') }}}</button></a>
        </div>
        <!--<div class="col-lg-6 col-xs-6 col-md-6">
            <a href="/user/video/buy" class="float-left" style="text-decoration: none;"><h4 class="text-dark"><- {{{ trans('main.forum_goback') }}}</h4></a>
        </div>    -->    
    </div> 
    @if($private)
    <h2>Cursos Privados</h2>
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
                                <h2><a style="text-decoration: none;" href="/user/forum/post/category/{{{ $list['id'] }}}" class="text-primary">{{{ $list['title'] }}}</a></h2>
                                <p class="text-secondary">{{{ $list['desc'] }}}</p>
                            </div>
                        </div>    
                    </section>
                </div>    
            @endforeach
        </div>
        @endif
   
    <h2 class="pull-left">{{{ trans('main.forum_category_title') }}}</h2>
        <div class="row">
            @foreach($lists as $list)
                @if($loop->index%2==0)
                    </div>
                    <div class="row">
                @endif
                <div class="col-md-6">    
                    <section class="panel panel-default">
                        <div class="panel-body-forum">
                            <div class="row ultimos-blogs-titulo">
                                <h2><a style="text-decoration: none;" href="/user/forum/post/category/{{{ $list->id }}}" class="text-primary">{{{ $list->title }}}</a></h2>
                                <p class="text-secondary">{{{ $list->desc }}}</p>
                            </div>
                        </div>    
                    </section>
                </div>    
            @endforeach
        </div>
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

