@extends(getTemplate().'.view.layout.layout')
@section('title')
{{ get_option('site_title','') }} - {{ !empty($category->title) ? $category->title : 'Categories' }}
@endsection
@section('content')
<ul class="nav nav-tabs nav-justified">
    <li role="presentation"><a class="nav-home" href="#">Home</a></li>
    @foreach($setting['category'] as $mainCategory)
    @if($mainCategory->title == 'Forum' || $mainCategory->title == 'forum')
    <li role="presentation" class="active"><a class="nav-home" href="/user/forum">{{  $mainCategory->title }}</a></li>
    @else
    <li role="presentation" class="active"><a class="nav-home" href="/category/{{  $mainCategory->title }}">{{  $mainCategory->title }}</a></li>
    @endif
    @endforeach
</ul>
<br>
<div class="row">
    <div class="container-fluid">
        <div class="col titulo-cursos-destacados">
            <span>
                <h2><img src="{{ $category->icon }}" width="30px" height="30px" /><b> {{ $category->title }}</b></h2>
            </span>
        </div>
    </div>
</div>
<br>
<div class="row ultimos-blogs">
    @foreach($contents as $content)
    <div class="col-md-5">
        <a href="/product/{{ $content['id'] }}" title="{{ $content['title'] }}" class="enlace-tabs">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img class="img-responsive img-ultimos-blogs"
                                src="{{ !empty($content['metas']['thumbnail']) ? $content['metas']['thumbnail'] : '' }}"
                                alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-description vertical-center">
                                <div class="row ultimos-blogs-titulo">
                                    <h4><b>{{ $content['title'] }}</b></h4>
                                </div>
                                <!--<div class="row ultimos-blogs-contenido">
                                    <div class="col">
                                        <span class="ultimos-blogs-contenido-interno">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac
                                            laoreet
                                            ante, ut iaculis
                                            purus. Donec nec eleifend ligula, id sollicitudin sem. Phasellus
                                            pharetra
                                            tellus at auctor
                                            faucibus. Cras posuere nec sem a consequat. Phasellus pharetra
                                            tellus at
                                            auctor faucibus. Cras
                                            posuere nec sem a consequat.
                                        </span>
                                    </div>
                                </div>-->
                                <div class="row ultimos-blogs-contenido">
                                    <div class="col">
                                        <span class="ultimos-blogs-contenido-interno">
                                            <h4><span class="label label-tag-cursos"> <span
                                                        class="circle-tag-cursos"></span> Video</span></h4>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-cursos-listado btn-block">
                        <h4><b>Continuar</b></h4>
                    </button>
                </div>
            </div>
        </a>
    </div>
    @endforeach

</div>
@endsection
