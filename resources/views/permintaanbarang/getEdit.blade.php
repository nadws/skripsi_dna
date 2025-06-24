<div class="row">
    <div class="col-lg-4">
        <label for="">Invoice</label>
        <input type="text" class="form-control" value="{{ $peminjaman->invoice }}" disabled>
        <input type="hidden" class="form-control" name="invoice" value="{{ $peminjaman->invoice }}">
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
<div class="row pembelian" {{ $peminjaman->kategori == 'pembelian' ? '' : 'hidden' }}>
    <div class="col-lg-6">
        <label for="">Asset</label>
        <select name="barang_id_pembelian" id="" class="form-control">
            <option value="">-Pilih Asset-</option>
            @foreach ($barang as $b)
                <option value="{{ $b->id }}" @selected($b->id == $peminjaman->barang_id)>{{ $b->nama_barang }}
                    ({{ $b->merek }})
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6">
        <label for="">Suplier</label>
        <select name="suplier_id_pembelian" id="" class="form-control">
            <option value="">-Pilih Suplier-</option>
            @foreach ($suplier as $b)
                <option value="{{ $b->id }}" @selected($b->id == $pembelian->suplier_id)>{{ $b->nama }} </option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6 mt-2">
        <label for="">Jumlah</label>
        <input type="number" name="jumlah_pembelian" class="form-control" value="{{ $pembelian->jumlah ?? 0 }}"
            min="0" required>
    </div>
    <div class="col-lg-6 mt-2">
        <label for="">Harga Satuan</label>
        <input type="number" name="harga_satuan_pembelian" class="form-control"
            value="{{ $pembelian->harga_satuan ?? 0 }}" min="0">
    </div>
</div>
<div class="row overstock" {{ $peminjaman->kategori == 'overstock' ? '' : 'hidden' }}>
    <div class="col-lg-6">
        <label for="">Cabang</label>
        <select name="cabang_id_overstock" id="" class="form-control get_aseet_cabang">
            <option value="">-Pilih Cabang-</option>
            @foreach ($cabang as $b)
                <option value="{{ $b->id }}" @selected($b->id == ($overstock->dari_cabang_id ?? 0))>{{ $b->nama }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-lg-6">
        <label for="">Asset</label>
        <select name="barang_id_overstock" id="" class="form-control load_asset">
            @foreach ($assets as $item)
                <option value="{{ $item->id }}" @selected($item->id == ($overstock->barang_id ?? 0))>{{ $item->nama_barang }}
                    ({{ $item->merek }})
                </option>
            @endforeach

        </select>
    </div>
    <div class="col-lg-6">
        <label for="">Stock</label>
        <input type="number" name="stock" class="form-control stock" value="{{ $stok ?? 0 }}" disabled>
    </div>
    <div class="col-lg-6">
        <label for="">Harga Satuan </label>
        <input type="number" class="form-control harga" disabled value="{{ $harga ?? 0 }}">
        <input type="hidden" name="harga_satuan_overstock" class="form-control harga" value="{{ $harga ?? 0 }}">
    </div>
    <div class="col-lg-6">
        <label for="">Jumlah Permintaan</label>
        <input type="number" name="jumlah_overstock" class="form-control" value="{{ $overstock->jumlah ?? 0 }}">
    </div>


</div>
