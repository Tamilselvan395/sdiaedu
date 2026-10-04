<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillAssessmentQuestion extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'step' => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function assessment()
    {
        return $this->belongsTo(SkillAssessment::class, 'skill_assessment_id');
    }
}
