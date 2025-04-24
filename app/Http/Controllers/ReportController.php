<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnrolledStudents;
use App\Models\Assessment;
use App\Models\Subject;
use App\Models\ImportedClasslist;
use App\Exports\StudentReportExport;
use App\Exports\StudentGradeExport;
use App\Exports\StudentsSummaryExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
   public function index($subjectId)
{
   
    $students = EnrolledStudents::with(['student', 'grades'])
        ->whereHas('importedClasses', function ($query) use ($subjectId) {
            $query->where('subjects_id', $subjectId);
        })
        ->get();

    $passPercentage = $students->filter(function ($student) {
        return $student->grades->avg('finals_grade') >= 75;
    })->count() / $students->count() * 100;

    $failPercentage = 100 - $passPercentage;


    $sortedStudents = collect($students)->groupBy('student.gender');

    return view('teacher.list.report', compact('students', 'passPercentage', 'failPercentage', 'subjectId', 'sortedStudents'));
}


private function generateAssessmentHeaders($students, $assessments, $midtermAssessments, $finalsAssessments, $subject)
{
    $assessmentHeaderRow = ['ID', 'Student Name', 'Course'];
    $assessmentMaxPointsRow = ['', '', ''];
    $assessmentTypeHeaderRow = ['', '', ''];
    $gradingPeriodHeaderRow = ['', '', ''];

    $uniqueGradingPeriods = [];
    $previousAssessmentType = null;
    $lastSpecifiedAssessmentType = null;
    $addedTotalLecHeader = false;

    $assessmentTypeTotals = [];
    $tHeaderIndexes = [];

    foreach ($assessments as $assessment) {
        if ($previousAssessmentType !== $assessment->type) {
            if ($previousAssessmentType) {
                $assessmentHeaderRow[] = 'T';
                $assessmentMaxPointsRow[] = $assessmentTypeTotals[$previousAssessmentType];
                $assessmentTypeHeaderRow[] = '';
                $gradingPeriodHeaderRow[] = '';

                $tHeaderIndexes[$previousAssessmentType] = count($assessmentHeaderRow) - 1;
            }

            $assessmentTypeTotals[$assessment->type] = 0;

            $assessmentHeaderRow[] = $assessment->abbreviation;
            $assessmentMaxPointsRow[] = intval($assessment->max_points);
            $assessmentTypeHeaderRow[] = $assessment->type;

            if (!in_array($assessment->grading_period, $uniqueGradingPeriods)) {
                $gradingPeriodHeaderRow[] = $assessment->grading_period;
                $uniqueGradingPeriods[] = $assessment->grading_period;
            } else {
                $gradingPeriodHeaderRow[] = '';
            }

            $previousAssessmentType = $assessment->type;

            if (in_array($assessment->type, ['Quiz', 'OtherActivity', 'Exam'])) {
                $lastSpecifiedAssessmentType = $assessment->type;
            }
        } else {
            $assessmentHeaderRow[] = $assessment->abbreviation;
            $assessmentMaxPointsRow[] = intval($assessment->max_points);
            $assessmentTypeHeaderRow[] = '';

            if (!in_array($assessment->grading_period, $uniqueGradingPeriods)) {
                $gradingPeriodHeaderRow[] = $assessment->grading_period;
                $uniqueGradingPeriods[] = $assessment->grading_period;
            } else {
                $gradingPeriodHeaderRow[] = '';
            }
        }

        $assessmentTypeTotals[$assessment->type] += intval($assessment->max_points);
    }

    if (strpos($subject->subject_type, 'LecLab') !== false) {
        if ($lastSpecifiedAssessmentType && !$addedTotalLecHeader) {
            $lastTIndex = isset($tHeaderIndexes[$lastSpecifiedAssessmentType]) ? $tHeaderIndexes[$lastSpecifiedAssessmentType] : -1;

            if ($lastTIndex !== -1) {
                array_splice($assessmentHeaderRow, $lastTIndex + 1, 0, ['', 'Grade']);
                array_splice($assessmentMaxPointsRow, $lastTIndex + 1, 0, ['', '']);
                array_splice($assessmentTypeHeaderRow, $lastTIndex + 1, 0, ['Total', 'Lec']);
                array_splice($gradingPeriodHeaderRow, $lastTIndex + 1, 0, ['', '']);

                $addedTotalLecHeader = true;
            }
        }
    }

    if ($previousAssessmentType) {
        $assessmentHeaderRow[] = 'T';
        $assessmentMaxPointsRow[] = $assessmentTypeTotals[$previousAssessmentType];
        $assessmentTypeHeaderRow[] = '';
        $gradingPeriodHeaderRow[] = '';
    }

    $hasFGAssessments = count($assessments) > 0;

    if (strpos($subject->subject_type, 'LecLab') !== false) {
        if ($hasFGAssessments) {
            $assessmentHeaderRow[] = '';
            $assessmentMaxPointsRow[] = '';
            $assessmentTypeHeaderRow[] = 'Total';
            $gradingPeriodHeaderRow[] = '';
        }

        if ($hasFGAssessments) {
            $assessmentHeaderRow[] = 'Grade';
            $assessmentMaxPointsRow[] = '';
            $assessmentTypeHeaderRow[] = 'Lab';
            $gradingPeriodHeaderRow[] = '';
        }

        if ($hasFGAssessments) {
            $assessmentHeaderRow[] = 'Grade';
            $assessmentMaxPointsRow[] = '';
            $assessmentTypeHeaderRow[] = '1st Grading';
            $gradingPeriodHeaderRow[] = '';
        }
    } else {
        if ($hasFGAssessments) {
            $assessmentHeaderRow[] = '';
            $assessmentMaxPointsRow[] = '';
            $assessmentTypeHeaderRow[] = 'Total';
            $gradingPeriodHeaderRow[] = '';
        }

        if ($hasFGAssessments) {
            $assessmentHeaderRow[] = 'Grade';
            $assessmentMaxPointsRow[] = '';
            $assessmentTypeHeaderRow[] = '1st Grading';
            $gradingPeriodHeaderRow[] = '';
        }
    }

///////////////////MIDTERMS///////////////////////////////////
$previousMidtermAssessmentType = null;
$lastSpecifiedMidtermAssessmentType = null; 
$addedTotalLecHeaderMidterm = false; 

$midtermAssessmentTypeTotals = [];
$tHeaderIndexesMidterm = []; 

foreach ($midtermAssessments as $midtermAssessment) {
    if ($previousMidtermAssessmentType !== $midtermAssessment->type) {

        if ($previousMidtermAssessmentType) {
            $assessmentHeaderRow[] = 'T';
            $assessmentMaxPointsRow[] = $midtermAssessmentTypeTotals[$previousMidtermAssessmentType];
            $assessmentTypeHeaderRow[] = ''; 
            $gradingPeriodHeaderRow[] = ''; 

            
            $tHeaderIndexesMidterm[$previousMidtermAssessmentType] = count($assessmentHeaderRow) - 1;
        }

        $midtermAssessmentTypeTotals[$midtermAssessment->type] = 0;

        $assessmentHeaderRow[] = $midtermAssessment->abbreviation;
        $assessmentMaxPointsRow[] = intval($midtermAssessment->max_points);
        $assessmentTypeHeaderRow[] = $midtermAssessment->type;

        if (!in_array($midtermAssessment->grading_period, $uniqueGradingPeriods)) {
            $gradingPeriodHeaderRow[] = $midtermAssessment->grading_period;
            $uniqueGradingPeriods[] = $midtermAssessment->grading_period;
        } else {
            $gradingPeriodHeaderRow[] = ''; 
        }

        $previousMidtermAssessmentType = $midtermAssessment->type;

        
        if (in_array($midtermAssessment->type, ['Quiz', 'OtherActivity', 'Exam'])) {
            $lastSpecifiedMidtermAssessmentType = $midtermAssessment->type;
        }
    } else {
        $assessmentHeaderRow[] = $midtermAssessment->abbreviation;
        $assessmentMaxPointsRow[] = intval($midtermAssessment->max_points);
        $assessmentTypeHeaderRow[] = ''; 

        if (!in_array($midtermAssessment->grading_period, $uniqueGradingPeriods)) {
            $gradingPeriodHeaderRow[] = $midtermAssessment->grading_period;
            $uniqueGradingPeriods[] = $midtermAssessment->grading_period;
        } else {
            $gradingPeriodHeaderRow[] = '';
        }
    }

    $midtermAssessmentTypeTotals[$midtermAssessment->type] += intval($midtermAssessment->max_points);
}

if (strpos($subject->subject_type, 'LecLab') !== false) {
    if ($lastSpecifiedMidtermAssessmentType && !$addedTotalLecHeaderMidterm) {
        
        $lastTIndexMidterm = isset($tHeaderIndexesMidterm[$lastSpecifiedMidtermAssessmentType]) ? $tHeaderIndexesMidterm[$lastSpecifiedMidtermAssessmentType] : -1;

        if ($lastTIndexMidterm !== -1) {
           
            array_splice($assessmentHeaderRow, $lastTIndexMidterm + 1, 0, ['', 'Grade']);
            array_splice($assessmentMaxPointsRow, $lastTIndexMidterm + 1, 0, ['', '']);
            array_splice($assessmentTypeHeaderRow, $lastTIndexMidterm + 1, 0, ['Total', 'Lec']); 
            array_splice($gradingPeriodHeaderRow, $lastTIndexMidterm + 1, 0, ['', '']);

            $addedTotalLecHeaderMidterm = true; 
        }
    }
}

if ($previousMidtermAssessmentType) {
    $assessmentHeaderRow[] = 'T';
    $assessmentMaxPointsRow[] = $midtermAssessmentTypeTotals[$previousMidtermAssessmentType];
    $assessmentTypeHeaderRow[] = ''; 
    $gradingPeriodHeaderRow[] = ''; 
}

$hasMidtermAssessments = count($midtermAssessments) > 0;


             if (strpos($subject->subject_type, 'LecLab') !== false) {
                    if ($hasMidtermAssessments) {
                        $assessmentHeaderRow[] = '';
                        $assessmentMaxPointsRow[] = '';
                        $assessmentDateRow[] = '';
                        $assessmentTypeHeaderRow[] = 'Total';
                        $gradingPeriodHeaderRow[] = '';
                    }

                    if ($hasMidtermAssessments) {
                        $assessmentHeaderRow[] = 'Grade';
                        $assessmentMaxPointsRow[] = '';
                        $assessmentDateRow[] = '';
                        $assessmentTypeHeaderRow[] = 'Lab';
                        $gradingPeriodHeaderRow[] = '';
                    }

                    if ($hasMidtermAssessments) {
                        $assessmentHeaderRow[] = 'Grade';
                        $assessmentMaxPointsRow[] = '';
                        $assessmentDateRow[] = '';
                        $assessmentTypeHeaderRow[] = 'TM';
                        $gradingPeriodHeaderRow[] = '';
                    }

                     if ($hasMidtermAssessments) {
                        $assessmentHeaderRow[] = 'Grade';
                        $assessmentMaxPointsRow[] = '';
                        $assessmentDateRow[] = '';
                        $assessmentTypeHeaderRow[] = 'Midterm';
                        $gradingPeriodHeaderRow[] = '';
                    }
                } else {
                    if ($hasMidtermAssessments) {
                        $assessmentHeaderRow[] = '';
                        $assessmentMaxPointsRow[] = '';
                        $assessmentDateRow[] = '';
                        $assessmentTypeHeaderRow[] = 'Total';
                        $gradingPeriodHeaderRow[] = '';
                    }

                    if ($hasMidtermAssessments) {
                        $assessmentHeaderRow[] = 'Grade';
                        $assessmentMaxPointsRow[] = '';
                        $assessmentDateRow[] = '';
                        $assessmentTypeHeaderRow[] = 'TM';
                        $gradingPeriodHeaderRow[] = '';
                    }

                    if ($hasMidtermAssessments) {
                        $assessmentHeaderRow[] = 'Grade';
                        $assessmentMaxPointsRow[] = '';
                        $assessmentDateRow[] = '';
                        $assessmentTypeHeaderRow[] = 'Midterm';
                        $gradingPeriodHeaderRow[] = '';
                    }
                    }

    ///////////////////////FINALS/////////////////////////////////////////////////////////////

        $previousFinalsAssessmentType = null;
        $lastSpecifiedFinalsAssessmentType = null; 
        $addedTotalLecHeaderFinals = false;

        $finalsAssessmentTypeTotals = [];
        $tHeaderIndexesFinals = [];

        foreach ($finalsAssessments as $finalsAssessment) {

            ///skips DBG if it exist in the loop, so it will not show up beside the other assessment types
            if ($finalsAssessment->type === 'Direct Bonus Grade') {
                continue; 
            }

            if ($previousFinalsAssessmentType !== $finalsAssessment->type) {
                if ($previousFinalsAssessmentType) {
                    $assessmentHeaderRow[] = 'T';
                    $assessmentMaxPointsRow[] = $finalsAssessmentTypeTotals[$previousFinalsAssessmentType] ?? 0;
                    $assessmentTypeHeaderRow[] = ''; 
                    $gradingPeriodHeaderRow[] = ''; 

                    $tHeaderIndexesFinals[$previousFinalsAssessmentType] = count($assessmentHeaderRow) - 1;
                }

                $finalsAssessmentTypeTotals[$finalsAssessment->type] = 0;

                $assessmentHeaderRow[] = $finalsAssessment->abbreviation;
                $assessmentMaxPointsRow[] = intval($finalsAssessment->max_points);
                $assessmentDateRow[] = $finalsAssessment->activity_date;
                $assessmentTypeHeaderRow[] = $finalsAssessment->type;

                if (!in_array($finalsAssessment->grading_period, $uniqueGradingPeriods)) {
                    $gradingPeriodHeaderRow[] = $finalsAssessment->grading_period;
                    $uniqueGradingPeriods[] = $finalsAssessment->grading_period;
                } else {
                    $gradingPeriodHeaderRow[] = ''; 
                }

                $previousFinalsAssessmentType = $finalsAssessment->type;

                if (in_array($finalsAssessment->type, ['Quiz', 'OtherActivity', 'Exam'])) {
                    $lastSpecifiedFinalsAssessmentType = $finalsAssessment->type;
                }
            } else {
                $assessmentHeaderRow[] = $finalsAssessment->abbreviation;
                $assessmentMaxPointsRow[] = intval($finalsAssessment->max_points);
                $assessmentDateRow[] = $finalsAssessment->activity_date;
                $assessmentTypeHeaderRow[] = ''; 

                if (!in_array($finalsAssessment->grading_period, $uniqueGradingPeriods)) {
                    $gradingPeriodHeaderRow[] = $finalsAssessment->grading_period;
                    $uniqueGradingPeriods[] = $finalsAssessment->grading_period;
                } else {
                    $gradingPeriodHeaderRow[] = '';
                }
            }

            $finalsAssessmentTypeTotals[$finalsAssessment->type] += intval($finalsAssessment->max_points);
        }

        ////// add Total Lec and Lec Grade header only for LecLab subjects
        if ($lastSpecifiedFinalsAssessmentType && !$addedTotalLecHeaderFinals && strpos($subject->subject_type, 'LecLab') !== false) {
            $lastTIndexFinals = isset($tHeaderIndexesFinals[$lastSpecifiedFinalsAssessmentType]) ? $tHeaderIndexesFinals[$lastSpecifiedFinalsAssessmentType] : -1;

            if ($lastTIndexFinals !== -1) {
                array_splice($assessmentHeaderRow, $lastTIndexFinals + 1, 0, ['', 'Grade']);
                array_splice($assessmentMaxPointsRow, $lastTIndexFinals + 1, 0, ['', '']);
                array_splice($assessmentTypeHeaderRow, $lastTIndexFinals + 1, 0, ['Total', 'Lec']); 
                array_splice($gradingPeriodHeaderRow, $lastTIndexFinals + 1, 0, ['', '']);

                $addedTotalLecHeaderFinals = true; 
            }
        }

        if ($previousFinalsAssessmentType) {
            $assessmentHeaderRow[] = 'T';
            $assessmentMaxPointsRow[] = $finalsAssessmentTypeTotals[$previousFinalsAssessmentType] ?? 0;
            $assessmentTypeHeaderRow[] = '';
            $gradingPeriodHeaderRow[] = '';
        }

        $hasFinalsAssessments = count($finalsAssessments) > 0;

        if ($hasFinalsAssessments) {
            if (strpos($subject->subject_type, 'LecLab') !== false) {
                $assessmentHeaderRow[] = '';
                $assessmentMaxPointsRow[] = '';
                $assessmentDateRow[] = '';
                $assessmentTypeHeaderRow[] = 'Total';
                $gradingPeriodHeaderRow[] = '';

                $assessmentHeaderRow[] = 'Grade';
                $assessmentMaxPointsRow[] = '';
                $assessmentDateRow[] = '';
                $assessmentTypeHeaderRow[] = 'Lab';
                $gradingPeriodHeaderRow[] = '';

                $assessmentHeaderRow[] = 'Grade';
                $assessmentMaxPointsRow[] = '';
                $assessmentDateRow[] = '';
                $assessmentTypeHeaderRow[] = 'TF';
                $gradingPeriodHeaderRow[] = '';

                if ($finalsAssessment->where('type', 'Direct Bonus Grade')->count() > 0) {
                $assessmentHeaderRow[] = ''; 
                $assessmentMaxPointsRow[] = '';
                $assessmentDateRow[] = '';
                $assessmentTypeHeaderRow[] = $finalsAssessment->abbreviation;
                $gradingPeriodHeaderRow[] = '';
                 }

                $assessmentHeaderRow[] = 'Grade';
                $assessmentMaxPointsRow[] = '';
                $assessmentDateRow[] = '';
                $assessmentTypeHeaderRow[] = 'Final';
                $gradingPeriodHeaderRow[] = '';
            } else {
                $assessmentHeaderRow[] = '';
                $assessmentMaxPointsRow[] = '';
                $assessmentDateRow[] = '';
                $assessmentTypeHeaderRow[] = 'Total';
                $gradingPeriodHeaderRow[] = '';

                $assessmentHeaderRow[] = 'Grade';
                $assessmentMaxPointsRow[] = '';
                $assessmentDateRow[] = '';
                $assessmentTypeHeaderRow[] = 'TF';
                $gradingPeriodHeaderRow[] = '';

                if ($finalsAssessment->where('type', 'Direct Bonus Grade')->count() > 0) {
                $assessmentHeaderRow[] = ''; 
                $assessmentMaxPointsRow[] = '';
                $assessmentDateRow[] = '';
                $assessmentTypeHeaderRow[] = $finalsAssessment->abbreviation;
                $gradingPeriodHeaderRow[] = '';
                 }

                $assessmentHeaderRow[] = 'Grade';
                $assessmentMaxPointsRow[] = '';
                $assessmentDateRow[] = '';
                $assessmentTypeHeaderRow[] = 'Final';
                $gradingPeriodHeaderRow[] = '';
            }
        }

        $assessmentRows = [
            $gradingPeriodHeaderRow,
            $assessmentTypeHeaderRow,
            $assessmentHeaderRow,
            $assessmentMaxPointsRow,
        ];


    $sortedStudents = collect($students)->groupBy('student.gender')
                                                    ->map(function ($group) {
                                                        return $group->sortBy([
                                                            ['student.last_name', 'asc'], 
                                                              ['student.name', 'asc'],    
                                                            ]);
                                                        });

        foreach ($sortedStudents as $gender => $students) {
            $assessmentRows[] = ['colspan' => count($assessmentHeaderRow), 'value' => $gender];

            foreach ($students as $student) {
                $assessmentRow = [
                    $student->student->id_number,
                    $student->student->last_name . ', ' . $student->student->name . ' ' . $student->student->middle_name,
                    $student->student->course,
                ];

                $assessmentTypeTotals = []; 
                $lastAssessmentType = null;

        foreach ($assessments as $index => $assessment) {
            $score = $student->getScore($assessment->id);
            $assessmentRow[] = $score;

            
            if (is_numeric($score)) {
                $assessmentTypeTotals[$assessment->type] = ($assessmentTypeTotals[$assessment->type] ?? 0) + $score;
            }

            $isLastColumn = ($index === (count($assessments) - 1));
            $isLastColumnOfType = ($isLastColumn || $assessment->type !== $assessments[$index + 1]->type);

         
            if ($isLastColumnOfType) {
                $assessmentRow[] = $assessmentTypeTotals[$assessment->type] ?? ''; 
            }

            $lastAssessmentType = $assessment->type;
        }
 ////////for LecLab type columns total/lec grade - Fg////
        if (strpos($subject->subject_type, 'LecLab') !== false) {
            if ($hasFGAssessments) {
             
                $totalLec = 0;
                $lecGrade = 0;

                foreach ($student->grades as $grade) {
                    $totalLec += $grade->total_fg_lec;
                    $lecGrade += $grade->lec_fg_grade;
                }

       
                $lastTIndex = isset($tHeaderIndexes[$lastSpecifiedAssessmentType]) ? $tHeaderIndexes[$lastSpecifiedAssessmentType] : -1;

                if ($lastTIndex !== -1) {
              
                    array_splice($assessmentRow, $lastTIndex + 1, 0, [$totalLec, $lecGrade]);
                }
            }
        }


             ////////for LecLab type columns Fg////
               if (strpos($subject->subject_type, 'LecLab') !== false) {
                   if ($hasFGAssessments) {
                        $totalLab = 0;
                        foreach ($student->grades as $grade) {
                            $totalLab += $grade->total_fg_lab;
                        }
                        $assessmentRow[] = $totalLab;
                    }

                     if ($hasFGAssessments) {
                        $labGrade = 0;
                        foreach ($student->grades as $grade) {
                            $labGrade += $grade->lab_fg_grade;
                        }
                        $assessmentRow[] = $labGrade;
                    }


                    if ($hasFGAssessments) {
                            $assessmentRow[] = $student->grades->avg('fg_grade');
                        }


                } else {
                      ////////for lec type and lab type columns Fg////
                       if ($hasFGAssessments) {
                            $totalFgGrade = 0;
                            foreach ($student->grades as $grade) {
                                $totalFgGrade += $grade->total_fg_grade;
                            }
                            $assessmentRow[] = $totalFgGrade;
                        }


                        if ($hasFGAssessments) {
                                $assessmentRow[] = $student->grades->avg('fg_grade');
                            }

                        }

            $midtermAssessmentTypeTotals = [];
            $lastMidtermAssessmentType = null;

            foreach ($midtermAssessments as $index => $midtermAssessment) {
            $score = $student->getScore($midtermAssessment->id);
            $assessmentRow[] = $score;

          
            if (is_numeric($score)) {
                $midtermAssessmentTypeTotals[$midtermAssessment->type] = ($midtermAssessmentTypeTotals[$midtermAssessment->type] ?? 0) + $score;
            }

            $isLastColumn = ($index === (count($midtermAssessments) - 1));
            $isLastColumnOfType = ($isLastColumn || $midtermAssessment->type !== $midtermAssessments[$index + 1]->type);

          
            if ($isLastColumnOfType) {
                $assessmentRow[] = $midtermAssessmentTypeTotals[$midtermAssessment->type] ?? ''; 
            }

            $lastMidtermAssessmentType = $midtermAssessment->type;
        }


///////////////////for LecLab type columns midterms/////////////////
           if (strpos($subject->subject_type, 'LecLab') !== false) {
             if ($hasMidtermAssessments) {
              
                $totalLecMD = 0;
                $lecGradeMD = 0;

         
                foreach ($student->grades as $grade) {
                    $totalLecMD += $grade->total_midterms_lec;
                    $lecGradeMD += $grade->lec_midterms_grade;
                }

           
                $lastTIndexMidterm = isset($tHeaderIndexesMidterm[$lastSpecifiedMidtermAssessmentType]) ? $tHeaderIndexesMidterm[$lastSpecifiedMidtermAssessmentType] : -1;

                if ($lastTIndexMidterm !== -1) {
              
                    array_splice($assessmentRow, $lastTIndexMidterm + 1, 0, [$totalLecMD, $lecGradeMD]);
                }
            }
        }



      ///////////////////for LecLab type columns midterms/////////////////

                    if (strpos($subject->subject_type, 'LecLab') !== false) {
                        if ($hasMidtermAssessments) {
                            $totalLabMDGrade = 0;
                                foreach ($student->grades as $grade) {
                                    $totalLabMDGrade += $grade->total_midterms_lab;
                                }
                                $assessmentRow[] =$totalLabMDGrade;
                        }

                        if ($hasMidtermAssessments) {
                            $LabMDGrade = 0;
                                foreach ($student->grades as $grade) {
                                    $LabMDGrade += $grade->lab_midterms_grade;
                                }
                                $assessmentRow[] = $LabMDGrade;
                        }

                          if ($hasMidtermAssessments) {
                            $tentativeMDGrade = 0;
                                foreach ($student->grades as $grade) {
                                    $tentativeMDGrade += $grade->tentative_midterms_grade;
                                }
                                $assessmentRow[] = $tentativeMDGrade;
                        }

                         if ($hasMidtermAssessments) {
                            $assessmentRow[] = $student->grades->avg('midterms_grade');
                        }

                        

                    } else {

 ///////////////////for Lec type/Lab type columns midterms/////////////////

                        if ($hasMidtermAssessments) {
                            $totalMDGrade = 0;
                                foreach ($student->grades as $grade) {
                                    $totalMDGrade += $grade->total_midterms_grade;
                                }
                                $assessmentRow[] = $totalMDGrade;
                        }

                        if ($hasMidtermAssessments) {
                            $tentativeMDGrade = 0;
                                foreach ($student->grades as $grade) {
                                    $tentativeMDGrade += $grade->tentative_midterms_grade;
                                }
                                $assessmentRow[] = $tentativeMDGrade;
                        }

                        if ($hasMidtermAssessments) {
                            $assessmentRow[] = $student->grades->avg('midterms_grade');
                        }

                    }




                $finalsAssessmentTypeTotals = [];
                $lastFinalsAssessmentType = null;
                $directBonusGradeScore = null; 

                foreach ($finalsAssessments as $index => $finalsAssessment) {
                    $score = $student->getScore($finalsAssessment->id);

                    if ($finalsAssessment->type === 'Direct Bonus Grade') {
                        $directBonusGradeScore = $score; 
                    } else {
                        $assessmentRow[] = $score; 
                    }

                    if (is_numeric($score)) {
                        $finalsAssessmentTypeTotals[$finalsAssessment->type] = ($finalsAssessmentTypeTotals[$finalsAssessment->type] ?? 0) + $score;
                    }

                    $isLastColumn = ($index === (count($finalsAssessments) - 1));
                    $isLastColumnOfType = ($isLastColumn || $finalsAssessment->type !== $finalsAssessments[$index + 1]->type);

                    if ($isLastColumnOfType && $finalsAssessment->type !== 'Direct Bonus Grade') {
                        $assessmentRow[] = $finalsAssessmentTypeTotals[$finalsAssessment->type] ?? ''; 
                    }

                    $lastFinalsAssessmentType = $finalsAssessment->type;
                }

        ///////////////////for LecLab type columns finals/////////////////
          if (strpos($subject->subject_type, 'LecLab') !== false) {
             if ($hasFinalsAssessments) {
          
                $totalLecFN = 0;
                $lecGradeFN = 0;

    
                foreach ($student->grades as $grade) {
                    $totalLecFN += $grade->total_finals_lec;
                    $lecGradeFN += $grade->lec_finals_grade;
                }

                $lastTIndexFinals = isset($tHeaderIndexesFinals[$lastSpecifiedFinalsAssessmentType]) ? $tHeaderIndexesFinals[$lastSpecifiedFinalsAssessmentType] : -1;

               if ($lastTIndexFinals !== -1) {
        
                    array_splice($assessmentRow, $lastTIndexFinals + 1, 0, [$totalLecFN, $lecGradeFN]);
                }
            }
        }


  ///////////////////for LecLab type columns finals/////////////////
        if (strpos($subject->subject_type, 'LecLab') !== false) {
            if ($hasFinalsAssessments) {
                $totalLabFNGrade = 0;
                            foreach ($student->grades as $grade) {
                                $totalLabFNGrade  += $grade->total_finals_lab;
                            }
                            $assessmentRow[] = $totalLabFNGrade ;
            }

            if ($hasFinalsAssessments) {
               $LabFNGrade = 0;
                            foreach ($student->grades as $grade) {
                                 $LabFNGrade += $grade->lab_finals_grade;
                            }
                            $assessmentRow[] =  $LabFNGrade;
            }

            if ($hasFinalsAssessments) {
               $tentativeFNGrade = 0;
                            foreach ($student->grades as $grade) {
                                $tentativeFNGrade += $grade->tentative_finals_grade;
                            }
                            $assessmentRow[] = $tentativeFNGrade;
            }

            if ($directBonusGradeScore !== null) {
                $assessmentRow[] = $directBonusGradeScore;
            }

            if ($hasFinalsAssessments) {
                foreach ($student->grades as $grade) {
                   
                   if (isset($grade->finals_status)) {
                        if ($grade->finals_status === 'DEFAULT') {
                            
                            $assessmentRow[] = $grade->adjusted_finals_grade;
                        } else {
                            $assessmentRow[] = $grade->finals_status;
                        }
                        break;
                    }
                }
            }

       } else {


  ///////////////////for Lec type/Lab type columns finals/////////////////
           if ($hasFinalsAssessments) {
                $totalFNGrade = 0;
                            foreach ($student->grades as $grade) {
                                $totalFNGrade += $grade->total_finals_grade;
                            }
                            $assessmentRow[] = $totalFNGrade;
            }

            if ($hasFinalsAssessments) {
               $tentativeFNGrade = 0;
                            foreach ($student->grades as $grade) {
                                $tentativeFNGrade += $grade->tentative_finals_grade;
                            }
                            $assessmentRow[] = $tentativeFNGrade;
            }

            if ($directBonusGradeScore !== null) {
                $assessmentRow[] = $directBonusGradeScore;
            }

            if ($hasFinalsAssessments) {
                foreach ($student->grades as $grade) {
                    if (isset($grade->finals_status)) {
                        if ($grade->finals_status === 'DEFAULT') {
                            
                            $assessmentRow[] = $grade->adjusted_finals_grade;
                        } else {
                            $assessmentRow[] = $grade->finals_status;
                        }
                        break;
                    }
                }
            }


        }

            $assessmentRows[] = $assessmentRow;
        }
    }

     
    $assessmentRows[] = [];


    $assessmentDateRow = [
        '', '', '',
    ];


foreach ($assessments as $index => $assessment) {
    $assessmentDateRow[] = !empty($assessment->activity_date) ? $assessment->activity_date : ($assessment->manual_activity_date ?? '');


    $isLastColumn = ($index === (count($assessments) - 1));
    $isLastColumnOfType = ($isLastColumn || $assessment->type !== $assessments[$index + 1]->type);

    if ($isLastColumnOfType) {
        $assessmentDateRow[] = '';
    }
}


     /////////////////////For FG activity date - LecLab///////////
                if (strpos($subject->subject_type, 'LecLab') !== false) {
                    if ($hasFGAssessments) {
                      
                        $totalLec = 0;
                        $lecGrade = 0;

                       
                        foreach ($student->grades as $grade) {
                            $totalLec += $grade->total_fg_lec;
                            $lecGrade += $grade->lec_fg_grade;
                        }

                       
                        $lastTIndex = isset($tHeaderIndexes[$lastSpecifiedAssessmentType]) ? $tHeaderIndexes[$lastSpecifiedAssessmentType] : -1;

                        if ($lastTIndex !== -1) {
                           
                            array_splice($assessmentRow, $lastTIndex + 1, 0, [$totalLec, $lecGrade]);

                           
                            array_splice($assessmentDateRow, $lastTIndex + 1, 0, ['', '']);
                        }
                    }
                }

               if (strpos($subject->subject_type, 'LecLab') !== false) {
                  if ($hasFGAssessments) {
                         $assessmentDateRow[] = '';
                        $assessmentDateRow[] = '';
                         $assessmentDateRow[] = '';
                    }


                } else {
        /////////////////////For FG activity date - Lec type and Lab type///////////

                      if ($hasFGAssessments) {
                             $assessmentDateRow[] = '';
                            $assessmentDateRow[] = '';
                        }

                    }




            foreach ($midtermAssessments as $index => $midtermAssessment) {
               $assessmentDateRow[] = !empty($midtermAssessment->activity_date) ? $midtermAssessment->activity_date : ($midtermAssessment->manual_activity_date ?? '');

               
                $isLastColumn = ($index === (count($midtermAssessments) - 1));
                $isLastColumnOfType = ($isLastColumn || $midtermAssessment->type !== $midtermAssessments[$index + 1]->type);

                
                if ($isLastColumnOfType) {
                    $assessmentDateRow[] = '';
                }
            }



           if (strpos($subject->subject_type, 'LecLab') !== false) {
            if ($hasMidtermAssessments) {
                
                $totalLecMD = 0;
                $lecGradeMD = 0;

                
                foreach ($student->grades as $grade) {
                    $totalLecMD += $grade->total_midterms_lec;
                    $lecGradeMD += $grade->lec_midterms_grade;
                }

               
                $lastTIndexMidterm = isset($tHeaderIndexesMidterm[$lastSpecifiedMidtermAssessmentType]) ? $tHeaderIndexesMidterm[$lastSpecifiedMidtermAssessmentType] : -1;

                if ($lastTIndexMidterm !== -1) {
                    
                    array_splice($assessmentRow, $lastTIndexMidterm + 1, 0, [$totalLecMD, $lecGradeMD]);

                    array_splice($assessmentDateRow, $lastTIndexMidterm + 1, 0, ['', '']);
                }
            }
        }

             if (strpos($subject->subject_type, 'LecLab') !== false) {
                     if ($hasMidtermAssessments) {
                         $assessmentDateRow[] = '';
                         $assessmentDateRow[] = '';
                         $assessmentDateRow[] = '';
                         $assessmentDateRow[] = '';
                    }



              } else {
                     if ($hasMidtermAssessments) {
                         $assessmentDateRow[] = '';
                         $assessmentDateRow[] = '';
                         $assessmentDateRow[] = '';
                    }
            }
   
foreach ($finalsAssessments as $index => $finalsAssessment) {
    $assessmentDateRow[] = !empty($finalsAssessment->activity_date) ? $finalsAssessment->activity_date : ($finalsAssessment->manual_activity_date ?? '');

   
    $isLastColumn = ($index === (count($finalsAssessments) - 1));
    $isLastColumnOfType = ($isLastColumn || $finalsAssessment->type !== $finalsAssessments[$index + 1]->type);

   
    if ($isLastColumnOfType) {
        $assessmentDateRow[] = '';
    }
}


       if (strpos($subject->subject_type, 'LecLab') !== false) {
             if ($hasFinalsAssessments) {
              
                $totalLecFN = 0;
                $lecGradeFN = 0;

                
                foreach ($student->grades as $grade) {
                    $totalLecFN += $grade->total_finals_lec;
                    $lecGradeFN += $grade->lec_finals_grade;
                }

                
                $lastTIndexFinals = isset($tHeaderIndexesFinals[$lastSpecifiedFinalsAssessmentType]) ? $tHeaderIndexesFinals[$lastSpecifiedFinalsAssessmentType] : -1;

               if ($lastTIndexFinals !== -1) {
                    
                    array_splice($assessmentRow, $lastTIndexFinals + 1, 0, [$totalLecFN, $lecGradeFN]);

                     array_splice($assessmentDateRow, $lastTIndexFinals + 1, 0, ['', '']);
                }
            }
        }



             if (strpos($subject->subject_type, 'LecLab') !== false) {
                     if ($hasFinalsAssessments) {
                         $assessmentDateRow[] = '';
                         $assessmentDateRow[] = '';
                         $assessmentDateRow[] = '';
                         $assessmentDateRow[] = '';
                    }



              } else {
                     if ($hasFinalsAssessments) {
                         $assessmentDateRow[] = '';
                         $assessmentDateRow[] = '';
                         $assessmentDateRow[] = '';
                    }
            }

    $assessmentRows = array_merge($assessmentRows, [$assessmentDateRow]);

   //////return $assessmentRows;
////}

    return [
        'assessmentHeaderRow' => $assessmentHeaderRow,
        'assessmentMaxPointsRow' => $assessmentMaxPointsRow,
        'assessmentTypeHeaderRow' => $assessmentTypeHeaderRow,
        'gradingPeriodHeaderRow' => $gradingPeriodHeaderRow,
        'midtermassessmentHeaderRow' => $assessmentHeaderRow,
        'midtermassessmentMaxPointsRow' => $assessmentMaxPointsRow,
        'midtermassessmentTypeHeaderRow' => $assessmentTypeHeaderRow,
        'midtermgradingPeriodHeaderRow' => $gradingPeriodHeaderRow,
        'finalsassessmentHeaderRow' => $assessmentHeaderRow,
        'finalsassessmentMaxPointsRow' => $assessmentMaxPointsRow,
        'finalsassessmentTypeHeaderRow' => $assessmentTypeHeaderRow,
        'finalsgradingPeriodHeaderRow' => $gradingPeriodHeaderRow,
        'assessmentRows' => $assessmentRows,
    ];
}

 public function generatePdfReport($subjectId)
{
    $subject = Subject::findOrFail($subjectId);

    $students = EnrolledStudents::with(['student', 'grades'])
        ->whereHas('importedClasses', function ($query) use ($subjectId) {
            $query->where('subjects_id', $subjectId);
        })
        ->get();

    $assessments = Assessment::where('subject_id', $subjectId)
        ->where('grading_period', 'First Grading') 
        ->orderByRaw("FIELD(type, 'Quiz', 'Additional Points Quiz', 'OtherActivity', 'Additional Points OT', 'Exam', 'Additional Points Exam', 'Lab Activity', 'Additional Points Lab', 'Lab Exam', 'Direct Bonus Grade')")
        ->orderBy('type', 'desc') 
        ->get();

    $midtermAssessments = Assessment::where('subject_id', $subjectId)
        ->where('grading_period', 'Midterm') 
        ->orderByRaw("FIELD(type, 'Quiz', 'Additional Points Quiz', 'OtherActivity', 'Additional Points OT', 'Exam', 'Additional Points Exam', 'Lab Activity', 'Additional Points Lab', 'Lab Exam', 'Direct Bonus Grade')")
        ->orderBy('type', 'desc') 
        ->get();

    $finalsAssessments = Assessment::where('subject_id', $subjectId)
        ->where('grading_period', 'Finals')
        ->orderByRaw("FIELD(type, 'Quiz', 'Additional Points Quiz', 'OtherActivity', 'Additional Points OT', 'Exam', 'Additional Points Exam', 'Lab Activity', 'Additional Points Lab', 'Lab Exam', 'Direct Bonus Grade')")
        ->orderBy('type', 'desc') 
        ->get();

    
    $abbreviate = function ($assessments, $gradingPeriod) {
        $typeAbbreviations = [
            'Quiz' => 'Q',
            'OtherActivity' => 'OT',
            'Exam' => 'E',
            'Lab Activity' => 'LA',
            'Lab Exam' => 'LE',
            'Additional Points Quiz' => 'QB',
            'Additional Points OT' => 'OTB',
            'Additional Points Exam' => 'EB',
            'Additional Points Lab' => 'LB',
            'Direct Bonus Grade' => '+FG',
        ];
        $exemptedTypes = array_keys(array_filter($typeAbbreviations, fn($abbr) => in_array($abbr, ['E', 'LE', 'QB', 'OTB', 'EB', 'LB', '+FG'])));
        $typeCounts = [];

        $assessments = $assessments->map(function ($assessment) use ($typeAbbreviations, $exemptedTypes, &$typeCounts) {
            $type = $assessment->type;
            $gradingPeriod = $assessment->grading_period;

            if (in_array($type, $exemptedTypes)) {
                $assessment->abbreviation = $typeAbbreviations[$type];
            } else {
                $typeCounts[$gradingPeriod][$type] = $typeCounts[$gradingPeriod][$type] ?? 0;
                $count = ++$typeCounts[$gradingPeriod][$type];
                $assessment->abbreviation = $typeAbbreviations[$type] . $count;
            }

            return $assessment;
        });

        $typeMapping = [
            'Additional Points Quiz' => 'Quiz',
            'Additional Points OT' => 'OtherActivity',
            'Additional Points Exam' => 'Exam',
            'Additional Points Lab' => 'Lab Activity',
        ];

        return $assessments->map(function ($assessment) use ($typeMapping) {
            $assessment->type = $typeMapping[$assessment->type] ?? $assessment->type;
            return $assessment;
        });
    };

    $assessments = $abbreviate($assessments, 'First Grading')->groupBy('type')->map(fn($group) => $group->sortBy('activity_date')->values())->flatten();
    $midtermAssessments = $abbreviate($midtermAssessments, 'Midterm')->groupBy('type')->map(fn($group) => $group->sortBy('activity_date')->values())->flatten();
    $finalsAssessments = $abbreviate($finalsAssessments, 'Finals')->groupBy('type')->map(fn($group) => $group->sortBy('activity_date')->values())->flatten();

    $headers = $this->generateAssessmentHeaders($students, $assessments, $midtermAssessments, $finalsAssessments, $subject);

    $columnLimit = 30; 
    $chunkedAssessmentRows = [];

    foreach ($headers['assessmentRows'] as $row) {
        if (!is_array($row)) {
            $chunkedAssessmentRows[] = [$row]; 
            continue;
        }

       
        $chunks = array_chunk($row, $columnLimit);
        foreach ($chunks as $index => $chunk) {
            $chunkedAssessmentRows[$index][] = $chunk;
        }
    }

    $data = [
        'subject' => $subject,
        'students' => $students,
        'assessments' => $assessments,
        'midtermAssessments' => $midtermAssessments,
        'finalsAssessments' => $finalsAssessments,
        'assessmentHeaderRow' => $headers['assessmentHeaderRow'],
        'assessmentMaxPointsRow' => $headers['assessmentMaxPointsRow'],
        'assessmentTypeHeaderRow' => $headers['assessmentTypeHeaderRow'],
        'gradingPeriodHeaderRow' => $headers['gradingPeriodHeaderRow'],
        'midtermassessmentHeaderRow' => $headers['midtermassessmentHeaderRow'],
        'midtermassessmentMaxPointsRow' => $headers['midtermassessmentMaxPointsRow'],
        'midtermassessmentTypeHeaderRow' => $headers['midtermassessmentTypeHeaderRow'],
        'midtermgradingPeriodHeaderRow' => $headers['midtermgradingPeriodHeaderRow'],
        'finalsassessmentHeaderRow' => $headers['finalsassessmentHeaderRow'],
        'finalsassessmentMaxPointsRow' => $headers['finalsassessmentMaxPointsRow'],
        'finalsassessmentTypeHeaderRow' => $headers['finalsassessmentTypeHeaderRow'],
        'finalsgradingPeriodHeaderRow' => $headers['finalsgradingPeriodHeaderRow'],
        'assessmentRows' => $headers['assessmentRows'],
        'chunkedAssessmentRows' => $chunkedAssessmentRows,

    ];

    $filename = $subject->term . '_' . $subject->subject_code . '_' . $subject->section . '.pdf';

    return PDF::loadView('teacher.list.pdf', $data)
        ->setPaper('legal', 'landscape')
        ->stream($filename);

}

 public function generateGradesList($subjectId)
    {
        $subject = Subject::findOrFail($subjectId);

        $students = EnrolledStudents::with(['student', 'grades'])
            ->whereHas('importedClasses', function ($query) use ($subjectId) {
                $query->where('subjects_id', $subjectId);
            })
            ->get();

        // Fetch assessments for each grading period
        $fgAssessments = $this->fetchAssessmentsByGradingPeriod($subjectId, 'fg_grade');
        $midtermAssessments = $this->fetchAssessmentsByGradingPeriod($subjectId, 'midterms_grade');
        $finalsAssessments = $this->fetchAssessmentsByGradingPeriod($subjectId, 'finals_grade');

        $sortedStudents = collect($students)->groupBy('student.gender');

        $pdf = PDF::loadView('teacher.list.gradeslist', compact(
            'subject',
            'students',
            'sortedStudents',
            'fgAssessments',
            'midtermAssessments',
            'finalsAssessments'
        ))->setPaper('A4', 'portrait');

        return $pdf->download('gradeslist.pdf');
    }

    private function fetchAssessmentsByGradingPeriod($subjectId, $gradingPeriod)
    {
        return Assessment::where('subject_id', $subjectId)
            ->where('grading_period', $gradingPeriod)
            ->orderBy('type', 'desc')
            ->get();
    }

    public function generateExcelReport($subjectId)
    {
         
        $subject = Subject::findOrFail($subjectId);

        
        $exportFileName = $subject->term . '_' . $subject->subject_code . '_' . $subject->section . '_records.xlsx';


        return Excel::download(new StudentReportExport($subjectId), $exportFileName);
    }

    public function exportGradesList($subjectId)
    {
        $subject = Subject::findOrFail($subjectId);

        $students = EnrolledStudents::with(['student', 'grades'])
            ->whereHas('importedClasses', function ($query) use ($subjectId) {
                $query->where('subjects_id', $subjectId);
            })
            ->get();

        $fgAssessments = $this->fetchAssessmentsByGradingPeriod($subjectId, 'fg_grade');
        $midtermAssessments = $this->fetchAssessmentsByGradingPeriod($subjectId, 'midterms_grade');
        $finalsAssessments = $this->fetchAssessmentsByGradingPeriod($subjectId, 'finals_grade');

        $sortedStudents = collect($students)->groupBy('student.gender');

        
        $exportFileName = $subject->term . '_' . $subject->subject_code . '_' . $subject->section . '_grade_list.xlsx';


        return Excel::download(new StudentGradeExport($subject, $students, $sortedStudents),  $exportFileName);
    }

   public function generateSummaryReport($subjectId)
{

    $subject = Subject::findOrFail($subjectId);

    $exportFileName = $subject->term . '_' . $subject->subject_code . '_' . $subject->section . '_summary.xlsx';

    return Excel::download(new StudentsSummaryExport($subjectId), $exportFileName);
}


}
