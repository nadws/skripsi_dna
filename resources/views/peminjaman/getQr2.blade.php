<style>
    @media print {
        .btn_hilang {
            display: none;
        }
    }
</style>
<center>
    <div class="text-center">{!! QrCode::size(300)->generate(url("/peminjaman/getDataPeminjaman2?id=$id")) !!}</div>
    <p class="text-center mt-4">{{ $peminjaman->invoice }}</p>
</center>
<script>
    window.print()
</script>
