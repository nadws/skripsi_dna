<li class="menu-item  {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}">
    <a href="{{ route('peminjaman.index') }}" class='menu-link'>
        <span><i class="bi bi-database-fill"></i> Penggunaan Asset</span>
    </a>
</li>
<li class="menu-item  ">
    <a href="{{ route('peminjaman.index') }}" class='menu-link'>
        <span><i class="bi bi-database-fill"></i> Pengajuan Disposal Asset</span>
    </a>
</li>
<li class="menu-item  ">
    <a href="{{ route('peminjaman.index') }}" class='menu-link'>
        <span><i class="bi bi-database-fill"></i> Pengajuan Perbaikan Asset</span>
    </a>
</li>
<li class="menu-item  {{ request()->routeIs('accpermintaan.index') ? 'active' : '' }}">
    <a href="{{ route('accpermintaan.index') }}" class='menu-link'>
        <span><i class="bi bi-database-fill"></i> Pengajuan Permintaan Asset</span>
    </a>
</li>
