<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relasi dengan jadwal penjagaan
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // Relasi dengan kehadiran
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // Relasi dengan laporan yang dibuat
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Relasi dengan laporan yang divalidasi (untuk korlap)
    public function validatedReports()
    {
        return $this->hasMany(Report::class, 'validated_by');
    }

    // Scope untuk filter role
    public function scopePetugas($query)
    {
        return $query->where('role', 'petugas');
    }
}