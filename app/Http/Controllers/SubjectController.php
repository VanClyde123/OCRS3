<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\SubjectType;
use App\Models\Grades;
use App\Models\Assessment;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    public function index()
  {
    $subjects = Subject::all();
    
    return view('teacher.list.classlist', compact('subjects'));
  }

  public function updateSubjectType(Request $request, Subject $subject)
    {
       
        $assessments = Assessment::where('subject_id', $subject->id)->exists();
        
            $grades = Grades::whereHas('assessment', function ($query) use ($subject) {
                $query->where('subject_id', $subject->id);
            })->exists();

       
                if ($assessments || $grades) {
                    return redirect()->back()->with('error', 'You cannot change the class type because there are already existing assessments and grades.');
                }

        
        $subjectTypePercentages = SubjectType::pluck('subject_type')->toArray();
        $allSubjectTypes = array_merge(['Lec', 'Lab'], $subjectTypePercentages);

       
            $request->validate([
                'subject_type' => ['required', Rule::in($allSubjectTypes)],
            ]);

      
                $subject->update([
                    'subject_type' => $request->input('subject_type'),
                ]);

        
        return redirect()->back()->with('success', 'Class type updated successfully.');
    }
}
