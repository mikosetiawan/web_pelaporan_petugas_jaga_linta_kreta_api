<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'schedule_id', 'check_in',
        'check_out', 'check_in_location',
        'check_out_location', 'status', 'notes'
    ];

    protected $casts = [
        'check_in' => 'datetime',
        'check_out' => 'datetime',
    ];

    // Relasi dengan petugas
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan jadwal
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    // Relasi dengan laporan
    public function report()
    {
        return $this->hasOne(Report::class);
    }

    // Scope untuk kehadiran hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }
}