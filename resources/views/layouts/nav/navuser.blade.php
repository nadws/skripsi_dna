<ul>
    <li class="menu-item  {{ request()->routeIs('disposal.index') ? 'active' : '' }}">
        <a href="{{ route('disposal.index') }}" class='menu-link'>
            <span><i class="bi bi-trash"></i> Disposal Inventaris</span>
        </a>
    </li>
    <li class="menu-item  {{ request()->routeIs('perbaikan.index') ? 'active' : '' }}">
        <a href="{{ route('perbaikan.index') }}" class='menu-link'>
            <span><i class="bi bi-grid-fill"></i> Perbaikan Inventaris</span>
        </a>
    </li>

</ul>
