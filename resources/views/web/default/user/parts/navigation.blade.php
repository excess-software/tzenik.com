    <div class="container">
<ul class="nav nav-pills nav-justified hidden-xs">
     <li role="presentation" class="{{ request()->is('user/video/buy') ? 'active' : ''  }}"><a class="nav-home" href="/user/video/buy"><i class="fa fa-home"></i> Videos</a></li>
    <li role="presentation" class="{{ request()->is('user/tareas') ? 'active' : ''  }}"><a class="nav-home" href="/user/tareas"><i class="fa fa-file"></i> Tareas</a></li>
     <li role="presentation" class="{{ request()->is('user/forum*') ? 'active' : ''  }}"><a class="nav-home" href="/user/forum"><i class="fa fa-calendar"></i> Foro</a></li>
    <li role="presentation" class="{{ request()->is('user/videoteca') ? 'active' : ''  }}"><a class="nav-home" href="/user/videoteca"><i class="fa fa-video-camera"></i> Aprendo+</a></li>
    
    
   <!--  <li role="presentation" class="{{ request()->is('user/calendar') ? 'active' : ''  }}"><a class="nav-home" href="/user/calendar"><i class="fa fa-calendar"></i> Calendario</a></li> -->
    <li role="presentation" class="{{ request()->is('user/dashboard/all') || request()->is('user/dashboard/all/*') ? 'active' : ''  }}"><a class="nav-home" href="/user/dashboard/all"><i class="fa fa-book"></i> Mis Cursos</a>
    </li>
</ul>
@if($user->category_id == 9)
<div class="row">
    <div class="col-md-12 p text-center cursos-internos">
        <h3>Cursos Internos de Fundal</h3>
    </div>
</div>
@endif    