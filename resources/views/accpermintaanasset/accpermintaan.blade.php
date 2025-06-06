<div class="row">
    <input type="hidden" name="id" value="{{ $p->id }}">
    <table class="table">
        <tr>
            <th>Cabang</th>
            <th width="2%"> : </th>
            <th>{{ $p->cabang->nama }}</th>
        </tr>
        <tr>
            <th>Nama Asset</th>
            <th width="2%"> : </th>
            <th>{{ $p->barang->nama_barang }} ({{ $p->barang->merek }})</th>
        </tr>
        <tr>
            <th>Suplier / Cabang</th>
            <th width="2%"> : </th>
            <th>
                {{ empty($p->pembelian->suplier->nama) ? '' : 'Suplier ' . $p->pembelian->suplier->nama }}
                {{ empty($p->overstock->cabang->nama) ? '' : 'Cabang ' . $p->overstock->cabang->nama }}
            </th>
        </tr>
        <tr>
            <th>Jumlah</th>
            <th width="2%"> : </th>
            <th>
                {{ $p->jumlah }}
            </th>
        </tr>
        <tr>
            <th>Kategori</th>
            <th width="2%"> : </th>
            <th>
                {{ $p->kategori }}
            </th>
        </tr>
        <tr>
            <th>Status</th>
            <th width="2%"> : </th>
            <th>
                <span
                    class="badge {{ $p->status == 'pending' ? 'bg-warning' : ($p->status == 'approved' ? 'bg-success' : 'bg-danger') }}  ">{{ $p->status }}</span>
            </th>
        </tr>
        @if ($p->status == 'rejected')
            <tr>
                <th>Alasan Penolakan</th>
                <th width="2%"> : </th>
                <th>
                    {{ $p->ket_presiden }}
                </th>
            </tr>
        @endif

    </table>
    <div class="col-lg-12">
        <label for="">Keputusan</label>
        <select name="status" id="" class="form-control keputusan" required>
            <option value="">-Pilih Keputusan-</option>
            <option value="approved">Setujui</option>
            <option value="rejected">Tolak</option>
        </select>
    </div>
    <div class="col-lg-12 mt-2 alasan" hidden>
        <label for="">Alasan Penolakan</label>
        <textarea name="ket_presiden" id="" cols="8" rows="5" class="form-control"></textarea>
    </div>
</div>
