<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectDescription extends Model
{
    use HasFactory;

    protected $fillable = [
    'subject_code',
    'subject_name',
     ];

     public function assessmentDescriptions()
        {
           return $this->hasMany(AssessmentDescription::class, 'subject_desc_id');
        }
}
