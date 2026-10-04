<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function parentProfile()
    {
        return $this->hasOne(ParentProfile::class);
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'admissions');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function assessmentResults()
    {
        return $this->hasMany(AssessmentResult::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
