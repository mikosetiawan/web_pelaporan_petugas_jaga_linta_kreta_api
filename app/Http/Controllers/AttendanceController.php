<?php 

// app/Http/Controllers/AttendanceController.php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $todaySchedule = Schedule::where('user_id', $user->id)
            ->whereDate('date', today())
            ->first();

        $attendance = $todaySchedule ? $todaySchedule->attendance : null;

        return view('attendance.index', compact('todaySchedule', 'attendance'));
    }

    public function checkIn(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'check_in_location' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $attendance = Attendance::create([
            'user_id' => Auth::id(),
            'schedule_id' => $request->schedule_id,
            'check_in' => now(),
            'check_in_location' => $request->check_in_location,
            'status' => 'checked_in',
            'notes' => $request->notes
        ]);

        return redirect()->route('attendance.index')
            ->with('success', 'Check-in berhasil dicatat');
    }

    public function checkOut(Request $request)
    {
        $request->validate([
            'attendance_id' => 'required|exists:attendances,id',
            'check_out_location' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $attendance = Attendance::find($request->attendance_id);
        $attendance->update([
            'check_out' => now(),
            'check_out_location' => $request->check_out_location,
            'status' => 'checked_out',
            'notes' => $request->notes
        ]);

        return redirect()->route('attendance.index')
            ->with('success', 'Check-out berhasil dicatat');
    }
}