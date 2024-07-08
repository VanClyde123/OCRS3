<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnrolledStudents;
use App\Models\Subject;
use App\Models\ImportedClasslist;
use App\Models\Assessment;
use App\Models\AssessmentDescription;
use App\Models\User;
use App\Models\Grades;
use App\Models\SubjectType;
use App\Models\Semester;
use Illuminate\Support\Facades\DB;
use Auth;


class StudentScoreController extends Controller
{
   public function showScores($enrolledStudentId)
{
   $enrolledStudent = EnrolledStudents::find($enrolledStudentId);

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

    if ($enrolledStudent && $enrolledStudent->student_id === Auth::user()->id) {
        $enrolledStudent->load('studentgrades.assessment');

        $scores = $enrolledStudent->studentgrades;

        
        $subjectType = DB::table('subjects')
            ->join('imported_classlist', 'subjects.id', '=', 'imported_classlist.subjects_id')
            ->join('enrolled_students', 'imported_classlist.id', '=', 'enrolled_students.imported_classlist_id')
            ->where('enrolled_students.id', $enrolledStudentId)
            ->value('subject_type');


        $latestPublishedAssessment = $enrolledStudent->importedclasses->subject->latestPublishedAssessment();
        if ($latestPublishedAssessment) {
            $student = Auth::user();
            if (!$student->viewedAssessments->contains($latestPublishedAssessment->id)) {
                $student->viewedAssessments()->attach($latestPublishedAssessment->id);
            }
        }

        return view('student.scores.showscores', compact('scores', 'gradingPeriods', 'assessmentTypes', 'subjectType'));
    } else {
        return redirect()->route('login')->with('error', 'Access denied.');
    }
}


}
