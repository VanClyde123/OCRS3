<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\Subject;
use App\Models\EnrolledStudents;
use App\Models\ImportedClasslist;
use App\Models\Assessment;
use App\Models\AssessmentDescription;
use App\Models\User;
use App\Models\Grades;
use App\Models\SubjectType;
use App\Models\Semester;
use App\Models\GradeCeilingSetting;


class StudentsSummaryExport implements FromCollection, WithEvents, WithTitle
{
      use Exportable;

    protected $subjectId;
     protected $gradeCeiling;

    public function __construct($subjectId)
    {
        $this->subjectId = $subjectId;
         $this->gradeCeiling = GradeCeilingSetting::where('identifier', 'default')->first(); // Fetch settings
    }

     public function title(): string
    {
        
        $subject = Subject::findOrFail($this->subjectId);

        
        return $subject->subject_code . ' - ' . $subject->section;
    }

    public function collection()
    {
        $data = [];

         $students = EnrolledStudents::with(['student', 'grades'])
        ->whereHas('importedClasses', function ($query) {
            $query->where('subjects_id', $this->subjectId);
        })
        ->get();

  //  dd($students->toArray());

        
        $data[] = $this->generateCourseSummary($students, 'BSIT');
        $data[] = $this->generateCourseSummary($students, 'BSCS');
        $data[] = $this->generateCourseSummary($students, 'BSCpE');
        $data[] = $this->generateNonSITSummary($students);

        return collect($data)->flatten(1); 
    }

 

    protected function generateCourseSummary($students, $course)
    {
    
     $courseSummary = [];


        $courseStudents = $students->where('student.course', $course);

        $gradeAbove = $this->gradeCeiling->grade_above;
        $gradeLower = $this->gradeCeiling->grade_lower;
        $gradeUpper = $this->gradeCeiling->grade_upper;

     
        $courseSummary[] = ["Course: $course"];
        $courseSummary[] = ['Particulars:', 'No. of '];

       
        $countStudents = function ($condition) use ($courseStudents) {
            return $courseStudents->filter($condition)->count();
        };

         $courseSummary[] = ["Students with grades of $gradeAbove and above", $countStudents(function ($student) use ($gradeAbove) {
            return $student->grades->where('adjusted_finals_grade', '>=', $gradeAbove)->isNotEmpty();
        })];
         $courseSummary[] = ["Students with grades of $gradeLower to $gradeUpper", $countStudents(function ($student) use ($gradeLower, $gradeUpper) {
            return $student->grades->whereBetween('adjusted_finals_grade', [$gradeLower, $gradeUpper])->isNotEmpty();
        })];
        $courseSummary[] = ['Students with grades below 75 but completed the semester', $countStudents(function ($student) {
                return $student->grades
                    ->filter(function ($grade) {
                        if (!is_null($grade->adjusted_finals_grade) && $grade->adjusted_finals_grade < 75) {
                            return in_array($grade->finals_status, ['DEFAULT', '', null]);
                        }
                        return false;
                    })
                    ->isNotEmpty();
        })];
        $courseSummary[] = ['Students with grades below 75 and stopped attending (withdraw)', $countStudents(function ($student) {
            return $student->grades->where('finals_status', 'WITHDRAW')->isNotEmpty();
        })];
        $courseSummary[] = ['Students with INC grades', $countStudents(function ($student) {
            return $student->grades->where('finals_status', 'INC')->isNotEmpty();
        })];
        $courseSummary[] = ['Students with NFE grades', $countStudents(function ($student) {
            return $student->grades->where('finals_status', 'NFE')->isNotEmpty();
        })];
        $courseSummary[] = ['Students with DRP grades (never attended the class)', $countStudents(function ($student) {
            return $student->grades->where('finals_status', 'DRP')->isNotEmpty();
        })];
         $courseSummary[] = ['Students who officially droppped (OD)', $countStudents(function ($student) {
            return $student->grades->where('finals_status', 'OD')->isNotEmpty();
        })];
        $courseSummary[] = ['TOTAL', $courseStudents->count()];

        $courseSummary[] = ['', '']; 

        return $courseSummary;
    }

    protected function generateNonSITSummary($students)
    {
        $nonSITSummary = [];


        $nonSITStudents = $students->whereNotIn('student.course', ['BSIT', 'BSCS', 'BSCpE']);

        $gradeAbove = $this->gradeCeiling->grade_above;
        $gradeLower = $this->gradeCeiling->grade_lower;
        $gradeUpper = $this->gradeCeiling->grade_upper;


        $nonSITSummary[] = ['Course: Non-SIT'];
        $nonSITSummary[] = ['Particulars:', 'No. of '];

        $countNonSITStudents = function ($condition) use ($nonSITStudents) {
            return $nonSITStudents->filter($condition)->count();
        };

        $nonSITSummary[] = ["Students with grades of $gradeAbove and above", $countNonSITStudents(function ($student) use ($gradeAbove) {
            return $student->grades->where('adjusted_finals_grade', '>=', $gradeAbove)->isNotEmpty();
        })];

        $nonSITSummary[] = ["Students with grades of $gradeLower to $gradeUpper", $countNonSITStudents(function ($student) use ($gradeLower, $gradeUpper) {
            return $student->grades->whereBetween('adjusted_finals_grade', [$gradeLower, $gradeUpper])->isNotEmpty();
        })];

        $nonSITSummary[] = ['Students with grades below 75 but completed the semester', $countNonSITStudents(function ($student) {
            return $student->grades
                    ->filter(function ($grade) {
                        if (!is_null($grade->adjusted_finals_grade) && $grade->adjusted_finals_grade < 75) {
                            return in_array($grade->finals_status, ['DEFAULT', '', null]);
                        }
                        return false;
                    })
                    ->isNotEmpty();
        })];

        $nonSITSummary[] = ['Students with grades below 75 and stopped attending (withdraw)', $countNonSITStudents(function ($student) {
            return $student->grades->where('finals_status', 'WITHDRAW')->isNotEmpty();
        })];

        $nonSITSummary[] = ['Students with INC grades', $countNonSITStudents(function ($student) {
            return $student->grades->where('finals_status', 'INC')->isNotEmpty();
        })];

        $nonSITSummary[] = ['Students with NFE grades', $countNonSITStudents(function ($student) {
            return $student->grades->where('finals_status', 'NFE')->isNotEmpty();
        })];

        $nonSITSummary[] = ['Students with DRP grades (never attended the class)', $countNonSITStudents(function ($student) {
            return $student->grades->where('finals_status', 'DRP')->isNotEmpty();
        })];

        $nonSITSummary[] = ['Students who officially droppped (OD)', $countNonSITStudents(function ($student) {
            return $student->grades->where('finals_status', 'OD')->isNotEmpty();
        })];

        $nonSITSummary[] = ['TOTAL', $nonSITStudents->count()];

        $nonSITSummary[] = ['', ''];

        return $nonSITSummary;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                
                $alphabet = range('A', 'Z'); 
                foreach ($alphabet as $column) {
                    $event->sheet->getDelegate()->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}