<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\EnrolledStudents;
use App\Models\Instructor;
use App\Models\ImportedClasslist;
use App\Models\Grades;
use App\Models\Semester;
use App\Models\Assessment;
use Illuminate\Support\Facades\DB;

class SecretaryController extends Controller
{
    public function showInstructors(Request $request)
{
    $query = User::where('role', 2);

    // Apply search filter if search query is provided
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('middle_name', 'like', "%$search%")
              ->orWhere('last_name', 'like', "%$search%");
        });
    }

    $instructors = $query->get();

    return view('secretary.teacher_list.instructor_list', compact('instructors'));
}

public function showInstructorSubjects(Request $request, $instructorId)
{
    $instructor = User::findOrFail($instructorId);

   
    $currentSemester = Semester::where('is_current', true)->first();

     if ($currentSemester) {  
    $query = $instructor->taughtSubjects()
        ->whereHas('subject', function ($query) use ($currentSemester) {
            $query->where('term', $currentSemester->semester_name . ', ' . $currentSemester->school_year);
        });

    
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->whereHas('subject', function ($sq) use ($search) {
                $sq->where('description', 'like', "%$search%")
                   ->orWhere('subject_code', 'like', "%$search%")
                   ->orWhere('section', 'like', "%$search%");
            });
        });
    }

    $subjects = $query->get();

    } else {
        $subjects = [];
    }


    return view('secretary.teacher_list.subjects', compact('instructor', 'subjects'));
}

public function showPastInstructorSubjects(Request $request, $instructorId)
{
    $instructor = User::findOrFail($instructorId);

    

    $currentSemester = Semester::where('is_current', true)->first();

    if ($currentSemester) {  
    $query = $instructor->taughtSubjects()
        ->whereHas('subject', function ($query) use ($currentSemester) {
            $query->where('term', '!=', $currentSemester->semester_name . ', ' . $currentSemester->school_year);
        });

 
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->whereHas('subject', function ($sq) use ($search) {
                $sq->where('description', 'like', "%$search%")
                   ->orWhere('subject_code', 'like', "%$search%")
                   ->orWhere('section', 'like', "%$search%");
            });
        });
    }

   
    if ($request->has('term')) {
        $term = $request->input('term');
        $query->whereHas('subject', function ($sq) use ($term) {
            $sq->where('term','like', "%$term%");
        });
    }

    $pastSubjects = $query->get();

    } else {
        $pastSubjects = [];
    }


    return view('secretary.teacher_list.past_subjects', compact('instructor', 'pastSubjects'));
}

public function showEnrolledStudents($subjectId)
{
  $subject = ImportedClasslist::findOrFail($subjectId)->subject;
    $enrolledStudents = EnrolledStudents::where('imported_classlist_id', $subjectId)
        ->with('student')
        ->get();

    return view('secretary.teacher_list.enrolled_students', compact('subject', 'enrolledStudents'));
}

public function viewStudentPoints($studentId, $subjectId)
{
     $student = User::findOrFail($studentId);
    $subject = Subject::findOrFail($subjectId);

    
    $importedClass = $subject->importedClasses->first();

    $gradingPeriods = DB::table('assessments')->select('grading_period')->distinct()->pluck('grading_period');


    $excludedAssessmentTypes = [
        'Additional Points Quiz',
        'Additional Points OT',
        'Additional Points Exam',
        'Additional Points Lab',
        'Direct Bonus Grade',
    ];

    $assessmentTypes = DB::table('assessments')
        ->select('type')
        ->distinct()
        ->whereNotIn('type', $excludedAssessmentTypes)
        ->pluck('type');

    $enrolledStudent = EnrolledStudents::where('student_id', $studentId)
        ->where('imported_classlist_id', $importedClass->id)
        ->first();


    $grades = Grades::where('enrolled_student_id', $enrolledStudent->id)
        ->whereHas('assessment', function ($query) use ($subjectId) {
            $query->where('subject_id', $subjectId);
        })
        ->with('assessment')
        ->get();

       
    $enrolledStudent->load('studentgrades.assessment');

    $studentGrades = $enrolledStudent->studentgrades;

    return view('secretary.teacher_list.view_scores', compact('student', 'grades', 'subject', 'studentGrades', 'gradingPeriods', 'assessmentTypes'));
}

