<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    @php
        $name = auth()->user()->name;
        $alias = implode(
            '',
            array_map(function ($word) {
                return strtoupper($word[0]);
            }, explode(' ', $name)),
        );

        $pages = \App\Http\Controllers\Controller::get_sidebar_access(auth()->user()->role_id);

        $profile = 0;

        foreach ($pages as $r) {
            if ($r->page_name == 'Profile') {
                if ($r->action == 'Read') {
                    $profile = $r->access;
                }
            }
        }
    @endphp

    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ $name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">{{ __('Logged in') }}
                    {{ auth()->user()->last_login !== null ? auth()->user()->last_login->diffForHumans() : '5 Minutes a go' }}
                </div>
                @if($profile == 1)
                <a href="{{ route('profile.index') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                @endif
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="post" class="d-inline-block">
                    @csrf
                    <button type="submit" class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
