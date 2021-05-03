<ul class="nav nav-pills  nav-justified nav-custom-bg">
    <li role="presentation" class="{{ request()->is('user/video/buy') ? 'active' : ''  }}"><a class="nav-home" href="/user/video/buy"><i class="fa fa-home"></i> Videos</a></li>
    <li role="presentation" class="{{ request()->is('user/tareas') ? 'active' : ''  }}"><a class="nav-home" href="/user/tareas"><i class="fa fa-file"></i> Tareas</a></li>
     <li role="presentation" class="{{ request()->is('user/forum*') ? 'active' : ''  }}"><a class="nav-home" href="/user/forum"><i class="fa fa-calendar"></i> Foro</a></li>
    <li role="presentation" class="{{ request()->is('user/videoteca') ? 'active' : ''  }}"><a class="nav-home" href="/user/videoteca"><i class="fa fa-video-camera"></i> Aprendo+</a></li>
    
    
    <li role="presentation" class="{{ request()->is('user/quizzes') || request()->is('user/dashboard/*') ? 'active' : ''  }}"><a class="nav-home" href="/user/quizzes"><i class="fa fa-book"></i> Mis Cursos</a>

    @if($user->category_id == 9)
      <!--  <li role="presentation">
            <a class="nav-home" href="#">Cursos Internos de Fundal</a>
        </li> -->
    @endif    

</ul>