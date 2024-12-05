@php
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

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand mb-2">
            <a href="#"><img src="{{ asset('assets/img/Logo.png') }}" width="50" class="my-3"
                    alt="{{ env('APP_NAME') }}"></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm mb-2">
            <a href="#"><img src="{{ asset('assets/img/Logo.png') }}" width="25"
                    alt="{{ env('APP_NAME') }}"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('home') ? 'active' : '' }}"><a class="nav-link" href="{{ route('home') }}"><i
                        class="fas fa-home"></i> <span>Dashboard</span></a>
            </li>
            <li class="menu-header">Main Feature</li>
            <li class=""><a class="nav-link" href="#"><i class="fas fa-file-contract"></i> <span>Incoming
                        Mail</span></a></li>
            <li class=""><a class="nav-link" href="#"><i class="fas fa-file-signature"></i> <span>Outgoing
                        Mail</span></a></li>
            <li class=""><a class="nav-link" href="#"><i class="fas fa-file-archive"></i> <span>Letter
                        Type</span></a></li>
            @if($profile == 1 || auth()->user()->role_id == 1)
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users-cog"></i>
                    <span>Setting</span></a>
                <ul class="dropdown-menu">
                    @if ($profile == 1)
                        <li><a class="nav-link" href="{{ route('profile.index') }}">Profile</a></li>
                    @endif
                    @if (auth()->user()->role_id == 1)
                        <li><a class="nav-link" href="{{ route('group.index') }}">Role Permission</a></li>
                    @endif
                </ul>
            </li>
            @endif
        </ul>
    </aside>
</div>
