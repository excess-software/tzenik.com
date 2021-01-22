@include(getTemplate().'.view.layout.header')


    <div class="container">
            <div class="row">
                <div class="col">
                    @yield('page')
                </div>
            </div>
    </div>



@include(getTemplate().'.view.layout.footer')