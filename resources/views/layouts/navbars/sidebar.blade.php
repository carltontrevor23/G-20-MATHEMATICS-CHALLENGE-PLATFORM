<div class="sidebar" data-color="azure" data-image="{{ asset('light-bootstrap/img/bg-image-2.webp') }}">
    
    <div class="sidebar-wrapper">
        <div class="logo">
            
            <a href="http://127.0.0.1:8000/home" class="simple-text logo-normal">
                <img src="{{ asset('light-bootstrap/img/logo-website-final.png')  }}" alt="logo" style="height:120px; vertical-align:left;">
            </a>
        </div>
        <!--Menu items that appear on the sidebar-->
        <ul class="nav">
            <li class="nav-item @if($activePage == 'dashboard') active @endif">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>{{ __("Dashboard") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'user') active @endif">
                <a class="nav-link" href="{{route('profile.edit')}}">
                    <i class="nc-icon nc-single-02"></i>
                        <p>{{ __("User Profile") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'schools') active @endif">
                <a class="nav-link" href="{{route('schools.display')}}">
                    <i class="nc-icon nc-backpack"></i>
                            <p>{{ __("Schools") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'representatives') active @endif">
                <a class="nav-link" href="{{route('schools.display-representatives')}}">
                    <i class="nc-icon nc-circle-09"></i>
                            <p>{{ __("Representatives") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'challenges') active @endif">
                <a class="nav-link" href="{{route('challenges.display', 'challenges')}}">
                    <i class="nc-icon nc-notes"></i>
                    <p>{{ __("Challenges") }}</p>
                </a>
            </li>
            <li class="nav-item @if($activePage == 'analytics') active @endif">
                <a class="nav-link" href="{{route('analytics.display', 'analytics')}}">
                    <i class="nc-icon nc-layers-3"></i>
                    <p>{{ __("Analytics") }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
