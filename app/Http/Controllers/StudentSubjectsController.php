<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EnrolledStudents;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\Assessment;
use Auth;



class StudentSubjectsController extends Controller
{
    public function studentsubjects(Request $request)
    {
    $student = Auth::user();

    if ($student && $student->role === 3) {
        
        $currentSemester = Semester::where('is_current', true)->first();
        if ($currentSemester) {  
            
            $search = $request->input('search');

            
            $enrolledStudentSubjects = $student->enrolledStudentSubjects()
                ->whereHas('importedclasses.subject', function ($query) use ($currentSemester) {
                    $query->where('term', $currentSemester->semester_name . ', ' . $currentSemester->school_year);
                })
                ->with(['importedclasses.subject', 'importedclasses.instructor'])
                ->when($search, function ($query, $search) {
                    $query->where(function ($query) use ($search) {
                        $query->whereHas('importedclasses.subject', function ($query) use ($search) {
                            $query->where('subject_code', 'like', "%$search%")
                                ->orWhere('description', 'like', "%$search%");
                        })
                        ->orWhereHas('importedclasses.instructor', function ($query) use ($search) {
                            $query->where('name', 'like', "%$search%")
                                ->orWhere('last_name', 'like', "%$search%");
                        })
                        ->orWhereHas('importedclasses', function ($query) use ($search) {
                            $query->where('days', 'like', "%$search%")
                                ->orWhere('time', 'like', "%$search%")
                                ->orWhere('room', 'like', "%$search%");
                        });
                    });
                })
                ->get();

        } else {
            $enrolledStudentSubjects = [];
        }

        return view('student.subjectlist', compact('enrolledStudentSubjects'));
    } else {
        return redirect()->route('login')->with('error', 'Access denied.');
    }
    }
    public function studentpastsubjects(Request $request)
    {
   $student = Auth::user();

if ($student && $student->role === 3) {
    $currentSemester = Semester::where('is_current', true)->first();
    if ($currentSemester) {

        $currentTerm = $currentSemester->semester_name;
        $currentSchoolYear = $currentSemester->school_year;

      
        $terms = ['First Semester', 'Second Semester', 'Short Term'];

      
        $currentTermIndex = array_search($currentTerm, $terms);

   
        $previousTerms = [];

        for ($i = $currentTermIndex - 1; $i >= 0; $i--) {
            $previousTerms[] = $terms[$i] . ', ' . $currentSchoolYear;
        }

   
        $yearParts = explode(' - ', $currentSchoolYear);
        $startYear = (int)$yearParts[0];
        $endYear = (int)$yearParts[1];

        while ($startYear > 0 && $endYear > 0) {
            $startYear--;
            $endYear--;

            foreach (array_reverse($terms) as $term) {
                $previousTerms[] = $term . ', ' . $startYear . ' - ' . $endYear;
            }
        }

        $search = $request->input('search');
        $term = $request->input('term');

        $pastStudentSubjects = $student->enrolledStudentSubjects()
            ->whereHas('importedclasses.subject', function ($query) use ($previousTerms) {
                $query->whereIn('term', $previousTerms);
            })
            ->with(['importedclasses.subject', 'importedclasses.instructor'])
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->whereHas('importedclasses.subject', function ($query) use ($search) {
                        $query->where('subject_code', 'like', "%$search%")
                              ->orWhere('description', 'like', "%$search%");
                    })
                    ->orWhereHas('importedclasses.instructor', function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                              ->orWhere('last_name', 'like', "%$search%");
                    })
                    ->orWhereHas('importedclasses', function ($query) use ($search) {
                        $query->where('days', 'like', "%$search%")
                              ->orWhere('time', 'like', "%$search%")
                              ->orWhere('room', 'like', "%$search%");
                    });
                });
            })
            ->when($term, function ($query, $term) {
                $query->whereHas('importedclasses.subject', function ($query) use ($term) {
                    $query->where('term', 'like', "%$term%");
                });
            })
            ->get();

    } else {
        $pastStudentSubjects = [];
    }

        return view('student.past_subjectlist', compact('pastStudentSubjects'));
    } else {
        return redirect()->route('login')->with('error', 'Access denied.');
    }
    }



}