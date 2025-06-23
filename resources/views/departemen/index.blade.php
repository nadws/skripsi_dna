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
                        <th>Nama Departemen</th>
                        <th>Cabang</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departemen as $c)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $c->nama }}</td>
                            <td>{{ $c->cabang->nama }}</td>
                            <td class="text-center">
                                <button data-bs-toggle="modal" data-bs-target="#edit"
                                    class="btn btn-warning btn-sm getData" data-id="{{ $c->id }}"><i
                                        class="bi bi-pencil-square"></i></button>
                                <a href="{{ route('departemen.delete', $c->id) }}"
                                    onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-sm"><i
                                        class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <form action="{{ route('departemen.store') }}" method="post">
        @csrf
        <x-modal id="tambah">
            <div class="row">
                <div class="col-lg-12">
                    <label for="">Nama Departemen</label>
                    <input type="text" class="form-control" name="nama">
                    <input type="hidden" name="cabang_id" value="{{ $cabang_id }}">
                </div>
                {{-- <div class="col-lg-6">
                    <label for="">Cabang</label>
                    <select name="cabang_id" id="" class="form-control">
                        <option value="">Pilih Cabang</option>
                        @foreach ($cabang as $c)
                            <option value="{{ $c->id }}">{{ $c->nama }}</option>
                        @endforeach
                    </select>
                </div> --}}

            </div>

        </x-modal>
    </form>

    <form action="{{ route('departemen.update') }}" method="post">
        @csrf
        <x-modal-edit id="edit" size="modal-lg" judul="Edit Departemen" url="/departemen/getEdit"></x-modal-edit>
    </form>
</x-app-layout>
