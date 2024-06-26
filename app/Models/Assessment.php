<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;
     public function grades()
    {
        return $this->hasMany(Grades::class);
    }

    public function viewers()
{
    return $this->belongsToMany(User::class, 'assessment_views', 'assessment_id', 'student_id');
}
   protected $table = 'assessments';
protected $fillable = [
           'subject_id',
           'grading_period',
           'type',
           'description',
           'max_points',
           'bonus_points',
           'subject_type',
           'activity_date',
           'published',
           'published_at',
           
    ];

}