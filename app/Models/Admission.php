<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'admission_date' => 'date',
            'fees_amount' => 'decimal:2',
        ];
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function enquiry()
    {
        return $this->belongsTo(Enquiry::class);
    }
}
