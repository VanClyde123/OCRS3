<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeCeilingSetting extends Model
{
    use HasFactory;

    protected $fillable = ['identifier', 'grade_above', 'grade_lower', 'grade_upper'];
}
