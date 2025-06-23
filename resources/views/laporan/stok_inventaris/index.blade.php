<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <form action="{{ route('stok_inventaris.print') }}" method="get" target="_blank">
                <div class="row">
                    <div class="col-lg-4">
                        <select name="cabang" id="getBarang" class="form-control">
                            <option value="">Pilih Cabang</option>
                            @foreach ($cabang as $c)
                                <option value="{{ $c->id }}">{{ $c->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-8">
                        <button type="submit" class="btn btn-primary float-end">Print</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div id="load_barang"></div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('change', '#getBarang', function(e) {
                    var cabang = $(this).val();
                    $.ajax({
                        url: "/stok_inventaris/getStok",
                        type: "GET",
                        data: {
                            cabang: cabang
                        },
                        success: function(data) {
                            $("#load_barang").html(data);

                        }
                    });
                });
            });
        </script>
    @endsection

</x-app-layout>
