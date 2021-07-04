@extends(getTemplate().'.view.layout.layout')

@section('title')
{{ get_option('site_title','') }} - {{ !empty($category->title) ? $category->title : 'Categories' }}
@endsection

@section('content')
    <style>
        .br-1{
            border-radius: 5px;
            min-width: 100px;
            display: inline-block;
            color: #000000;
        }
        .task-name{
            display: inline-block;
        }
        .task-card{
            height: auto;
            padding: 20px;
            display: block;
            border: 3px solid #000000;
            border-radius: 5px;
        }
        .task-card:not(:first-child){
            margin-bottom: 10px;
        }
    </style>
<div class="">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    @include(getTemplate() . '.user.parts.navigation')

    <div class="row ">
        <div class="container">
            <div class="col-md-12">
                <h2 class="titulo-partials">Tareas</h2>
                <div class="row">
                    <div class="accordion2" id="accordion2">
                    @foreach($courses as $course)
                        @if(count($course->homeworks)>0)
                       <h3 class="mb-2 text-white p-3">{{$course->title}}</h3>
                            @foreach($course->homeworks as $homework)
                                <div class="task-card">
                                    <div class="row">
                                    <div class="col-sm-12">
                                        <span class="task-name">{{$homework->part}} - {{$homework->title}}</span>

                                        <a class="btn btn-warning br-1 pull-right" onclick="subir({{$course->id}}, {{$homework->part_id}})">
                                            Subir
                                        </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                    </div>
                    @if(count($courses)==0)
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

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLongTitle">Subir Tarea</h5>
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
     <!--  <div class="modal-footer">
        <button type="button" class="btn btn-warning">Salir</button>
      </div> -->
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
      if(response == "success"){
            $.notify({
                message: 'Tarea subida exitosamente'
            }, {
                type: 'success',
                allow_dismiss: true,
                z_index: '99999999',
                placement: {
                    from: "bottom",
                    align: "right"
                },
                position: 'fixed'
            });
      }
      this.removeFile(file);
  }
};
</script>
@endsection
