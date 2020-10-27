@extends(getTemplate().'.user.layout.sendvideolayout')

@section('pages')
    <div class="h-30"></div>
    <div class="conteiner-fluid">
        <div class="container cont-10">
            <div class="h-30"></div>
            <div class="multi-steps">
                <div class="row">
                    <div class="col-md-6"><a href="/user/content/new_course"><button class="btn btn-primary btn-lg btn-block">{{{ trans('main.select_course') }}}</button></a></div>
                    <div class="col-md-6"><a href="/user/content/new_webinar"><button class="btn btn-primary btn-lg btn-block">{{{ trans('main.select_webinar_or_coaching') }}}</button></a></div>
                </div>
            </div>
            <div class="h-30"></div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('.editor-te').jqte({format: false});
    </script>
    <script>
        $('document').ready(function () {
            $('input[name="post"]').change(function () {
                if($(this).prop('checked')){
                    $('input[name="post_price"]').removeAttr('disabled');
                }else{
                    $('input[name="post_price"]').attr('disabled','disabled');
                }
            });
            $('#free').change(function () {
                if($(this).prop('checked')){
                    $('input[name="price"]').attr('disabled','disabled');
                    $('input[name="post_price"]').attr('disabled','disabled');
                }else{
                    $('input[name="price"]').removeAttr('disabled');
                }
            });
        })
    </script>
    <script>
        $('#category_id').change(function () {
            var id = $(this).val();
            $('.filter-tags').removeAttr('checked');
            $('.filters').not('#filter'+id).each(function(){
                $('.filters').slideUp();
            });
            $('#filter'+id).slideDown(500);
        })
    </script>
@endsection
