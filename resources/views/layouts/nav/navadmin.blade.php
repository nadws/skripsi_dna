<li
    class="menu-item {{ request()->routeIs('departemen.index') || request()->routeIs('karyawan.index') || request()->routeIs('barang.index') ? 'active' : '' }}  has-sub">
    <a href="#" class='menu-link'>
        <span><i class="bi bi-grid-1x2-fill"></i> Data Master</span>
    </a>
    <div class="submenu ">
        <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
        <div class="submenu-group-wrapper">


            <ul class="submenu-group">
                <li class="submenu-item {{ request()->routeIs('departemen.index') ? 'active' : '' }}">
                    <a href="{{ route('departemen.index') }}" class="submenu-link">
                        Departemen
                    </a>
                </li>



                <li class="submenu-item {{ request()->routeIs('karyawan.index') ? 'active' : '' }}">
                    <a href="{{ route('karyawan.index') }}" class="submenu-link">
                        Karyawan
                    </a>
                </li>
                <li class="submenu-item {{ request()->routeIs('barang.index') ? 'active' : '' }}">
                    <a href="{{ route('barang.index') }}" class="submenu-link">
                        Asset
                    </a>
                </li>
            </ul>


        </div>
    </div>
</li>


<li class="menu-item {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}">
    <a href="{{ route('peminjaman.index') }}" class="menu-link">
        <span><i class="bi bi-journal-bookmark"></i></i>Peminjaman Inventaris</span>
    </a>
</li>
<li class="menu-item {{ request()->routeIs('permintaan.index') ? 'active' : '' }}">
    <a href="{{ route('permintaan.index') }}" class="menu-link">
        <span><i class="bi bi-journal-bookmark"></i></i>Permintaan Inventaris</span>
    </a>
</li>
<li class="menu-item  {{ request()->routeIs('perbaikan.index') ? 'active' : '' }}">
    <a href="{{ route('perbaikan.index') }}" class='menu-link'>
        <span><i class="bi bi-grid-fill"></i> Perbaikan Inventaris</span>
    </a>
</li>
<li class="menu-item  {{ request()->routeIs('disposal.index') ? 'active' : '' }}">
    <a href="{{ route('disposal.index') }}" class='menu-link'>
        <span><i class="bi bi-trash"></i> Disposal Inventaris</span>
    </a>
</li>
