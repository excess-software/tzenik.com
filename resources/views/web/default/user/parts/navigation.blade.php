<div class="container">
<ul class="nav nav-pills nav-justified">
    <li role="presentation" class="{{ request()->is('user/video/buy') ? 'active' : ''  }}"><a class="nav-home" href="/user/video/buy"><i class="fa fa-home"></i> Tablero</a></li>
    <li role="presentation" class="{{ request()->is('user/quizzes') || request()->is('user/dashboard/*') ? 'active' : ''  }}"><a class="nav-home" href="/user/quizzes"><i class="fa fa-book"></i> Cursos</a>
    </li>
    <li role="presentation" class="{{ request()->is('user/forum*') ? 'active' : ''  }}"><a class="nav-home" href="/user/forum"><i class="fa fa-calendar"></i> Foro</a></li>
    <li role="presentation" class="{{ request()->is('user/calendar') ? 'active' : ''  }}"><a class="nav-home" href="/user/calendar"><i class="fa fa-calendar"></i> Calendario</a></li>
</ul>
@if($user->category_id == 9)
<div class="row">
    <div class="col-md-12 p text-center">
    <h1><b>Cursos Fundal</b></h1>
    </div>
</div>
@endif