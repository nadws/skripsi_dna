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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Cabang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $u)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->role }}</td>
                            <td>{{ $u->cabang->nama ?? '-' }}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#edit"
                                    class="btn btn-warning btn-sm getData" data-id="{{ $u->id }}"><i
                                        class="bi bi-pencil-square"></i></a>
                                    {{-- <a href="#" onclick="return confirm('Apakah anda yakin?')"
                                    class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{ route('user.store') }}" method="post">
        @csrf
        <x-modal id="tambah" size="modal-lg">
            <div class="row">
                <div class="col-lg-6">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="col-lg-6">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="col-lg-6">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="col-lg-6">
                    <label for="">Role</label>
                    <select name="role" class="form-control" id="">
                        <option value="">Pilih Role</option>
                        <option value="presiden">Presiden</option>
                        <option value="superadmin">superadmin</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
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
            </div>
        </x-modal>
    </form>

    <form action="{{ route('user.update') }}" method="post">
        @csrf
        <x-modal-edit id="edit" size="modal-lg" url="user.getEdit"></x-modal-edit>
    </form>
</x-app-layout>
