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
                $disposal = DB::table('disposals')->where('invoice_peminjaman', $p->invoice)->first();

                if (!empty($disposal->barang_id)) {
                    continue;
                }
            @endphp
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $p->invoice }}</td>
                <td>{{ $p->karyawan->nama }}</td>
                <td>{{ $p->cabang->nama }}</td>
                <td>{{ $p->barang->nama_barang }}</td>
                <td>{{ $p->qty }}</td>
                <td>{{ $p->ket }}</td>
                <td><span
                        class="badge {{ $p->status == 'pending' ? 'bg-warning' : ($p->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $p->status }}</span>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
