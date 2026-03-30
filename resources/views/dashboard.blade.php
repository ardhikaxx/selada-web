@extends('layouts.app')

@section('title', 'SmartHydro - Dashboard IoT Hidroponik')

@section('content')
<div class="row">
    <!-- Card Statistik: Suhu -->
    <div class="col-xl-3 col-md-6">
        <div class="card floating-card">
            <div class="stat-card" id="temperature-card">
                <div class="stat-icon">
                    <i class="fas fa-temperature-high"></i>
                </div>
                <div class="stat-value" data-stat="temperature">28.5°C</div>
                <div class="stat-label">Suhu Udara</div>
                <span class="stat-trend bg-success bg-opacity-10 text-success" id="temperature-trend">
                    <i class="fas fa-arrow-up"></i> 0.5°
                </span>
                <div class="value-indicator mt-3">
                    <div class="value-range bg-success"></div>
                    <div class="value-marker" id="temperature-marker" style="left: 70%;"></div>
                </div>
                <div class="d-flex justify-content-between mt-1">
                    <small class="text-muted">20°C</small>
                    <small class="text-muted">30°C</small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Card Statistik: Kelembaban -->
    <div class="col-xl-3 col-md-6">
        <div class="card floating-card">
            <div class="stat-card" id="humidity-card">
                <div class="stat-icon">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="stat-value" data-stat="humidity">65%</div>
                <div class="stat-label">Kelembaban Udara</div>
                <span class="stat-trend bg-danger bg-opacity-10 text-danger" id="humidity-trend">
                    <i class="fas fa-arrow-down"></i> 2%
                </span>
                <div class="value-indicator mt-3">
                    <div class="value-range bg-success"></div>
                    <div class="value-marker" id="humidity-marker" style="left: 65%;"></div>
                </div>
                <div class="d-flex justify-content-between mt-1">
                    <small class="text-muted">50%</small>
                    <small class="text-muted">80%</small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Card Statistik: pH Air -->
    <div class="col-xl-3 col-md-6">
        <div class="card floating-card">
            <div class="stat-card" id="ph-card">
                <div class="stat-icon">
                    <i class="fas fa-vial"></i>
                </div>
                <div class="stat-value" data-stat="ph">6.2</div>
                <div class="stat-label">pH Air</div>
                <span class="stat-trend bg-warning bg-opacity-10 text-warning" id="ph-trend">
                    <i class="fas fa-exclamation-circle"></i> Tinggi
                </span>
                <div class="value-indicator mt-3">
                    <div class="value-range bg-success"></div>
                    <div class="value-marker" id="ph-marker" style="left: 80%;"></div>
                </div>
                <div class="d-flex justify-content-between mt-1">
                    <small class="text-muted">5.5</small>
                    <small class="text-muted">7.0</small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Card Statistik: Nutrisi -->
    <div class="col-xl-3 col-md-6">
        <div class="card floating-card">
            <div class="stat-card" id="nutrient-card">
                <div class="stat-icon">
                    <i class="fas fa-flask"></i>
                </div>
                <div class="stat-value" data-stat="nutrient">78%</div>
                <div class="stat-label">Level Nutrisi</div>
                <span class="stat-trend bg-success bg-opacity-10 text-success" id="nutrient-trend">
                    <i class="fas fa-check-circle"></i> Normal
                </span>
                <div class="progress mt-3">
                    <div class="progress-bar bg-success" role="progressbar" data-progress="nutrient" id="nutrient-progress" style="width: 78%"></div>
                </div>
                <div class="d-flex justify-content-between mt-1">
                    <small class="text-muted">Rendah</small>
                    <small class="text-muted">Tinggi</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Grafik Parameter Lingkungan -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <span><i class="fas fa-chart-line me-2"></i>Grafik Parameter Lingkungan</span>
                <div class="period-selector">
                    <button class="period-btn active" data-period="day">Hari</button>
                    <button class="period-btn" data-period="week">Minggu</button>
                    <button class="period-btn" data-period="month">Bulan</button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="environmentChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Status Perangkat & Kontrol -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-microchip me-2"></i>Status Perangkat
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">
                    <div>
                        <span class="device-status online"></span>
                        <strong>Controller Utama</strong>
                    </div>
                    <span class="badge bg-success">Online</span>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">
                    <div>
                        <span class="device-status online"></span>
                        <strong>Sensor Suhu & Kelembaban</strong>
                    </div>
                    <span class="badge bg-success">Online</span>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">
                    <div>
                        <span class="device-status online"></span>
                        <strong>Sensor pH & Nutrisi</strong>
                    </div>
                    <span class="badge bg-success">Online</span>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mb-3 p-3 bg-light rounded">
                    <div>
                        <span class="device-status offline"></span>
                        <strong>Pompa Sirkulasi</strong>
                    </div>
                    <span class="badge bg-danger">Offline</span>
                </div>
                
                <hr>
                
                <h6 class="mb-3"><i class="fas fa-sliders-h me-2"></i>Kontrol Sistem</h6>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="control-btn">
                            <i class="fas fa-play"></i>
                            <div>Pompa Nutrisi</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="control-btn">
                            <i class="fas fa-fill-drip"></i>
                            <div>Tambahkan Nutrisi</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="control-btn">
                            <i class="fas fa-tint"></i>
                            <div>Atur pH Air</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="control-btn">
                            <i class="fas fa-lightbulb"></i>
                            <div>Lampu LED</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Grafik Pertumbuhan -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-seedling me-2"></i>Grafik Pertumbuhan Tanaman
            </div>
            <div class="card-body">
                <div class="chart-container">
                    <canvas id="growthChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Notifikasi & Alert -->
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-bell me-2"></i>Notifikasi Sistem</span>
                <span class="badge bg-primary rounded-pill">3 Baru</span>
            </div>
            <div class="card-body">
                <div class="notification-item notification-warning">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1 text-warning"><i class="fas fa-exclamation-triangle me-1"></i> Peringatan pH Air</h6>
                        <small>10 menit lalu</small>
                    </div>
                    <p class="mb-0">Level pH air diluar batas normal (6.2). Segera lakukan penyesuaian.</p>
                </div>
                
                <div class="notification-item notification-info">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1 text-info"><i class="fas fa-info-circle me-1"></i> Informasi Perangkat</h6>
                        <small>1 jam lalu</small>
                    </div>
                    <p class="mb-0">Pompa sirkulasi nutrisi tidak aktif. Periksa koneksi daya.</p>
                </div>
                
                <div class="notification-item notification-success">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1 text-success"><i class="fas fa-check-circle me-1"></i> Operasi Berhasil</h6>
                        <small>3 jam lalu</small>
                    </div>
                    <p class="mb-0">Penambahan nutrisi otomatis telah berhasil dilakukan.</p>
                </div>
                
                <div class="text-center mt-3">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-history me-1"></i> Lihat Riwayat Lengkap
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Data Historis -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-database me-2"></i>Data Historis
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal & Waktu</th>
                                <th>Suhu</th>
                                <th>Kelembaban</th>
                                <th>pH Air</th>
                                <th>Nutrisi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="historical-data-body">
                            <tr>
                                <td>23 Agustus 2023, 14:30</td>
                                <td>28.5°C</td>
                                <td>65%</td>
                                <td>6.2</td>
                                <td>78%</td>
                                <td><span class="badge bg-warning text-dark">Perhatian pH</span></td>
                            </tr>
                            <tr>
                                <td>23 Agustus 2023, 12:15</td>
                                <td>27.8°C</td>
                                <td>67%</td>
                                <td>6.0</td>
                                <td>80%</td>
                                <td><span class="badge bg-success">Normal</span></td>
                            </tr>
                            <tr>
                                <td>23 Agustus 2023, 10:00</td>
                                <td>26.2°C</td>
                                <td>70%</td>
                                <td>5.9</td>
                                <td>82%</td>
                                <td><span class="badge bg-success">Normal</span></td>
                            </tr>
                            <tr>
                                <td>23 Agustus 2023, 08:45</td>
                                <td>25.5°C</td>
                                <td>72%</td>
                                <td>5.9</td>
                                <td>85%</td>
                                <td><span class="badge bg-success">Normal</span></td>
                            </tr>
                            <tr>
                                <td>23 Agustus 2023, 06:30</td>
                                <td>24.8°C</td>
                                <td>75%</td>
                                <td>5.8</td>
                                <td>87%</td>
                                <td><span class="badge bg-success">Normal</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data dummy untuk grafik lingkungan
        const timeLabels = ['00:00', '03:00', '06:00', '09:00', '12:00', '15:00', '18:00', '21:00'];
        
        // Data untuk grafik lingkungan
        const temperatureData = [26.8, 25.5, 24.8, 27.3, 30.2, 31.5, 29.8, 28.5];
        const humidityData = [70, 75, 78, 65, 58, 55, 62, 65];
        const phData = [6.0, 6.1, 6.0, 6.2, 6.3, 6.2, 6.2, 6.2];
        
        // Grafik Lingkungan
        const envCtx = document.getElementById('environmentChart').getContext('2d');
        const environmentChart = new Chart(envCtx, {
            type: 'line',
            data: {
                labels: timeLabels,
                datasets: [
                    {
                        label: 'Suhu (°C)',
                        data: temperatureData,
                        borderColor: 'rgb(220, 53, 69)',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgb(220, 53, 69)',
                        pointBorderColor: '#fff',
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Kelembaban (%)',
                        data: humidityData,
                        borderColor: 'rgb(23, 162, 184)',
                        backgroundColor: 'rgba(23, 162, 184, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgb(23, 162, 184)',
                        pointBorderColor: '#fff',
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'pH Air',
                        data: phData,
                        borderColor: 'rgb(102, 16, 242)',
                        backgroundColor: 'rgba(102, 16, 242, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgb(102, 16, 242)',
                        pointBorderColor: '#fff',
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Parameter Lingkungan Hari Ini',
                        font: {
                            size: 16,
                            weight: '600'
                        },
                        padding: {
                            bottom: 20
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(0, 0, 0, 0.7)',
                        padding: 15,
                        cornerRadius: 10,
                        titleFont: {
                            size: 14,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 14
                        }
                    },
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                size: 13
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        suggestedMin: 20,
                        suggestedMax: 80,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            padding: 10
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            padding: 10
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
        
        // Data untuk grafik pertumbuhan
        const days = ['Hari 1', 'Hari 5', 'Hari 10', 'Hari 15', 'Hari 20', 'Hari 25', 'Hari 30'];
        const heightData = [5, 8, 12, 18, 25, 32, 38];
        
        // Grafik Pertumbuhan
        const growthCtx = document.getElementById('growthChart').getContext('2d');
        const growthChart = new Chart(growthCtx, {
            type: 'bar',
            data: {
                labels: days,
                datasets: [{
                    label: 'Tinggi Tanaman (cm)',
                    data: heightData,
                    backgroundColor: 'rgba(44, 156, 91, 0.7)',
                    borderColor: 'rgba(44, 156, 91, 1)',
                    borderWidth: 1,
                    borderRadius: 5,
                    hoverBackgroundColor: 'rgba(44, 156, 91, 0.9)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Pertumbuhan Tinggi Tanaman Cabe',
                        font: {
                            size: 16,
                            weight: '600'
                        },
                        padding: {
                            bottom: 20
                        }
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Tinggi (cm)',
                            font: {
                                weight: '600'
                            }
                        },
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            padding: 10
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            padding: 10
                        }
                    }
                }
            }
        });
        
        // Tombol periode grafik
        const periodButtons = document.querySelectorAll('[data-period]');
        periodButtons.forEach(button => {
            button.addEventListener('click', function() {
                periodButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                // Di sini bisa ditambahkan logika untuk mengubah data grafik berdasarkan periode
            });
        });
        
        // Interaksi kontrol button
        const controlButtons = document.querySelectorAll('.control-btn');
        controlButtons.forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active');
                
                // Toggle icon on/off state
                const icon = this.querySelector('i');
                if (this.classList.contains('active')) {
                    if (icon.classList.contains('fa-play')) {
                        icon.classList.replace('fa-play', 'fa-pause');
                    } else if (icon.classList.contains('fa-lightbulb')) {
                        icon.classList.replace('fa-lightbulb', 'fa-lightbulb-on');
                    }
                    this.style.borderColor = 'var(--primary)';
                    this.style.boxShadow = '0 5px 15px rgba(44, 156, 91, 0.2)';
                } else {
                    if (icon.classList.contains('fa-pause')) {
                        icon.classList.replace('fa-pause', 'fa-play');
                    } else if (icon.classList.contains('fa-lightbulb-on')) {
                        icon.classList.replace('fa-lightbulb-on', 'fa-lightbulb');
                    }
                    this.style.borderColor = '#e2e8f0';
                    this.style.boxShadow = 'none';
                }
            });
        });
        
        // Fungsi untuk menghasilkan data dummy acak
        function generateDummyData() {
            return {
                temperature: (Math.random() * 5 + 24).toFixed(1), // 24.0 - 29.0
                humidity: Math.floor(Math.random() * 30 + 50),     // 50% - 80%
                ph: (Math.random() * 1.2 + 5.7).toFixed(1),       // 5.7 - 6.9
                nutrient: Math.floor(Math.random() * 20 + 70),     // 70% - 90%
                timestamp: new Date().toLocaleTimeString('id-ID')
            };
        }
        
        // Fungsi untuk mengupdate UI dengan data baru
        function updateUI(data) {
            // Update nilai statistik
            document.querySelector('[data-stat="temperature"]').textContent = data.temperature + '°C';
            document.querySelector('[data-stat="humidity"]').textContent = data.humidity + '%';
            document.querySelector('[data-stat="ph"]').textContent = data.ph;
            document.querySelector('[data-stat="nutrient"]').textContent = data.nutrient + '%';
            
            // Update progress bar nutrisi
            document.querySelector('[data-progress="nutrient"]').style.width = data.nutrient + '%';
            
            // Update trend indicators
            updateTrendIndicators(data);
            
            // Update value markers
            updateValueMarkers(data);
            
            // Update tabel data historis
            updateHistoricalData(data);
            
            // Animasikan perubahan
            animateChanges();
        }
        
        // Fungsi untuk mengupdate indikator tren
        function updateTrendIndicators(data) {
            // Suhu
            const tempTrend = document.getElementById('temperature-trend');
            const tempValue = parseFloat(data.temperature);
            
            if (tempValue > 28) {
                tempTrend.className = 'stat-trend bg-danger bg-opacity-10 text-danger';
                tempTrend.innerHTML = '<i class="fas fa-arrow-up"></i> Tinggi';
            } else if (tempValue < 26) {
                tempTrend.className = 'stat-trend bg-info bg-opacity-10 text-info';
                tempTrend.innerHTML = '<i class="fas fa-arrow-down"></i> Rendah';
            } else {
                tempTrend.className = 'stat-trend bg-success bg-opacity-10 text-success';
                tempTrend.innerHTML = '<i class="fas fa-check-circle"></i> Normal';
            }
            
            // Kelembaban
            const humidityTrend = document.getElementById('humidity-trend');
            const humidityValue = parseInt(data.humidity);
            
            if (humidityValue > 75) {
                humidityTrend.className = 'stat-trend bg-danger bg-opacity-10 text-danger';
                humidityTrend.innerHTML = '<i class="fas fa-arrow-up"></i> Tinggi';
            } else if (humidityValue < 60) {
                humidityTrend.className = 'stat-trend bg-info bg-opacity-10 text-info';
                humidityTrend.innerHTML = '<i class="fas fa-arrow-down"></i> Rendah';
            } else {
                humidityTrend.className = 'stat-trend bg-success bg-opacity-10 text-success';
                humidityTrend.innerHTML = '<i class="fas fa-check-circle"></i> Normal';
            }
            
            // pH
            const phTrend = document.getElementById('ph-trend');
            const phValue = parseFloat(data.ph);
            
            if (phValue > 6.5) {
                phTrend.className = 'stat-trend bg-danger bg-opacity-10 text-danger';
                phTrend.innerHTML = '<i class="fas fa-exclamation-circle"></i> Tinggi';
            } else if (phValue < 5.8) {
                phTrend.className = 'stat-trend bg-warning bg-opacity-10 text-warning';
                phTrend.innerHTML = '<i class="fas fa-exclamation-circle"></i> Rendah';
            } else {
                phTrend.className = 'stat-trend bg-success bg-opacity-10 text-success';
                phTrend.innerHTML = '<i class="fas fa-check-circle"></i> Normal';
            }
            
            // Nutrisi
            const nutrientTrend = document.getElementById('nutrient-trend');
            const nutrientValue = parseInt(data.nutrient);
            
            if (nutrientValue < 75) {
                nutrientTrend.className = 'stat-trend bg-warning bg-opacity-10 text-warning';
                nutrientTrend.innerHTML = '<i class="fas fa-exclamation-circle"></i> Rendah';
            } else if (nutrientValue > 85) {
                nutrientTrend.className = 'stat-trend bg-info bg-opacity-10 text-info';
                nutrientTrend.innerHTML = '<i class="fas fa-check-circle"></i> Tinggi';
            } else {
                nutrientTrend.className = 'stat-trend bg-success bg-opacity-10 text-success';
                nutrientTrend.innerHTML = '<i class="fas fa-check-circle"></i> Normal';
            }
        }
        
        // Fungsi untuk mengupdate posisi marker pada value indicator
        function updateValueMarkers(data) {
            // Suhu (20-30°C)
            const tempMarker = document.getElementById('temperature-marker');
            const tempValue = parseFloat(data.temperature);
            const tempPosition = ((tempValue - 20) / 10) * 100;
            tempMarker.style.left = Math.min(Math.max(tempPosition, 0), 100) + '%';
            
            // Warna marker suhu
            if (tempValue > 28) {
                tempMarker.style.backgroundColor = 'var(--danger)';
            } else if (tempValue < 26) {
                tempMarker.style.backgroundColor = 'var(--info)';
            } else {
                tempMarker.style.backgroundColor = 'var(--success)';
            }
            
            // Kelembaban (50-80%)
            const humidityMarker = document.getElementById('humidity-marker');
            const humidityValue = parseInt(data.humidity);
            const humidityPosition = ((humidityValue - 50) / 30) * 100;
            humidityMarker.style.left = Math.min(Math.max(humidityPosition, 0), 100) + '%';
            
            // Warna marker kelembaban
            if (humidityValue > 75) {
                humidityMarker.style.backgroundColor = 'var(--danger)';
            } else if (humidityValue < 60) {
                humidityMarker.style.backgroundColor = 'var(--info)';
            } else {
                humidityMarker.style.backgroundColor = 'var(--success)';
            }
            
            // pH (5.5-7.0)
            const phMarker = document.getElementById('ph-marker');
            const phValue = parseFloat(data.ph);
            const phPosition = ((phValue - 5.5) / 1.5) * 100;
            phMarker.style.left = Math.min(Math.max(phPosition, 0), 100) + '%';
            
            // Warna marker pH
            if (phValue > 6.5 || phValue < 5.8) {
                phMarker.style.backgroundColor = 'var(--danger)';
            } else {
                phMarker.style.backgroundColor = 'var(--success)';
            }
            
            // Progress bar nutrisi
            const nutrientProgress = document.getElementById('nutrient-progress');
            const nutrientValue = parseInt(data.nutrient);
            
            // Warna progress bar nutrisi
            if (nutrientValue < 75) {
                nutrientProgress.className = 'progress-bar bg-warning';
            } else if (nutrientValue > 85) {
                nutrientProgress.className = 'progress-bar bg-info';
            } else {
                nutrientProgress.className = 'progress-bar bg-success';
            }
        }
        
        // Fungsi untuk mengupdate data historis
        function updateHistoricalData(data) {
            const tbody = document.getElementById('historical-data-body');
            const now = new Date();
            const dateTime = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            
            // Tentukan status berdasarkan data
            let statusClass, statusText;
            const phValue = parseFloat(data.ph);
            const tempValue = parseFloat(data.temperature);
            const humidityValue = parseInt(data.humidity);
            
            if (phValue > 6.5 || phValue < 5.8 || tempValue > 28 || tempValue < 26 || humidityValue > 75 || humidityValue < 60) {
                statusClass = 'bg-warning text-dark';
                statusText = 'Perhatian';
            } else {
                statusClass = 'bg-success';
                statusText = 'Normal';
            }
            
            // Tambahkan baris baru di atas
            const newRow = `
                <tr class="highlight">
                    <td>${dateTime}</td>
                    <td>${data.temperature}°C</td>
                    <td>${data.humidity}%</td>
                    <td>${data.ph}</td>
                    <td>${data.nutrient}%</td>
                    <td><span class="badge ${statusClass}">${statusText}</span></td>
                </tr>
            `;
            
            // Tambahkan baris baru dan hapus baris terakhir jika sudah lebih dari 5 baris
            tbody.innerHTML = newRow + tbody.innerHTML;
            if (tbody.children.length > 5) {
                tbody.removeChild(tbody.lastChild);
            }
        }
        
        // Fungsi untuk animasi perubahan
        function animateChanges() {
            // Animasi pulse pada card
            const cards = document.querySelectorAll('.stat-card');
            cards.forEach(card => {
                card.classList.add('pulse');
                setTimeout(() => card.classList.remove('pulse'), 1000);
            });
            
            // Animasi highlight pada baris tabel baru
            const newRow = document.querySelector('#historical-data-body tr');
            newRow.classList.add('highlight');
            setTimeout(() => newRow.classList.remove('highlight'), 1000);
        }
        
        // Update data setiap detik
        setInterval(() => {
            const newData = generateDummyData();
            updateUI(newData);
        }, 1000);
        
        // Inisialisasi data pertama
        const initialData = generateDummyData();
        updateUI(initialData);
    });
</script>
@endsection