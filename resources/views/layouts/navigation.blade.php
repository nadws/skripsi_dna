<nav class="main-navbar">
    <div class="container">
        <ul>
            <li class="menu-item  {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class='menu-link'>
                    <span><i class="bi bi-grid-fill"></i> Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->role == 'manager')
                @include('layouts.nav.navpresiden')
            @elseif(Auth::user()->role == 'admin')
                @include('layouts.nav.navadmin')
            @elseif(Auth::user()->role == 'superadmin')
                @include('layouts.nav.navsuperadmin')
            @else
            @endif


        </ul>
    </div>
</nav>
