@extends(getTemplate().'.view.layout.layout')
@section('title')
{{ !empty($setting['site']['site_title']) ? $setting['site']['site_title'] : '' }}
@endsection
<!-- @section('page')
    @include(getTemplate() . '.view.parts.slider')
    @include(getTemplate() . '.view.parts.container')
    @if(isset($setting['site']['main_page_newest_container']) and $setting['site']['main_page_newest_container'] == 1)
        @include(getTemplate() . '.view.parts.newest')
    @endif
    @if(isset($setting['site']['main_page_popular_container']) and $setting['site']['main_page_popular_container'] == 1)
        @include(getTemplate() . '.view.parts.popular')
        @include(getTemplate() . '.view.parts.most_sell')
    @endif
    @if(isset($setting['site']['main_page_vip_container']) and $setting['site']['main_page_vip_container'] == 1)
        @include(getTemplate() . '.view.parts.vip')
    @endif
    @include(getTemplate() . '.view.parts.news')
    @include(getTemplate(). '.view.parts.pills')

@endsection -->
@section('content')
@include(getTemplate() . '.view.parts.navigation')

<hr>

<div class="banner-tzenik">
    <div class="row">
        <div class="col">
            <img class="img-responsive center-block d-block mx-auto" alt="Brand" src="{{ get_option('site_logo') }}"
                alt="{{ get_option('site_title') }}" />
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            <span>
                <h1><b>Alegr&iacute;a de Aprender</b></h1>
            </span>
        </div>
    </div>
    <div class="row text-center">
        <div class="col banner-descripcion">
            <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac laoreet ante, ut iaculis
                purus. Donec nec eleifend ligula, id sollicitudin sem. Phasellus pharetra tellus at auctor
                faucibus. Cras posuere nec sem a consequat. Phasellus pharetra tellus at auctor faucibus. Cras
                posuere nec sem a consequat.</h3>
        </div>
    </div>
</div>

<hr>

<div class="row">
    <div class="container-fluid">
        <div class="col titulo-cursos-destacados">
            <span>
                <h2><b>Cursos Destacados</b></h2>
            </span>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="container-fluid">
        <div class="col-md-9 cursos-destacados">
            @php
            $contador_cursos_nuevos = 1;
            @endphp
            @foreach($popular_content as $popular)
            <?php $meta = arrayToList($popular->metas, 'option', 'value'); ?>
            @if($popular->type == 'course')
            @if($contador_cursos_nuevos <= 5)
            <a href="/product/{{ $popular->id }}">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel-description vertical-center">
                                <div class="row curso-destacado-titulo black-text">
                                    <h3><b>{{ $popular->title }}</b></h3>
                                </div>
                                <div class="row curso-destacado-contenido">
                                    <div class="col">
                                        <span class="curso-destacado-contenido-interno black-text">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img class="img-responsive" src="{{ !empty($meta['thumbnail']) ? $meta['thumbnail'] : '' }}"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-cursos-destacados btn-block">
                        <h4><b>Continuar</b></h4>
                    </button>
                </div>
            </div>
            </a>  
            @php
            $contador_cursos_nuevos++;
            @endphp
            @endif
            @endif
            @endforeach
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="container-fluid">
        <div class="col titulo-proximos-webinars">
            <span>
                <h2><b>Pr&oacute;ximos Webinars</b></h2>
            </span>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="container-fluid">
        <div class="col-md-9 proximos-webinars">
        @php
            $contador_webinars = 1;
            @endphp
            @foreach($new_content as $new)
            <?php $meta = arrayToList($new->metas, 'option', 'value'); ?>
            @if($new->type == 'webinar')
            @if($contador_webinars <= 5)
            <a href="/product/{{ $new->id }}">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img-responsive center-block img-proximos-webinars"
                                src="{{ !empty($meta['thumbnail']) ? $meta['thumbnail'] : '' }}" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="panel-description vertical-center">
                                <div class="row proximos-webinars-titulo">
                                    <h3><b>{{ $new->title }}</b></h3>
                                </div>
                                <div class="row proximos-webinars-contenido">
                                    <div class="col">
                                        <span class="proximos-webinars-contenido-interno">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-proximos-webinars btn-block">
                        <h4><b>Continuar</b></h4>
                    </button>
                </div>
            </div>
            </a>  
            @php
            $contador_webinars++;
            @endphp
            @endif
            @endif
            @endforeach
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="container-fluid">
        <div class="col titulo-ultimos-blogs">
            <span>
                <h2><b>&Uacute;ltimos Blogs</b></h2>
            </span>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="container-fluid ultimos-blogs">
    @php
            $contador_blog = 1;
            @endphp
            @foreach($blog_post as $post)
            <?php $meta = arrayToList($post->metas, 'option', 'value'); ?>
            @if($contador_blog <= 2)
            <a href="/blog/post/{{ $post->id }}">
            <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img class="img-responsive img-ultimos-blogs center-block"
                                src="{{ $post->image }}" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-description vertical-center">
                                <div class="row ultimos-blogs-titulo">
                                    <h2><b>{{ $post->title }}</b></h2>
                                </div>
                                <div class="row ultimos-blogs-contenido">
                                    <div class="col">
                                        <span class="ultimos-blogs-contenido-interno">
                                        {!! Str::limit($post->pre_content, 100) !!}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-ultimos-blogs btn-block">
                        <h4><b>Continuar</b></h4>
                    </button>
                </div>
            </div>
        </div>
            </a>  
            @php
            $contador_blog++;
            @endphp
            @endif
            @endforeach
    </div>
</div>
@endsection
