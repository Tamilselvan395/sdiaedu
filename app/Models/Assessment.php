<?php

namespace App\Models;

use App\Enums\AssessmentStatus;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'assessment_date' => 'date',
            'status' => AssessmentStatus::class,
            'total_marks' => 'integer',
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function results()
    {
        return $this->hasMany(AssessmentResult::class);
    }
}
