@if($user->category_id == 9)
<div class="row">
    <div class="col-md-12 text-center">
    <h1><b>Cursos Fundal</b></h1>
    </div>
</div>
@endif
<br>
<ul class="nav nav-tabs nav-justified">
        <li role="presentation" class="{{ request()->is('user/video/buy') ? 'active' : ''  }}"><a class="nav-home" href="/user/video/buy"><i class="fa fa-home"></i> Tablero</a></li>
        <li role="presentation" class="{{ request()->is('user/quizzes') ? 'active' : ''  }}"><a class="nav-home" href="/user/quizzes"><i class="fa fa-book"></i> Cursos</a>
        </li>
        <li role="presentation" class="{{ request()->is('user/calendar') ? 'active' : ''  }}"><a class="nav-home" href="/user/calendar"><i class="fa fa-calendar"></i> Calendario</a></li>
    </ul>

    <br>