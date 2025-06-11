<table class="table table-bordered" id="table1">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Permintaan</th>
            <th>Asset</th>
            <th>Suplier / Cabang</th>
            <th>Jumlah</th>
            <th>Kategori</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($permintaan as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>PER-{{ $p->invoice }}</td>
                <td>{{ $p->barang->nama_barang }} ({{ $p->barang->merek }})</td>
                <td>{{ empty($p->pembelian->suplier->nama) ? '' : 'Suplier ' . $p->pembelian->suplier->nama }}
                    {{ empty($p->overstock->cabang->nama) ? '' : 'Cabang ' . $p->overstock->cabang->nama }}
                </td>
                <td>{{ $p->jumlah }}</td>
                <td>{{ $p->kategori }}</td>
                <td>{{ $p->keterangan }}</td>
                <td><span
                        class="badge {{ $p->status == 'pending' ? 'bg-warning' : ($p->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $p->status }}</span>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
