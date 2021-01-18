@extends(getTemplate().'.view.layout.layout')
@section('title')
{{ !empty($setting['site']['site_title']) ? $setting['site']['site_title'] : '' }}
- {{ $post->title ?? '' }}
@endsection

@section('content')
@include(getTemplate() . '.view.parts.navigation')

<div class="container">
    <div class="">
        <div class="col-md-12 volver-atras-blog">
            <br>
            <div class="row">
                <a href="javascript:history.back()">
                    <h4><i class="fa fa-arrow-left"> </i><span> Blogs</span></h4>
                </a>
            </div>
            <br>
        </div>
    </div>
    <br>
    <div class="row ">
        <div class="col-md-2 ">
        </div>
        <div class="col-md-8 content-blog">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <img class="img-responsive media-blog" src="{{ $post->image }}">
                    </div>
                    <div class="row">
                        <h2><b>{{$post->title}}</b></h2>
                    </div>
                    <br>
                    <div class="row">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 ">
        </div>
    </div>
</div>
@endsection
