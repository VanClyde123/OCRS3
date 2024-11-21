<?php

namespace App\Exports;


use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use App\Models\EnrolledStudents;
use App\Models\Assessment;
use App\Models\Subject;
use App\Models\ImportedClasslist;

class StudentReportExport implements FromCollection, WithHeadings, WithColumnFormatting, ShouldAutoSize, WithStyles, WithEvents, WithTitle
{
   

    protected $subjectId;

    public function __construct($subjectId)
    {
        $this->subjectId = $subjectId;
    }

    public function title(): string
    {
        
        $subject = Subject::findOrFail($this->subjectId);

        
        return $subject->subject_code . ' - ' . $subject->section;
    }

   protected function getAssessmentAbbreviations($assessments, $gradingPeriod)
{
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

    $exemptedTypes = ['Exam', 'Lab Exam', 'Additional Points Quiz', 'Additional Points OT', 'Additional Points Exam', 'Additional Points Lab', 'Direct Bonus Grade'];

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

    $assessments = $assessments->map(function ($assessment) use ($typeMapping) {
        $assessment->type = $typeMapping[$assessment->type] ?? $assessment->type;
        return $assessment;
    });

    return $assessments;
}

    public function collection()
    {
          $students = EnrolledStudents::with(['student', 'grades'])
        ->whereHas('importedClasses', function ($query) {
            $query->where('subjects_id', $this->subjectId);
        })
        ->get();
        $passingStudents = $students->filter(function ($student) {
            return $student->grades->avg('finals_grade') >= 75;
        });

        $failingStudents = $students->reject(function ($student) use ($passingStudents) {
            return $passingStudents->contains('id', $student->id);
        });
        $subject = Subject::findOrFail($this->subjectId);

     $assessments = Assessment::where('subject_id', $this->subjectId)
            ->where('grading_period', 'First Grading') 
            ->orderByRaw("FIELD(type, 'Quiz', 'Additional Points Quiz', 'OtherActivity', 'Additional Points OT', 'Exam', 'Additional Points Exam', 'Lab Activity', 'Additional Points Lab', 'Lab Exam', 'Direct Bonus Grade')")
            ->orderBy('type', 'desc') 
            ->get();

        $midtermAssessments = Assessment::where('subject_id', $this->subjectId)
            ->where('grading_period', 'Midterm') 
            ->orderByRaw("FIELD(type, 'Quiz', 'Additional Points Quiz', 'OtherActivity', 'Additional Points OT', 'Exam', 'Additional Points Exam', 'Lab Activity', 'Additional Points Lab', 'Lab Exam', 'Direct Bonus Grade')")
            ->orderBy('type', 'desc') 
            ->get();

        $finalsAssessments = Assessment::where('subject_id', $this->subjectId)
            ->where('grading_period', 'Finals')
            ->orderByRaw("FIELD(type, 'Quiz', 'Additional Points Quiz', 'OtherActivity', 'Additional Points OT', 'Exam', 'Additional Points Exam', 'Lab Activity', 'Additional Points Lab', 'Lab Exam', 'Direct Bonus Grade')")
            ->orderBy('type', 'desc') 
            ->get();

        $assessments = $this->getAssessmentAbbreviations($assessments, 'First Grading');
        $midtermAssessments = $this->getAssessmentAbbreviations($midtermAssessments, 'Midterm');
        $finalsAssessments = $this->getAssessmentAbbreviations($finalsAssessments, 'Finals');
       
        $assessments = $assessments->groupBy('type')->map(function ($group) {
            return $group->sortBy(function ($assessment) {
                return $assessment->activity_date ?? PHP_INT_MAX;
            })->values();
        })->flatten();

        $midtermAssessments = $midtermAssessments->groupBy('type')->map(function ($group) {
            return $group->sortBy(function ($assessment) {
                return $assessment->activity_date ?? PHP_INT_MAX;
            })->values();
        })->flatten();

        $finalsAssessments = $finalsAssessments->groupBy('type')->map(function ($group) {
            return $group->sortBy(function ($assessment) {
                return $assessment->activity_date ?? PHP_INT_MAX;
            })->values();
        })->flatten();


        $hasFGAssessments = $assessments->isNotEmpty();
       
        $hasMidtermAssessments = $midtermAssessments->isNotEmpty();

      
        $hasFinalsAssessments = $finalsAssessments->isNotEmpty();


        $sortedStudents = collect($students)->groupBy('student.gender');
        
        $subjectInfoRows = $this->getSubjectInfoRows($subject);

      

         $assessmentRows = $this->getAssessmentRows($students, $assessments, $midtermAssessments, $finalsAssessments);



        return collect([...$subjectInfoRows, [], $this->getStudentHeaderRow(), ...$assessmentRows]);
    }



    
    private function getAssessmentRows($students, $assessments, $midtermAssessments, $finalsAssessments)
{


    $subject = Subject::findOrFail($this->subjectId);

    
    $assessmentHeaderRow = [
      '', '', ''
      
    ];

    $assessmentMaxPointsRow = [
       'ID', 'Student Name', 'Course',
        
    ];
///////////////////////FIRST GRADING/////////////////////////////////////////////////////////////
   
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
            $assessmentMaxPointsRow[] = $assessment->max_points;
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
            $assessmentMaxPointsRow[] = $assessment->max_points;
            $assessmentTypeHeaderRow[] = ''; 

            if (!in_array($assessment->grading_period, $uniqueGradingPeriods)) {
                $gradingPeriodHeaderRow[] = $assessment->grading_period;
                $uniqueGradingPeriods[] = $assessment->grading_period;
            } else {
                $gradingPeriodHeaderRow[] = '';
            }
        }

