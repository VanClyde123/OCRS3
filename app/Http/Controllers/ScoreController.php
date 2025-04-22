<?php

namespace App\Http\Controllers;

use App\Models\Subject; 
use App\Http\Controllers\Log;
use App\Models\EnrolledStudents;
use App\Models\Assessment;
use App\Models\Grades;
use App\Models\User;
use App\Models\SubjectType; 
use App\Models\AssessmentDescription; 
use Illuminate\Http\Request;

use App\Services\TransmutationService;
use App\Services\TransmutationLecLab6040Service;
use App\Services\TransmutationLecLab4060Service;
use App\Services\TransmutationLecLab5050Service;

class ScoreController extends Controller
{

    public function saveAssessment(Request $request)
{

 $assessments = json_decode($request->input('assessments'));

 
    $subject_id = $request->input('subject_id');
    $subjectType = $request->input('subject_type');
    

   foreach ($assessments as $assessment) {
        if (isset($assessment->isNew) && $assessment->isNew === true) {
          
            if (
                ($assessment->type !== 'Additional Points Quiz' &&
                    $assessment->type !== 'Additional Points OT' &&
                    $assessment->type !== 'Additional Points Exam' &&
                   $assessment->type !==  'Additional Points Lab' &&
                    $assessment->type !== 'Direct Bonus Grade') &&
                (!is_numeric($assessment->max_points) || $assessment->max_points <= 0)
            ) {
                return response()->json(['error' => 'Invalid max_points value for assessment.']);
            }

            $newAssessment = new Assessment;
            $newAssessment->subject_id = $subject_id;
            $newAssessment->grading_period = $assessment->grading_period;
            $newAssessment->type = $assessment->type;
              
            if (!empty($assessment->manual_description)) {
                $newAssessment->description = $assessment->manual_description;
            } else {
                $newAssessment->description = $assessment->description;
            }

            if (
                $assessment->type !== 'Additional Points Quiz' &&
                $assessment->type !== 'Additional Points OT' &&
                $assessment->type !== 'Additional Points Exam' &&
                 $assessment->type !==  'Additional Points Lab' &&
                $assessment->type !== 'Direct Bonus Grade'
            ) {
                $newAssessment->max_points = $assessment->max_points;
                 
                if (!empty($assessment->manual_activity_date)) {
                   
                    $newAssessment->manual_activity_date = $assessment->manual_activity_date;
                    $newAssessment->activity_date = null;
                } elseif (!empty($assessment->activity_date) && strtotime($assessment->activity_date)) {
                   
                    $newAssessment->activity_date = $assessment->activity_date;
                    $newAssessment->manual_activity_date = null;
                } else {
                   
                    $newAssessment->activity_date = null;
                    $newAssessment->manual_activity_date = null;
                }
            }

            $newAssessment->subject_type = $subjectType;

            $newAssessment->save();
        }
    }


    return response()->json(['message' => 'asessment records saved ']);
}



public function fetchAssessments(Request $request)
{
    

    $gradingPeriod = $request->input('grading_period');
    $type = $request->input('type');

    
    $subjectType = $request->input('subject_type');

  
     $assessments = Assessment::where('grading_period', $gradingPeriod);

     $subjectId = $request->input('subject_id'); // Add this line

  if ($type !== 'All') {
        $assessments->where('type', $type);
    }

    $assessments->where('subject_id', $subjectId);
   
    $assessments->where('subject_type', $subjectType);

    $assessments = $assessments->get()->map(function ($assessment) {
        return [
            'type' => $assessment->type,
            'description' => $assessment->description,
            'maxPoints' => (float) $assessment->max_points,
            'activity_date' => $assessment->activity_date,
        ];
    });

   
    return response()->json(['assessments' => $assessments]);
}


/////////////////////not in use/////////////
public function updateAssessments(Request $request, $id)
{
     $assessment = Assessment::find($id);

        if (!$assessment) {
            return response()->json(['error' => 'asssessmentss not found'], 404);
        }

        $assessment->description = $request->input('description');
        $assessment->maxPoints = $request->input('maxPoints');

        $assessment->save();

        return response()->json(['message' => 'assssment updatedd']);
    }


/////////for fetching an existing assessment record for the student score modal////////
public function fetchassessmentDetails($enrolledStudentId, $assessmentId)
{
    // get the assessment details based on the $enrolledStudentId and $assessmentId
    $assessmentDetails = Assessment::where('id', $assessmentId)->first();
     
    if ($assessmentDetails) {
        return response()->json($assessmentDetails);
    } else {
        return response()->json(['error' => 'asessment not found']);
    }
}

/////////////inserted  score////////////////////////

