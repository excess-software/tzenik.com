@extends(getTemplate().'.view.layout.layout')

@section('title')
{{ get_option('site_title','') }} - {{ !empty($category->title) ? $category->title : 'Categories' }}
@endsection

@section('content')
<div class="container-full">
    @include(getTemplate() . '.user.parts.navigation')

    <div class="row contenido-cursos-dash">
        <div class="container-fluid">
            <div class="col-md-10">
                <div class="row">
                    <div class="col">
                        <h2><b>Tus Cursos</b></h2>
                    </div>
                </div>
                <div class="row">
                    @foreach($list as $item)
                    @if(isset($item->content))
                    <div class="col-md-6 dash-content-user">
                        <a href="/product/{{ $item->content->id }}" title="{{ $item->content->title }}" class="enlace-tabs">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                        @php
                                        $meta = arrayToList($item->content['metas'], 'option', 'value')
                                        @endphp
                                            <img class="img-responsive img-ultimos-blogs"
                                                src="{{ $meta['thumbnail']}}"
                                                alt="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel-description vertical-center">
                                                <div class="row ultimos-blogs-titulo">
                                                    <h4><b>{{ $item->content->title }}</b></h4>
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
                                                                        class="circle-tag-cursos"></span> Video</span>
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
                            <h1><b>Aún no has comprado cursos</b></h1>
                        </div>
                    </div>
                    <br>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $('.star-rate').raty({
        starType: 'i',
        score: function () {
            return $(this).attr('data-score');
        },
        click: function (rate) {
            var id = $(this).attr('data-id');
            $.get('/user/video/buy/rate/' + id + '/' + rate, function (data) {
                if (data == 0) {
                    $.notify({
                        message: 'Sorry feedback not send. Try again.'
                    }, {
                        type: 'danger',
                        allow_dismiss: false,
                        z_index: '99999999',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        position: 'fixed'
                    });
                }
                if (data == 1) {
                    $('.btn-submit-confirm').removeAttr('disabled');
                    $.notify({
                        message: 'Your feedback sent successfully.'
                    }, {
                        type: 'danger',
                        allow_dismiss: false,
                        z_index: '99999999',
                        placement: {
                            from: "bottom",
                            align: "right"
                        },
                        position: 'fixed'
                    });
                }
            })
        }
    });

</script>
@endsection
