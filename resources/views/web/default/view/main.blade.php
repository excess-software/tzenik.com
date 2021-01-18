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

<div class="banner-tzenik">
    <div class="row">
        <div class="col">
            <img class="img-responsive center-block d-block mx-auto" alt="Brand" src="{{ get_option('site_logo') }}"
                alt="{{ get_option('site_title') }}" />
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            
                <h1 class="main">Alegr&iacute;a de Aprender</h1>
            
        </div>
    </div>
    <div class="row text-center">
        <div class="col banner-descripcion">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ac laoreet ante, ut iaculis
                purus. Donec nec eleifend ligula, id sollicitudin sem. Phasellus pharetra tellus at auctor
                faucibus. Cras posuere nec sem a consequat. Phasellus pharetra tellus at auctor faucibus. Cras
                posuere nec sem a consequat.</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="container">
        <div class="col-md-12 titulo-cursos-destacados">
            
                <h2> Cursos Destacados </h2>
            
        </div>
    </div>
</div>

<div class="row">
    <div class="container">
        <div class="col-md-12 cursos-destacados">
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
                                <div class="">
                                    <h3>{{ $popular->title }}</h3>
                                </div>
                                <div class="">
                                    <div class="col">
                                       <p> {!! Str::limit($popular->content, 200) !!}</p>
                                    </div>
                                </div>
                                <div class="">
                                    <button class="btn btn-cursos-destacados btn">
                                        <h4>Entrar a Curso</h4>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img class="img-responsive" style="width: auto;" src="{{ !empty($meta['thumbnail']) ? $meta['thumbnail'] : 'https://cdn-a.william-reed.com/var/wrbm_gb_food_pharma/storage/images/1/8/6/0/230681-6-eng-GB/IB3-Limited-SIC-Pharma-April-20142_news_large.jpg' }}"
                                alt="">
                        </div>
                    </div>
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
    <div class="container">
        <div class="col-md-12 titulo-proximos-webinars">
            <span>
                <h2> Pr&oacute;ximos Webinars </h2>
            </span>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="container">
        <div class="col-md-12 proximos-webinars">
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
                                            src="{{ !empty($meta['thumbnail']) ? $meta['thumbnail'] : 'https://cdn-a.william-reed.com/var/wrbm_gb_food_pharma/storage/images/1/8/6/0/230681-6-eng-GB/IB3-Limited-SIC-Pharma-April-20142_news_large.jpg' }}" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="panel-description vertical-center">
                                            <div class="">
                                                <h3> {{ $new->title }} </h3>
                                            </div>
                                            <div class="">
                                                <div class="col">
                                                    <span class="">
                                                        {!! Str::limit($new->content, 75) !!}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="">
                                                <button class="btn btn-proximos-webinars ">
                                                    <h4> Ingresar a Webinar </h4>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <div class="container">
        <div class="col-md-12 titulo-ultimos-blogs">
            <span>
                <h2> &Uacute;ltimos Blogs </h2>
            </span>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="container ultimos-blogs">
        @php
            $contador_blog = 1;
        @endphp
        @foreach($blog_post as $post)
            <?php $meta = arrayToList($post->metas, 'option', 'value'); ?>
        @if($contador_blog <= 2)
            
                <div class="col-md-6">
                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <img class="img-responsive img-ultimos-blogs center-block" src="{{ $post->image }}" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel-description vertical-center">
                                        <div class="row ultimos-blogs-titulo">
                                            <h3> {!! Str::limit($post->title, 25) !!} </h3>
                                        </div>
                                        <div class="row ultimos-blogs-contenido">
                                            <div class="col">
                                                <span class="ultimos-blogs-contenido-interno">
                                                {!! Str::limit($post->pre_content, 75) !!}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            
                            <a href="/blog/post/{{ $post->id }}">
                                <button class="btn btn-ultimos-blogs btn-block">
                                    <h4> Continuar </h4>
                                </button></a>
                        </div>
                    </div>
                    
                </div>
            
        @php
            $contador_blog++;
        @endphp
        @endif
        @endforeach
    </div>
</div>
@endsection
