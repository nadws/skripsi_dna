<x-app-layout title="{{ $title }}">
    <div class="card">
        <div class="card-header">
            <form action="{{ route('laporan_disposal.print') }}" method="get" target="_blank">
                <div class="row">
                    <div class="col-lg-4">
                        <select name="cabang" id="getData" class="form-control">
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
            <div id="load_data"></div>
        </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('change', '#getData', function(e) {
                    var cabang = $(this).val();

                    $.ajax({
                        url: "/laporan_disposal/getdata",
                        type: "GET",
                        data: {
                            cabang: cabang
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
