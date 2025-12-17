<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Asset</th>
            <th>Pemilik</th>
            <th>Jumlah</th>
            <th>Vendor</th>
            <th>Biaya</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Progress</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($perbaikan as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->barang->nama_barang }}</td>
                <td>{{ $p->from == 'user' ? $p->karyawan->nama : 'Cabang :' . $p->cabang->nama }}</td>
                <td>{{ $p->jumlah }}</td>
                <td>{{ $p->vendor->nama }}</td>
                <td>Rp. {{ number_format($p->biaya, 0) }}</td>
                <td>{{ $p->keterangan }}</td>
                <td><span
                        class="badge {{ $p->status == 'pending' ? 'bg-warning' : ($p->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $p->status }}</span>
                </td>
                <td>
                    <span
                        class="badge {{ $p->status_perbaikan == 'finish' ? 'bg-success' : 'bg-danger' }}  ">{{ ucfirst($p->status_perbaikan) }}</span>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
