<div class="row">
    <div class="col-lg-6">
        <label for="">Nama</label>
        <input type="text" class="form-control" name="name" value="{{ $user->name }}">
        <input type="hidden" name="id" value="{{ $user->id }}">
    </div>
    <div class="col-lg-6">
        <label for="">Email</label>
        <input type="email" class="form-control" name="email" value="{{ $user->email }}">
    </div>
    <div class="col-lg-6">
        <label for="">Password (kosongkan jika tidak diubah)</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="col-lg-6">
        <label for="">Role</label>
        <select name="role" class="form-control" id="">
            <option value="">Pilih Role</option>
            <option value="presiden" @selected($user->role == 'presiden')>Presiden</option>
            <option value="superadmin" @selected($user->role == 'superadmin')>superadmin</option>
            <option value="admin" @selected($user->role == 'admin')>Admin</option>
            <option value="user" @selected($user->role == 'user')>User</option>
        </select>
    </div>
    <div class="col-lg-6">
        <label for="">Cabang</label>
        <select name="cabang_id" class="form-control" id="">
            <option value="">Pilih Cabang</option>
            @foreach ($cabang as $c)
                <option value="{{ $c->id }}" @selected($user->cabang_id == $c->id)>{{ $c->nama }}</option>
            @endforeach
        </select>
    </div>
</div>