  public function insertScore(Request $request)
   {

   $validatedData = $request->validate([
        'points' => 'required|array', 

    ]);

    $points = $request->input('points');

    foreach ($points as $enrolledStudentId => $assessmentScores) {
        foreach ($assessmentScores as $assessmentId => $enteredPoints) {

              if ($enteredPoints < 0) {
                return back()->with('error', 'enter a non-negative score.');
            }
               
            $assessment = Assessment::findOrFail($assessmentId);

            /////// entered points exceed the maximum points validations
           
            $enrolledStudent = EnrolledStudents::find($enrolledStudentId);
            $studentName = $enrolledStudent->student->name;
            $studentMiddle = $enrolledStudent->student->middle_name;
            $studentLast = $enrolledStudent->student->last_name;

           if (is_numeric($enteredPoints) && $enteredPoints > $assessment->max_points) {
            //// get the key for specific student id
            $studentKey = 'warning_' . $enrolledStudentId;

            ////// checks if a warning message has been displayed recently for the student
            if (!session()->has($studentKey)) {
                ///// if not then display the warning message 
                session()->flash('warning', 'Inserted points exceeded the max points of ' . $assessment->description . ' for ' . $studentLast . ', ' . $studentName . ' ' . $studentMiddle . ' , considered as bonus points');
                session()->put($studentKey, true);
                    }
                }

            //// updare or create the points 
            $grade = Grades::updateOrCreate(
                [
                    'enrolled_student_id' => $enrolledStudentId,
                    'assessment_id' => $assessmentId,
                ],
                [
                    'points' => $enteredPoints,
                ]
            );

                $exemptTypes = [
                'Direct Bonus Grade',
                'Additional Points Quiz',
                'Additional Points OT',
                'Additional Points Exam',
                'Additional Points Lab',
            ];

            ///// get all scores from students, except the final status row
            $allStudentGrades = Grades::where('enrolled_student_id', $enrolledStudentId)
                ->whereNotNull('assessment_id')
                ->get();

            $hasGrades = $allStudentGrades->count() > 0;

            $allAreAbsent = $hasGrades && $allStudentGrades->every(function ($grade) use ($exemptTypes) {
                ///// skip assessments of exempt types from the chekcing
                if (in_array($grade->assessment->type, $exemptTypes)) {
                    return true; 
                }
                return strtoupper(trim($grade->points)) === 'A';
            });

            $hasNumericScore = $hasGrades && $allStudentGrades->contains(function ($grade) use ($exemptTypes) {
                ///// skip assessments of exempt types from the chekcing numeric score check
                if (in_array($grade->assessment->type, $exemptTypes)) {
                    return false; 
                }
                return is_numeric($grade->points);
            });

            
            $studentRecord = Grades::firstOrNew([
                'enrolled_student_id' => $enrolledStudentId,
                'assessment_id' => null,
            ]);

            if ($allAreAbsent) {
                $studentRecord->finals_status = 'DRP';
            } elseif ($hasNumericScore && $studentRecord->finals_status === 'DRP') {
                   
                    $studentRecord->finals_status = null;
            }

            $studentRecord->save();
 
   
  // //// $student = EnrolledStudents::find($enrolledStudentId);
   
    //////calculate the scores and save it to the student's record
   $studentGrades = Grades::where('enrolled_student_id', $enrolledStudentId)->get();
 
    $subjectType = Assessment::where('id', $assessmentId)->value('subject_type');

   // Retrieve subject type percentages from the database
   $subjectTypePercentage = SubjectType::where('subject_type', $subjectType)->first();

if ($subjectType === 'Lec') {
             
    $hasQuizRecords = $studentGrades->where('assessment.type', 'Quiz')->count() > 0;
    $hasOtherActivityRecords = $studentGrades->whereIn('assessment.type', ['OtherActivity'])->count() > 0;
    $hasExamRecords = $studentGrades->where('assessment.type', 'Exam')->count() > 0;

    if ($hasQuizRecords && $hasOtherActivityRecords && $hasExamRecords) {
        ////////////First grading////////////////////
        $firstGradingMaxPointsQuizzes = $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->where('assessment.type', 'Quiz')
            ->sum('assessment.max_points');

        $firstGradingMaxPointsOtherActivity = $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->whereIn('assessment.type', ['OtherActivity'])
            ->sum('assessment.max_points');

        $firstGradingMaxPointsExam = $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->where('assessment.type', 'Exam')
            ->sum('assessment.max_points');

        $actualPointsQuizzes = $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->where('assessment.type', 'Quiz')
           ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

        $bonusPointsQuiz =  $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->where('assessment.type', 'Additional Points Quiz')
            ->sum('points');

        
        $actualPointsQuizzes += $bonusPointsQuiz;

        $actualPointsOtherActivity = $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->whereIn('assessment.type', ['OtherActivity'])
           ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

        $bonusPointsOT =  $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->where('assessment.type', 'Additional Points OT')
            ->sum('points');

        $actualPointsOtherActivity += $bonusPointsOT;

        $actualPointsExam = $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->where('assessment.type', 'Exam')
           ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

        $bonusPointsExam =  $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->where('assessment.type', 'Additional Points Exam')
            ->sum('points');

        
        $actualPointsExam += $bonusPointsExam;

        
       
        

        //// calculate total points 
        $totalPointsRaw = (
            ($firstGradingMaxPointsQuizzes !== 0 ? ($actualPointsQuizzes / $firstGradingMaxPointsQuizzes) * 40 : 0) +
            ($firstGradingMaxPointsOtherActivity !== 0 ?  ($actualPointsOtherActivity / $firstGradingMaxPointsOtherActivity) * 20 : 0) +
            ($firstGradingMaxPointsExam !== 0 ? ($actualPointsExam / $firstGradingMaxPointsExam) * 40 : 0)
        );

                
        if ($totalPointsRaw > 100.0) {
            $totalPointsRaw = 100.0;
        }

        $totalPoints = round($totalPointsRaw, 1);
        //////// get the range of the total points in the transmutation table and return the official grade 
        $fgOfficialGrade = $this->calculateOfficialGrade($totalPoints);

        ///// save the official grade to a new record in the database
        $existingRecord = Grades::where('enrolled_student_id', $enrolledStudentId)
            ->whereNull('assessment_id') /////filter records without assessment_id(from assessments table)
            ->first();

        if ($existingRecord) {
            ////update if there is an existing record
            $existingRecord->total_fg_grade = $totalPointsRaw;
            $existingRecord->tentative_fg_grade = $totalPoints;
            $existingRecord->fg_grade = $fgOfficialGrade;
            $existingRecord->save();
        } else {
            /////create new record
            $newRecord = new Grades();
            $newRecord->enrolled_student_id = $enrolledStudentId;
            $newRecord->assessment_id = null;
            $newRecord->points = null; 

            $newRecord->total_fg_lec = null; 
            $newRecord->lec_fg_grade = null; 
            $newRecord->total_fg_lab = null; 
            $newRecord->lab_fg_grade = null; 
            $newRecord->total_fg_grade = $totalPointsRaw;
            $newRecord->tentative_fg_grade = $totalPoints;
            $newRecord->fg_grade = $fgOfficialGrade;

            $newRecord->total_midterms_lec = null; 
            $newRecord->lec_midterms_grade = null; 
            $newRecord->total_midterms_lab = null; 
            $newRecord->lab_midterms_grade = null; 
            $newRecord->total_midterms_grade = null;
            $newRecord->tentative_midterms_grade = null;
            $newRecord->midterms_grade = null;

            $newRecord->total_finals_lec = null; 
            $newRecord->lec_finals_grade = null; 
            $newRecord->total_finals_lab = null; 
            $newRecord->lab_finals_grade = null; 
            $newRecord->total_finals_grade = null;
            $newRecord->tentative_finals_grade = null;
            $newRecord->finals_grade = null;
            $newRecord->save();
        }
    } else {
        
        Grades::updateOrCreate(
            ['enrolled_student_id' => $enrolledStudentId, 'assessment_id' => null],
            ['fg_grade' => null]
        );
    }


          /////////////////Midterms///////////////////
        $hasMidtermsQuizRecords = $studentGrades->where('assessment.grading_period', 'Midterm')->where('assessment.type', 'Quiz')->count() > 0;
        $hasMidtermsOtherActivityRecords = $studentGrades->where('assessment.grading_period', 'Midterm')->whereIn('assessment.type', ['OtherActivity'])->count() > 0;
        $hasMidtermsExamRecords = $studentGrades->where('assessment.grading_period', 'Midterm')->where('assessment.type', 'Exam')->count() > 0;

        if ($hasMidtermsQuizRecords && $hasMidtermsOtherActivityRecords && $hasMidtermsExamRecords) {
            $midtermsMaxPointsQuizzes = $studentGrades
                ->where('assessment.grading_period', 'Midterm')
                ->where('assessment.type', 'Quiz')
                ->sum('assessment.max_points');

            $midtermsMaxPointsOtherActivity = $studentGrades
                ->where('assessment.grading_period', 'Midterm')
                ->whereIn('assessment.type', ['OtherActivity'])
                ->sum('assessment.max_points');

            $midtermsMaxPointsExam = $studentGrades
                ->where('assessment.grading_period', 'Midterm')
                ->where('assessment.type', 'Exam')
                ->sum('assessment.max_points');

            $actualPointsQuizzesMidterms = $studentGrades
                ->where('assessment.grading_period', 'Midterm')
                ->where('assessment.type', 'Quiz')
               ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

            $bonusPointsQuiz =  $studentGrades
                ->where('assessment.grading_period', 'Midterm')
                ->where('assessment.type', 'Additional Points Quiz')
                ->sum('points');

        
            $actualPointsQuizzesMidterms += $bonusPointsQuiz;

            $actualPointsOtherActivityMidterms = $studentGrades
                ->where('assessment.grading_period', 'Midterm')
                ->whereIn('assessment.type', ['OtherActivity'])
               ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

            $bonusPointsOT =  $studentGrades
                ->where('assessment.grading_period', 'Midterm')
                ->where('assessment.type', 'Additional Points OT')
                ->sum('points');

            $actualPointsOtherActivityMidterms += $bonusPointsOT;

            $actualPointsExamMidterms = $studentGrades
                ->where('assessment.grading_period', 'Midterm')
                ->where('assessment.type', 'Exam')
               ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

            $bonusPointsExam =  $studentGrades
                ->where('assessment.grading_period', 'Midterm')
                ->where('assessment.type', 'Additional Points Exam')
                ->sum('points');

        
            $actualPointsExamMidterms += $bonusPointsExam;

            // checks if fgOfficialGrade exists before proceeding
            if ($fgOfficialGrade !== null) {
                $totalPointsMidtermsRaw = (
                    ($midtermsMaxPointsQuizzes !== 0 ? ($actualPointsQuizzesMidterms / $midtermsMaxPointsQuizzes) * 40 : 0) +
                    ($midtermsMaxPointsOtherActivity !== 0 ? ($actualPointsOtherActivityMidterms / $midtermsMaxPointsOtherActivity) * 20 : 0) +
                    ($midtermsMaxPointsExam !== 0 ? ($actualPointsExamMidterms / $midtermsMaxPointsExam) * 40 : 0)
                );

                if ($totalPointsMidtermsRaw > 100.0) {
                    $totalPointsMidtermsRaw = 100.0;
                }

                $totalPointsMidterms = round($totalPointsMidtermsRaw, 1);

                // get the range of total points for Midterms from the transmutation table to return the tentative grade
                $tentativeMidtermGrade = $this->calculateOfficialGrade($totalPointsMidterms);

                // calculate the Midterms tentative grade
                $midtermsOfficialGrade = round((2 / 3) * $tentativeMidtermGrade + (1 / 3) * $fgOfficialGrade, 0);

                $existingRecord = Grades::where('enrolled_student_id', $enrolledStudentId)
                    ->whereNull('assessment_id')
                    ->first();

                if ($existingRecord) {
                    $existingRecord->total_midterms_grade = $totalPointsMidtermsRaw;
                    $existingRecord->tentative_midterms_grade = $tentativeMidtermGrade;
                    $existingRecord->midterms_grade = $midtermsOfficialGrade;
                    $existingRecord->save();
                } else {
                    $newRecord = new Grades();
                    $newRecord->enrolled_student_id = $enrolledStudentId;
                    $newRecord->assessment_id = null;
                    $newRecord->points = null;

                    $newRecord->total_fg_lec = null; 
                    $newRecord->lec_fg_grade = null; 
                    $newRecord->total_fg_lab = null; 
                    $newRecord->lab_fg_grade = null; 
                    $newRecord->total_fg_grade = null;
                    $newRecord->tentative_fg_grade = null;
                    $newRecord->fg_grade = null;

                    $newRecord->total_midterms_lec = null; 
                    $newRecord->lec_midterms_grade = null; 
                    $newRecord->total_midterms_lab = null; 
                    $newRecord->lab_midterms_grade = null; 
                    $newRecord->total_midterms_grade = $totalPointsMidtermsRaw;
                    $newRecord->tentative_midterms_grade = $tentativeMidtermGrade;
                    $newRecord->midterms_grade = $midtermsOfficialGrade;

                    $newRecord->total_finals_lec = null; 
                    $newRecord->lec_finals_grade = null; 
                    $newRecord->total_finals_lab = null; 
                    $newRecord->lab_finals_grade = null; 
                    $newRecord->total_finals_grade = null;
                    $newRecord->tentative_finals_grade = null;
                    $newRecord->finals_grade = null;
                    $newRecord->save();
                }
            } else {
                
                Log::info('Midterms calculations skipped.');
            }
        } else {
            
            Grades::updateOrCreate(
                ['enrolled_student_id' => $enrolledStudentId, 'assessment_id' => null],
                ['midterms_grade' => null]
            );
        }
        ///////////////////////////Finals///////////////////////
        $hasFinalsQuizRecords = $studentGrades->where('assessment.grading_period', 'Finals')->where('assessment.type', 'Quiz')->count() > 0;
        $hasFinalsOtherActivityRecords = $studentGrades->where('assessment.grading_period', 'Finals')->whereIn('assessment.type', ['OtherActivity'])->count() > 0;
        $hasFinalsExamRecords = $studentGrades->where('assessment.grading_period', 'Finals')->where('assessment.type', 'Exam')->count() > 0;

        if ($hasFinalsQuizRecords && $hasFinalsOtherActivityRecords && $hasFinalsExamRecords) {
            $finalsMaxPointsQuizzes = $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->where('assessment.type', 'Quiz')
                ->sum('assessment.max_points');

            $finalsMaxPointsOtherActivity = $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->whereIn('assessment.type', ['OtherActivity'])
                ->sum('assessment.max_points');

            $finalsMaxPointsExam = $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->where('assessment.type', 'Exam')
                ->sum('assessment.max_points');

            $actualPointsQuizzesFinals = $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->where('assessment.type', 'Quiz')
               ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });


            $bonusPointsQuiz =  $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->where('assessment.type', 'Additional Points Quiz')
                ->sum('points');

            
            $actualPointsQuizzesFinals  += $bonusPointsQuiz;

            $actualPointsOtherActivityFinals = $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->whereIn('assessment.type', ['OtherActivity'])
               ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

            $bonusPointsOT =  $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->where('assessment.type', 'Additional Points OT')
                ->sum('points');

            $actualPointsOtherActivityFinals += $bonusPointsOT;

            $actualPointsExamFinals = $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->where('assessment.type', 'Exam')
               ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

            $bonusPointsExam =  $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->where('assessment.type', 'Additional Points Exam')
                ->sum('points');

            
             $actualPointsExamFinals += $bonusPointsExam;

            $bonusPointsDirect = $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->where('assessment.type', 'Direct Bonus Grade')
                ->sum('points');

            if ($midtermsOfficialGrade !== null) {
                $totalPointsFinalsRaw = (
                    ($finalsMaxPointsQuizzes !== 0 ? ($actualPointsQuizzesFinals / $finalsMaxPointsQuizzes) * 40 : 0) +
                    ($finalsMaxPointsOtherActivity !== 0 ? ($actualPointsOtherActivityFinals / $finalsMaxPointsOtherActivity) * 20 : 0) +
                    ($finalsMaxPointsExam !== 0 ? ($actualPointsExamFinals / $finalsMaxPointsExam) * 40 : 0)
                );

                if ($totalPointsFinalsRaw > 100.0) {
                    $totalPointsFinalsRaw = 100.0;
                }

                $totalPointsFinals = round($totalPointsFinalsRaw, 1);
                $tentativeFinalsGrade = $this->calculateOfficialGrade($totalPointsFinals);

            
                
                $rawFinalsGrade = round((2 / 3) * $tentativeFinalsGrade + (1 / 3) * $midtermsOfficialGrade, 0);

               
                $adjustedFinalsGrade = $rawFinalsGrade + $bonusPointsDirect;


                $adjustedFinalsGrade = max(65, $adjustedFinalsGrade);

                if ($adjustedFinalsGrade < 70) {
                    $adjustedFinalsGrade = 70;
                }


                $existingRecord = Grades::where('enrolled_student_id', $enrolledStudentId)
                    ->whereNull('assessment_id')
                    ->first();

                if ($existingRecord) {
                    $existingRecord->total_finals_grade = $totalPointsFinalsRaw;
                    $existingRecord->tentative_finals_grade = $tentativeFinalsGrade;
                    $existingRecord->finals_grade = $rawFinalsGrade;
                    $existingRecord->adjusted_finals_grade = $adjustedFinalsGrade;
                    $existingRecord->save();
                } else {
                    $newRecord = new Grades();
                    $newRecord->enrolled_student_id = $enrolledStudentId;
                    $newRecord->assessment_id = null;
                    $newRecord->points = null;

                    $newRecord->total_fg_lec = null; 
                    $newRecord->lec_fg_grade = null; 
                    $newRecord->total_fg_lab = null; 
                    $newRecord->lab_fg_grade = null; 
                    $newRecord->total_fg_grade = null;
                    $newRecord->tentative_fg_grade = null;
                    $newRecord->fg_grade = null;

                    $newRecord->total_midterms_lec = null; 
                    $newRecord->lec_midterms_grade = null; 
                    $newRecord->total_midterms_lab = null; 
                    $newRecord->lab_midterms_grade = null; 
                    $newRecord->total_midterms_grade = null;
                    $newRecord->tentative_midterms_grade = null;
                    $newRecord->midterms_grade = null;

                    $newRecord->total_finals_lec = null; 
                    $newRecord->lec_finals_grade = null; 
                    $newRecord->total_finals_lab = null; 
                    $newRecord->lab_finals_grade = null; 
                    $newRecord->total_finals_grade = $totalPointsFinalsRaw;
                    $newRecord->tentative_finals_grade = $tentativeFinalsGrade;
                    $newRecord->finals_grade = $rawFinalsGrade;
                    $newRecord->adjusted_finals_grade = $adjustedFinalsGrade; 
                    $newRecord->save();
                }
            } else {
                
                Log::info('Finals calculations skipped.');
            }
        } else {
           
            Grades::updateOrCreate(
                ['enrolled_student_id' => $enrolledStudentId, 'assessment_id' => null],
                ['finals_grade' => null]
            );
        }

     } 
elseif ($subjectType === 'Lab') {
   
            /////////////////////first grading///////////////////////
$hasLabActivityRecords = $studentGrades
    ->where('assessment.grading_period', 'First Grading')
    ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
    ->count() > 0;

if ($hasLabActivityRecords) {
    $totalMaxPointsLab = $studentGrades
        ->where('assessment.grading_period', 'First Grading')
        ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
        ->sum('assessment.max_points');

    $actualTotalPointsLab = $studentGrades
        ->where('assessment.grading_period', 'First Grading')
        ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
       ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

    $bonusPointsLab =  $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->where('assessment.type', 'Additional Points Lab')
            ->sum('points');

        
     $actualTotalPointsLab += $bonusPointsLab;


    $actualTotalPointsLab = min($actualTotalPointsLab, $totalMaxPointsLab);

    $totalActualPointsLab = round($actualTotalPointsLab, 1);
    
    $fgOfficialGradeLab = $this->calculateLabOfficialGrade($totalActualPointsLab, $totalMaxPointsLab);

    
    $existingRecord = Grades::where('enrolled_student_id', $enrolledStudentId)
        ->whereNull('assessment_id') 
        ->first();

    if ($existingRecord) {
        $existingRecord->total_fg_grade = $actualTotalPointsLab;
        $existingRecord->fg_grade = $fgOfficialGradeLab;
        $existingRecord->save();
    } else {
        
        $newRecord = new Grades();
        $newRecord->enrolled_student_id = $enrolledStudentId;
        $newRecord->assessment_id = null;
        $newRecord->points = null;

        $newRecord->total_fg_lec = null; 
        $newRecord->lec_fg_grade = null; 
        $newRecord->total_fg_lab = null; 
        $newRecord->lab_fg_grade = null;
        $newRecord->total_fg_grade =  $actualTotalPointsLab;
        $newRecord->tentative_fg_grade = null;
        $newRecord->fg_grade = $fgOfficialGradeLab;

        $newRecord->total_midterms_lec = null; 
        $newRecord->lec_midterms_grade = null; 
        $newRecord->total_midterms_lab = null; 
        $newRecord->lab_midterms_grade = null; 
        $newRecord->total_midterms_grade = null;
        $newRecord->tentative_midterms_grade = null;
        $newRecord->midterms_grade = null;

        $newRecord->total_finals_lec = null; 
        $newRecord->lec_finals_grade = null; 
        $newRecord->total_finals_lab = null; 
        $newRecord->lab_finals_grade = null;
        $newRecord->total_finals_grade = null;
        $newRecord->tentative_finals_grade = null;
        $newRecord->finals_grade = null;
        $newRecord->save();
    }
} else {
   
    Grades::updateOrCreate(
        ['enrolled_student_id' => $enrolledStudentId, 'assessment_id' => null],
        ['fg_grade' => null]
    );
}

             ///////////////////Midterms//////////////////////////////
$hasLabActivityRecordsMidterms = $studentGrades
    ->where('assessment.grading_period', 'Midterm')
    ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
    ->count() > 0;

    $MidtermsOfficialGradeLab = null; 

if ($fgOfficialGradeLab !== null && $hasLabActivityRecordsMidterms) {
    $totalMaxPointsLabMidterms = $studentGrades
        ->where('assessment.grading_period', 'Midterm')
        ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
        ->sum('assessment.max_points');

    $actualTotalPointsLabMidterms = $studentGrades
        ->where('assessment.grading_period', 'Midterm')
        ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
       ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

     $bonusPointsLab =  $studentGrades
            ->where('assessment.grading_period', 'Midterm')
            ->where('assessment.type', 'Additional Points Lab')
            ->sum('points');

        
     $actualTotalPointsLabMidterms  += $bonusPointsLab;

    $actualTotalPointsLabMidterms = min($actualTotalPointsLabMidterms, $totalMaxPointsLabMidterms);

    $totalActualPointsLabMidterms = round($actualTotalPointsLabMidterms, 1);

    $MidtermsTentativeGradeLab = $this->calculateLabOfficialGradeMidterms($totalActualPointsLabMidterms, $totalMaxPointsLabMidterms);

    $MidtermsOfficialGradeLab = round((2 / 3) * $MidtermsTentativeGradeLab + (1 / 3) * $fgOfficialGradeLab, 0);
    // dd($MidtermsOfficialGradeLab);
  
    $existingRecord = Grades::where('enrolled_student_id', $enrolledStudentId)
        ->whereNull('assessment_id') 
        ->first();

    if ($existingRecord) {
        $existingRecord->total_midterms_grade  = $actualTotalPointsLabMidterms;
        $existingRecord->tentative_midterms_grade = $MidtermsTentativeGradeLab;
        $existingRecord->midterms_grade = $MidtermsOfficialGradeLab;
        $existingRecord->save();
    } else {
        
        $newRecord = new Grades();
        $newRecord->enrolled_student_id = $enrolledStudentId;
        $newRecord->assessment_id = null;
        $newRecord->points = null;

        $newRecord->total_fg_lec = null; 
        $newRecord->lec_fg_grade = null; 
        $newRecord->total_fg_lab = null; 
        $newRecord->lab_fg_grade = null; 
        $newRecord->total_fg_grade =  null;
        $newRecord->tentative_fg_grade = null;
        $newRecord->fg_grade = null;

        $newRecord->total_midterms_lec = null; 
        $newRecord->lec_midterms_grade = null; 
        $newRecord->total_midterms_lab = null; 
        $newRecord->lab_midterms_grade = null; 
        $newRecord->total_midterms_grade = $actualTotalPointsLabMidterms;
        $newRecord->tentative_midterms_grade = $MidtermsTentativeGradeLab;
        $newRecord->midterms_grade = $MidtermsOfficialGradeLab;

        $newRecord->total_finals_lec = null; 
        $newRecord->lec_finals_grade = null; 
        $newRecord->total_finals_lab = null; 
        $newRecord->lab_finals_grade = null; 
        $newRecord->total_finals_grade = null;
        $newRecord->tentative_finals_grade = null;
        $newRecord->finals_grade = null;
        $newRecord->save();
    }
} else {
    
    Grades::updateOrCreate(
        ['enrolled_student_id' => $enrolledStudentId, 'assessment_id' => null],
        ['midterms_grade' => null]
    );
}


                  ////////////////////////Finals/////////////////////////
 $hasLabActivityRecordsFinals = $studentGrades
    ->where('assessment.grading_period', 'Finals')
    ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
    ->count() > 0;

 if ($MidtermsOfficialGradeLab !== null && $hasLabActivityRecordsFinals) {
    $totalMaxPointsLabFinals = $studentGrades
        ->where('assessment.grading_period', 'Finals')
        ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
        ->sum('assessment.max_points');

    $actualTotalPointsLabFinals = $studentGrades
        ->where('assessment.grading_period', 'Finals')
        ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
       ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });
    

     $bonusPointsLab =  $studentGrades
            ->where('assessment.grading_period', 'Finals')
            ->where('assessment.type', 'Additional Points Lab')
            ->sum('points');

        
     $actualTotalPointsLabFinals  += $bonusPointsLab;


    $bonusPointsDirect = $studentGrades
            ->where('assessment.grading_period', 'Finals')
            ->where('assessment.type', 'Direct Bonus Grade')
            ->sum('points');

    $actualTotalPointsLabFinals = min($actualTotalPointsLabFinals, $totalMaxPointsLabFinals);

    $totalActualPointsLabFinals = round($actualTotalPointsLabFinals, 1);

    $FinalsTentativeGradeLab = $this->calculateLabOfficialGradeFinals($totalActualPointsLabFinals, $totalMaxPointsLabFinals);

  
   $rawFinalsGradeLab = round((2 / 3) * $FinalsTentativeGradeLab + (1 / 3) * $MidtermsOfficialGradeLab, 0);

   
    $adjustedFinalsGradeLab = $rawFinalsGradeLab + $bonusPointsDirect;

     $adjustedFinalsGradeLab = max(65, $adjustedFinalsGradeLab);

       if ($adjustedFinalsGradeLab < 70) {
                   $adjustedFinalsGradeLab = 70;
                }
   
    
   
    $existingRecord = Grades::where('enrolled_student_id', $enrolledStudentId)
        ->whereNull('assessment_id')
        ->first();

    if ($existingRecord) {
        $existingRecord->total_finals_grade  = $actualTotalPointsLabFinals;
        $existingRecord->tentative_finals_grade = $FinalsTentativeGradeLab;
        $existingRecord->finals_grade = $rawFinalsGradeLab; 
        $existingRecord->adjusted_finals_grade = $adjustedFinalsGradeLab;
        $existingRecord->save();
    } else {
      
        $newRecord = new Grades();
        $newRecord->enrolled_student_id = $enrolledStudentId;
        $newRecord->assessment_id = null;
        $newRecord->points = null;

        $newRecord->total_fg_lec = null; 
        $newRecord->lec_fg_grade = null; 
        $newRecord->total_fg_lab = null; 
        $newRecord->lab_fg_grade = null; 
        $newRecord->total_fg_grade =  null;
        $newRecord->tentative_fg_grade = null;
        $newRecord->fg_grade = null;

        $newRecord->total_midterms_lec = null; 
        $newRecord->lec_midterms_grade = null; 
        $newRecord->total_midterms_lab = null; 
        $newRecord->lab_midterms_grade = null; 
        $newRecord->total_midterms_grade = null;
        $newRecord->tentative_midterms_grade = null;
        $newRecord->midterms_grade = null;

        $newRecord->total_finals_lec = null; 
        $newRecord->lec_finals_grade = null; 
        $newRecord->total_finals_lab = null; 
        $newRecord->lab_finals_grade = null; 
        $newRecord->total_finals_grade = $actualTotalPointsLabFinals;
        $newRecord->tentative_finals_grade = $FinalsTentativeGradeLab;
        $newRecord->finals_grade = $rawFinalsGradeLab;
        $newRecord->adjusted_finals_grade = $adjustedFinalsGradeLab;
        $newRecord->save();
    }
} else {
    
    Grades::updateOrCreate(
        ['enrolled_student_id' => $enrolledStudentId, 'assessment_id' => null],
        ['finals_grade' => null]
    );
}
                    }
