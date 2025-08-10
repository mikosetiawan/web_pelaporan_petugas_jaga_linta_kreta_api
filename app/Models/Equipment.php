<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'quantity', 'condition', 'crossing_id', 'notes'
    ];

    public function crossing()
    {
        return $this->belongsTo(Crossing::class);
    }
}