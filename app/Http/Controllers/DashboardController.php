<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Crossing;
use App\Models\Attendance;
use App\Models\Equipment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Get data for charts
        $statusData = [
            'normal' => Report::where('status', 'normal')->count(),
            'gangguan' => Report::where('status', 'gangguan')->count(),
            'darurat' => Report::where('status', 'darurat')->count()
        ];

        $reportsTrend = $this->getReportsTrendData();
        $equipmentStatus = $this->getEquipmentStatusData();

        return view('dashboard', compact('statusData', 'reportsTrend', 'equipmentStatus'));
    }

    private function getReportsTrendData()
    {
        // This would typically query your database for the last 7 days of reports
        // For now, we'll return sample data
        return [
            'labels' => ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            'normal' => [12, 19, 15, 17, 14, 13, 10],
            'gangguan' => [3, 2, 4, 1, 2, 1, 2],
            'darurat' => [1, 0, 2, 1, 0, 1, 0]
        ];
    }

    private function getEquipmentStatusData()
    {
        // This would typically query your equipment status per crossing
        // For now, we'll return sample data
        return [
            'labels' => ['JPL Cilegon', 'JPL Anyer', 'JPL Serang'],
            'baik' => [15, 12, 10],
            'perlu_perbaikan' => [2, 3, 5],
            'rusak' => [1, 0, 2]
        ];
    }
}