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

    protected static function boot()
    {
        parent::boot();

        
              ///////for auto deleting asscoiated grades records in grades table
                static::deleting(function ($assessment) {
                    $assessment->grades()->delete();
                });
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
           'manual_activity_date',
           'published',
           'published_at',
           
    ];

}