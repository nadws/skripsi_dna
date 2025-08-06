<table class="table table-bordered" id="table1">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Peminjaman</th>
            <th>Nama Karyawan</th>
            <th>Cabang</th>
            <th>Barang</th>
            <th>Qty</th>
            <th>Ket</th>
            <th>status</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($peminjaman as $no => $p)
            @php
                if ($p->qty - $p->qty_disposal <= 0) {
                    continue;
                }
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $p->invoice }}</td>
                <td>{{ $p->karyawan->nama }}</td>
                <td>{{ $p->cabang->nama }}</td>
                <td>{{ $p->barang->nama_barang }}</td>
                <td>{{ $p->qty - $p->qty_disposal }}</td>
                <td>{{ $p->ket }}</td>
                <td><span
                        class="badge {{ $p->status == 'pending' ? 'bg-warning' : ($p->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $p->status }}</span>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
