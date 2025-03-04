<li class="menu-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
    <a href="{{ route('user.index') }}" class="menu-link">
        <span><i class="bi bi-people"></i> Data User</span>
    </a>
</li>
<li class="menu-item {{ request()->routeIs('cabang.index') ? 'active' : '' }}">
    <a href="{{ route('cabang.index') }}" class="menu-link">
        <span><i class="bi bi-building"></i> Data Cabang</span>
    </a>
</li>

<li class="menu-item {{ request()->routeIs('kategori.index') ? 'active' : '' }}">
    <a href="{{ route('kategori.index') }}" class="menu-link">
        <span><i class="bi bi-card-checklist"></i> Data Kategori Asset</span>
    </a>
</li>
<li class="menu-item {{ request()->routeIs('suplier.index') ? 'active' : '' }}">
    <a href="{{ route('suplier.index') }}" class="menu-link">
        <span><i class="bi bi-card-checklist"></i> Data Suplier</span>
    </a>
</li>
<li class="menu-item {{ request()->routeIs('vendor.index') ? 'active' : '' }}">
    <a href="{{ route('vendor.index') }}" class="menu-link">
        <span><i class="bi bi-gear"></i> Data Vendor</span>
    </a>
</li>
