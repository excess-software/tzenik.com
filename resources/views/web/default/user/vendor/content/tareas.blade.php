@extends(getTemplate() . '.user.vendor.layout.layout')
@section('page')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap.min.js"></script>
<section class="card">
    <header class="card-header">
        <h2 class="card-title">Tareas de tus cursos</h2>
    </header>
    <div class="card-body">

        <div id="accordion">
            @foreach($courses as $course)
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
                        {{$course->homeworks}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
    <div class="card-footer text-center">
    </div>
</section>
<script>
</script>
@endsection
