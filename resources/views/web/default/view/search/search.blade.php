@extends(getTemplate().'.view.layout.layout')
@section('title')
{{ get_option('site_title','') }} Search - {{ !empty(request()->get('q')) ? request()->get('q') : '' }}
@endsection
@section('content')
<div class="container">
    <div class="row cat-search-section">
        <div class="container">
            <div class="col-md-6 col-sm-6 col-xs-12 cat-icon-container">
                <span> {{ !empty($search_title) ? $search_title : 'Search' }}
                    "{{ !empty(request()->get('q')) ? request()->get('q') : '' }}"</span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <form>
                    {{ csrf_field() }}
                    <select class="form-control font-s" name="search_type">
                        @foreach ($searchTypes as $index => $searchType)
                        <option value="{{$searchType}}" @if(!empty(request()->get('type')) && request()->get('type') ==
                            $index) selected @endif>{{ $searchType }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
@if($contents)
<div class="row">
    <div class="container">
        <div class="col-md-12 cursos-destacados">
            @foreach($contents as $content)

            @if(empty(request()->get('type')) or (!empty(request()->get('type')) and request()->get('type') !==
            'user_name'))
            <a href="/product/{{ $content['id'] }}">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="panel-description vertical-center">
                                    <div class="row curso-destacado-titulo black-text">
                                        <h3><b>{{  $content['title'] }}</b></h3>
                                    </div>
                                    <div class="row curso-destacado-contenido">
                                        <div class="col">
                                            <span class="curso-destacado-contenido-interno black-text">
                                                {!! Str::limit($content['content'], 250) !!}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img class="img-responsive" style="max-height: 300px !important; width: auto;"
                                    src="{{ !empty($content['metas']['thumbnail']) ? $content['metas']['thumbnail'] : 'https://cdn-a.william-reed.com/var/wrbm_gb_food_pharma/storage/images/1/8/6/0/230681-6-eng-GB/IB3-Limited-SIC-Pharma-April-20142_news_large.jpg' }}"
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
            @else

            <a href="/profile/{{ $content['id'] }}" title="{{ $content['name'] }}" class="text-center">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel-description vertical-center">
                                    <div class="row curso-destacado-titulo black-text">
                                        <h3><b>{!! $content['name'] !!}</b></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <img class="img-responsive" style="max-height: 300px !important; width: auto;"
                                    src="{{ !empty($content['metas']['thumbnail']) ? $content['metas']['thumbnail'] : 'https://cdn-a.william-reed.com/var/wrbm_gb_food_pharma/storage/images/1/8/6/0/230681-6-eng-GB/IB3-Limited-SIC-Pharma-April-20142_news_large.jpg' }}"
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
            @endif
            @endforeach
        </div>
    </div>
</div>
@else
<div class="container">
    <div class="row">
        <div class="col text-center">
            <h1>{{ trans('main.no_search_result') }}</h1>
        </div>
    </div>
</div>
<br>
@endif
@endsection
@section('script')
<script>
    var category_content_count = {
        {
            !empty($setting['site']['category_content_count']) ? $setting['site']['category_content_count'] : 6
        }
    }
    $(function () {
        pagination('.body-target', category_content_count, 0);
        $('.pagi').pagination({
            items: {
                !!count($contents) !!
            },
            itemsOnPage: category_content_count,
            cssStyle: 'light-theme',
            prevText: '<i class="fa fa-angle-left"></i>',
            nextText: '<i class="fa fa-angle-right"></i>',
            onPageClick: function (pageNumber, event) {
                pagination('.body-target', category_content_count, pageNumber - 1);
            }
        });
    });

</script>
<script type="application/javascript" src="/assets/default/javascripts/category-page-custom.js"></script>
@endsection
