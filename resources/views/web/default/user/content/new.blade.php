@extends(getTemplate() . '.user.vendor.layout.layout')
@section('page')

<div class="cards">
    <div class="card-body">
        <div class="tabs">
            <ul class="nav nav-pills partes-nuevo-curso">
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link active" cstep="1" data-toggle="tab"> {{ trans('main.general') }} </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link disabled" cstep="2" data-toggle="tab">{{ trans('main.category') }}</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link disabled" cstep="3" data-toggle="tab">{{ trans('main.extra_info') }}</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link disabled" cstep="4" data-toggle="tab">{{ trans('main.view') }}</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link disabled" cstep="5" data-toggle="tab">{{ trans('main.parts') }}</a>
                </li>
            </ul>
        </div>
        <br>
        <div class="tab-content">
            <div class="steps" id="step1">
                <form method="post" action="/user/content/new/store" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault">{{ trans('main.course_type') }}</label>
                        <div class="col-md-10 tab-con">
                            <select name="type" class="form-control font-s">
                                <option value="single">{{ trans('main.single') }}</option>
                                <option value="course">{{ trans('main.course') }}</option>
                                <option value="webinar">{{ trans('main.webinar') }}</option>
                                <option value="course+webinar">{{ trans('main.course_webinar') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault">{{ trans('main.publish_type') }}</label>
                        <div class="col-md-10 tab-con">
                            <select name="private" class="form-control font-s">
                                <option value="2">Fundal</option>
                                <option value="0">{{ trans('main.open') }}</option>
                                <option value="3">Videoteca</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault">{{ trans('main.course_title') }}</label>
                        <div class="col-md-10 tab-con">
                            <input type="text" name="title" placeholder="30-60 Characters" class="form-control"
                            onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2 tab-con"
                            for="inputDefault">{{ trans('main.description') }}</label>
                        <div class="col-md-10 tab-con">
                            <textarea class="form-control" rows="12" placeholder="Description..."
                                name="content" required></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="col-md-12 tab-con">
                            <input type="submit" class="btn btn-primary pull-left" value="Next">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $('.editor-te').jqte({
        format: false
    });

</script>
<script>
    $('document').ready(function () {
        $('input[name="post"]').change(function () {
            if ($(this).prop('checked')) {
                $('input[name="post_price"]').removeAttr('disabled');
            } else {
                $('input[name="post_price"]').attr('disabled', 'disabled');
            }
        });
        $('#free').change(function () {
            if ($(this).prop('checked')) {
                $('input[name="price"]').attr('disabled', 'disabled');
                $('input[name="post_price"]').attr('disabled', 'disabled');
            } else {
                $('input[name="price"]').removeAttr('disabled');
            }
        });
    })

</script>
<script>
    /*$('#category_id').change(function () {
        var id = $(this).val();
        $('.filter-tags').removeAttr('checked');
        $('.filters').not('#filter' + id).each(function () {
            $('.filters').slideUp();
        });
        $('#filter' + id).slideDown(500);
    })/*

</script>
@endsection
