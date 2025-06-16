<div class="row">
    <div class="col-lg-6">
        <label for="">Nama Suplier</label>
        <input type="hidden" class="form-control" name="id" value="{{ $suplier->id }}">
        <input type="text" class="form-control" name="nama" value="{{ $suplier->nama }}">
    </div>
    <div class="col-lg-6">
        <label for="">Kategori</label>
        <select name="kategori_id" class="form-control" id="">
            <option value="">Pilih Kategori</option>
            @foreach ($kategori as $k)
                <option value="{{ $k->id }}" @selected($suplier->kategori_id == $k->id)>{{ $k->kategori }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6">
        <label for="">Cabang</label>
        <select name="cabang_id" class="form-control" id="">
            <option value="">Pilih Cabang</option>
            @foreach ($cabang as $c)
                <option value="{{ $c->id }}" @selected($suplier->cabang_id == $c->id)>{{ $c->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6">
        <label for="">Telpon</label>
        <input type="text" class="form-control" name="telp" value="{{ $suplier->telp }}">
    </div>
    <div class="col-lg-6">
        <label for="">Alamat</label>
        <input type="text" class="form-control" name="alamat" value="{{ $suplier->alamat }}">
    </div>
    <div class="col-lg-12">
        <label for="">Keterangan</label>
        <textarea name="keterangan" class="form-control" id="" cols="10" rows="4">{{ $suplier->keterangan }}</textarea>
    </div>
</div>
