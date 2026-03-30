<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard monitoring IoT untuk cabe hidroponik
     */
    public function index()
    {
        // Data dummy untuk ditampilkan di dashboard
        $sensorData = [
            'temperature' => 28.5,
            'humidity' => 65,
            'ph' => 6.2,
            'nutrient_level' => 78,
            'water_temperature' => 26.0,
            'light_intensity' => 8500,
            'pump_status' => 'offline',
            'last_update' => now()->format('Y-m-d H:i:s')
        ];
        
        $notifications = [
            [
                'type' => 'warning',
                'title' => 'Peringatan pH Air',
                'message' => 'Level pH air diluar batas normal (6.2). Segera lakukan penyesuaian.',
                'time' => '10 menit lalu'
            ],
            [
                'type' => 'info',
                'title' => 'Informasi Perangkat',
                'message' => 'Pompa sirkulasi nutrisi tidak aktif. Periksa koneksi daya.',
                'time' => '1 jam lalu'
            ],
            [
                'type' => 'success',
                'title' => 'Operasi Berhasil',
                'message' => 'Penambahan nutrisi otomatis telah berhasil dilakukan.',
                'time' => '3 jam lalu'
            ]
        ];
        
        $devices = [
            ['name' => 'Controller Utama', 'status' => 'online'],
            ['name' => 'Sensor Suhu & Kelembaban', 'status' => 'online'],
            ['name' => 'Sensor pH & Nutrisi', 'status' => 'online'],
            ['name' => 'Pompa Sirkulasi', 'status' => 'offline']
        ];
        
        $historicalData = [
            [
                'datetime' => '23 Agustus 2023, 14:30',
                'temperature' => 28.5,
                'humidity' => 65,
                'ph' => 6.2,
                'nutrient' => 78,
                'status' => 'warning'
            ],
            [
                'datetime' => '23 Agustus 2023, 12:15',
                'temperature' => 27.8,
                'humidity' => 67,
                'ph' => 6.0,
                'nutrient' => 80,
                'status' => 'success'
            ],
            [
                'datetime' => '23 Agustus 2023, 10:00',
                'temperature' => 26.2,
                'humidity' => 70,
                'ph' => 5.9,
                'nutrient' => 82,
                'status' => 'success'
            ],
            [
                'datetime' => '23 Agustus 2023, 08:45',
                'temperature' => 25.5,
                'humidity' => 72,
                'ph' => 5.9,
                'nutrient' => 85,
                'status' => 'success'
            ],
            [
                'datetime' => '23 Agustus 2023, 06:30',
                'temperature' => 24.8,
                'humidity' => 75,
                'ph' => 5.8,
                'nutrient' => 87,
                'status' => 'success'
            ]
        ];
        
        return view('dashboard', compact('sensorData', 'notifications', 'devices', 'historicalData'));
    }
    
    /**
     * Mengambil data sensor terbaru (API endpoint untuk AJAX)
     */
    public function getSensorData()
    {
        // Data dummy yang akan diambil via AJAX untuk update real-time
        $data = [
            'temperature' => round(24 + (rand(0, 100) / 20), 1), // 24.0 - 29.0
            'humidity' => rand(50, 80), // 50% - 80%
            'ph' => round(5.8 + (rand(0, 80) / 100), 1), // 5.8 - 6.6
            'nutrient_level' => rand(70, 90), // 70% - 90%
            'timestamp' => now()->format('H:i:s')
        ];
        
        return response()->json($data);
    }
    
    /**
     * Mengirim perintah ke perangkat IoT
     */
    public function sendCommand(Request $request)
    {
        $validated = $request->validate([
            'device' => 'required|string',
            'command' => 'required|string',
            'value' => 'nullable|numeric'
        ]);
        
        // Simulasi pengiriman perintah ke perangkat IoT
        // Di aplikasi nyata, ini akan mengirim perintah ke perangkat IoT melalui MQTT/HTTP
        
        return response()->json([
            'status' => 'success',
            'message' => 'Perintah berhasil dikirim ke perangkat',
            'device' => $validated['device'],
            'command' => $validated['command'],
            'value' => $validated['value'] ?? null
        ]);
    }
}