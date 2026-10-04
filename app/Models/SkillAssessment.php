<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillAssessment extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function questions()
    {
        return $this->hasMany(SkillAssessmentQuestion::class)->orderBy('step')->orderBy('sort_order');
    }

    public function submissions()
    {
        return $this->hasMany(SkillAssessmentSubmission::class);
    }
}
