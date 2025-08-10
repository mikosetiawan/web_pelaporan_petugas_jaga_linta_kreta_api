<?php

namespace App\Http\Controllers;

use App\Models\Crossing;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EquipmentController extends Controller
{
   public function check()
    {
        $user = Auth::user();
        $crossing = $user->schedules()->today()->first()?->crossing;
        $equipment = $crossing ? $crossing->equipment()->get() : collect();

        return view('equipment.check', compact('crossing', 'equipment'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'equipment' => 'required|array',
            'equipment.*.id' => 'required|exists:equipment,id',
            'equipment.*.condition' => 'required|in:baik,rusak_ringan,rusak_berat',
            'notes' => 'nullable|string|max:1000',
        ], [
            'equipment.*.condition.in' => 'Kondisi harus salah satu dari: baik, rusak_ringan, rusak_berat.',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->equipment as $item) {
                $equipment = Equipment::findOrFail($item['id']);
                $equipment->update([
                    'condition' => $item['condition'],
                    'notes' => $request->notes,
                ]);
            }

            DB::commit();

            return redirect()->route('dashboard')
                ->with('success', 'Pemeriksaan perlengkapan berhasil dicatat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Equipment verification failed: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan pemeriksaan. Silakan coba lagi.')
                ->withInput();
        }
    }
}