elseif ($subjectTypePercentage) {
      /////////////////////////////////////First grading////////////////////

      ////////////////////////Lec///////////////////////////
$hasLecRecords = $studentGrades
    ->where('assessment.grading_period', 'First Grading')
    ->whereIn('assessment.type', ['Quiz', 'OtherActivity', 'Exam'])
    ->count() > 0;

if ($hasLecRecords) {
    $firstGradingMaxPointsQuizzes = $studentGrades
        ->where('assessment.grading_period', 'First Grading')
        ->where('assessment.type', 'Quiz')
        ->sum('assessment.max_points');

    $firstGradingMaxPointsOtherActivity = $studentGrades
        ->where('assessment.grading_period', 'First Grading')
        ->whereIn('assessment.type', ['OtherActivity'])
        ->sum('assessment.max_points');

    $firstGradingMaxPointsExam = $studentGrades
        ->where('assessment.grading_period', 'First Grading')
        ->where('assessment.type', 'Exam')
        ->sum('assessment.max_points');

    $actualPointsQuizzes = $studentGrades
        ->where('assessment.grading_period', 'First Grading')
        ->where('assessment.type', 'Quiz')
       ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

     $bonusPointsQuiz =  $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->where('assessment.type', 'Additional Points Quiz')
            ->sum('points');

        
        $actualPointsQuizzes += $bonusPointsQuiz;

    $actualPointsOtherActivity = $studentGrades
        ->where('assessment.grading_period', 'First Grading')
        ->whereIn('assessment.type', ['OtherActivity'])
       ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

    $bonusPointsOT =  $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->where('assessment.type', 'Additional Points OT')
            ->sum('points');

        $actualPointsOtherActivity += $bonusPointsOT;

    $actualPointsExam = $studentGrades
        ->where('assessment.grading_period', 'First Grading')
        ->where('assessment.type', 'Exam')
       ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

    $bonusPointsExam =  $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->where('assessment.type', 'Additional Points Exam')
            ->sum('points');

        
        $actualPointsExam += $bonusPointsExam;

    //// calculate total points 
    $totalPointsLecFGRaw = (
        ($firstGradingMaxPointsQuizzes !== 0 ? ($actualPointsQuizzes / $firstGradingMaxPointsQuizzes) * 40 : 0) +
        ($firstGradingMaxPointsOtherActivity !== 0 ?  ($actualPointsOtherActivity / $firstGradingMaxPointsOtherActivity) * 20 : 0) +
        ($firstGradingMaxPointsExam !== 0 ? ($actualPointsExam / $firstGradingMaxPointsExam) * 40 : 0)
    );
    
    if ($totalPointsLecFGRaw > 100.0) {
            $totalPointsLecFGRaw = 100.0;
        }

    $totalPointsLecFG = round($totalPointsLecFGRaw, 1);
   
    //////// get the range of the total points in the transmutation table and return the official grade 
    $fgLecGradeInitial = $this->calculateOfficialGrade($totalPointsLecFG);
   // dd($fgLecGradeInitial);
    //////////////////////////Lab/////////////////////
    $hasLabRecords = $studentGrades
        ->where('assessment.grading_period', 'First Grading')
        ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
        ->count() > 0;

    if ($hasLabRecords) {
        $totalMaxPointsLab = $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
            ->sum('assessment.max_points');

        $actualTotalPointsLab = $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
           ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

        $bonusPointsLab =  $studentGrades
            ->where('assessment.grading_period', 'First Grading')
            ->where('assessment.type', 'Additional Points Lab')
            ->sum('points');

        
     $actualTotalPointsLab += $bonusPointsLab;
 
        $actualTotalPointsLab = min($actualTotalPointsLab, $totalMaxPointsLab);
       
        $totalMaxPointsLabFG = $totalMaxPointsLab;
        $totalActualPointsLabFG = round($actualTotalPointsLab, 1);

        $fgLabGradeInitial = $this->calculateLecLab6040OfficialGrade($totalActualPointsLabFG, $totalMaxPointsLabFG);

          // Calculate scores based on retrieved percentages
        $lecPercentage = $subjectTypePercentage->lec_percentage;
        $labPercentage = $subjectTypePercentage->lab_percentage;

        $FGLecGrade = $lecPercentage  * $fgLecGradeInitial;
        $FGLabGrade = $labPercentage  * $fgLabGradeInitial;

        $FGLecLab6040Grade = round($FGLecGrade + $FGLabGrade, 0);

        // dd($FGLecLab6040Grade);

        $existingRecord = Grades::where('enrolled_student_id', $enrolledStudentId)
            ->whereNull('assessment_id') /////filter records without assessment_id(from assessments table)
            ->first();

        if ($existingRecord) {
            ////update 
            $existingRecord->total_fg_lec = $totalPointsLecFGRaw; 
            $existingRecord->lec_fg_grade = $fgLecGradeInitial; 
            $existingRecord->total_fg_lab = $actualTotalPointsLab; 
            $existingRecord->lab_fg_grade = $fgLabGradeInitial; 
            $existingRecord->fg_grade = $FGLecLab6040Grade;
            $existingRecord->save();
        } else {
            /////create 
            $newRecord = new Grades();
            $newRecord->enrolled_student_id = $enrolledStudentId;
            $newRecord->assessment_id = null;
            $newRecord->points = null; 

            $newRecord->total_fg_lec = $totalPointsLecFGRaw; 
            $newRecord->lec_fg_grade = $fgLecGradeInitial; 
            $newRecord->total_fg_lab = $actualTotalPointsLab; 
            $newRecord->lab_fg_grade = $fgLabGradeInitial; 
            $newRecord->total_fg_grade = null; 
            $newRecord->tentative_fg_grade = null; 
            $newRecord->fg_grade = $FGLecLab6040Grade;

            $newRecord->total_midterms_lec = null; 
            $newRecord->lec_midterms_grade = null; 
            $newRecord->total_midterms_lab = null; 
            $newRecord->lab_midterms_grade = null; 
            $newRecord->total_midterms_grade = null;
            $newRecord->tentative_midterms_grade = null;
            $newRecord->midterms_grade = null;

            $newRecord->total_finals_lec = null; 
            $newRecord->lec_finals_grade = null; 
            $newRecord->total_finals_lab = null; 
            $newRecord->lab_finals_grade = null; 
            $newRecord->total_finals_grade = null;
            $newRecord->tentative_finals_grade = null;
            $newRecord->finals_grade = null;
            $newRecord->save();
        }
    } else {
        
        Grades::updateOrCreate(
            ['enrolled_student_id' => $enrolledStudentId, 'assessment_id' => null],
            ['fg_grade' => null]
        );
    }
} else {
    
    Grades::updateOrCreate(
        ['enrolled_student_id' => $enrolledStudentId, 'assessment_id' => null],
        ['fg_grade' => null]
    );
}
    
          ////////////////////////////////Midterms////////////////////////////////

     ////////////////////////Lec///////////////////////////
$hasLecRecordsMidterms = $studentGrades
    ->where('assessment.grading_period', 'Midterm')
    ->whereIn('assessment.type', ['Quiz', 'OtherActivity', 'Exam'])
    ->count() > 0;

if ($hasLecRecordsMidterms) {
    $midtermsMaxPointsQuizzes = $studentGrades
        ->where('assessment.grading_period', 'Midterm')
        ->where('assessment.type', 'Quiz')
        ->sum('assessment.max_points');

    $midtermsMaxPointsOtherActivity = $studentGrades
        ->where('assessment.grading_period', 'Midterm')
        ->whereIn('assessment.type', ['OtherActivity'])
        ->sum('assessment.max_points');

    $midtermsMaxPointsExam = $studentGrades
        ->where('assessment.grading_period', 'Midterm')
        ->where('assessment.type', 'Exam')
        ->sum('assessment.max_points');

    $actualPointsQuizzesMidterms = $studentGrades
        ->where('assessment.grading_period', 'Midterm')
        ->where('assessment.type', 'Quiz')
       ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

    $bonusPointsQuiz =  $studentGrades
         ->where('assessment.grading_period', 'Midterm')
         ->where('assessment.type', 'Additional Points Quiz')
         ->sum('points');

        
    $actualPointsQuizzesMidterms += $bonusPointsQuiz;


    $actualPointsOtherActivityMidterms = $studentGrades
        ->where('assessment.grading_period', 'Midterm')
        ->whereIn('assessment.type', ['OtherActivity'])
       ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

    $bonusPointsOT =  $studentGrades
                ->where('assessment.grading_period', 'Midterm')
                ->where('assessment.type', 'Additional Points OT')
                ->sum('points');

            $actualPointsOtherActivityMidterms += $bonusPointsOT;

    $actualPointsExamMidterms = $studentGrades
        ->where('assessment.grading_period', 'Midterm')
        ->where('assessment.type', 'Exam')
       ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

    $bonusPointsExam =  $studentGrades
                ->where('assessment.grading_period', 'Midterm')
                ->where('assessment.type', 'Additional Points Exam')
                ->sum('points');

        
    $actualPointsExamMidterms += $bonusPointsExam;

    //// calculate total points 
    $totalPointsLecMidtermsRaw = (
        ($midtermsMaxPointsQuizzes !== 0 ? ($actualPointsQuizzesMidterms / $midtermsMaxPointsQuizzes) * 40 : 0) +
        ($midtermsMaxPointsOtherActivity !== 0 ? ($actualPointsOtherActivityMidterms / $midtermsMaxPointsOtherActivity) * 20 : 0) +
        ($midtermsMaxPointsExam !== 0 ? ($actualPointsExamMidterms / $midtermsMaxPointsExam) * 40 : 0)
    );

    if ($totalPointsLecMidtermsRaw > 100.0) {
        $totalPointsLecMidtermsRaw = 100.0;
         }

    $totalPointsLecMidterms = round($totalPointsLecMidtermsRaw, 1);
    $midtermsLecGradeInitial = $this->calculateOfficialGrade($totalPointsLecMidterms);
    //dd( $midtermsLecGradeInitial);

    /////////////////////////////lab//////////////////////////////////
    $hasLabRecordsMidterms = $studentGrades
        ->where('assessment.grading_period', 'Midterm')
        ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
        ->count() > 0;

    if ($hasLabRecordsMidterms) {
        $totalMaxPointsLabMidterms = $studentGrades
            ->where('assessment.grading_period', 'Midterm')
            ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
            ->sum('assessment.max_points');

        $actualTotalPointsLabMidterms = $studentGrades
            ->where('assessment.grading_period', 'Midterm')
            ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
           ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

        $bonusPointsLab =  $studentGrades
            ->where('assessment.grading_period', 'Midterm')
            ->where('assessment.type', 'Additional Points Lab')
            ->sum('points');

        
        $actualTotalPointsLabMidterms  += $bonusPointsLab;

        $actualTotalPointsLabMidterms = min($actualTotalPointsLabMidterms, $totalMaxPointsLabMidterms);

        $totalMaxPointsLabMD = $totalMaxPointsLabMidterms;
        $totalActualPointsLabMD = round($actualTotalPointsLabMidterms, 1);
        //dd($totalActualPointsLab);
        $midtermsLabGradeInitial = $this->calculateLecLab6040OfficialGradeMidterms($totalActualPointsLabMD, $totalMaxPointsLabMD);

         // Calculate scores based on retrieved percentages
            $lecPercentage = $subjectTypePercentage->lec_percentage;
            $labPercentage = $subjectTypePercentage->lab_percentage;

        if ($FGLecLab6040Grade !== null) {
            $MDLecGrade = $lecPercentage * $midtermsLecGradeInitial;
            $MDLabGrade = $labPercentage * $midtermsLabGradeInitial;

            $TentativeMDLecLab6040Grade = $MDLecGrade + $MDLabGrade;

            ///=(1/3)*AG9+(2/3)*BH9
            $MDLecLab6040Grade = round((1 / 3) * $FGLecLab6040Grade + (2 / 3) * $TentativeMDLecLab6040Grade, 0);
            // dd($MDLecLab6040Grade);

            $existingRecord = Grades::where('enrolled_student_id', $enrolledStudentId)
                ->whereNull('assessment_id')
                ->first();

            if ($existingRecord) {

                $existingRecord->total_midterms_lec = $totalPointsLecMidtermsRaw; 
                $existingRecord->lec_midterms_grade = $midtermsLecGradeInitial; 
                $existingRecord->total_midterms_lab = $actualTotalPointsLabMidterms;
                $existingRecord->lab_midterms_grade = $midtermsLabGradeInitial;
                $existingRecord->tentative_midterms_grade = $TentativeMDLecLab6040Grade;
                $existingRecord->midterms_grade = $MDLecLab6040Grade;
                $existingRecord->save();
            } else {
                $newRecord = new Grades();
                $newRecord->enrolled_student_id = $enrolledStudentId;
                $newRecord->assessment_id = null;
                $newRecord->points = null;

                $newRecord->total_fg_lec = null; 
                $newRecord->lec_fg_grade = null; 
                $newRecord->total_fg_lab = null; 
                $newRecord->lab_fg_grade = null; 
                $newRecord->total_fg_grade = null; 
                $newRecord->tentative_fg_grade = null; 
                $newRecord->fg_grade = null;


                $newRecord->total_midterms_lec = $totalPointsLecMidtermsRaw;  
                $newRecord->lec_midterms_grade = $midtermsLecGradeInitial;
                $newRecord->total_midterms_lab = $actualTotalPointsLabMidterms;
                $newRecord->lab_midterms_grade = $midtermsLabGradeInitial;
                $newRecord->total_midterms_grade = null;
                $newRecord->tentative_midterms_grade = $TentativeMDLecLab6040Grade;
                $newRecord->midterms_grade = $MDLecLab6040Grade;

                $newRecord->total_finals_lec = null; 
                $newRecord->lec_finals_grade = null; 
                $newRecord->total_finals_lab = null; 
                $newRecord->lab_finals_grade = null; 
                $newRecord->total_finals_grade = null;
                $newRecord->tentative_finals_grade = null;
                $newRecord->finals_grade = null;
                $newRecord->save();
            }
        } else {
           
            Log::info('Midterms calculations skipped.');
        }
    } else {
        
        Grades::updateOrCreate(
            ['enrolled_student_id' => $enrolledStudentId, 'assessment_id' => null],
            ['midterms_grade' => null]
        );
    }
} else {
    
    Grades::updateOrCreate(
        ['enrolled_student_id' => $enrolledStudentId, 'assessment_id' => null],
        ['midterms_grade' => null]
    );
}

            ////////////////////////////////Finals////////////////////////////////
             ////////////////////////////////////LEC/////////////////////
$hasLecRecordsFinals = $studentGrades
    ->where('assessment.grading_period', 'Finals')
    ->whereIn('assessment.type', ['Quiz', 'OtherActivity', 'Exam'])
    ->count() > 0;

if ($hasLecRecordsFinals) {
    $finalsMaxPointsQuizzes = $studentGrades
        ->where('assessment.grading_period', 'Finals')
        ->where('assessment.type', 'Quiz')
        ->sum('assessment.max_points');

    $finalsMaxPointsOtherActivity = $studentGrades
        ->where('assessment.grading_period', 'Finals')
        ->whereIn('assessment.type', ['OtherActivity'])
        ->sum('assessment.max_points');

    $finalsMaxPointsExam = $studentGrades
        ->where('assessment.grading_period', 'Finals')
        ->where('assessment.type', 'Exam')
        ->sum('assessment.max_points');

    $actualPointsQuizzesFinals = $studentGrades
        ->where('assessment.grading_period', 'Finals')
        ->where('assessment.type', 'Quiz')
       ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

     $bonusPointsQuiz =  $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->where('assessment.type', 'Additional Points Quiz')
                ->sum('points');

            
            $actualPointsQuizzesFinals  += $bonusPointsQuiz;

    $actualPointsOtherActivityFinals = $studentGrades
        ->where('assessment.grading_period', 'Finals')
        ->whereIn('assessment.type', ['OtherActivity'])
       ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

    $bonusPointsOT =  $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->where('assessment.type', 'Additional Points OT')
                ->sum('points');

            $actualPointsOtherActivityFinals += $bonusPointsOT;


    $actualPointsExamFinals = $studentGrades
        ->where('assessment.grading_period', 'Finals')
        ->where('assessment.type', 'Exam')
       ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });

    $bonusPointsExam =  $studentGrades
                ->where('assessment.grading_period', 'Finals')
                ->where('assessment.type', 'Additional Points Exam')
                ->sum('points');

            
             $actualPointsExamFinals += $bonusPointsExam;

    //// calculate total points 
    $totalPointsLecFinalsRaw = (
        ($finalsMaxPointsQuizzes !== 0 ? ($actualPointsQuizzesFinals / $finalsMaxPointsQuizzes) * 40 : 0) +
        ($finalsMaxPointsOtherActivity !== 0 ? ($actualPointsOtherActivityFinals / $finalsMaxPointsOtherActivity) * 20 : 0) +
        ($finalsMaxPointsExam !== 0 ? ($actualPointsExamFinals / $finalsMaxPointsExam) * 40 : 0)
    );

     if ($totalPointsLecFinalsRaw > 100.0) {
        $totalPointsLecFinalsRaw = 100.0;
         }

    $totalPointsLecFinals = round($totalPointsLecFinalsRaw, 1);
    $finalsLecGradeInitial = $this->calculateOfficialGrade($totalPointsLecFinals);
    //dd($finalsLecGradeInitial);
    
    ////////////////////////////////Lab//////////////////////

    $hasLabRecordsFinals = $studentGrades
        ->where('assessment.grading_period', 'Finals')
        ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
        ->count() > 0;

    if ($hasLabRecordsFinals) {
        $totalMaxPointsLabFinals = $studentGrades
            ->where('assessment.grading_period', 'Finals') 
            ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
            ->sum('assessment.max_points');

        $actualTotalPointsLabFinals = $studentGrades
            ->where('assessment.grading_period', 'Finals')
            ->whereIn('assessment.type', ['Lab Activity', 'Lab Exam'])
           ->sum(function($grade) {
        return is_numeric($grade->points) ? $grade->points : 0;
    });


          $bonusPointsLab =  $studentGrades
            ->where('assessment.grading_period', 'Finals')
            ->where('assessment.type', 'Additional Points Lab')
            ->sum('points');

        
       $actualTotalPointsLabFinals  += $bonusPointsLab;

        $bonusPointsDirect = $studentGrades
            ->where('assessment.grading_period', 'Finals')
            ->where('assessment.type', 'Direct Bonus Grade')
            ->sum('points');



        $actualTotalPointsLabFinals = min($actualTotalPointsLabFinals, $totalMaxPointsLabFinals);

        $totalMaxPointsLabFN = $totalMaxPointsLabFinals;
        $totalActualPointsLabFN = round($actualTotalPointsLabFinals, 1); 
        //dd($totalActualPointsLab);
        $finalsLabGradeInitial = $this->calculateLecLab6040OfficialGradeFinals($totalActualPointsLabFN, $totalMaxPointsLabFN);       
        ///// calculate scores based on retrieved percentages from db
        $lecPercentage = $subjectTypePercentage->lec_percentage;
        $labPercentage = $subjectTypePercentage->lab_percentage;

        if ($MDLecLab6040Grade !== null) {
            $FNLecGrade = $lecPercentage * $finalsLecGradeInitial;  
            $FNLabGrade = $labPercentage * $finalsLabGradeInitial; 

            $TentativeFNLecLab6040Grade = $FNLecGrade + $FNLabGrade;
            //dd($TentativeFNLecLab6040Grade);

            ///=(1/3)*BK9+(2/3)*CM9+CN9
          
            $rawFNLecLab6040Grade = round((1 / 3) * $MDLecLab6040Grade + (2 / 3) * $TentativeFNLecLab6040Grade, 0);

            
            $adjustedFNLecLab6040Grade = $rawFNLecLab6040Grade + $bonusPointsDirect;
            //dd($FNLecLab6040Grade);


           $rawFNLecLab6040Grade = max(65, $rawFNLecLab6040Grade);
           $adjustedFNLecLab6040Grade = max(65, $adjustedFNLecLab6040Grade);

             if ($adjustedFNLecLab6040Grade < 70) {
                    $adjustedFNLecLab6040Grade = 70;
                }


            $existingRecord = Grades::where('enrolled_student_id', $enrolledStudentId)
                ->whereNull('assessment_id') 
                ->first();

            if ($existingRecord) {

                $existingRecord->total_finals_lec = $totalPointsLecFinalsRaw; 
                $existingRecord->lec_finals_grade =  $finalsLecGradeInitial;
                $existingRecord->total_finals_lab =  $actualTotalPointsLabFinals;
                $existingRecord->lab_finals_grade = $finalsLabGradeInitial;
                $existingRecord->tentative_finals_grade = $TentativeFNLecLab6040Grade; 
                $existingRecord->finals_grade = $rawFNLecLab6040Grade;
                $existingRecord->adjusted_finals_grade = $adjustedFNLecLab6040Grade;
                $existingRecord->save();
            } else {
                $newRecord = new Grades();
                $newRecord->enrolled_student_id = $enrolledStudentId;
                $newRecord->assessment_id = null; 
                $newRecord->points = null; 

                $newRecord->total_fg_lec = null; 
                $newRecord->lec_fg_grade = null; 
                $newRecord->total_fg_lab = null; 
                $newRecord->lab_fg_grade = null; 
                $newRecord->total_fg_grade = null; 
                $newRecord->tentative_fg_grade = null; 
                $newRecord->fg_grade = null;

                $newRecord->total_midterms_lec = null; 
                $newRecord->lec_midterms_grade = null; 
                $newRecord->total_midterms_lab = null; 
                $newRecord->lab_midterms_grade = null; 
                $newRecord->total_midterms_grade = null;
                $newRecord->tentative_midterms_grade = null;
                $newRecord->midterms_grade = null; 

                $newRecord->total_finals_lec = $totalPointsLecFinalsRaw; 
                $newRecord->lec_finals_grade = $finalsLecGradeInitial;
                $newRecord->total_finals_lab = $actualTotalPointsLabFinals;
                $newRecord->lab_finals_grade = $finalsLabGradeInitial;
                $newRecord->total_finals_grade = null;
                $newRecord->tentative_finals_grade = $TentativeFNLecLab6040Grade; 
                $newRecord->finals_grade = $rawFNLecLab6040Grade;
                $newRecord->adjusted_finals_grade = $adjustedFNLecLab6040Grade;
                $newRecord->save();
            }
        } else {
            
            Log::info('Finals calculations skipped.');
        }
    } else {
        
        Grades::updateOrCreate(
            ['enrolled_student_id' => $enrolledStudentId, 'assessment_id' => null],
            ['finals_grade' => null]
        );
    }
} else {
    
    Grades::updateOrCreate(
        ['enrolled_student_id' => $enrolledStudentId, 'assessment_id' => null],
        ['finals_grade' => null]
    );
}
}

 else {
   
    Log::info('unknown subject type: ' . $subjectType);
  }
       }
    }
    return redirect()->back();
    }

