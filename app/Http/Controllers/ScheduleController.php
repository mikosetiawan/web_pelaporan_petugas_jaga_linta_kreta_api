<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Crossing;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with(['crossing', 'user'])
            ->orderBy('date')
            ->orderBy('start_time')
            ->paginate(10);

        return view('schedules.index', compact('schedules'));
    }

    public function create()
    {
        $crossings = Crossing::all();
        $users = User::where('role', 'petugas')->get();
        
        return view('schedules.create', compact('crossings', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'crossing_id' => 'required|exists:crossings,id',
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'shift' => 'required|in:pagi,sore,malam',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        Schedule::create($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function show(Schedule $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        $crossings = Crossing::all();
        $users = User::where('role', 'petugas')->get();
        
        return view('schedules.edit', compact('schedule', 'crossings', 'users'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'crossing_id' => 'required|exists:crossings,id',
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'shift' => 'required|in:pagi,sore,malam',
            'status' => 'sometimes|in:aktif,nonaktif'
        ]);

        $schedule->update($validated);

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil diperbarui');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index')
            ->with('success', 'Jadwal berhasil dihapus');
    }
}