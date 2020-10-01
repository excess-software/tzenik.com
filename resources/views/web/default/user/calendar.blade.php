@extends(getTemplate().'.view.layout.layout')

@section('title')
{{ get_option('site_title','') }} - {{ !empty($category->title) ? $category->title : 'Categories' }}
@endsection

@section('content')

<div class="container-full">
@include(getTemplate() . '.user.parts.navigation')
<div class="row contenido-calendario-dash">
            <div class="container-fluid">
                <div class="col-md-10">
                    <div id="calendario">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.css"
        integrity="sha256-uq9PNlMzB+1h01Ij9cx7zeE2OR2pLAfRw3uUUOOPKdA=" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js"
        integrity="sha256-mMw9aRRFx9TK/L0dn25GKxH/WH7rtFTp+P9Uma+2+zc=" crossorigin="anonymous"></script>
<script>
        $(document).ready(function () {
            var calendario = document.getElementById('calendario');
            var crearCalendario = new FullCalendar.Calendar(calendario, {
                initialView: 'dayGridMonth',
                locale: 'es',
                eventSources: [{
                    events: [{
                        title: 'test',
                        start: '2020-10-01T12:30:00',
                        allDay: false,
                        url: 'https://www.google.com/'
                    }, {
                        title: 'event1',
                        start: '2020-10-02',
                        url: 'test.com'
                    }, ],
                    color: 'blue',
                    textColor: 'white'
                }, {
                    events: [{
                        title: 'test',
                        start: '2020-10-01T12:30:00',
                        allDay: false,
                        url: 'https://www.google.com/'
                    }],
                    color: 'red',
                    textColor: 'yellow'
                }]
            });

            crearCalendario.render();
        });
    </script>
@endsection
