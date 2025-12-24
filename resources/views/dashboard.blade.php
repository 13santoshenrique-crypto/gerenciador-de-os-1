@extends('layouts.app')

@section('content')
<style>
    .kpi-card {
        background-color: var(--white-color);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 2rem;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }
    .kpi-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--box-shadow-hover);
    }
    .kpi-icon {
        font-size: 3rem;
        margin-right: 1.5rem;
        color: var(--primary-color);
    }
    .kpi-value {
        font-size: 2.5rem;
        font-weight: 700;
    }
    .kpi-label {
        font-size: 1rem;
        color: var(--text-color-light);
    }
    .chart-container {
        margin-top: 2rem;
    }
</style>

<div>
    <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-6" style="color: var(--text-color);">Dashboard Principal</h2>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Total Ordens de Serviço -->
        <div class="kpi-card">
            <div class="kpi-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
            <div>
                <div class="kpi-value">{{ $totalServiceOrders ?? '...' }}</div>
                <div class="kpi-label">Ordens de Serviço</div>
            </div>
        </div>

        <!-- Card 2: Ordens Pendentes -->
        <div class="kpi-card">
            <div class="kpi-icon" style="color: var(--warning-color);">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <div class="kpi-value">{{ $pendingServiceOrders ?? '...' }}</div>
                <div class="kpi-label">OS Pendentes</div>
            </div>
        </div>

        <!-- Card 3: Total de Equipamentos -->
        <div class="kpi-card">
            <div class="kpi-icon">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <div>
                <div class="kpi-value">{{ $totalEquipments ?? '...' }}</div>
                <div class="kpi-label">Equipamentos</div>
            </div>
        </div>
        
        <!-- Card 4: Manutenções Atrasadas -->
        <div class="kpi-card">
            <div class="kpi-icon" style="color: var(--danger-color);">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div>
                <div class="kpi-value">{{ $overdueMaintenances ?? '...' }}</div>
                <div class="kpi-label">Manutenções Atrasadas</div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 chart-container">
        <div class="card">
            <h3 class="font-semibold mb-4">Ordens de Serviço por Status</h3>
            <canvas id="serviceOrderStatusChart"></canvas>
        </div>
        <div class="card">
            <h3 class="font-semibold mb-4">Novas Ordens de Serviço (Últimos 30 dias)</h3>
            <canvas id="newServiceOrdersChart"></canvas>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Chart 1: Service Order Status (Pie Chart)
        const serviceOrderStatusCtx = document.getElementById('serviceOrderStatusChart').getContext('2d');
        const serviceOrderStatusChart = new Chart(serviceOrderStatusCtx, {
            type: 'pie',
            data: {
                labels: {!! $serviceOrderStatusLabels !!},
                datasets: [{
                    data: {!! $serviceOrderStatusData !!},
                    backgroundColor: [
                        'rgba(255, 159, 64, 0.8)', // pending
                        'rgba(54, 162, 235, 0.8)', // in_progress
                        'rgba(75, 192, 192, 0.8)', // completed
                        'rgba(255, 99, 132, 0.8)',  // cancelled
                    ],
                    borderColor: var(--white-color),
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // Chart 2: New Service Orders (Line Chart)
        const newServiceOrdersCtx = document.getElementById('newServiceOrdersChart').getContext('2d');
        const newServiceOrdersChart = new Chart(newServiceOrdersCtx, {
            type: 'line',
            data: {
                labels: {!! $newServiceOrdersLabels !!},
                datasets: [{
                    label: 'Novas OS',
                    data: {!! $newServiceOrdersData !!},
                    backgroundColor: 'rgba(74, 144, 226, 0.2)',
                    borderColor: 'rgba(74, 144, 226, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
