@extends(getTemplate().'.view.layout.layout')

@section('title')
{{ get_option('site_title','') }} - {{ !empty($category->title) ? $category->title : 'Categories' }}
@endsection

@section('content')
<div>
    @include(getTemplate() . '.user.parts.navigation')
                    <div class="col-md-3">
                        <h2 class="titulo-partials">Filtros</h2>
                        <ul class="list-group">
                            <a href="/user/dashboard/all" style="text-decoration: none;">
                                <li class="list-group-item list-content-media"><b>Todos los cursos</b></li>
                            </a>
                            <br>
                            <a href="/user/dashboard/inProcess" style="text-decoration: none;">
                                <li class="list-group-item list-content-media"><b>Cursos en proceso</b></li>
                            </a>
                            <br>
                            <a href="/user/dashboard/finished" style="text-decoration: none;">
                                <li class="list-group-item list-content-media list-active"><b>Cursos terminados</b></li>
                            </a>
                            <br>
                            <a href="/user/quizzes" style="text-decoration: none;">
                                <li class="list-group-item list-content-media"><b>Calificaciones</b></li>
                            </a>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col">
                                <h2 class="titulo-partials">Tus Cursos</h2>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($list as $item)
                            @if(isset($item[0]->content))
                            <div class="col-md-6 dash-content-user">
                                <a href="/product/{{ $item[0]->content->id }}" title="{{ $item[0]->content->title }}"
                                    class="enlace-tabs">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @php
                                                    $meta = arrayToList($item[0]->content['metas'], 'option', 'value')
                                                    @endphp
                                                    <img class="img-responsive img-ultimos-blogs"
                                                        src="{{ $meta['thumbnail']}}" alt="">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel-description vertical-center">
                                                        <div class="row ultimos-blogs-titulo">
                                                            <h3>{{ $item[0]->content->title }}</h3>
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
                                                                                class="circle-tag-cursos"></span>
                                                                            Video</span>
                                                                    </h4>
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
                            @endif
                            @endforeach
                            @if(!$list)
                            <br>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4>Aún no has completado cursos.</h4>
                                </div>
                            </div>
                            <br>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection