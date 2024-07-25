<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> {{ $navName }} </a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="dropdown">
                        <i class="nc-icon nc-palette"></i>
                        <span class="d-lg-none">{{ __('Dashboard') }}</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav   d-flex align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href=" {{route('profile.edit') }} ">
                        <span class="no-icon">{{ __('Account') }}</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="no-icon">{{ __('Quick Actions') }}</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{  route('upload.index')  }}">{{ __('Upload Challenges') }}</a>
                        <a class="dropdown-item" href="{{  route('challenges.display')  }}">{{ __('View Existing Challenges') }}</a>
                        <a class="dropdown-item" href="{{  route('school.index')  }}">{{ __('Upload Schools') }}</a>
                        <a class="dropdown-item" href="{{  route('schools.display-representatives')  }}">{{ __('View School Representatives') }}</a>
                        <a class="dropdown-item" href="">{{ __('View Challenge Analytics') }}</a>
                        <div class="divider"></div>
                        <a class="dropdown-item" href="#">{{ __('Separated link') }}</a>
                    </div>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a class="text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Log out') }} </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>