/////////////////////////////////FOR LEC TYPE///////////////////////////////
public function calculateOfficialGrade($totalPoints)
{
    $transmutationTable = TransmutationService::getTransmutationTable();
    $officialGrade = null;

    foreach ($transmutationTable as $row) {
        if ($totalPoints >= $row['range_start'] && $totalPoints <= $row['range_end']) {
            $officialGrade = $row['official_grade'];
            break;
        }
    }

    return $officialGrade;
}


///////////////////////////////////////FOR LAB TYPE//////////////////////////////////////


/////////////////////////first grading
public function calculateLabOfficialGrade($totalActualPointsLab,  $totalMaxPointsLab)
{
    $ranges = TransmutationService::getLabTransmutationTable($totalMaxPointsLab);
    $officialGradeLab = null;

    foreach ($ranges as $range) {
        if ($totalActualPointsLab >= $range['range_start'] && $totalActualPointsLab <= $range['range_end']) {
            $officialGradeLab = $range['official_grade'];
            break;
        }
    }


    return $officialGradeLab;
}
////////////////////////////Midterms
public function calculateLabOfficialGradeMidterms($totalActualPointsLabMidterms,  $totalMaxPointsLabMidterms)
{
    $ranges = TransmutationService::getLabTransmutationTableMidterms($totalMaxPointsLabMidterms);
    $officialGradeLab = null;

    foreach ($ranges as $range) {
        if ($totalActualPointsLabMidterms >= $range['range_start'] && $totalActualPointsLabMidterms <= $range['range_end']) {
            $officialGradeLab = $range['official_grade'];
            break;
        }
    }


    return $officialGradeLab;
}

