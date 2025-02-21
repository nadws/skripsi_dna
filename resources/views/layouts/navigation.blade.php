<nav class="main-navbar">
    <div class="container">
        <ul>
            <li class="menu-item  ">
                <a href="{{ route('dashboard') }}" class='menu-link'>
                    <span><i class="bi bi-grid-fill"></i> Dashboard</span>
                </a>
            </li>
            <li class="menu-item  has-sub">
                <a href="#" class='menu-link'>
                    <span><i class="bi bi-database-fill"></i> Data Master</span>
                </a>
                <div class="submenu ">
                    <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item  ">
                                <a href="{{ route('cabang.index') }}" class='submenu-link'>Data Cabang</a>
                            </li>
                            <li class="submenu-item">
                                <a href="{{ route('departemen.index') }}" class='submenu-link'>Data Departemen</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('karyawan.index') }}" class='submenu-link'>Data Karyawan</a>
                            </li>
                            <li class="submenu-item  has-sub">
                                <a href="#" class='submenu-link'>Barang & Stock</a>
                                <!-- 3 Level Submenu -->
                                <ul class="subsubmenu">

                                    <li class="subsubmenu-item ">
                                        <a href="{{ route('barang.index') }}" class="subsubmenu-link">Data Barang</a>
                                    </li>
                                    <li class="subsubmenu-item ">
                                        <a href="#" class="subsubmenu-link">Stok Masuk</a>
                                    </li>
                                    <li class="subsubmenu-item ">
                                        <a href="#" class="subsubmenu-link">Stok Opname</a>
                                    </li>
                                    <li class="subsubmenu-item ">
                                        <a href="#" class="subsubmenu-link">Over Stock</a>
                                    </li>
                                    <li class="subsubmenu-item ">
                                        <a href="{{ route('peminjaman.index') }}" class="subsubmenu-link">Peminjaman
                                            Barang</a>
                                    </li>
                                    <li class="subsubmenu-item ">
                                        <a href="#" class="subsubmenu-link">Disposal Barang</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
