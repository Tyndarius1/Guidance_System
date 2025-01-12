<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'counselor_id',
        'student_id',
        'session_date',
        'course',
        'guidance_type',
        'session_notes',
    ];

        // Cast session_date to Carbon instance
        protected $casts = [
            'session_date' => 'datetime',
        ];
    public function counselor()
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }

   
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
