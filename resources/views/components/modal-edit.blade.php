@props(['size' => '', 'id' => 'edit', 'url' => ''])
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog {{ $size }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="load-data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary submit">Simpan</button>
                <button type="button" disabled class="btn btn-primary submit_proses" hidden>Proses ..</button>
            </div>
        </div>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.getData', function(e) {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route($url) }}",
                    type: "GET",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $("#load-data").html(data);

                    }
                });
            });
        });
    </script>
@endsection
