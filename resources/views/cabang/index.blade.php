<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <button data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-primary float-end">Tambah
                Data</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Cabang</th>
                        <th>Alamat</th>
                        <th>Keterangan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cabang as $c)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $c->nama }}</td>
                            <td>{{ $c->alamat }}</td>
                            <td>{{ $c->ket }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{ route('cabang.delete', $c->id) }}"
                                    onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i
                                        class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <form action="{{ route('cabang.store') }}" method="post">
        @csrf
        <x-modal size="modal-lg" id="tambah">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Nama Cabang</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="col-lg-6">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control" name="alamat">
                </div>
                <div class="col-lg-12">
                    <label for="">Keterangan</label>
                    <textarea name="ket" class="form-control" id="" cols="10" rows="4"></textarea>
                </div>
            </div>

        </x-modal>
    </form>

</x-app-layout>
