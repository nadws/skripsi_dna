<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">Tambah Data</button>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Suplier</th>
                        <th>Telpon</th>
                        <th>Alamat</th>
                        <th>Keterangan</th>
                        <th>Cabang</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($suplier as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>{{ $s->telp }}</td>
                            <td>{{ $s->alamat }}</td>
                            <td>{{ $s->keterangan }}</td>
                            <td>{{ $s->cabang->nama }}</td>
                            <td>{{ $s->kategori->kategori }}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#edit"
                                    class="btn btn-warning btn-sm getData" data-id="{{ $s->id }}"><i
                                        class="bi bi-pencil-square"></i></button>
                                <a href="{{ route('suplier.delete', $s->id) }}"
                                    onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i
                                        class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('suplier.store') }}" method="post">
        @csrf
        <x-modal size="modal-lg" id="tambah">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Nama Suplier</label>
                    <input type="text" class="form-control" name="nama">
                </div>
                <div class="col-lg-6">
                    <label for="">Kategori</label>
                    <select name="kategori_id" class="form-control" id="">
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategori as $k)
                            <option value="{{ $k->id }}">{{ $k->kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="">Cabang</label>
                    <select name="cabang_id" class="form-control" id="">
                        <option value="">Pilih Cabang</option>
                        @foreach ($cabang as $c)
                            <option value="{{ $c->id }}">{{ $c->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6">
                    <label for="">Telpon</label>
                    <input type="text" class="form-control" name="telp">
                </div>
                <div class="col-lg-6">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control" name="alamat">
                </div>
                <div class="col-lg-12">
                    <label for="">Keterangan</label>
                    <textarea name="keterangan" class="form-control" id="" cols="10" rows="4"></textarea>
                </div>
            </div>

        </x-modal>
    </form>

    <form action="{{ route('suplier.update') }}" method="post">
        @csrf
        <x-modal-edit id="edit" size="modal-lg" judul="Edit Suplier" url="suplier.getEdit"></x-modal-edit>
    </form>
</x-app-layout>
