<div class="row">
    <div class="col-lg-6">
        <label for="">Nama Karyawan</label>
        <select name="karyawan_id" id="" class="form-control">
            <option value="">Pilih Karyawan</option>
            @foreach ($karyawan as $k)
                <option value="{{ $k->id }}" @selected($k->id == $peminjaman->karyawan_id)>{{ $k->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6">
        <label for="">Barang</label>
        <select name="barang_id" id="" class="form-control">
            <option value="">Pilih Barang</option>
            @foreach ($barang as $b)
                <option value="{{ $b->id }}" @selected($b->id == $peminjaman->barang_id)>{{ $b->nama_barang }} (
                    {{ $b->merek }} )
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6 mt-2">
        <label for="">Qty</label>
        <input type="hidden" class="form-control" name="id" value="{{ $peminjaman->id }}">
        <input type="number" class="form-control" name="qty" value="{{ $peminjaman->qty }}">
    </div>
    <div class="col-lg-6 mt-2">
        <label for="">Ket</label>
        <input type="text" class="form-control" name="ket" value="{{ $peminjaman->ket }}">
    </div>
    <div class="col-lg-6 mt-2">
        <label for="">Lampirkan Formulir </label>
        <input type="file" class="form-control" name="file">
        <br>
        <br>
        <img id="imagePreview" src="{{ asset('peminjaman_image/' . $peminjaman->file) }}" alt="Preview Gambar"
            style="max-width: 150px;">
    </div>



</div>