        $assessmentTypeTotals[$assessment->type] += $assessment->max_points;
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

///////////////////column for LecLab type - totat lec/lec grade/total lab/lab/grade/fg_grade///////////
                 if (strpos($subject->subject_type, 'LecLab') !== false) {
                   

                    if ($hasFGAssessments) {
                        $assessmentHeaderRow[] = '';
                        $assessmentMaxPointsRow[] = '';
                        $assessmentDateRow[] = '';
                        $assessmentTypeHeaderRow[] = 'Total';
                        $gradingPeriodHeaderRow[] = '';
                    }

                    if ($hasFGAssessments) {
                        $assessmentHeaderRow[] = 'Grade';
                        $assessmentMaxPointsRow[] = '';
                        $assessmentDateRow[] = '';
                        $assessmentTypeHeaderRow[] = 'Lab';
                        $gradingPeriodHeaderRow[] = '';
                    }

                    if ($hasFGAssessments) {
                        $assessmentHeaderRow[] = 'Grade';
                        $assessmentMaxPointsRow[] = '';
                        $assessmentDateRow[] = '';
                        $assessmentTypeHeaderRow[] = '1st Grading';
                        $gradingPeriodHeaderRow[] = '';
                    }
                } else {
//////////////////columns for LEc type and Lab type///////////////////
                    if ($hasFGAssessments) {
                        $assessmentHeaderRow[] = '';
                        $assessmentMaxPointsRow[] = '';
                        $assessmentDateRow[] = '';
                        $assessmentTypeHeaderRow[] = 'Total';
                        $gradingPeriodHeaderRow[] = '';
                    }

                    if ($hasFGAssessments) {
                        $assessmentHeaderRow[] = 'Grade';
                        $assessmentMaxPointsRow[] = '';
                        $assessmentDateRow[] = '';
                        $assessmentTypeHeaderRow[] = '1st Grading';
                        $gradingPeriodHeaderRow[] = '';
                    }
                }




///////////////////////MIDTERMS/////////////////////////////////////////////////////////////


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
        $assessmentMaxPointsRow[] = $midtermAssessment->max_points;
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
        $assessmentMaxPointsRow[] = $midtermAssessment->max_points;
        $assessmentTypeHeaderRow[] = ''; 

