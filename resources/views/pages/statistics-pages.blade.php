@extends('layouts.app')

@section('title')
    Statistik Pengelolaan
@endsection

@prepend('prepend-style')
    <style>
        button {
            padding: 12.5px 30px;
            border: 0;
            border-radius: 100px;
            background-color: #1ade79;
            color: #ffffff;
            font-weight: Bold;
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
        }

        button:hover {
            background-color: #0ba25e;
            box-shadow: 0 0 20px #6fc5ff50;
            transform: scale(1.1);
        }

        button:active {
            background-color: #30dda9;
            transition: all 0.25s;
            -webkit-transition: all 0.25s;
            box-shadow: none;
            transform: scale(0.98);
        }

        #komposisiChart,
        #pemilahanChart {
            width: 100%;
            height: auto;
            max-width: 300px;
            max-height: 300px;
        }
    </style>
@endprepend

@section('content')
    <div class="container">
        <div class="row" style="padding-top: 5.5rem">
                <div class="section-content section-dashboard-home" data-aos="fade-up">
                    <div class="container-fluid">
                        <div class="dashboard-heading">
                            <h4 class="dashboard-title">Statistik Pengelolaan Sampah</h4>
                        </div>
                        <div class="dashboard-content">
                            <!-- Filter Kategori -->
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label for="filterKategori">Filter Kategori Timbulan Sampah</label>
                                    <select id="filterKategori" class="form-control">
                                        <option value="all">Semua Kategori</option>
                                        <option value="Desa">Desa</option>
                                        <option value="Perumahan">Perumahan</option>
                                        <option value="Wilayah Lain">Wilayah Lain</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Bar Chart Timbulan Sampah -->
                            <div class="row">
                                <div class="col-md-6" style="text-align: center">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="dashboard-card-title">
                                                Data Timbulan Sampah (Ton)
                                            </div>
                                            <div class="bar-chart" style="align-content: center">
                                                <canvas id="barChart" width="max-width" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="text-align: center">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="dashboard-card-title">
                                                Data Timbulan Sampah (Ton) - Line Chart
                                            </div>
                                            <div class="line-chart" style="align-content: center">
                                                <canvas id="lineChart" width="max-width" height="200"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pie Charts for Komposisi and Pemilahan -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="dashboard-card-title">
                                                Data Komposisi Sampah (Ton)
                                            </div>
                                            <div class="pie-charts">
                                                <canvas id="komposisiChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            <div class="dashboard-card-title">
                                                Data Pemilahan Sampah (Ton)
                                            </div>
                                            <div class="pie-charts">
                                                <canvas id="pemilahanChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Ambil data dan render Chart berdasarkan filter
        $(document).ready(function() {

            var barChart;
            var lineChart;

            function fetchData(kategori = 'all') {
                $.ajax({
                    url: "{{ route('statistik.data-timbulan') }}", // API endpoint untuk mengambil data timbulan
                    method: 'GET',
                    data: {
                        kategori: kategori // Kirim parameter kategori
                    },
                    success: function(response) {
                        let labels = [];
                        let data = [];
                        let chartLabel = kategori === 'all' ? 'Timbulan Sampah (Semua Kategori)' :
                            'Timbulan Sampah (' + kategori + ')';

                        // Loop melalui data dan isi array untuk Chart.js
                        response.forEach(function(item) {
                            labels.push(item.nama); // Nama wilayah
                            data.push(item.jumlah); // Jumlah timbulan sampah
                        });

                        // Reset Chart jika sudah ada sebelumnya
                        if (barChart) {
                            barChart.destroy();
                        }

                        // Render Bar Chart untuk Timbulan Sampah
                        var ctx = document.getElementById('barChart').getContext('2d');
                        barChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: chartLabel,
                                    data: data,
                                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                                    borderColor: '#4CAF50',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                        // Reset Line Chart jika sudah ada sebelumnya
                        if (lineChart) {
                            lineChart.destroy();
                        }
                        // Render Line Chart untuk Timbulan Sampah
                        var ctxLine = document.getElementById('lineChart').getContext('2d');
                        lineChart = new Chart(ctxLine, {
                            type: 'line', // Tipe chart 'line'
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: chartLabel,
                                    data: data,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Line color (with transparency)
                                    borderColor: 'rgba(75, 192, 192, 1)', // Line border color
                                    borderWidth: 2,
                                    fill: true // Fill the area under the line
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('Gagal mengambil data timbulan!');
                    }
                });
            }

            // Panggil fetchData pertama kali dengan kategori 'all'
            fetchData();

            // Event listener untuk filter
            $('#filterKategori').on('change', function() {
                var selectedKategori = $(this).val();
                fetchData(selectedKategori); // Ambil data berdasarkan kategori yang dipilih
            });

            // Render pie chart untuk Komposisi dan Pemilahan tetap sama seperti sebelumnya
            // Data Komposisi
            $.ajax({
                url: "{{ route('statistik.data-komposisi') }}", // API endpoint untuk mengambil data komposisi
                method: 'GET',
                success: function(response) {
                    let labels = [];
                    let data = [];

                    response.forEach(function(item) {
                        labels.push(item.kategori);
                        data.push(item.jumlah);
                    });

                    var ctx = document.getElementById('komposisiChart').getContext('2d');
                    var komposisiChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Komposisi Sampah',
                                data: data,
                                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                                hoverOffset: 4
                            }]
                        }
                    });
                }
            });

            // Data Pemilahan
            $.ajax({
                url: "{{ route('statistik.data-pemilahan') }}", // API endpoint untuk mengambil data pemilahan
                method: 'GET',
                success: function(response) {
                    let labels = [];
                    let data = [];

                    response.forEach(function(item) {
                        labels.push(item.kategori);
                        data.push(item.jumlah);
                    });

                    var ctx = document.getElementById('pemilahanChart').getContext('2d');
                    var pemilahanChart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Pemilahan Sampah',
                                data: data,
                                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                                hoverOffset: 4
                            }]
                        }
                    });
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Gagal mengambil data pemilahan!');
                }
            });
        });
    
        // Menambahkan kelas `scrolled` saat di-scroll
        window.addEventListener("scroll", function() {
            var navbar = document.querySelector(".navbar");
            if (window.scrollY > 0.1) { // Sesuaikan angka 50 ini sesuai kebutuhan
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
        window.addEventListener("scroll", function() {
            const title = document.getElementById("title");
            if (window.scrollY > 0.01) {
                title.style.color = "white"; // Change color to white after scrolling 10px
            } else {
                title.style.color = "black"; // Revert to black when scroll is less than 10px
            }
        });

    </script>

@endpush
