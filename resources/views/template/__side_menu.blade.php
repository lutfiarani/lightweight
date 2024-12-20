<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
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