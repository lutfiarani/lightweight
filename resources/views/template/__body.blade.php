@include('template.__header')




<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('template.__top_menu')
         
        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                @include('template.__app_menu')
                @include('template.__side_menu')
            </div>    
            <div class="app-main__outer">
                @yield('content')
                @include('template.foot')  
            </div>
            @yield('js')
        </div>
    </div>      

@include('template.__footer')