<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'days' => 'array',
            'start_date' => 'date',
            'end_date' => 'date',
            'capacity' => 'integer',
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function admissions()
    {
        return $this->hasMany(Admission::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'admissions');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }
}
