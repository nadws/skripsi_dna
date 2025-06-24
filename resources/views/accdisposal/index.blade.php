<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Asset</th>
                        <th>Pemilik</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
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
                            <td>

                                @if ($d->status == 'approved')
                                    <span class="badge bg-success"><i class="bi bi-check2-all"></i></span>
                                @else
                                    <button data-bs-toggle="modal" data-bs-target="#edit" data-id="{{ $d->id }}"
                                        class="btn btn-info btn-sm getData"><i class="bi bi-search"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>
    </div>
    <form action="{{ route('accdisposal.edit') }}" method="POST" class="submit">
        @csrf
        <x-modal-edit size="modal-lg" id="edit" url="/accdisposal/getDisposal" tipe='edit'
            judul='Permintaan Assets'>
        </x-modal-edit>
    </form>


</x-app-layout>
