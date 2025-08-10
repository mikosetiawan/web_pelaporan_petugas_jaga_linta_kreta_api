<x-app-layout title="My Dashboard">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Data Visualization Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Dashboard Overview</h2>

                <!-- Status Distribution Chart -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Status Distribution (Last 7 Days)</h3>
                    <div class="h-64">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>

                <!-- Reports Trend Chart -->
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Reports Trend</h3>
                    <div class="h-64">
                        <canvas id="reportsTrendChart"></canvas>
                    </div>
                </div>

                <!-- Equipment Status -->
                <div>
                    <h3 class="text-lg font-medium text-gray-700 mb-4">Equipment Status</h3>
                    <div class="h-64">
                        <canvas id="equipmentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- Status Terkini -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Status Penjagaan Terkini</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-800">JPL Cilegon KM 5+200</p>
                            <p class="text-sm text-gray-600">Ahmad Sutanto</p>
                        </div>
                        <span class="bg-green-500 w-3 h-3 rounded-full"></span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-800">JPL Anyer KM 12+500</p>
                            <p class="text-sm text-gray-600">Budi Setiawan</p>
                        </div>
                        <span class="bg-green-500 w-3 h-3 rounded-full"></span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-800">JPL Serang KM 8+100</p>
                            <p class="text-sm text-gray-600">Menunggu petugas</p>
                        </div>
                        <span class="bg-yellow-500 w-3 h-3 rounded-full"></span>
                    </div>
                </div>
            </div>

            <!-- Laporan Terbaru -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Laporan Terbaru</h3>
                <div class="space-y-3">
                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <p class="text-sm font-medium text-gray-800">Shift Pagi - Normal</p>
                        <p class="text-xs text-gray-600">Ahmad S. - 08:30</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 py-2">
                        <p class="text-sm font-medium text-gray-800">Kereta Lewat Lancar</p>
                        <p class="text-xs text-gray-600">Budi S. - 08:15</p>
                    </div>
                    <div class="border-l-4 border-yellow-500 pl-4 py-2">
                        <p class="text-sm font-medium text-gray-800">Cuaca Berawan</p>
                        <p class="text-xs text-gray-600">Citra D. - 07:45</p>
                    </div>
                </div>
            </div>

            <!-- Kontak Darurat -->
            <div class="bg-red-50 rounded-xl border border-red-200 p-6">
                <h3 class="text-lg font-bold text-red-800 mb-4">Kontak Darurat</h3>
                <div class="space-y-2 text-sm">
                    <p><strong>Dispatcher:</strong> (0254) 391-234</p>
                    <p><strong>Security:</strong> (0254) 391-235</p>
                    <p><strong>Medis:</strong> (0254) 391-236</p>
                    <p><strong>Pemadam:</strong> 113</p>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Status Distribution Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            const statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Normal', 'Gangguan', 'Darurat'],
                    datasets: [{
                        data: [65, 15, 20],
                        backgroundColor: [
                            '#10B981',
                            '#F59E0B',
                            '#EF4444'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    }
                }
            });

            // Reports Trend Chart
            const trendCtx = document.getElementById('reportsTrendChart').getContext('2d');
            const trendChart = new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                    datasets: [
                        {
                            label: 'Normal',
                            data: [12, 19, 15, 17, 14, 13, 10],
                            borderColor: '#10B981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Gangguan',
                            data: [3, 2, 4, 1, 2, 1, 2],
                            borderColor: '#F59E0B',
                            backgroundColor: 'rgba(245, 158, 11, 0.1)',
                            tension: 0.3,
                            fill: true
                        },
                        {
                            label: 'Darurat',
                            data: [1, 0, 2, 1, 0, 1, 0],
                            borderColor: '#EF4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            tension: 0.3,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Equipment Status Chart
            const equipmentCtx = document.getElementById('equipmentChart').getContext('2d');
            const equipmentChart = new Chart(equipmentCtx, {
                type: 'bar',
                data: {
                    labels: ['JPL Cilegon', 'JPL Anyer', 'JPL Serang'],
                    datasets: [
                        {
                            label: 'Baik',
                            data: [15, 12, 10],
                            backgroundColor: '#10B981'
                        },
                        {
                            label: 'Perlu Perbaikan',
                            data: [2, 3, 5],
                            backgroundColor: '#F59E0B'
                        },
                        {
                            label: 'Rusak',
                            data: [1, 0, 2],
                            backgroundColor: '#EF4444'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>