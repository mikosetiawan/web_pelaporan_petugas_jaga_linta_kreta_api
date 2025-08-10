<?php

// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Report;
use App\Models\Crossing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Jika pengguna adalah petugas, hanya ambil laporan milik mereka
        // Jika korlap atau admin, ambil semua laporan
        $reports = $user->role === 'petugas'
            ? $user->reports()->latest()->get()
            : Report::latest()->get();

        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $user = Auth::user();

        // Hanya petugas yang boleh membuat laporan
        if ($user->role !== 'petugas') {
            return redirect()->route('dashboard')->with('error', 'Hanya petugas yang dapat membuat laporan.');
        }

        $attendance = $user->attendances()->whereDate('created_at', today())->first();
        $crossing = $attendance?->schedule?->crossing;

        if (!$attendance || !$crossing) {
            return view('reports.create')->with('error', 'Anda harus melakukan check-in terlebih dahulu sebelum membuat laporan.');
        }

        return view('reports.create', compact('attendance', 'crossing'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Hanya petugas yang boleh menyimpan laporan
        if ($user->role !== 'petugas') {
            return redirect()->route('dashboard')->with('error', 'Hanya petugas yang dapat membuat laporan.');
        }

        $request->validate([
            'attendance_id' => 'required|exists:attendances,id',
            'crossing_id' => 'required|exists:crossings,id',
            'type' => 'required|in:routine,incident',
            'content' => 'required|string|max:65535',
            'equipment_checklist' => 'nullable|array',
            'equipment_checklist.*' => 'exists:equipment,id',
            'incident_details' => 'nullable|array',
            'incident_details.time' => 'nullable|date_format:H:i',
            'incident_details.type' => 'nullable|string|max:255',
            'incident_details.description' => 'nullable|string|max:65535',
        ]);

        try {
            Report::create([
                'user_id' => Auth::id(),
                'crossing_id' => $request->crossing_id,
                'attendance_id' => $request->attendance_id,
                'type' => $request->type,
                'content' => $request->content,
                'equipment_checklist' => $request->equipment_checklist ?? [],
                'incident_details' => $request->incident_details ?? [],
                'status' => 'submitted',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('reports.index')
                ->with('success', 'Laporan berhasil dibuat');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal membuat laporan: ' . $e->getMessage());
        }
    }

    public function show(Report $report)
    {

        return view('reports.show', compact('report'));
    }

    public function showValidation(Report $report)
    {

        return view('reports.validate', compact('report'));
    }

    public function validateReport(Request $request, Report $report)
    {
        // Only allow korlap or admin to validate
        $user = Auth::user();
        if (!in_array($user->role, ['korlap', 'admin'])) {
            return redirect()->route('dashboard')->with('error', 'Hanya korlap atau admin yang dapat memvalidasi laporan.');
        }

        $request->validate([
            'validation_notes' => 'required|string|max:65535',
            'status' => 'required|in:validated,rejected', // Match database enum
        ]);

        try {
            $report->update([
                'validated_at' => now(),
                'validated_by' => Auth::id(),
                'validation_notes' => $request->validation_notes,
                'status' => $request->status,
            ]);

            return redirect()->route('reports.index') // Changed to reports.index for better UX
                ->with('success', 'Laporan berhasil divalidasi');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memvalidasi laporan: ' . $e->getMessage());
        }
    }
    

    public function edit(Report $report)
    {

        if ($report->status !== 'draft') {
            return redirect()->route('reports.index')->with('error', 'Hanya laporan dengan status draf yang dapat diedit.');
        }

        $attendance = $report->attendance;
        $crossing = $report->crossing;

        return view('reports.edit', compact('report', 'attendance', 'crossing'));
    }

    public function update(Request $request, Report $report)
    {


        if ($report->status !== 'draft') {
            return redirect()->route('reports.index')->with('error', 'Hanya laporan dengan status draf yang dapat diedit.');
        }

        $request->validate([
            'type' => 'required|in:routine,incident',
            'content' => 'required|string|max:65535',
            'equipment_checklist' => 'nullable|array',
            'equipment_checklist.*' => 'exists:equipment,id',
            'incident_details' => 'nullable|array',
            'incident_details.time' => 'nullable|date_format:H:i',
            'incident_details.type' => 'nullable|string|max:255',
            'incident_details.description' => 'nullable|string|max:65535',
        ]);

        try {
            $report->update([
                'type' => $request->type,
                'content' => $request->content,
                'equipment_checklist' => $request->equipment_checklist ?? [],
                'incident_details' => $request->incident_details ?? [],
                'status' => 'draft',
                'updated_at' => now(),
            ]);

            return redirect()->route('reports.index')->with('success', 'Laporan berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui laporan: ' . $e->getMessage());
        }
    }

    public function destroy(Report $report)
    {


        if ($report->status !== 'draft') {
            return redirect()->route('reports.index')->with('error', 'Hanya laporan dengan status draf yang dapat dihapus.');
        }

        try {
            $report->delete();
            return redirect()->route('reports.index')->with('success', 'Laporan berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus laporan: ' . $e->getMessage());
        }
    }
}