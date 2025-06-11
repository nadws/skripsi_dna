<table class="table table-bordered" id="table1">
    <thead>
        <tr>
            <th>No</th>
            <th>Asset</th>
            <th>Pemilik</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($disposal as $d)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $d->barang->nama_barang }}</td>
                <td>{{ $d->from == 'user' ? $d->karyawan->nama : 'Cabang :' . $d->cabang->nama }}</td>
                <td>{{ $d->jumlah }}</td>
                <td>{{ $d->keterangan }}</td>
                <td><span
                        class="badge {{ $d->status == 'pending' ? 'bg-warning' : ($d->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $d->status }}</span>
                </td>
            </tr>
        @endforeach
    </tbody>


</table>
