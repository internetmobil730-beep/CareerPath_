@section('title', 'KONTROL PANELİ')
@extends('dashboard.layout')

@section('content')
<h2 class="mb-4 title">Admin Dashboard</h2>

<div class="row text-center">

    <div class="col-md-4">
        <div class="card shadow-lg bgcolor1 p-4 mb-3">
            <div class="card-body">
                <h5 class="card-title">Toplam Becerleri</h5>
                <p class="card-text display-6">
                    {{ $skillsCount ?? 0 }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-lg bgcolor2 p-4 mb-3">
            <div class="card-body">
                <h5 class="card-title">Toplam Bölümler</h5>
                <p class="card-text display-6">
                    {{ $majorsCount ?? 0 }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-lg bgcolor3 p-4 mb-3">
            <div class="card-body">
                <h5 class="card-title">Toplam Üniversiteler</h5>
                <p class="card-text display-6">
                    {{ $universitiesCount ?? 0 }}
                </p>
            </div>
        </div>
    </div>

</div>
<div class="row mt-5">
    <div class="col-md-6">
        <canvas id="skillsChart"></canvas>
    </div>
    <div class="col-md-6">
        <canvas id="usersChart"></canvas>
    </div>
    
</div>
<div class="row mt-5">
    <div class="col-md-12">
        <div class="card shadow-lg p-4">
            <h5 class="text-center mb-4">Genel İstatistik Karşılaştırması</h5>
            <canvas id="combinedComparisonChart" style="width: 100%; height: 400px;"></canvas>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    new Chart(document.getElementById('skillsChart'), {
        type: "doughnut",
        data: {
            labels: ['Beceri_Kategorileri', 'Beceriler', 'Bölümler', 'Üniversiteler'],
            datasets: [{
                data: [ {{ $categoriesCount }}, 
                        {{ $skillsCount }}, 
                        {{ $majorsCount }}, 
                        {{ $universitiesCount }}
                      ],
                backgroundColor: ['#28a745', '#ffc107', '#fbb2b9ff', '#6c757d']
            }]
        },
        options: {
            responsive: true
        }
    });

    new Chart(document.getElementById('usersChart'), {
        type: "pie",
        data: {
            labels: ['Kullanıcılar'],
            datasets: [{
                data: [{{ $usersCount }}], 
                backgroundColor: ['#6f42c1'] 
            }]
        },
        options: {
            responsive: true
        }
    });
const ctx = document.getElementById('combinedComparisonChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar', 
        data: {
            labels: ['Bölümler', 'Beceriler', 'Üniversiteler', 'Kategoriler',  'Kullanıcılar'],
            datasets: [{
                label: 'Toplam Sayı',
                data: [
                    {{ $majorsCount}},
                    {{ $skillsCount}}, 
                    {{ $universitiesCount}},
                    {{ $categoriesCount}},
                    {{ $usersCount}}
                ],
                backgroundColor: [
                    '#628141', 
                    '#E49BA6', 
                    '#36A2EB', 
                    '#FFCE56', 
                    '#9966FF'  
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection