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
use Barryvdh\DomPDF\Facade\Pdf;
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

            $subjectDetails = DB::table('subjects')
            ->join('imported_classlist', 'subjects.id', '=', 'imported_classlist.subjects_id')
            ->join('enrolled_students', 'imported_classlist.id', '=', 'enrolled_students.imported_classlist_id')
            ->join('users', 'imported_classlist.instructor_id', '=', 'users.id') 
            ->where('enrolled_students.id', $enrolledStudentId)
            ->select(
                    'subjects.subject_code',
                    'subjects.description',
                    'users.name',
                    'users.middle_name',
                    'users.last_name',
                    'imported_classlist.days',
                    'imported_classlist.time',
                    'imported_classlist.room'
                )
            ->first();

              $instructorFullName = trim("{$subjectDetails->last_name}, {$subjectDetails->name} {$subjectDetails->middle_name} ");


            $latestPublishedAssessment = $enrolledStudent->importedclasses->subject->latestPublishedAssessment();
            if ($latestPublishedAssessment) {
                $student = Auth::user();
                if (!$student->viewedAssessments->contains($latestPublishedAssessment->id)) {
                    $student->viewedAssessments()->attach($latestPublishedAssessment->id);
                }
            }

            return view('student.scores.showscores', compact('scores', 'gradingPeriods', 'assessmentTypes', 'subjectType', 'enrolledStudentId', 'subjectDetails', 'instructorFullName'));
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }

    public function exportPdf($enrolledStudentId)
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

             
            $subjectDetails = DB::table('subjects')
            ->join('imported_classlist', 'subjects.id', '=', 'imported_classlist.subjects_id')
            ->join('enrolled_students', 'imported_classlist.id', '=', 'enrolled_students.imported_classlist_id')
            ->join('users', 'imported_classlist.instructor_id', '=', 'users.id') 
            ->where('enrolled_students.id', $enrolledStudentId)
            ->select(
                    'subjects.subject_code',
                    'subjects.description',
                    'users.name',
                    'users.middle_name',
                    'users.last_name',
                    'imported_classlist.days',
                    'imported_classlist.time',
                    'imported_classlist.room'
                )
            ->first();

            $instructorFullName = trim("{$subjectDetails->last_name}, {$subjectDetails->name} {$subjectDetails->middle_name} ");
      
            $student = $enrolledStudent->student;
            $subject = $enrolledStudent->importedclasses->subject;

            $filename = "{$student->id_number}_{$student->last_name}_{$student->name}_{$student->middle_name}_{$subject->subject_code}_{$subject->section}.pdf";

           
            $pdf = Pdf::loadView('student.scores.pdfscores', compact('scores', 'gradingPeriods', 'assessmentTypes', 'subjectType', 'enrolledStudentId', 'subjectDetails', 'instructorFullName'))
                     ->setPaper('legal', 'landscape');

            return $pdf->stream($filename); 
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }
    }


}
