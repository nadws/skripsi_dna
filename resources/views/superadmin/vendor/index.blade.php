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
                        <th>Nama Vendor</th>
                        <th>No telpon</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendor as $v)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $v->nama }}</td>
                            <td>{{ $v->telepon }}</td>
                            <td>{{ $v->alamat }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                                <a href="#" onclick="return confirm('Apakah anda yakin?')"
                                    class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <form action="{{ route('vendor.store') }}" method="post">
        @csrf
        <x-modal id="tambah" title="Tambah Data">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Nama Vendor</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="col-lg-6">
                    <label for="">Hp / Telpon</label>
                    <input type="text" class="form-control" name="telepon">
                </div>
                <div class="col-lg-6">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control" name="alamat">
                </div>
            </div>
        </x-modal>
    </form>
</x-app-layout>
