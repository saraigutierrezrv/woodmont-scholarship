<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Student extends Model
{
    use HasFactory;

    // Aquí le dices a Laravel qué campos puede guardar el formulario
    protected $fillable = [
        'full_name',
        'birth_date',
        'mobile_number',
        'grade',
        'location',
        'guardian_name',
        'guardian_id_number',
        'scholarship_amount',
    ];

    protected function age(): Attribute
    {
        return Attribute::make(
            get: fn () => Carbon::parse($this->birth_date)->age,
        );
    }

    // Add this to your Student.php file
    public function meetings(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Meeting::class)
            ->withPivot(['attended', 'grades_submitted', 'letter_submitted'])
            ->withTimestamps();
    }
}