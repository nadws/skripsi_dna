<li class="menu-item {{ request()->routeIs('departemen.index') ? 'active' : '' }}">
    <a href="{{ route('departemen.index') }}" class="menu-link">
        <span><i class="bi bi-journal"></i> Data Departemen</span>
    </a>
</li>
<li class="menu-item {{ request()->routeIs('karyawan.index') ? 'active' : '' }}">
    <a href="{{ route('karyawan.index') }}" class="menu-link">
        <span><i class="bi bi-journal"></i> Data Karyawan</span>
    </a>
</li>
<li class="menu-item {{ request()->routeIs('barang.index') ? 'active' : '' }}">
    <a href="{{ route('barang.index') }}" class="menu-link">
        <span><i class="bi bi-journal"></i> Data Asset</span>
    </a>
</li>
<li class="menu-item {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}">
    <a href="{{ route('peminjaman.index') }}" class="menu-link">
        <span><i class="bi bi-journal"></i> Pengajuan Peminjaman Asset</span>
    </a>
</li>
<li class="menu-item ">
    <a href="" class="menu-link">
        <span><i class="bi bi-journal"></i> Pengajuan Permintaan Asset</span>
    </a>
</li>
