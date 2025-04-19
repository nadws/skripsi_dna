<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-heade">

        </div>
        <div class="card-body">
            <table class="table teble-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Asset</th>
                        <th>Perminataan Cabang</th>
                        <th>Suplier / Cabang</th>
                        <th>Jumlah</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Status</th>

                        <th>Aksi</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($permintaan as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>PER-{{ $p->invoice }}</td>
                            <td>{{ $p->barang->nama_barang }} ({{ $p->barang->merek }})</td>
                            <td>{{ $p->cabang->nama }}</td>
                            <td>{{ empty($p->pembelian->suplier->nama) ? '' : 'Suplier ' . $p->pembelian->suplier->nama }}
                                {{ empty($p->overstock->cabang->nama) ? '' : 'Cabang ' . $p->overstock->cabang->nama }}
                            </td>
                            <td>{{ $p->jumlah }}</td>
                            <td>{{ $p->kategori }}</td>
                            <td>{{ $p->keterangan }}</td>
                            <td><span
                                    class="badge {{ $p->status == 'pending' ? 'bg-warning' : ($p->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $p->status }}</span>
                            </td>
                            <td>
                                @if ($p->status == 'pending')
                                    <button data-bs-toggle="modal" data-bs-target="#edit" data-id="{{ $p->id }}"
                                        class="btn btn-info btn-sm getData"><i class="bi bi-search"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('accpermintaan.edit') }}" method="POST">
        @csrf
        <x-modal-edit size="modal-lg" id="edit" url="accpermintaan.getEdit" tipe='edit'
            judul='Permintaan Assets'>
        </x-modal-edit>
    </form>



</x-app-layout>
