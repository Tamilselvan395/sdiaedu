<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillAssessmentSubmission extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'answers' => 'array',
            'recommended_courses' => 'array',
        ];
    }

    public function assessment()
    {
        return $this->belongsTo(SkillAssessment::class, 'skill_assessment_id');
    }

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }
}
