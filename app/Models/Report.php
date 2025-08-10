<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'crossing_id', 'attendance_id',
        'type', 'content', 'equipment_checklist',
        'incident_details', 'status', 'validated_at',
        'validated_by', 'validation_notes'
    ];

    protected $casts = [
        'equipment_checklist' => 'array',
        'incident_details' => 'array',
        'validated_at' => 'datetime',
    ];

    // Relasi dengan petugas pembuat laporan
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan lintasan
    public function crossing()
    {
        return $this->belongsTo(Crossing::class);
    }

    // Relasi dengan kehadiran
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }

    // Relasi dengan validator (korlap)
    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }

    // Scope untuk laporan hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    // Scope untuk laporan insiden
    public function scopeIncidents($query)
    {
        return $query->where('type', 'incident');
    }
}