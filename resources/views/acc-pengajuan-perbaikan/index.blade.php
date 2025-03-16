<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Asset</th>
                        <th>Pemilik</th>
                        <th>Jumlah</th>
                        <th>Vendor</th>
                        <th>Biaya</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
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

                                @if ($p->status == 'approved')
                                    <span class="badge bg-success"><i class="bi bi-check2-all"></i></span>
                                @else
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
    <form action="{{ route('accperbaikan.edit') }}" method="POST">
        @csrf
        <x-modal-edit size="modal-lg" id="edit" url="accperbaikan.getPerbaikan" tipe='acc'
            judul='Perbaikan Assets'>
        </x-modal-edit>
    </form>


</x-app-layout>
