<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <form action="{{ route('laporan_perbaikan_inventaris.print') }}" method="get" target="_blank">
                <div class="row">
                    <div class="col-lg-2">
                        <label for="">Cabang</label>
                        <select name="cabang" class="form-control">
                            <option value="">Pilih Cabang</option>
                            @foreach ($cabang as $c)
                                <option value="{{ $c->id }}">{{ $c->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <label for="">Dari Tanggal</label>
                        <input type="date" class="form-control" name="tgl_awal">
                    </div>
                    <div class="col-lg-2">
                        <label for="">Sampai Tanggal</label>
                        <input type="date" class="form-control" name="tgl_akhir">
                    </div>
                    <div class="col-lg-2">
                        <label for="">Aksi</label>
                        <br>
                        <button type="button" class="btn btn-primary" id="getData"><i class="bi bi-printer-fill"></i>
                            Search</button>
                    </div>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-primary float-end">Print</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div id="load_data"></div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '#getData', function(e) {
                    var cabang = $(this).val();
                    var tgl_awal = $('input[name=tgl_awal]').val();
                    var tgl_akhir = $('input[name=tgl_akhir]').val();

                    $.ajax({
                        url: "/laporan_perbaikan_inventaris/getdata",
                        type: "GET",
                        data: {
                            cabang: cabang,
                            tgl_awal: tgl_awal,
                            tgl_akhir: tgl_akhir
                        },
                        success: function(data) {
                            $("#load_data").html(data);

                        }
                    });
                });
            });
        </script>
    @endsection

</x-app-layout>
