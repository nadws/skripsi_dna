<li class="menu-item {{ request()->routeIs('departemen.index') ? 'active' : '' }}">
    <a href="{{ route('departemen.index') }}" class="menu-link">
        <span><i class="bi bi-journal"></i>Departemen</span>
    </a>
</li>
<li class="menu-item {{ request()->routeIs('karyawan.index') ? 'active' : '' }}">
    <a href="{{ route('karyawan.index') }}" class="menu-link">
        <span><i class="bi bi-person-vcard"></i>Karyawan</span>
    </a>
</li>
<li class="menu-item {{ request()->routeIs('barang.index') ? 'active' : '' }}">
    <a href="{{ route('barang.index') }}" class="menu-link">
        <span><i class="bi bi-house-check-fill"></i>Asset</span>
    </a>
</li>
<li class="menu-item {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}">
    <a href="{{ route('peminjaman.index') }}" class="menu-link">
        <span><i class="bi bi-journal-bookmark"></i></i>Peminjaman Asset</span>
    </a>
</li>
<li class="menu-item {{ request()->routeIs('permintaan.index') ? 'active' : '' }}">
    <a href="{{ route('permintaan.index') }}" class="menu-link">
        <span><i class="bi bi-journal-bookmark"></i></i>Permintaan Asset</span>
    </a>
</li>
<li class="menu-item  {{ request()->routeIs('perbaikan.index') ? 'active' : '' }}">
    <a href="{{ route('perbaikan.index') }}" class='menu-link'>
        <span><i class="bi bi-grid-fill"></i> Perbaikan asset</span>
    </a>
</li>
