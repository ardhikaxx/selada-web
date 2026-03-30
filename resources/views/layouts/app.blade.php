<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SmartHydro - Dashboard IoT Hidroponik')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2c9c5b;
            --primary-dark: #1d7a46;
            --primary-light: #e8f5ee;
            --secondary: #6c757d;
            --accent: #ff7e29;
            --accent-light: #fff2e8;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --success: #28a745;
            --dark: #343a40;
            --light: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, var(--primary), #34c477);
            --gradient-accent: linear-gradient(135deg, var(--accent), #ff9b55);
            --card-shadow: 0 10px 30px rgba(0,0,0,0.08);
            --card-shadow-hover: 0 15px 35px rgba(0,0,0,0.12);
            --text-primary: #2d3748;
            --text-secondary: #718096;
            --border-radius: 16px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: #f5f7f9;
            color: var(--text-primary);
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        .dashboard-header {
            background: var(--gradient-primary);
            color: white;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .card {
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            border: none;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--card-shadow-hover);
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-weight: 600;
            padding: 1.2rem 1.5rem;
            border-radius: var(--border-radius) var(--border-radius) 0 0 !important;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .stat-card {
            text-align: center;
            padding: 1.8rem 1.5rem;
            position: relative;
        }
        
        .stat-icon {
            font-size: 2.8rem;
            margin-bottom: 1.2rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
            line-height: 1;
        }
        
        .stat-value {
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-primary);
        }
        
        .stat-label {
            color: var(--text-secondary);
            font-size: 0.95rem;
            font-weight: 500;
        }
        
        .stat-trend {
            position: absolute;
            top: 1.2rem;
            right: 1.2rem;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 0.25rem 0.6rem;
            border-radius: 50px;
        }
        
        .chart-container {
            position: relative;
            height: 320px;
            width: 100%;
        }
        
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
        }
        
        .btn-primary {
            background: var(--gradient-primary);
            border: none;
            font-weight: 500;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 156, 91, 0.3);
        }
        
        .btn-outline-primary {
            border-color: var(--primary);
            color: var(--primary);
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background: var(--gradient-primary);
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 156, 91, 0.2);
        }
        
        .alert-custom {
            border-left: 4px solid var(--accent);
            border-radius: 10px;
            padding: 1.2rem;
            background-color: white;
            margin-bottom: 1rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        
        .progress {
            height: 12px;
            border-radius: 10px;
            background-color: #e9ecef;
            overflow: hidden;
        }
        
        .progress-bar {
            border-radius: 10px;
        }
        
        .device-status {
            display: inline-block;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            margin-right: 10px;
        }
        
        .online {
            background-color: var(--success);
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
        }
        
        .offline {
            background-color: var(--danger);
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2);
        }
        
        .control-btn {
            padding: 0.8rem;
            border-radius: 12px;
            text-align: center;
            background: white;
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .control-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            border-color: var(--primary);
        }
        
        .control-btn i {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .notification-item {
            padding: 1.2rem;
            border-left: 4px solid;
            border-radius: 8px;
            margin-bottom: 1rem;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .notification-item:hover {
            transform: translateX(5px);
        }
        
        .notification-warning {
            border-left-color: var(--warning);
            background: linear-gradient(to right, rgba(255, 193, 07, 0.05), white);
        }
        
        .notification-info {
            border-left-color: var(--info);
            background: linear-gradient(to right, rgba(23, 162, 184, 0.05), white);
        }
        
        .notification-success {
            border-left-color: var(--success);
            background: linear-gradient(to right, rgba(40, 167, 69, 0.05), white);
        }
        
        .period-selector {
            background: var(--primary-light);
            border-radius: 50px;
            padding: 0.3rem;
            display: inline-flex;
        }
        
        .period-btn {
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 500;
            border: none;
            background: transparent;
            color: var(--text-secondary);
            transition: all 0.3s ease;
        }
        
        .period-btn.active {
            background: var(--primary);
            color: white;
        }
        
        .value-indicator {
            height: 6px;
            width: 100%;
            background: #e2e8f0;
            border-radius: 3px;
            position: relative;
            margin-top: 0.5rem;
        }
        
        .value-range {
            position: absolute;
            height: 100%;
            border-radius: 3px;
        }
        
        .value-marker {
            position: absolute;
            top: -3px;
            width: 52px;
            height: 12px;
            border-radius: 10%;
            background: var(--primary);
            transform: translateX(-50%);
            transition: all 0.5s ease;
        }
        
        .gauge-container {
            position: relative;
            width: 100%;
            height: 180px;
            margin: 0 auto;
        }
        
        .floating-card {
            position: relative;
            overflow: hidden;
        }
        
        .floating-card::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: var(--primary-light);
            z-index: 0;
        }
        
        .floating-card::after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: var(--accent-light);
            z-index: 0;
        }
        
        .floating-card > * {
            position: relative;
            z-index: 1;
        }
        
        /* Animations */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        @keyframes highlight {
            0% { background-color: transparent; }
            50% { background-color: rgba(44, 156, 91, 0.1); }
            100% { background-color: transparent; }
        }
        
        .highlight {
            animation: highlight 1s ease;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .stat-value {
                font-size: 2rem;
            }
            
            .chart-container {
                height: 250px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="mb-2"><i class="fas fa-seedling me-2"></i>SmartHydro</h1>
                    <p class="mb-0 opacity-75">Sistem IoT Monitoring Cabe Hidroponik</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="badge bg-light text-dark fs-6 p-2 rounded-pill">
                        <i class="fas fa-sync-alt me-1"></i> Terakhir diperbarui: <span id="last-update">...</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <main class="container">
        @yield('content')
    </main>

    <!-- Bootstrap & Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        // Update waktu terakhir refresh
        function updateLastRefreshTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('last-update').textContent = now.toLocaleDateString('id-ID', options);
        }
        
        // Update waktu setiap detik
        updateLastRefreshTime();
        setInterval(updateLastRefreshTime, 1000);
        
        // Simulasi data real-time
        function simulateRealTimeData() {
            // Update stat cards dengan data acak
            document.querySelector('[data-stat="temperature"]').textContent = (Math.random() * 5 + 25).toFixed(1) + '°C';
            document.querySelector('[data-stat="humidity"]').textContent = Math.floor(Math.random() * 20 + 60) + '%';
            document.querySelector('[data-stat="ph"]').textContent = (Math.random() * 0.6 + 5.9).toFixed(1);
            document.querySelector('[data-stat="nutrient"]').textContent = Math.floor(Math.random() * 10 + 70) + '%';
            
            // Update progress bar
            document.querySelector('[data-progress="nutrient"]').style.width = document.querySelector('[data-stat="nutrient"]').textContent;
            
            // Animate update
            const cards = document.querySelectorAll('.stat-card');
            cards.forEach(card => {
                card.classList.add('pulse');
                setTimeout(() => card.classList.remove('pulse'), 1000);
            });
        }
        
        // Update data setiap 30 detik
        setInterval(simulateRealTimeData, 30000);
    </script>
    
    @yield('scripts')
</body>
</html>