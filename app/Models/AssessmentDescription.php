<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssessmentDescription extends Model
{
    use HasFactory;

     protected $table = 'assessment_descriptions';

    protected $fillable = ['subject_desc_id','grading_period', 'type', 'description'];

    public function subjectDescription()
{
    return $this->belongsTo(SubjectDescription::class, 'subject_desc_id');
}
}