        if (!in_array($midtermAssessment->grading_period, $uniqueGradingPeriods)) {
            $gradingPeriodHeaderRow[] = $midtermAssessment->grading_period;
            $uniqueGradingPeriods[] = $midtermAssessment->grading_period;
        } else {
            $gradingPeriodHeaderRow[] = '';
        }
    }

    $midtermAssessmentTypeTotals[$midtermAssessment->type] += $midtermAssessment->max_points;
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
                $assessmentMaxPointsRow[] = $finalsAssessment->max_points;
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
                $assessmentMaxPointsRow[] = $finalsAssessment->max_points;
                $assessmentDateRow[] = $finalsAssessment->activity_date;
                $assessmentTypeHeaderRow[] = ''; 

                if (!in_array($finalsAssessment->grading_period, $uniqueGradingPeriods)) {
                    $gradingPeriodHeaderRow[] = $finalsAssessment->grading_period;
                    $uniqueGradingPeriods[] = $finalsAssessment->grading_period;
                } else {
                    $gradingPeriodHeaderRow[] = '';
                }
            }

            $finalsAssessmentTypeTotals[$finalsAssessment->type] += $finalsAssessment->max_points;
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


    $sortedStudents = collect($students)->groupBy('student.gender');

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
                            
                            $assessmentRow[] = $grade->finals_grade;
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
                            
                            $assessmentRow[] = $grade->finals_grade;
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
    $assessmentDateRow[] = $assessment->activity_date;


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
                $assessmentDateRow[] = $midtermAssessment->activity_date;

               
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
    $assessmentDateRow[] = $finalsAssessment->activity_date;

   
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

    return $assessmentRows;
}

    protected function getSubjectInfoRows(Subject $subject): array
    {
        return [
           ['Subject Code:', $subject->subject_code, 'Days:', $subject->importedClasses->first()->days],
            ['Description:', $subject->description, 'Time:',  $subject->importedClasses->first()->time],
            ['Term:', $subject->term, 'Section:', $subject->section],
            ['Instructor:', $subject->importedClasses->first()->instructor->name . ' ' .$subject->importedClasses->first()->instructor->middle_name . ' ' .$subject->importedClasses->first()->instructor->last_name, 'Room:', $subject->importedClasses->first()->room],
           
        ];
    }

    public function registerEvents(): array
    {

            $subject = Subject::findOrFail($this->subjectId);
           return [
            AfterSheet::class => function (AfterSheet $event) use ($subject) {
               
                $event->sheet->mergeCells('A1:Z4');

              
                $event->sheet->setCellValue('A1', "Subject Code: {$subject->subject_code}                                                                                   Days: {$subject->importedClasses->first()->days}\nDescription: {$subject->description}           Time: {$subject->importedClasses->first()->time}\nTerm: {$subject->term}                                                               Section: {$subject->section}\nInstructor: {$subject->importedClasses->first()->instructor->name} {$subject->importedClasses->first()->instructor->middle_name} {$subject->importedClasses->first()->instructor->last_name}                                                                      Room: {$subject->importedClasses->first()->room}");


               
                $event->sheet->getStyle('A1')->applyFromArray([
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                        'wrapText' => true,
                    ],
                ]);

            $lastColumn = 'ZZ';

            $lastDataRow = $event->sheet->getHighestDataRow();

          
            $event->sheet->getStyle("D{$lastDataRow}:{$lastColumn}{$lastDataRow}")->applyFromArray([
                'alignment' => [
                    'textRotation' => 90,
                ],
            ]);

            $event->sheet->getRowDimension($lastDataRow)->setRowHeight(70); 


            $worksheet = $event->sheet->getDelegate();
          
            
            $rowNumbers = [5, 6, 7, 8]; 

            
            $exemptColumns = ['A', 'B', 'C']; 

            
            foreach ($rowNumbers as $rowNumber) {
                $highestColumn = $worksheet->getHighestColumn($rowNumber);
                $columns = range('A', $highestColumn);

                foreach ($columns as $column) {
                  
                    if (!in_array($column, $exemptColumns)) {
                        $worksheet->getColumnDimension($column)->setAutoSize(false);
                    }
                }
            }   
          
             
            $event->sheet->setCellValue('A' . ($lastDataRow + 2), "Legends:");
            $event->sheet->setCellValue('A' . ($lastDataRow + 3), "A - ABSENT");
            $event->sheet->setCellValue('A' . ($lastDataRow + 4), "E - EXCUSED");
            $event->sheet->setCellValue('A' . ($lastDataRow + 5), "Q - Quiz");
            $event->sheet->setCellValue('A' . ($lastDataRow + 6), "OT - OtherActivity");
            $event->sheet->setCellValue('A' . ($lastDataRow + 7), "E - Exam");
            $event->sheet->setCellValue('A' . ($lastDataRow + 8), "LA - Lab Activity");
            $event->sheet->setCellValue('A' . ($lastDataRow + 9), "LE - Lab Exam");
            $event->sheet->setCellValue('A' . ($lastDataRow + 10), "QB - Additional Total Quiz");
            $event->sheet->setCellValue('A' . ($lastDataRow + 11), "OTB - Additional Total OtherActivity");
            $event->sheet->setCellValue('A' . ($lastDataRow + 12), "EB - Additional Total Exam");
            $event->sheet->setCellValue('A' . ($lastDataRow + 13), "LB - Additional Total Lab Activity");
            $event->sheet->setCellValue('A' . ($lastDataRow + 14), "+FG - Direct Bonus to Final Grade");
            $event->sheet->setCellValue('A' . ($lastDataRow + 15), "TM - Tentative Midterm");
            $event->sheet->setCellValue('A' . ($lastDataRow + 16), "TF - Tentative Finals");
            $event->sheet->setCellValue('A' . ($lastDataRow + 17), "T - Total");

          
            $event->sheet->mergeCells('A' . ($lastDataRow + 2) . ':B' . ($lastDataRow + 2));
            $event->sheet->mergeCells('A' . ($lastDataRow + 3) . ':B' . ($lastDataRow + 3));
            $event->sheet->mergeCells('A' . ($lastDataRow + 4) . ':B' . ($lastDataRow + 4));
            $event->sheet->mergeCells('A' . ($lastDataRow + 5) . ':B' . ($lastDataRow + 5));
            $event->sheet->mergeCells('A' . ($lastDataRow + 6) . ':B' . ($lastDataRow + 6));
            $event->sheet->mergeCells('A' . ($lastDataRow + 7) . ':B' . ($lastDataRow + 7));
            $event->sheet->mergeCells('A' . ($lastDataRow + 8) . ':B' . ($lastDataRow + 8));
            $event->sheet->mergeCells('A' . ($lastDataRow + 9) . ':B' . ($lastDataRow + 9));
            $event->sheet->mergeCells('A' . ($lastDataRow + 10) . ':B' . ($lastDataRow + 10));
            $event->sheet->mergeCells('A' . ($lastDataRow + 11) . ':B' . ($lastDataRow + 11));
            $event->sheet->mergeCells('A' . ($lastDataRow + 12) . ':B' . ($lastDataRow + 12));
            $event->sheet->mergeCells('A' . ($lastDataRow + 13) . ':B' . ($lastDataRow + 13));
            $event->sheet->mergeCells('A' . ($lastDataRow + 14) . ':B' . ($lastDataRow + 14));
            $event->sheet->mergeCells('A' . ($lastDataRow + 15) . ':B' . ($lastDataRow + 15));
            $event->sheet->mergeCells('A' . ($lastDataRow + 16) . ':B' . ($lastDataRow + 16));
            $event->sheet->mergeCells('A' . ($lastDataRow + 17) . ':B' . ($lastDataRow + 17));

            $borderStyle = [
                'borders' => [
                    'outline' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'],
                    ],
                ],
            ];

            $event->sheet->getStyle('A' . ($lastDataRow + 2) . ':B' . ($lastDataRow + 17))->applyFromArray($borderStyle);

           
            $event->sheet->getStyle('A' . ($lastDataRow + 2) . ':Z' . ($lastDataRow + 17))->applyFromArray([
                'font' => [
                    'bold' => true,
                ],
            ]);
            
            $event->sheet->getColumnDimension('A')->setWidth(20);
       

            },
        ];
    }

     public function styles(Worksheet $sheet)
    {
        
        $headerRows = [1, 2, 3, 4, 5, 6, 7, 8];

       
        foreach ($headerRows as $row) {
            $sheet->getStyle("A{$row}:ZZ{$row}")->applyFromArray([
                'font' => [
                    'bold' => true,
                ],
            ]);
        }
    }

    public function headings(): array
    {
        return [
         
        ];
    }

    protected function getStudentHeaderRow(): array
    {
        return [];
    }
     public function columnFormats(): array
    {
        return [
            
        ];
    }
}
