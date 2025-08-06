<x-app-layout title="Dashboard">
    <h3 class="text-center">Selamat Datang Di Website Sistem Informasi Inventaris PT.Saba Indomedika</h3>
    <br>
    {{-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('hero/1.png') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('hero/2.jpg') }}" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('hero/3.jpg') }}" class="d-block w-100" alt="...">
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-lg-6">
            <label for="" class="text-center fw-bold">Peminjaman Assets</label>
            <div style="position: relative; height:400px; width:100%;">
                <canvas id="peminjamanChart"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <label for="" class="text-center fw-bold">Stok Assets</label>
            <div style="position: relative; height:400px;">
                <canvas id="stokChart"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <label for="" class="text-center fw-bold">Perbaikan Assets</label>
            <div style="position: relative; height:400px;">
                <canvas id="perbaikanChart"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <label for="" class="text-center fw-bold">Disposal Assets</label>
            <div style="position: relative; height:400px;">
                <canvas id="disposalChart"></canvas>
            </div>
        </div>
    </div>


    @section('scripts')
        <script>
            // ====== Grafik Peminjaman per Bulan ======
            const labelsPeminjaman = {!! json_encode($peminjaman->pluck('bulan')) !!};
            const dataPeminjaman = {!! json_encode($peminjaman->pluck('total')) !!};

            new Chart(document.getElementById('peminjamanChart'), {
                type: 'bar',
                data: {
                    labels: labelsPeminjaman,
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: dataPeminjaman,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });

            // ====== Grafik Stok per Barang ======
            const labelsStok = {!! json_encode($stok->pluck('nama_barang')) !!};
            const dataStok = {!! json_encode($stok->pluck('stok')) !!};

            new Chart(document.getElementById('stokChart'), {
                type: 'bar',
                data: {
                    labels: labelsStok,
                    datasets: [{
                        label: 'Stok Barang',
                        data: dataStok,
                        backgroundColor: 'rgba(255, 159, 64, 0.6)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });


            const labelsPerbaikan = {!! json_encode($perbaikan->pluck('bulan')) !!};
            const dataPerbaikan = {!! json_encode($perbaikan->pluck('total')) !!};

            new Chart(document.getElementById('perbaikanChart'), {
                type: 'bar',
                data: {
                    labels: labelsPerbaikan,
                    datasets: [{
                        label: 'Jumlah Perbaikan',
                        data: dataPeminjaman,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });
            const labelsDisposal = {!! json_encode($disposal->pluck('bulan')) !!};
            const dataDisposal = {!! json_encode($disposal->pluck('total')) !!};

            new Chart(document.getElementById('disposalChart'), {
                type: 'bar',
                data: {
                    labels: labelsDisposal,
                    datasets: [{
                        label: 'Jumlah Disposal',
                        data: dataPeminjaman,
                        backgroundColor: 'rgba(255, 159, 64, 0.6)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });
        </script>
    @endsection
</x-app-layout>