////////////////for student list//////////////

 public function viewAllStudents1(Request $request)
        {
            $query = User::where('role', 3);

            // Apply search filter if search query is provided
            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('id_number', 'like', "%$search%")
                      ->orWhere('last_name', 'like', "%$search%")
                      ->orWhere('name', 'like', "%$search%")
                      ->orWhere('middle_name', 'like', "%$search%");
                });
            }

    $students = $query->get();

    return view('secretary.student_list.view_students', compact('students'));
}
    
        public function viewEnrolledSubjects1(Request $request, $studentId)
    {
        $student = User::find($studentId);
         $currentSemester = Semester::where('is_current', true)->first();
 
 if ($currentSemester) { 
          $query = $student->enrolledSubjects()->where('term', $currentSemester->semester_name . ', ' . $currentSemester->school_year);

            
            if ($request->has('search')) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('subject_code', 'like', "%$search%")
                      ->orWhere('description', 'like', "%$search%")
                      ->orWhere('section', 'like', "%$search%");
                });
            }

            $enrolledSubjects = $query->get();

            } else {
        $enrolledSubjects = [];
    }

        return view('secretary.student_list.enrolled_subjects', compact('student', 'enrolledSubjects'));
    }

   public function viewPastEnrolledSubjects1(Request $request, $studentId)
{
    $student = User::find($studentId);
    $currentSemester = Semester::where('is_current', true)->first();

if ($currentSemester) {
    $query = $student->enrolledSubjects()
        ->where('term', '!=', $currentSemester->semester_name . ', ' . $currentSemester->school_year);

   
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('subject_code', 'like', "%$search%")
              ->orWhere('description', 'like', "%$search%")
              ->orWhere('section', 'like', "%$search%");
        });
    }

     
    if ($request->has('term')) {
        $term = $request->input('term');
        $query->where('term','like', "%$term%");
    }

    $pastEnrolledSubjects = $query->get();

    } else {
        $pastEnrolledSubjects  = [];
    }

        return view('secretary.student_list.view_pastsubjects', compact('student', 'pastEnrolledSubjects'));
    }
 
    public function viewGrades1($studentId, $subjectId)
    {
      $student = User::find($studentId);
      $subject = Subject::find($subjectId);


    $gradingPeriods = DB::table('assessments')->select('grading_period')->distinct()->pluck('grading_period');


    $excludedAssessmentTypes = [
        'Additional Points Quiz',
        'Additional Points OT',
        'Additional Points Exam',
        'Additional Points Lab',
        'Direct Bonus Grade',
    ];

    $assessmentTypes = DB::table('assessments')
        ->select('type')
        ->distinct()
        ->whereNotIn('type', $excludedAssessmentTypes)
        ->pluck('type');


  
    $enrolledStudent = EnrolledStudents::where('student_id', $studentId)
        ->whereHas('importedclasses', function ($query) use ($subjectId) {
            $query->where('subjects_id', $subjectId);
        })
        ->first();

    
    $grades = Grades::where('enrolled_student_id', $enrolledStudent->id)
        ->whereHas('assessment', function ($query) use ($subjectId) {
            $query->where('subject_id', $subjectId);
        })
        ->with('assessment') 
        ->get();

    
    $enrolledStudent->load('studentgrades.assessment');

    $studentGrades = $enrolledStudent->studentgrades;

    return view('secretary.student_list.view_scores', compact('student', 'subject', 'grades', 'studentGrades', 'gradingPeriods', 'assessmentTypes'));
    }


      ///////for changeing instructor in a subject/////

    public function viewSubjects1()
    {
      
      $currentSemester = Semester::where('is_current', true)->first();

   if ($currentSemester) {  

    $importedClasses = ImportedClasslist::with(['subject', 'instructor'])
        ->whereHas('subject', function ($query) use ($currentSemester) {
            // Filter subjects based on the active semester
            $query->where('term', $currentSemester->semester_name . ', ' . $currentSemester->school_year);
        })
        ->get();

        } else {
        $importedClasses = [];
    }



    return view('secretary.subject_list.view_subjects', compact('importedClasses'));
       
    }


    public function changeInstructorForm1($importedClassId)
    {
       
        $importedClass = ImportedClasslist::findOrFail($importedClassId);

        
        $instructors = User::where('role', 2)->get();
            return view('secretary.subject_list.change_instructor', compact('importedClass', 'instructors'));
        }

    public function changeInstructor1($importedClassId, Request $request)
    {
          //// fetch the selected imported class
        $importedClass = ImportedClasslist::findOrFail($importedClassId);

        ///// update the instructor_id in the imported class
        $importedClass->instructor_id = $request->input('newInstructor');
        $importedClass->save();


        return redirect()->route('secretary.viewSubjects1')->with('success', 'Instructor changed successfully');
    }

}

