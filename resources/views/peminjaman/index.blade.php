<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            @if ($role == 'admin')
                <a href="{{ route('peminjaman.formulir') }}" target="_blank" class="btn btn-primary float-end ms-2"><i
                        class="bi bi-printer"></i> Print Formulir</a>
                <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary float-end">Tambah
                    Data</button>
            @else
            @endif

        </div>
        <div class="card-body">
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($peminjaman as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->invoice }}</td>
                            <td>{{ $p->karyawan->nama }}</td>
                            <td>{{ $p->cabang->nama }}</td>
                            <td>{{ $p->barang->nama_barang }}</td>
                            <td>{{ $p->qty }}</td>
                            <td>{{ $p->ket }}</td>
                            <td><span
                                    class="badge {{ $p->status == 'pending' ? 'bg-warning' : ($p->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $p->status }}</span>
                            </td>
                            <td>
                                @if ($role == 'manager')
                                    @if ($p->status == 'approved')
                                        <span class="badge bg-success"><i class="bi bi-check2-all"></i></span>
                                    @else
                                        <button data-bs-toggle="modal" data-bs-target="#edit"
                                            data-id="{{ $p->id }}" class="btn btn-info btn-sm getData"><i
                                                class="bi bi-search"></i></button>
                                    @endif
                                @else
                                    @if ($p->status == 'approved')
                                    @else
                                        <button data-bs-toggle="modal" data-bs-target="#view"
                                            data-id="{{ $p->id }}" class="btn btn-primary btn-sm getData"><i
                                                class="bi bi-eye-fill"></i></button>
                                        <a href="#" class="btn btn-warning btn-sm"><i
                                                class="bi bi-pencil-square"></i></a>
                                        <a href="{{ route('cabang.delete', $p->id) }}"
                                            onclick="return confirm('Apakah anda yakin?')"
                                            class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('peminjaman.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-modal size="modal-lg" id="tambah">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Nama Karyawan</label>
                    <select name="karyawan_id" id="" class="form-control">
                        <option value="">Pilih Karyawan</option>
                        @foreach ($karyawan as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="">Barang</label>
                    <select name="barang_id" id="" class="form-control">
                        <option value="">Pilih Barang</option>
                        @foreach ($barang as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_barang }} ( {{ $b->merek }} )
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 mt-2">
                    <label for="">Qty</label>
                    <input type="number" class="form-control" name="qty">
                </div>
                <div class="col-lg-6 mt-2">
                    <label for="">Ket</label>
                    <input type="text" class="form-control" name="ket">
                </div>
                <div class="col-lg-6 mt-2">
                    <label for="">Lampirkan Formulir </label>
                    <input type="file" class="form-control" name="file">
                </div>


            </div>

        </x-modal>
    </form>
    <form action="{{ route('peminjaman.accepted') }}" method="POST">
        @csrf
        <x-modal-edit size="modal-lg" id="edit" url="peminjaman.getDataPeminjaman" tipe='edit'
            judul='Peminjaman Assets'>
        </x-modal-edit>
    </form>

    <x-modal-edit size="modal-lg" id="view" url="peminjaman.getDataPeminjaman" tipe='acc'
        judul='Peminjaman Assets'>
    </x-modal-edit>



</x-app-layout>
