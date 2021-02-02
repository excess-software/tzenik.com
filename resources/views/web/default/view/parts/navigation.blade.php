<ul class="nav nav-tabs nav-justified">
    @foreach($setting['category'] as $mainCategory)
    @if($mainCategory->title == 'Forum' || $mainCategory->title == 'forum')
    <li role="presentation" class="{{request()->is('user/'.$mainCategory->title) ? 'active' : ''}}"><a class="nav-home" href="/user/forum">{{  $mainCategory->title }}</a></li>
    @elseif($mainCategory->title == 'Coach' || $mainCategory->title == 'coach' || $mainCategory->title == 'Coaching' || $mainCategory->title == 'coaching')
    <!--@elseif($mainCategory->title == 'Videoteca' || $mainCategory->title == 'VideoTeca' || $mainCategory->title == 'videoteca')
    <li role="presentation" class="{{request()->is('/'.$mainCategory->title) ? 'active' : ''}}"><a class="nav-home" href="/videoteca">{{  $mainCategory->title }}</a></li>-->
    @else
        @if(request()->is("category/".$mainCategory->title))
        <li role="presentation" class="active"><a class="nav-home" href="/category/{{  $mainCategory->title }}">{{Str::limit($mainCategory->title, 15) }}</a></li>
        @else
        <li role="presentation"><a class="nav-home" href="/category/{{  $mainCategory->title }}">{{Str::limit($mainCategory->title, 15) }}</a></li>
        @endif
    @endif
    @endforeach
    <li role="presentation" class="{{ request()->is('blog') ? 'active' : ''  }}"><a class="nav-home" href="/blog">Blog</a></li>
</ul>
<br>