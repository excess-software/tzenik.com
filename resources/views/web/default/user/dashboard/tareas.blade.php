@extends(getTemplate().'.view.layout.layout')

@section('title')
{{ get_option('site_title','') }} - {{ !empty($category->title) ? $category->title : 'Categories' }}
@endsection

@section('content')
<div class="">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    @include(getTemplate() . '.user.parts.navigation')

    <div class="row ">
        <div class="">
            <div class="col-md-12">
                <h2 class="titulo-partials">Tus Tareas</h2>
                <div class="row">
                    @foreach($courses as $course)
                        @if(!($course->homeworks)->isEmpty())
                        <div class="card">
                            <div class="card-header" id="heading-{{$course->id}}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-{{$course->id}}"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        {{$course->title}}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse-{{$course->id}}" class="collapse show" aria-labelledby="heading-{{$course->id}}" data-parent="#accordion">
                                <div class="card-body">
                                    @foreach($course->homeworks as $homework)
                                        <a onclick="subir({{$course->id}}, {{$homework->part_id}})"><p>{{$homework->part}} - {{$homework->title}}</p></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                    @if($courses->isEmpty())
                    <br>
                    <div class="row">
                        <div class="col-md-12 text-center" style="margin-top: 15%; margin-bottom: 15%;">
                            <h4>Aún no tienes tareas</h4>
                        </div>
                    </div>
                    <br>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalTareas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Subir Tarea</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/user/subirTarea" method="post" enctype="multipart/form-data" id="image-upload" class="dropzone">
            <input type="hidden" name="course" id="courseDrop" value="">
            <input type="hidden" name="part" id="partDrop" value="">
            @csrf
            <div>
                <h3>Sube acá tus tareas</h3>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning">Salir</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
function subir(curso, modulo){
    $('#modalTareas').modal('show');
    $('#courseDrop').val(curso);
    $('#partDrop').val(modulo);
    //$('#image-upload').attr('action', '/user/subirTarea/'+curso+'/'+modulo);
}

Dropzone.options.imageUpload = {
    maxFilesize : 100,
    acceptedFiles: ".jpeg,.jpg,.png,.gif",
    success: function(file, response){
      //Here you can get your response.
      console.log(response);
      this.removeFile(file);
  }
};
</script>
@endsection