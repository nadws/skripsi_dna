<table class="table table-bordered" id="table1">
    <thead>
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Kode Barang</th>
            <th class="text-center">Nama Barang</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">Merek</th>
            <th class="text-center">Stok</th>
            <th class="text-center">Harga Satuan</th>
            <th class="text-center">Foto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($barang as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->kode }}</td>
                <td>{{ $c->nama_barang }}</td>
                <td>{{ $c->kategori }}</td>
                <td>{{ $c->merek }}</td>
                <td class="text-end">{{ $c->stok }}</td>
                <td class="text-end">{{ number_format($c->harga_terbaru, 0) }}</td>
                <td class="text-center">
                    <img src="{{ asset('product_image/' . $c->image) }}" alt="" width="80px">
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
