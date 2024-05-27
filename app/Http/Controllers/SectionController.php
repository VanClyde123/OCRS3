<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
   public function getSections($subjectId)
{
    // Fetch sections associated with the subject ID
    $sections = Section::where('subject_description_id', $subjectId)->get();

    return response()->json(['sections' => $sections]);
}
}
