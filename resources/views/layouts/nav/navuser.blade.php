<ul>
    <li class="menu-item  ">
        <a href="{{ route('dashboard') }}" class='menu-link'>
            <span><i class="bi bi-grid-fill"></i> Pengajuan disposal asset</span>
        </a>
    </li>
    <li class="menu-item  {{ request()->routeIs('perbaikan.index') ? 'active' : '' }}">
        <a href="{{ route('perbaikan.index') }}" class='menu-link'>
            <span><i class="bi bi-grid-fill"></i> Pengajuan perbaikan asset</span>
        </a>
    </li>

</ul>
