@props(['size' => '', 'id' => 'edit', 'url' => '', 'tipe' => 'edit', 'judul' => ''])
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog {{ $size }}">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">{{ $judul }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{ $url }}
                <div class="load-data"></div>
            </div>
            <div class="modal-footer">
                @if ($tipe == 'edit' || $tipe == 'selesai' || $tipe == 'acc')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submit">Simpan</button>
                    <button type="button" disabled class="btn btn-primary submit_proses" hidden>Proses ..</button>
                @else
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @endif

            </div>
        </div>
    </div>
</div>
@if ($tipe != 'edit')
@else
    @section('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '.getData', function(e) {
                    var id = $(this).attr('data-id');
                    alert("{{ $url }}");
                    $.ajax({
                        url: "{{ route($url) }}",
                        type: "GET",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            $(".load-data").html(data);

                        }
                    });
                });
            });
        </script>
    @endsection
@endif
