<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_description_id',
        'section_name',
    ];

    public function subjectDescription()
    {
        return $this->belongsTo(SubjectDescription::class);
    }
}
