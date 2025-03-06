<ul>
    <li class="menu-item  ">
        <a href="{{ route('dashboard') }}" class='menu-link'>
            <span><i class="bi bi-grid-fill"></i> Disposal asset</span>
        </a>
    </li>
    <li class="menu-item  {{ request()->routeIs('perbaikan.index') ? 'active' : '' }}">
        <a href="{{ route('perbaikan.index') }}" class='menu-link'>
            <span><i class="bi bi-grid-fill"></i> Perbaikan asset</span>
        </a>
    </li>

</ul>
