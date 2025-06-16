<div class="row">
    <div class="col-lg-6">
        <label for="">Nama Vendor</label>
        <input type="hidden" class="form-control" name="id" value="{{ $vendor->id }}">
        <input type="text" class="form-control" name="nama" value="{{ $vendor->nama }}">
    </div>
    <div class="col-lg-6">
        <label for="">Hp / Telpon</label>
        <input type="text" class="form-control" name="telepon" value="{{ $vendor->telepon }}">
    </div>
    <div class="col-lg-6">
        <label for="">Kategori</label>
        <select name="kategori_id" class="form-control" id="">
            <option value="">Pilih Kategori</option>
            @foreach ($kategori as $k)
                <option value="{{ $k->id }}" @selected($vendor->kategori_id == $k->id)>{{ $k->kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6">
        <label for="">Cabang</label>
        <select name="cabang_id" class="form-control" id="">
            <option value="">-Pilih Cabang-</option>
            @foreach ($cabang as $c)
                <option value="{{ $c->id }}" @selected($vendor->cabang_id == $c->id)>{{ $c->nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-6">
        <label for="">Alamat</label>
        <input type="text" class="form-control" name="alamat" value="{{ $vendor->alamat }}">
    </div>
</div>
