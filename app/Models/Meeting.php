<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'meeting_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'meeting_date' => 'date',
    ];

    // This is the connection!
    public function students()
    {
        return $this->belongsToMany(Student::class)
            ->withPivot(['attended', 'grades_submitted', 'letter_submitted']) // The 3 Checkboxes
            ->withTimestamps();
    }

    protected static function booted()
    {
        static::created(function ($meeting) {
            // 1. Get all student IDs
            $studentIds = \App\Models\Student::pluck('id');

            // 2. Attach them all to this new meeting
            $meeting->students()->attach($studentIds);
        });
    }
}