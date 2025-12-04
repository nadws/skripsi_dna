<div class="row">
    <div class="col-lg-4">
        <img id="imagePreview" src="{{ asset('product_image/' . $barang->image) }}" alt="Preview Gambar"
            style="max-width: 150px;">
        <br>
        <input type="file" class="form-control" name="image" id="imageInput">
    </div>
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-6">
                <label for="">Kode Barang</label>
                <input type="text" class="form-control" name="kode_barang" value="{{ $barang->kode }}" disabled>
            </div>
            <div class="col-lg-6">
                <label for="">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" value="{{ $barang->nama_barang }}">

            </div>
            <div class="col-lg-6">
                <label for="">Kategori</label>
                <select name="kategori_id" id="" class="form-control">
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategori as $c)
                        <option value="{{ $c->id }}" {{ $barang->kategori_id == $c->id ? 'selected' : '' }}>
                            {{ $c->kategori }}</option>
                    @endforeach
                </select>

            </div>
            <div class="col-lg-6">
                <label for="">Merek</label>
                <input type="text" class="form-control" name="merek" value="{{ $barang->merek }}">
            </div>
            <div class="col-lg-6">
                <label for="">Serial Number</label>
                <input type="text" class="form-control" name="serial_number" value="{{ $barang->serial_number }}">
            </div>
            <div class="col-lg-6">
                <label for="">Spesifikasi</label>
                <input type="text" class="form-control" name="spesifikasi" value="{{ $barang->spesifikasi }}">
            </div>
            <div class="col-lg-12">
                <label for="">Tempat/Posisi</label>
                <input type="text" class="form-control" name="tempat_barang" value="{{ $barang->tempat_barang }}">
            </div>
            <input type="hidden" class="form-control" name="cabang_id" value="{{ $cabang_id }}">
            <input type="hidden" class="form-control" name="id" value="{{ $barang->id }}">

            {{-- <div class="col-lg-6">
                            <label for="">Stok Awal</label>
                            <input type="text" class="form-control" name="stok_awal">
                        </div>
                        <div class="col-lg-6">
                            <label for="">Harga Satuan Beli</label>
                            <input type="text" class="form-control" name="harga">
                        </div> --}}

        </div>

    </div>

</div>
