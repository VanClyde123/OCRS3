<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EnrolledStudents;
use App\Models\ImportedClasslist;
use App\Models\Subject;
use App\Models\User; 
use App\Models\Semester;
use App\Models\Instructor;
use App\Models\Grades;
use App\Exports\SummaryReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SummaryReportController extends Controller
{

    public function index()
    {
                return view('admin.summary_report.reports');
            }

    public function getFilteredReport(Request $request)
{
    $query = EnrolledStudents::query();

            // Join with related tables
            $query->join('imported_classlist', 'enrolled_students.imported_classlist_id', '=', 'imported_classlist.id')
                ->join('subjects', 'imported_classlist.subjects_id', '=', 'subjects.id')
                ->join('users as instructors', 'imported_classlist.instructor_id', '=', 'instructors.id')
                ->join('users as students', 'enrolled_students.student_id', '=', 'students.id')
                ->join('semesters', function ($join) {
                    $join->on('subjects.term', '=', 'semesters.semester_name')
                        ->on('semesters.school_year', '=', 'semesters.school_year');
                });

    
        if ($request->school_year) {
            $query->where('semesters.school_year', $request->school_year);
        }
                if ($request->term) {
                    $query->where('semesters.semester_name', $request->term);
                }
                    if ($request->instructor) {
                        $query->where('instructors.id', $request->instructor);
                    }
                    if ($request->subject) {
                        $query->where('subjects.id', $request->subject);
                    }
                        if ($request->section) {
                            $query->where('subjects.section', $request->section);
                        }
                            if ($request->program) {
                                $query->where('students.course', $request->program);
                            }

                   
                    $results = $query->select(
                        'semesters.school_year',
                        'semesters.semester_name as term',
                        'instructors.name as instructor',
                        'subjects.subject_code as subject',
                        'subjects.section',
                        'students.course as program',
                        \DB::raw('COUNT(enrolled_students.id) as total_enrolled')
                    )->groupBy(
                        'semesters.school_year',
                        'semesters.semester_name',
                        'instructors.name',
                        'subjects.subject_code',
                        'subjects.section',
                        'students.course'
                    )->get();

                            return response()->json($results);
                          }


      public function summaryReport()
    {
            $schoolYears = Semester::select('school_year')->distinct()->orderBy('school_year', 'desc')->get();

                return view('admin.summary_report.reports', compact('schoolYears'));
        }


        public function getTerms(Request $request)
        {
            $schoolYear = $request->school_year;

            $terms = Semester::where('school_year', $schoolYear)
                        ->select('semester_name')
                        ->distinct()
                        ->orderBy('semester_name', 'asc')
                        ->get();

            return response()->json($terms);
        }

    public function getInstructors(Request $request)
    {
        $schoolYear = $request->input('school_year');
        $term = $request->input('term');

        
        $subjects = Subject::where('term', "{$term}, {$schoolYear}")->pluck('id');
        $instructorIds = ImportedClasslist::whereIn('subjects_id', $subjects)
            ->pluck('instructor_id')
            ->unique();

        
        $instructors = User::whereIn('id', $instructorIds)
            ->where(function ($query) {
                $query->where('role', 2)
                      ->orWhere('secondary_role', 2);
            })
            ->select('id', 'name', 'middle_name', 'last_name')
            ->orderBy('last_name')
            ->get();

        return response()->json($instructors);
    }


public function getSubjects(Request $request)
{
    $schoolYear = $request->school_year;
    $term = $request->term;
    $instructorId = $request->instructor;

   
    if (!$schoolYear || !$term || !$instructorId) {
        return response()->json([]);
    }

    ///// term, school year
    $fullTerm = $term . ', ' . $schoolYear;

    /////get subjects basded on the selected instrictor, term, sy
    $subjects = ImportedClasslist::whereHas('subject', function ($query) use ($fullTerm) {
            $query->where('term', $fullTerm);
        })
        ->where('instructor_id', $instructorId)
        ->with('subject:id,subject_code,description') 
        ->get()
        ->unique(function ($class) {
            return $class->subject->subject_code . '|' . $class->subject->description;
        }) 
        ->map(function ($class) {
            return [
                'id' => $class->subject->id,
                'name' => $class->subject->subject_code . ' - ' . $class->subject->description
            ];
        })
        ->values(); 

    return response()->json($subjects);
}
public function getSections(Request $request)
{
    $subjectId = $request->subject;

    /////check if subbejct is selected
    if (!$subjectId) {
            return response()->json([]);
        }

    ///// find all subjects with the same code & description, for sections to be listed
    $subject = Subject::find($subjectId);

        if (!$subject) {
            return response()->json([]);
        }
    $sections = ImportedClasslist::whereHas('subject', function ($query) use ($subject) {
            $query->where('subject_code', $subject->subject_code)
                  ->where('description', $subject->description);
        })
        ->with('subject:id,section') 
        ->get()
        ->unique('subject.section') 
        ->map(function ($class) {
            return [
                'name' => $class->subject->section
            ];
        })
        ->values(); 

    return response()->json($sections);
}

    public function getPrograms()
    {
        $programs = User::whereNotNull('course')
            ->distinct()
            ->pluck('course');

        return response()->json($programs);
    }

public function generateReport(Request $request)
{
    $schoolYear = $request->input('school_year');
    $term = $request->input('term');
    $instructorId = $request->input('instructor');
    $subjectId = $request->input('subject');
    $section = $request->input('section');
    $program = $request->input('program');



    ///instructor full name fetch
    $instructor = null;
    if ($instructorId) {
        $instructorData = User::where('id', $instructorId)->first();
        if ($instructorData) {
            $instructor = $instructorData->name . ' ' . ($instructorData->middle_name ? $instructorData->middle_name . ' ' : '') . $instructorData->last_name;
        }
    }

    /////subject name fetch
    $subject = null;
    if ($subjectId) {
        $subjectData = Subject::where('id', $subjectId)->first();
        if ($subjectData) {
            $subject = $subjectData->subject_code . ' - ' . $subjectData->description;
        }
    }

   /////total enrolled count
    $query = ImportedClasslist::query()
        ->with(['instructor', 'subject'])
        ->withCount('enrolledStudents');

    /////////filters
    if ($schoolYear) {
        $query->whereHas('subject', function ($q) use ($schoolYear) {
            $q->where('term', 'LIKE', "%$schoolYear%");
        });
      }

    if ($term) {
        $query->whereHas('subject', function ($q) use ($term) {
            $q->where('term', 'LIKE', "%$term%");
        });
      }

    if ($instructorId) {
        $query->where('instructor_id', $instructorId);
    }

    if ($subjectId) {
        $query->whereHas('subject', function ($q) use ($subjectData) {
            $q->where('subject_code', $subjectData->subject_code)
              ->where('description', $subjectData->description);
        });
       }

    if ($section) {
        $query->whereHas('subject', function ($q) use ($section) {
            $q->where('section', $section);
        });
       }

    if ($program) {
    $query->whereHas('enrolledStudents', function ($q) use ($program) {
        $q->whereHas('student', function ($q2) use ($program) {
            $q2->where('course', $program);
            });
        });
   }

    
    $results = $query->with(['instructor', 'subject'])->get();

    /////clustering, data
    $groupedResults = [];

    foreach ($results as $record) {
        $subjectCode = $record->subject->subject_code;
        $instructorName = $record->instructor->name . ' ' . ($record->instructor->middle_name ? $record->instructor->middle_name . ' ' : '') . $record->instructor->last_name;
        $termName = $record->subject->term; 

       //////groupd by subject - no section specified
        $groupKey = $subjectCode . '-' . $instructorName . '-' . $termName; 

        if (!isset($groupedResults[$groupKey])) {
            $groupedResults[$groupKey] = [
                'subject' => $record->subject->subject_code,
                'instructor' => $instructorName,
                'term' => $termName, 
                'total_students' => 0,
                'passed' => 0,
                'failed' => 0,
                'dropped' => 0,
                'inc_nfe' => 0,
                'others' => 0,
            ];
        }

        /////fetch final grade and final status
        $enrolledStudentIds = $record->enrolledStudents->pluck('id');

        $grades = Grades::whereIn('enrolled_student_id', $enrolledStudentIds)
            ->whereNull('assessment_id') 
            ->get();

        /////count for final grade/status
        $passed = 0;
        $failed = 0;
        $dropped = 0;
        $inc_nfe = 0;
        $others = 0;

        foreach ($grades as $grade) {
            if ($grade->finals_status == 'DRP'|| $grade->finals_status == 'OD') {
                $dropped++;
            } elseif ($grade->finals_status == 'WITHDRAW') {
                $others++;
            } elseif ($grade->finals_status == 'INC' || $grade->finals_status == 'NFE') {
                $inc_nfe++;
            } elseif ($grade->adjusted_finals_grade >= 75) {
                $passed++;
            } else {
                $failed++;
            }
        }

        //////for clustered total
        $groupedResults[$groupKey]['total_students'] += $record->enrolled_students_count;
        $groupedResults[$groupKey]['passed'] += $passed;
        $groupedResults[$groupKey]['failed'] += $failed;
        $groupedResults[$groupKey]['dropped'] += $dropped;
        $groupedResults[$groupKey]['inc_nfe'] += $inc_nfe;
        $groupedResults[$groupKey]['others'] += $others;

        //////section specified calc data
        $totalStudents = $record->enrolled_students_count;
        $record->passed_percentage = $totalStudents ? round(($passed / $totalStudents) * 100, 2) : 0;
        $record->failed_percentage = $totalStudents ? round(($failed / $totalStudents) * 100, 2) : 0;
        $record->dropped_percentage = $totalStudents ? round(($dropped / $totalStudents) * 100, 2) : 0;
        $record->inc_nfe_percentage = $totalStudents ? round(($inc_nfe / $totalStudents) * 100, 2) : 0;
        $record->others_percentage = $totalStudents ? round(($others / $totalStudents) * 100, 2) : 0;
    }

    /////clustered calc data
    foreach ($groupedResults as &$group) {
        $totalStudents = $group['total_students'];

        $group['passed_percentage'] = $totalStudents ? round(($group['passed'] / $totalStudents) * 100, 2) : 0;
        $group['failed_percentage'] = $totalStudents ? round(($group['failed'] / $totalStudents) * 100, 2) : 0;
        $group['dropped_percentage'] = $totalStudents ? round(($group['dropped'] / $totalStudents) * 100, 2) : 0;
        $group['inc_nfe_percentage'] = $totalStudents ? round(($group['inc_nfe'] / $totalStudents) * 100, 2) : 0;
        $group['others_percentage'] = $totalStudents ? round(($group['others'] / $totalStudents) * 100, 2) : 0;
    }

    //////if program filter applied
if ($program) {
    $programTotals = [];

    foreach ($results as $record) {
        $subjectCode = $record->subject->subject_code;
         $section = $record->subject->section;
          $key = $subjectCode . ' - ' . $section; 

        if (!isset($programTotals[$key])) {
            $programTotals[$key] = [
                'subject' => $subjectCode,
                'section' => $section,
                'total_students' => 0,
                'passed' => 0,
                'failed' => 0,
                'dropped' => 0,
                'inc_nfe' => 0,
                'others' => 0,
            ];
        }

        $enrolledStudentIds = $record->enrolledStudents->pluck('id');

        $grades = Grades::whereIn('enrolled_student_id', $enrolledStudentIds)
            ->whereNull('assessment_id')
            ->whereHas('enrolledStudents.student', function ($q) use ($program) {
                $q->where('course', $program);
            })
            ->get();

        foreach ($grades as $grade) {
            if ($grade->finals_status == 'DRP' || $grade->finals_status == 'OD') {
                $programTotals[$key]['dropped']++;
            } elseif ($grade->finals_status == 'WITHDRAW') {
                $programTotals[$key]['others']++;
            } elseif ($grade->finals_status == 'INC' || $grade->finals_status == 'NFE') {
                $programTotals[$key]['inc_nfe']++;
            } elseif ($grade->adjusted_finals_grade >= 75) {
                $programTotals[$key]['passed']++;
            } else {
                $programTotals[$key]['failed']++;
            }
        }

        /////for counting students based from the selected program
        $programTotals[$key]['total_students'] += $grades->count();
    }

    /////program specifed students calc 
    foreach ($programTotals as &$totals) {
        $totalStudents = $totals['total_students'];

                $totals['passed_percentage'] = $totalStudents ? round(($totals['passed'] / $totalStudents) * 100, 2) : 0;
                $totals['failed_percentage'] = $totalStudents ? round(($totals['failed'] / $totalStudents) * 100, 2) : 0;
                $totals['dropped_percentage'] = $totalStudents ? round(($totals['dropped'] / $totalStudents) * 100, 2) : 0;
                $totals['inc_nfe_percentage'] = $totalStudents ? round(($totals['inc_nfe'] / $totalStudents) * 100, 2) : 0;
                $totals['others_percentage'] = $totalStudents ? round(($totals['others'] / $totalStudents) * 100, 2) : 0;
            }
        } 


        else {
            $programTotals = null;
        }


        return view('admin.summary_report.generated_report', compact(
            'schoolYear', 'term', 'instructor', 'subject', 'section', 'program', 'groupedResults', 'results', 'programTotals'
        ));
}

public function exportSummaryReport(Request $request)
{
    /////call the generateReport method
    $results = $this->generateReport($request);

    //////get filter from the selected filters(report blade)
    $filters = [
        'schoolYear' => $request->school_year,
        'term' => $request->term,
        'instructor' => $request->instructor,
        'subject' => $request->subject,
        'section' => $request->section,
        'program' => $request->program
    ];

    return Excel::download(new SummaryReportExport($results, $filters), 'Summary_Report.xlsx');
}

public function exportPDF(Request $request)
{
    
    $results = $this->generateReport($request);

    ///////for filter, handles not selected/selected filters, clusterd, section specified, program specified
    $groupedResults = $results['groupedResults'] ?? []; 
    $filteredResults = $results['results'] ?? []; 
    $programTotals = $results['programTotals'] ?? []; 


    ///////for determining filter type
    $dataToUse = ($request->input('section') || $request->input('program')) ? $filteredResults : ($results['data'] ?? []);

   
        $instructorName = '';
        if ($request->filled('instructor')) {
            $instructor = User::where('id', $request->input('instructor'))->first();
             if ($instructor) {
                $instructorName = "{$instructor->name}" . ($instructor->middle_name ? " {$instructor->middle_name}" : '') . " {$instructor->last_name}";
            }
        }

     
            $subjectDetails = '';
            if ($request->filled('subject')) {
                $subject = Subject::where('id', $request->input('subject'))->first();
                if ($subject) {
                    $subjectDetails = "{$subject->subject_code} - {$subject->description}";
                }
            }

    
    $pdf = Pdf::loadView('admin.summary_report.pdf_report', [
        'results' => $dataToUse,
        'groupedResults' => $groupedResults,
        'programTotals' => $programTotals, 
        'school_year' => $request->input('school_year', ''),
        'term' => $request->input('term', ''),
        'instructor' => $instructorName, 
        'subject' => $subjectDetails,    
        'section' => $request->input('section', ''),
        'program' => $request->input('program', ''),
    ])->setPaper('A4', 'landscape');

      return $pdf->stream('Summary_Report.pdf');
}

}
