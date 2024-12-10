@php
    $pages = \App\Http\Controllers\Controller::get_sidebar_access(auth()->user()->role_id);

    $profile = 0;
    $letterType = 0;
    $incomingMail = 0;
    $outgingMail = 0;

    foreach ($pages as $r) {
        if ($r->page_name == 'Profile') {
            if ($r->action == 'Read') {
                $profile = $r->access;
            }
        }

        if ($r->page_name == 'Letter Type') {
            if ($r->action == 'Read') {
                $letterType = $r->access;
            }
        }

        if ($r->page_name == 'Incoming Mail') {
            if ($r->action == 'Read') {
                $incomingMail = $r->access;
            }
        }

        if ($r->page_name == 'Outgoing Mail') {
            if ($r->action == 'Read') {
                $outgoingMail = $r->access;
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
            @if($incomingMail == 1)
            <li class="{{ request()->is('incoming_mail.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('incoming_mail.index') }}"><i class="fas fa-file-contract"></i> <span>Incoming
                        Mail</span></a></li>
            @endif
            @if($outgoingMail == 1)
            <li class=""><a class="nav-link" href="#"><i class="fas fa-file-signature"></i> <span>Outgoing
                        Mail</span></a></li>
            @endif
            @if($letterType == 1)
            <li class="{{ request()->is('letter_type.*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('letter_type.index') }}"><i class="fas fa-file-archive"></i> <span>Letter
                        Type</span></a></li>
            @endif
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
