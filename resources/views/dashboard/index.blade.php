@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Penjualan</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalPenjualan }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Pembiayaan</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalPembiayaan }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Total Proyek</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalProyek }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<canvas id="penjualanChart" width="400" height="200"></canvas>
<script>
    var ctx = document.getElementById('penjualanChart').getContext('2d');
    var penjualanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr'],
            datasets: [{
                label: 'Penjualan',
                data: [12, 19, 3, 5],
                backgroundColor: 'rgba(54, 162, 235, 0.6)'
            }]
        }
    });
</script>

