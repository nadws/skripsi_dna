<div class="row">
    <input type="hidden" name="id" value="{{$p->id}}">
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
        
    </table>
</div>