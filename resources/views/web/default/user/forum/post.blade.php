@extends(getTemplate().'.view.layout.layout')
@section('title')
    {{{ $setting['site']['site_title']}}}
    - {{{ $post->title}}}
@endsection

@section('content')
@include(getTemplate() . '.user.parts.navigation')
    <!--<div class="row">
        <div class="col-lg-6 col-xs-6 col-md-6">
            <a href="/user/forum/post/new" class="float-right" style="float: right"><button class="btn btn-info">{{{ trans('main.forum_btn_new_thread') }}}</button></a>
        </div>
        <div class="col-lg-6 col-xs-6 col-md-6">
            <a href="/user/forum/post/category/{{{ $post->category->id }}}" class="float-left" style="text-decoration: none;"><h4 class="text-dark"><- {{{ trans('main.forum_goback') }}}</h4></a>
        </div>        
    </div>-->

    <br>

<section class="card"">
    <div class="card-body" style="background-color: white;">
        <div class="col-md-12 col-xs-12 col-lg-12">
            <span>{{{ date('d F Y',$post->create_at) }}}<b> - </b>{{{$post->user->name}}}</span>
        </div>
        <br>
        <div class="col-md-12 col-xs-12 col-lg-12" style="background-color: white;">
            {{{$post->pre_content}}}
            <hr>
            {{{$post->content}}}
            <br>
                <div class="blog-comment-section">
                    
                    <hr>
                    <form method="post" action="/user/forum/post/comment/store">
                    @csrf
                        <input type="hidden" name="post_id" value="{{{ $post->id }}}"/>
                        <input type="hidden" name="parent" value="0" />
                        <div class="form-group">
                            <label>{{{ trans('main.your_comment') }}}</label>
                            <textarea class="form-control" name="comment" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-custom pull-left" value="Send">
                        </div>
                    </form>

                    <ul class="comment-box">
                        @foreach($post->comments as $comment)
                            <li>
                                <label>{{{ $comment->user->name}}}</label>
                                <label>{{{ date('d F Y | H:i',$comment->create_at) }}}</label>
                                <span>{{{$comment->comment}}}</span>
                                <span><a href="javascript:void(0);" answer-id="{{{ $comment->id }}}" answer-title="{{{ $comment->name or '' }}}" class="pull-left answer-btn">{{{ trans('main.reply') }}}</a> </span>
                                @if(count($comment->childs)>0)
                                    <ul class="col-md-11 col-md-offset-1 answer-comment">
                                        @foreach($comment->childs as $child)
                                            <li>
                                                <label>{{{ $child->name}}}</label>
                                                <label>{{{ date('d F Y | H:i',$child->create_at) }}}</label>
                                                <span>{{{$child->comment}}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
        </div>
    </div>
    </div>
</section>

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('.answer-btn').click(function () {
                var parent = $(this).attr('answer-id');
                var title = $(this).attr('answer-title');
                $('input[name="parent"]').val(parent);
                scrollToAnchor('.blog-comment-section');
                $('textarea').attr('placeholder',' Replied to '+title);
            });
        });
    </script>
    @if(!isset($user))
        <script>
            $(document).ready(function () {
                $('input[type="submit"]').click(function (e) {
                    e.preventDefault();
                    $('input[type="submit"]').val('Please login to your account to leave comment.')
                });
            });
        </script>
    @endif
@endsection
