<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">

            <li class="app-sidebar__heading">Master Data</li>
            <li>
                <a href="{{route('master.upload')}}" class="{{ request()->route()->getName() === 'master.upload' ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-cloud-upload"></i>
                    Upload Data
                </a>
            </li>
            <li>
                <a href="{{url('/')}}" class="{{ Request::is('/')||Request::routeIs('product.detail') ? 'mm-active' : '' }}">
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
           
       <li class="app-sidebar__heading">Production</li>
            @if (Auth::user()->hasRole('prod'))
            <li>
                <a href="index.html" class="mm-active">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Input Data
                </a>
            </li>
            @endif

        </ul>
    </div>
</div>