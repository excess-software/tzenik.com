@include(getTemplate().'.view.layout.header')


    <div class="container" style="width: 75% !important; margin-top: 50px; margin-bottom: 25%;">
            <div class="row">
                <div class="col">
                    @yield('page')
                </div>
            </div>
    </div>



@include(getTemplate().'.view.layout.footer')