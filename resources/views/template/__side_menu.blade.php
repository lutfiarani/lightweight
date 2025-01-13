<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            @if (Auth::user()->hasRole('dev'))
            <li class="app-sidebar__heading">Master Data</li>
            <li>
                <a href="{{route('master.upload')}}" class="{{ request()->route()->getName() === 'master.upload' ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-cloud-upload"></i>
                    Upload Data
                </a>
            </li>
            <li>
                <a href="{{route('index')}}" class="{{ Request::is('index')||Request::routeIs('product.detail') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-file"></i>
                    View Data
                </a>
            </li>
            <li>
                <a href="{{route('percentage.value')}}" class="{{ Request::routeIs('percentage.value') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-pen"></i>
                    Set Percentage
                </a>
            </li>
            <li>
                <a href="{{route('weight-list')}}" class="{{ Request::routeIs('weight-list') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-news-paper"></i>
                    Weight List Detail
                </a>
            </li>
            <li class="app-sidebar__heading">USER</li>
            <li>
                <a href="{{route('register')}}" class="{{ Request::routeIs('register') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-add-user"></i>
                    Register New User
                </a>
            </li> 
            @endif
            @if (Auth::user()->hasRole('prod'))
            <li class="app-sidebar__heading">Production</li>
            <li>
                @php
                    // Tentukan route berdasarkan email user
                    $route = '#'; // Default route jika tidak cocok
                    if (Auth::user()->email === 'outsole@test.com') {
                        $route = route('input_data_production_outsole');
                    } elseif (Auth::user()->email === 'upper@test.com') {
                        $route = route('input_data_production');
                    }
                @endphp
                <a 
                    href="{{ $route }}" 
                    class="{{ 
                        Request::routeIs('input_data_production') || 
                        Request::routeIs('input_data_production_outsole') 
                            ? 'mm-active' 
                            : '' 
                    }}">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Input Data
                </a>
            </li>
        @endif


            

        </ul>
    </div>
</div>