<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Crossing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code', 'name', 'location', 'status', 
        'latitude', 'longitude', 'description'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeWithTodaySchedule($query, $userId)
    {
        return $query->whereHas('schedules', function ($query) use ($userId) {
            $query->where('user_id', $userId)
                  ->whereDate('date', today());
        });
    }
}