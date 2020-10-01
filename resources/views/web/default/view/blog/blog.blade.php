@extends(getTemplate().'.view.layout.layout')
@section('title')
{{ !empty($setting['site']['site_title']) ? $setting['site']['site_title'] : '' }}
{{ trans('main.blog') }} -
@endsection
@section('content')
@include(getTemplate() . '.view.parts.navigation')
<div class="row">
    <div class="container-fluid">
        <div class="col titulo-blog">
            <span>
                <h2><b>Blog</b></h2>
            </span>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="container-fluid ultimos-blogs">
        @foreach($posts as $post)
        <a href="/blog/post/{{ $post->id }}">
            <div class="col-md-5">
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
                            <h4><b>Leer m&aacute;s</b></h4>
                        </button>
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
