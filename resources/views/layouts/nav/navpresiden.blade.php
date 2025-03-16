<li
    class="menu-item {{ request()->routeIs('peminjaman.index') || request()->routeIs('accperbaikan.index') || request()->routeIs('accpermintaan.index') || request()->routeIs('accdisposal.index') ? 'active' : '' }}  has-sub">
    <a href="#" class='menu-link'>
        <span><i class="bi bi-menu-up"></i> Pengajuan</span>
    </a>
    <div class="submenu ">
        <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
        <div class="submenu-group-wrapper">
            <ul class="submenu-group">
                <li class="submenu-item  {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}">
                    <a href="{{ route('peminjaman.index') }}" class='submenu-link'>
                        Peminjaman Inventaris Karyawan
                    </a>
                </li>
                <li class="submenu-item  {{ request()->routeIs('accperbaikan.index') ? 'active' : '' }}">
                    <a href="{{ route('accperbaikan.index') }}" class='submenu-link'>
                        </i> Perbaikan Inventaris
                    </a>
                </li>
                <li class="submenu-item  {{ request()->routeIs('accpermintaan.index') ? 'active' : '' }}">
                    <a href="{{ route('accpermintaan.index') }}" class='submenu-link'>
                        </i> Permintaan Inventaris
                    </a>
                </li>
                <li class="submenu-item  {{ request()->routeIs('accdisposal.index') ? 'active' : '' }}">
                    <a href="{{ route('accdisposal.index') }}" class='submenu-link'>
                        Disposal Inventaris
                    </a>
                </li>
            </ul>


        </div>
    </div>
</li>
<li class="menu-item  has-sub">
    <a href="#" class='menu-link'>
        <span><i class="bi bi-printer-fill"></i> Laporan</span>
    </a>
    <div class="submenu ">
        <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
        <div class="submenu-group-wrapper">
            <ul class="submenu-group">
                <li class="submenu-item">
                    <a href="#" class='submenu-link'>
                        Stok Inventaris
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="#" class='submenu-link'>
                        Data Karyawan
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="#" class='submenu-link'>
                        Data Cabang
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="#" class='submenu-link'>
                        Data Departemen
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="#" class='submenu-link'>
                        Peminjaman Inventaris Karyawan
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="#" class='submenu-link'>
                        Perbaikan Inventaris
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="#" class='submenu-link'>
                        Permintaan Inventaris
                    </a>
                </li>
                <li class="submenu-item">
                    <a href="#" class='submenu-link'>
                        Disposal Inventaris
                    </a>
                </li>


            </ul>


        </div>
    </div>
</li>
