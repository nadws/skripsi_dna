<div class="row">
    <div class="col-lg-6">
        <label for="">Nama Cabang</label>
        <input type="hidden" class="form-control" name="id" value="{{ $cabang->id }}">
        <input type="text" class="form-control" name="nama" value="{{ $cabang->nama }}">
    </div>
    <div class="col-lg-6">
        <label for="">Alamat</label>
        <input type="text" class="form-control" name="alamat" value="{{ $cabang->alamat }}">
    </div>
    <div class="col-lg-12">
        <label for="">Keterangan</label>
        <textarea name="ket" class="form-control" id="" cols="10" rows="4">{{ $cabang->ket }}</textarea>
    </div>
</div>
