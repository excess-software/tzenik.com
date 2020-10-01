<ul class="nav nav-tabs nav-justified">
    <li role="presentation" class="{{ request()->is('/') ? 'active' : ''  }}"><a class="nav-home" href="/">Home</a></li>
    @foreach($setting['category'] as $mainCategory)
    @if($mainCategory->title == 'Forum' || $mainCategory->title == 'forum')
    <!--<li role="presentation" class="active"><a class="nav-home" href="/user/forum">{{  $mainCategory->title }}</a></li>-->
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