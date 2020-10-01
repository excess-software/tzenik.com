@extends(getTemplate().'.view.layout.layout')
@section('title')
{{ !empty($setting['site']['site_title']) ? $setting['site']['site_title'] : '' }}
- {{ $product->title }}
@endsection
@section('content')
<div class="row visualizador-media">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 volver-atras-media">
                <br>
                <div class="row">
                    <a href="javascript:history.back()"><h4><i class="fa fa-arrow-left"> </i><span> Cursos</span></h4></a>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-8">
                        <h2><b>{{ $product->title }}</b></h2>
                    </div>
                    <!--<div class="col-md-4">
                        @if($product->support == 1)
                        <button class="btn btn-next-media pull-right">
                            <h5><b>Soporte</b></h5>
                        </button>
                        @endif
                    </div>-->
                </div>
                <br>
                <div class="row">
                    <video id="myDiv" class="media-cursos" controls>
                        <source src="{{ !empty($partVideo) ? $partVideo : $meta['video'] }}" type="video/mp4" />
                    </video>
                </div>
                <!-- <br>
                <div class="row">
                    <button class="btn btn-next-media pull-right">
                        <h4>Siguiente <i class="fa fa-arrow-right"></i></h4>
                    </button>
                </div>-->
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 content-media-curso">
                <div class="row">
                    <div class="col-md-5">
                        <div class="row text-content-media-curso">
                            <h2>{{!empty($partDesc->title) ? $partDesc->title : $partDesc[0]->title}}</h2>
                            <br>
                            <span>{!! !empty($partDesc->description) ? $partDesc->description : $partDesc[0]->description !!}</span>
                        </div>
                        <br>
                        <div class="row">
                            <h2>Materiales</h2>
                            <br>
                            <button class="btn btn-media-descargar-leccion">
                                <h4>Descargar Materiales de Lecci&oacute;n</h4>
                            </button>
                            <br>
                            <button class="btn btn-media-descargar-curso">
                                <h4>Descargar Materiales del Curso</h4>
                            </button>
                        </div>
                        <br>
                        <div class="row">
                            <h2>Etiquetas</h2>
                            <br>
                            @foreach(explode(',', $product->tag) as $tag)
                            <h4><span class="label label-tag-cursos"> <span class="circle-tag-cursos"></span>
                                    {{$tag}}</span></h4>
                            @endforeach
                        </div>
                        <br>
                        <div class="row">
                            <h2>Categor&iacute;a</h2>
                            <br>
                            <h4><span class="label label-tag-media-categoria"> <span
                                        class="circle-tag-media-categoria"></span>
                                    {{ $product->category->title }}</span></h4>
                        </div>
                        <br>
                    </div>
                    <div class="col-md-5">
                        <h2>Lista</h2>
                        <ul class="list-group partes-curso">
                            <!--@foreach($parts as $part)
                            <li>
                                <div class="part-links">
                                    <a href="/product/part/{{ $product->id }}/{{ $part['id'] }}">
                                        <div class="col-md-1 hidden-xs tab-con">
                                            @if($buy or $part['free'] == 1)
                                            <span class="playicon mdi mdi-play-circle"></span>
                                            @else
                                            <span class="playicon mdi mdi-lock"></span>
                                            @endif
                                        </div>
                                        <div
                                            class="@if($product->download == 1) col-md-4 @else col-md-5 @endif col-xs-10 tab-con">
                                            <label>{{ $part['title'] }}</label>
                                        </div>
                                    </a>
                                    <div class="col-md-2 tab-con">
                                        <span class="btn btn-gray btn-description hidden-xs" data-toggle="modal"
                                            href="#description-{{ $part['id'] }}">{{ trans('main.description') }}</span>
                                        <div class="modal fade" id="description-{{ $part['id'] }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">
                                                            &times;
                                                        </button>
                                                        <h4 class="modal-title">{{ trans('main.description') }}</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! $part['description'] !!}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-custom pull-left"
                                                            data-dismiss="modal">{{ trans('main.close') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center hidden-xs tab-con">
                                        <span>{{ $part['size'] }} {{ trans('main.mb') }}</span>
                                    </div>
                                    <div class="col-md-2 hidden-xs tab-con">
                                        <span>{{ $part['duration'] }} {{ trans('main.minute') }}</span>
                                    </div>
                                    @if($product->download == 1)
                                    <div class="col-md-1 col-xs-2 tab-con">
                                        <span class="download-part" data-href="/video/download/{{ $part['id'] }}"><span
                                                class="mdi mdi-arrow-down-bold"></span></span>
                                    </div>
                                    @endif
                                </div>
                            </li>
                            @endforeach-->
                            @foreach($parts as $part)
                            <a href="/product/part/{{ $product->id }}/{{ $part['id'] }}">
                                <li class="list-group-item list-content-media">
                                    @if($buy or $part['free'] == 1)
                                    <span class="playicon mdi mdi-play-circle"></span>
                                    @else
                                    <span class="playicon mdi mdi-lock"></span>
                                    @endif
                                    <b>
                                        {{ $part['title'] }}
                                    </b>
                                </li>
                            </a>
                            <br>
                            @endforeach
                            @if($buy)
                            @if (!empty($product->quizzes) and !$product->quizzes->isEmpty())
                            @foreach ($product->quizzes as $quiz)
                            @if($quiz->can_try)
                            <a href="{{ '/user/quizzes/'. $quiz->id .'/start'}}">
                                <li class="list-group-item list-content-media">
                                    <b>Quiz Final</b>
                                </li>
                            </a>
                            @endif
                            @endforeach
                            @endif
                            @endif
                        </ul>
                        @foreach($product->quizzes as $quiz)
                        @if(isset($quiz->user_grade))
                        @if($quiz->result_status == 'pass')
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="resultado-quiz" style="background-color: #3ED2B8">
                                    <p><b>Calificaci&oacute;n</b></p>
                                    <br>
                                    <p>
                                        <h3><b>¡{{$quiz->user_grade}}!</b></h3>
                                    </p>
                                    <br>
                                    <p>
                                        <h4><b>¡Felicidades!</b></h4>
                                    </p>
                                </div>
                            </div>
                            @elseif($quiz->result_status == 'fail')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <div class="resultado-quiz" style="background-color: red">
                                        <p><b>Calificaci&oacute;n</b></p>
                                        <br>
                                        <p>
                                            <h3><b>¡{{$quiz->user_grade}}!</b></h3>
                                        </p>
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="resultado-quiz" style="background-color: lightgray">
                                            <p><b>Calificaci&oacute;n</b></p>
                                            <br>
                                            <p>
                                                <h3><b>Pendiente</b></h3>
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @else
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="resultado-quiz" style="background-color: lightgray">
                                            <p><b>Calificaci&oacute;n</b></p>
                                            <br>
                                            <p>
                                                <h3><b>Pendiente</b></h3>
                                            </p>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endsection
