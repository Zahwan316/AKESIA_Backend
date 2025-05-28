@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
    <div>
        <h1>Dashboard</h1>

        <div class="container mt-5">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Kunjungan per Hari Bulan {{ now()->format('F Y') }}</h5>
                    <canvas id="kunjunganBulananChart" height="100"></canvas>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('kunjunganBulananChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line', // atau 'bar' kalau mau batang
                data: {
                    labels: {!! json_encode($labels) !!}, // contoh: ['2025-05-01', '2025-05-02', ...]
                    datasets: [{
                        label: 'Jumlah Kunjungan',
                        data: {!! json_encode($data) !!},   // contoh: [3, 5, 2, 0, 7, ...]
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });
        </script>


    </div>
@endsection
