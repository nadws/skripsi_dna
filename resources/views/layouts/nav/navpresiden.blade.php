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
<li
    class="menu-item {{ request()->routeIs('stok_inventaris.index') || request()->routeIs('laporan_karyawan.index') || request()->routeIs('laporan_cabang.index') || request()->routeIs('laporan_peminjaman_inventaris.index') || request()->routeIs('laporan_perbaikan_inventaris.index') || request()->routeIs('laporan_permintaan_inventaris.index') || request()->routeIs('laporan_disposal.index') ? 'active' : '' }}  has-sub">
    <a href="#" class='menu-link'>
        <span><i class="bi bi-printer-fill"></i> Laporan</span>
    </a>
    <div class="submenu ">
        <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
        <div class="submenu-group-wrapper">
            <ul class="submenu-group">
                <li class="submenu-item {{ request()->routeIs('stok_inventaris.index') ? 'active' : '' }}">
                    <a href="{{ route('stok_inventaris.index') }}" class='submenu-link'>
                        Stok Inventaris
                    </a>
                </li>
                <li class="submenu-item {{ request()->routeIs('laporan_karyawan.index') ? 'active' : '' }}">
                    <a href="{{ route('laporan_karyawan.index') }}" class='submenu-link'>
                        Data Karyawan
                    </a>
                </li>
                <li class="submenu-item {{ request()->routeIs('laporan_cabang.index') ? 'active' : '' }}">
                    <a href="{{ route('laporan_cabang.index') }}" class='submenu-link'>
                        Data Cabang
                    </a>
                </li>
                <li class="submenu-item {{ request()->routeIs('laporan_departemen.index') ? 'active' : '' }}">
                    <a href="{{ route('laporan_departemen.index') }}" class='submenu-link'>
                        Data Departemen
                    </a>
                </li>
                <li
                    class="submenu-item {{ request()->routeIs('laporan_peminjaman_inventaris.index') ? 'active' : '' }}">
                    <a href="{{ route('laporan_peminjaman_inventaris.index') }}" class='submenu-link'>
                        Peminjaman Inventaris Karyawan
                    </a>
                </li>
                <li
                    class="submenu-item {{ request()->routeIs('laporan_perbaikan_inventaris.index') ? 'active' : '' }}">
                    <a href="{{ route('laporan_perbaikan_inventaris.index') }}" class='submenu-link'>
                        Perbaikan Inventaris
                    </a>
                </li>
                <li
                    class="submenu-item {{ request()->routeIs('laporan_permintaan_inventaris.index') ? 'active' : '' }}">
                    <a href="{{ route('laporan_permintaan_inventaris.index') }}" class='submenu-link'>
                        Permintaan Inventaris
                    </a>
                </li>
                <li class="submenu-item {{ request()->routeIs('laporan_disposal.index') ? 'active' : '' }}">
                    <a href="{{ route('laporan_disposal.index') }}" class='submenu-link'>
                        Disposal Inventaris
                    </a>
                </li>
                <li class="submenu-item {{ request()->routeIs('laporan_vendor.index') ? 'active' : '' }}">
                    <a href="{{ route('laporan_vendor.index') }}" class='submenu-link'>
                        Vendor
                    </a>
                </li>
                <li class="submenu-item {{ request()->routeIs('laporan_suplier.index') ? 'active' : '' }}">
                    <a href="{{ route('laporan_suplier.index') }}" class='submenu-link'>
                        Suplier
                    </a>
                </li>


            </ul>


        </div>
    </div>
</li>
