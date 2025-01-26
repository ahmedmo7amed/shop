<div class="container-fluid">        
    <div class="page-title">
        <div class="row">
            <div class="col-6">
                @yield('breadcrumb-title')
            </div>
            <div class="col-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}"> <i data-feather="home"></i></a>
                    </li>
                    @yield('breadcrumb-items')
                </ol>
            </div>
        </div>
    </div>
</div>