////////////////////////////Finals
public function calculateLabOfficialGradeFinals($totalActualPointsLabFinals,  $totalMaxPointsLabFinals)
{
    $ranges = TransmutationService::getLabTransmutationTableFinals($totalMaxPointsLabFinals);
    $officialGradeLab = null;

    foreach ($ranges as $range) {
        if ($totalActualPointsLabFinals >= $range['range_start'] && $totalActualPointsLabFinals <= $range['range_end']) {
            $officialGradeLab = $range['official_grade'];
            break;
        }
    }


    return $officialGradeLab;
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////FOR LECLAB6040 TYPE//////////////////////////////////////


/////////////////////////first grading
public function calculateLecLab6040OfficialGrade($totalActualPointsLabFG,  $totalMaxPointsLabFG)
{
    $ranges = TransmutationLecLab6040Service::getLabTransmutationTable($totalMaxPointsLabFG);
    $officialGradeLab = null;

    foreach ($ranges as $range) {
        if ($totalActualPointsLabFG >= $range['range_start'] && $totalActualPointsLabFG <= $range['range_end']) {
            $officialGradeLab = $range['official_grade'];
            break;
        }
    }


    return $officialGradeLab;
}
////////////////////////////Midterms
public function calculateLecLab6040OfficialGradeMidterms($totalActualPointsLabMD,  $totalMaxPointsLabMD)
{
    $ranges = TransmutationLecLab6040Service::getLabTransmutationTableMidterms($totalMaxPointsLabMD);
    $officialGradeLab = null;

    foreach ($ranges as $range) {
        if ($totalActualPointsLabMD >= $range['range_start'] && $totalActualPointsLabMD <= $range['range_end']) {
            $officialGradeLab = $range['official_grade'];
            break;
        }
    }


    return $officialGradeLab;
}

////////////////////////////Finals
public function calculateLecLab6040OfficialGradeFinals($totalActualPointsLabFinals,  $totalMaxPointsLabFinals)
{
    $ranges = TransmutationLecLab6040Service::getLabTransmutationTableFinals($totalMaxPointsLabFinals);
    $officialGradeLab = null;

    foreach ($ranges as $range) {
        if ($totalActualPointsLabFinals >= $range['range_start'] && $totalActualPointsLabFinals <= $range['range_end']) {
            $officialGradeLab = $range['official_grade'];
            break;
        }
    }


    return $officialGradeLab;
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////



///////////////////////////////////////FOR LECLAB4060 TYPE//////////////////////////////////////


/////////////////////////first grading
public function calculateLecLab4060OfficialGrade($totalActualPointsLabFG,  $totalMaxPointsLabFG)
{
    $ranges = TransmutationLecLab4060Service::getLab4060TransmutationTable($totalMaxPointsLabFG);
    $officialGradeLab = null;

    foreach ($ranges as $range) {
        if ($totalActualPointsLabFG >= $range['range_start'] && $totalActualPointsLabFG <= $range['range_end']) {
            $officialGradeLab = $range['official_grade'];
            break;
        }
    }


    return $officialGradeLab;
}
////////////////////////////Midterms
public function calculateLecLab4060OfficialGradeMidterms($totalActualPointsLabMD,  $totalMaxPointsLabMD)
{
    $ranges = TransmutationLecLab4060Service::getLab4060TransmutationTableMidterms($totalMaxPointsLabMD);
    $officialGradeLab = null;

    foreach ($ranges as $range) {
        if ($totalActualPointsLabMD >= $range['range_start'] && $totalActualPointsLabMD <= $range['range_end']) {
            $officialGradeLab = $range['official_grade'];
            break;
        }
    }


    return $officialGradeLab;
}

////////////////////////////Finals
public function calculateLecLab4060OfficialGradeFinals($totalActualPointsLabFinals,  $totalMaxPointsLabFinals)
{
    $ranges = TransmutationLecLab4060Service::getLab4060TransmutationTableFinals($totalMaxPointsLabFinals);
    $officialGradeLab = null;

    foreach ($ranges as $range) {
        if ($totalActualPointsLabFinals >= $range['range_start'] && $totalActualPointsLabFinals <= $range['range_end']) {
            $officialGradeLab = $range['official_grade'];
            break;
        }
    }


    return $officialGradeLab;
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////


///////////////////////////////////////FOR LECLAB5050 TYPE//////////////////////////////////////


/////////////////////////first grading
public function calculateLecLab5050OfficialGrade($totalActualPointsLabFG,  $totalMaxPointsLabFG)
{
    $ranges = TransmutationLecLab5050Service::getLab5050TransmutationTable($totalMaxPointsLabFG);
    $officialGradeLab = null;

    foreach ($ranges as $range) {
        if ($totalActualPointsLabFG >= $range['range_start'] && $totalActualPointsLabFG <= $range['range_end']) {
            $officialGradeLab = $range['official_grade'];
            break;
        }
    }


    return $officialGradeLab;
}
////////////////////////////Midterms
public function calculateLecLab5050OfficialGradeMidterms($totalActualPointsLabMD,  $totalMaxPointsLabMD)
{
    $ranges = TransmutationLecLab5050Service::getLab5050TransmutationTableMidterms($totalMaxPointsLabMD);
    $officialGradeLab = null;

    foreach ($ranges as $range) {
        if ($totalActualPointsLabMD >= $range['range_start'] && $totalActualPointsLabMD <= $range['range_end']) {
            $officialGradeLab = $range['official_grade'];
            break;
        }
    }


    return $officialGradeLab;
}

////////////////////////////Finals
public function calculateLecLab5050OfficialGradeFinals($totalActualPointsLabFinals,  $totalMaxPointsLabFinals)
{
    $ranges = TransmutationLecLab5050Service::getLab5050TransmutationTableFinals($totalMaxPointsLabFinals);
    $officialGradeLab = null;

    foreach ($ranges as $range) {
        if ($totalActualPointsLabFinals >= $range['range_start'] && $totalActualPointsLabFinals <= $range['range_end']) {
            $officialGradeLab = $range['official_grade'];
            break;
        }
    }


    return $officialGradeLab;
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////


 public function getEnrolledStudentAssessmentGrades(Request $request)
{

$enrolledStudents = EnrolledStudent::with('student')->get();
$assessments = Assessment::all();
$grades = Grade::all();



return view('teacher.list.studentlist', compact('enrolledStudents', 'assessments', 'grades'));

}


///////not used 
  public function updateScore(Request $request, $enrolledStudentId)
   {
   
   $enrolledStudent = EnrolledStudents::findOrFail($enrolledStudentId);
    //////get input data from the dropdown(Grading Period dropdwon-studentlist.blade)
    $gradingPeriod = $request->input('grading_period');
    $assessmentId = $request->input('assessment_id');
    $points = $request->input('points');

///////
    ////////get the score record for the specified grading period
     $grade = $enrolledStudent->grades()
        ->where('grading_period', $gradingPeriod)
        ->where('assessment_id', $assessmentId)
        ->first();      
    

    if ($grade) {
        $grade->update(['points' => $points]);
    } else {
        $grade = new Grades([
            'grading_period' => $gradingPeriod,
            'assessment_id' => $assessmentId,
            'points' => $points,
        ]);

        $enrolledStudent->grades()->save($grade);
    }

    return response()->json($grade);
     }


/////(WIP) for getting the scores base from slected grading period
  public function getScores(Request $request)
   {        

   
        $studentId = $request->input('studentId');
        $gradingPeriod = $request->input('gradingPeriod');
        $assessmentId = $request->input('assessmentId');

        $grade = Grades::where('enrolled_student_id', $studentId)
            ->where('grading_period', $gradingPeriod)
            ->where('assessment_id', $assessmentId)
            ->first();

        return response()->json($grade);
     }
}