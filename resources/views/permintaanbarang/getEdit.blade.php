<div class="row">
    <div class="col-lg-4">
        <label for="">Invoice</label>
        <input type="text" class="form-control" value="{{ $peminjaman->invoice }}" disabled>
    </div>
    <div class="col-lg-4">
        <label for="">Kategori Permintaan</label>
        <select name="katgeori" id="" class="form-control kategori">
            <option value="">-Pilih Kategori-</option>
            <option value="pembelian" @selected($peminjaman->kategori == 'pembelian')>Pembelian</option>
            <option value="overstock" @selected($peminjaman->kategori == 'overstock')>Overstock</option>
        </select>
    </div>
    <div class="col-lg-4">
        <label for="">Keterangan</label>
        <input type="text" class="form-control" value="{{ $peminjaman->keterangan }}" name="keterangan" required>
    </div>
    <div class="col-lg-12">
        <hr>
    </div>
</div>
<div class="row pembelian" hidden>
    <div class="col-lg-6">
        <label for="">Asset</label>
        <select name="barang_id_pembelian" id="" class="form-control">
            <option value="">-Pilih Asset-</option>
            @foreach ($barang as $b)
                <option value="{{ $b->id }}">{{ $b->nama_barang }} ({{ $b->merek }})</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6">
        <label for="">Suplier</label>
        <select name="suplier_id_pembelian" id="" class="form-control">
            <option value="">-Pilih Suplier-</option>
            @foreach ($suplier as $b)
                <option value="{{ $b->id }}">{{ $b->nama }} </option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6 mt-2">
        <label for="">Jumlah</label>
        <input type="number" name="jumlah_pembelian" class="form-control">
    </div>
    <div class="col-lg-6 mt-2">
        <label for="">Harga Satuan</label>
        <input type="number" name="harga_satuan_pembelian" class="form-control" value="0" min="0">
    </div>
</div>
<div class="row overstock" hidden>
    <div class="col-lg-6">
        <label for="">Cabang</label>
        <select name="cabang_id_overstock" id="" class="form-control get_aseet_cabang">
            <option value="">-Pilih Cabang-</option>
            @foreach ($cabang as $b)
                <option value="{{ $b->id }}">{{ $b->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6">
        <label for="">Asset</label>
        <select name="barang_id_overstock" id="" class="form-control load_asset">

        </select>
    </div>
    <div class="col-lg-6">
        <label for="">Stock</label>
        <input type="number" name="stock" class="form-control stock" disabled>
    </div>
    <div class="col-lg-6">
        <label for="">Harga Satuan</label>
        <input type="number" class="form-control harga" disabled>
        <input type="hidden" name="harga_satuan_overstock" class="form-control harga">
    </div>
    <div class="col-lg-6">
        <label for="">Jumlah Permintaan</label>
        <input type="number" name="jumlah_overstock" class="form-control">
    </div>


</div>
