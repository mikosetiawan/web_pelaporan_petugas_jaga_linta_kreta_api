<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'crossing_id',
        'user_id',
        'date',
        'start_time',
        'end_time',
        'shift',
        'status'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    // Relasi dengan lintasan
    public function crossing()
    {
        return $this->belongsTo(Crossing::class);
    }

    // Relasi dengan petugas
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan kehadiran
    public function attendance()
    {
        return $this->hasOne(Attendance::class);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('date', now()->toDateString());
    }

}