<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;
use App\Models\Grades;
use App\Models\Semester;
use App\Models\ImportedClasslist;
use App\Models\EnrolledStudents;
use App\Models\Assessment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function list()
    {
     $data['getData'] = User::getAdminList();
    $data['header_title'] = "List";
    return view('admin.admin.list', $data);
    }

     public function add()
    {
     $data['header_title'] = "Add Admin";
     return view('admin.admin.add',$data);
    }
    
    public function insert(Request $request)
    {
        $id_number = trim($request->id_number);

        if(User::where('id_number', $id_number)->exists()) {
          return redirect('admin/admin/list')->with('error', 'ID number already exists');
        }
        $user = new User;
        $user->name = trim($request->name);
        $user->middle_name = trim($request->middle_name); 
        $user->last_name = trim($request->last_name);    
        $user->id_number = trim($request->id_number);
        $user->role = ($request->role);
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('admin/admin/list')->with('success', "Added User Successfully");
    }
    public function edit($id)
    {
     $data['getData'] = User::getSingleList($id);
     if(!empty($data['getData']))
      {
        $data['header_title'] = "Edit Admin";
        return view('admin.admin.edit',$data);
      }
      else
      {
         abort(404);
      }

    }
    public function update($id, Request $request)
      {
        $user = User::getSingleList($id);
        $user->name = trim($request->name);
        $user->middle_name = trim($request->middle_name); 
        $user->last_name = trim($request->last_name); 
        $user->id_number = trim($request->id_number);
        $user->role = ($request->role);
        if(!empty($request->password))
        {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect('admin/admin/list')->with('success', "User Updated Successfully");
    }
    public function delete($id)
    {
      $user = User::getSingleList($id);
      
      if ($user) {
              
          $user->delete();

          //// return a response
          return redirect('admin/admin/list')->with('success', 'User deleted successfully.');
      }

      //// if user not found, handle the error
      return redirect('admin/admin/list')->with('error', 'User not found.');
    }
      
     public function showPasswordConfirmation($id)
    {
        return view('admin.admin.password_confirmation', ['userId' => $id]);
    }

    public function confirmPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        if (Hash::check($request->password, $user->password)) {
            return redirect()->route('admin.edit', ['id' => $id]);
        }

        return back()->with('error', 'Incorrect Password');
    
    }

    public function viewAllStudents()
    {
        $students = User::where('role', 3)->get();
        return view('admin.student_list.view_students', compact('students'));
    }
    
    public function viewEnrolledSubjects($studentId)
    {
        $student = User::find($studentId);
         $currentSemester = Semester::where('is_current', true)->first();
 
          $enrolledSubjects = $student->enrolledSubjects()
            ->where('term', $currentSemester->semester_name . ', ' . $currentSemester->school_year)
            ->get();
        return view('admin.student_list.enrolled_subjects', compact('student', 'enrolledSubjects'));
    }

    public function viewPastEnrolledSubjects($studentId)
    {
        $student = User::find($studentId);
        $currentSemester = Semester::where('is_current', true)->first();

        
        $pastEnrolledSubjects = $student->enrolledSubjects()
            ->where('term', '!=', $currentSemester->semester_name . ', ' . $currentSemester->school_year)
            ->get();

        return view('admin.student_list.view_pastsubjects', compact('student', 'pastEnrolledSubjects'));
    }
 
    public function viewGrades($studentId, $subjectId)
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

    return view('admin.student_list.view_scores', compact('student', 'subject', 'grades', 'studentGrades', 'gradingPeriods', 'assessmentTypes'));
    }

    public function viewSubjects()
    {
      
    $importedClasses = ImportedClasslist::with(['subject', 'instructor'])->get();

    return view('admin.subject_list.view_subjects', compact('importedClasses'));
       
    }

    public function changeInstructorForm($importedClassId)
    {
       
        $importedClass = ImportedClasslist::findOrFail($importedClassId);

        
        $instructors = User::where('role', 2)->get();
            return view('admin.subject_list.change_instructor', compact('importedClass', 'instructors'));
        }

    public function changeInstructor($importedClassId, Request $request)
    {
          // Fetch the selected imported class
        $importedClass = ImportedClasslist::findOrFail($importedClassId);

        // Update the instructor_id in the imported class
        $importedClass->instructor_id = $request->input('newInstructor');
        $importedClass->save();

        return redirect()->route('admin.viewSubjects')->with('success', 'Instructor changed successfully');
    }

    ////////for the instructor list(the one in the side bar)//////////////////////

     public function showInstructors()
    {
    $instructors = User::where('role', 2)->get();

    return view('admin.teacher_list.instructor_list', compact('instructors'));
    }

    public function showInstructorSubjects($instructorId)
    {
        $instructor = User::findOrFail($instructorId);
        $currentSemester = Semester::where('is_current', true)->first();
        $subjects = $instructor->taughtSubjects()
            ->whereHas('subject', function ($query) use ($currentSemester) {
                $query->where('term', $currentSemester->semester_name . ', ' . $currentSemester->school_year);
            })
            ->get();


        return view('admin.teacher_list.subjects', compact('instructor', 'subjects'));
    }

    public function showPastInstructorSubjects($instructorId)
    {
        $instructor = User::findOrFail($instructorId);
        $currentSemester = Semester::where('is_current', true)->first();
        $pastSubjects = $instructor->taughtSubjects()
            ->whereHas('subject', function ($query) use ($currentSemester) {
                $query->where('term', '!=', $currentSemester->semester_name . ', ' . $currentSemester->school_year);
            })
            ->get();

        return view('admin.teacher_list.past_subjects', compact('instructor', 'pastSubjects'));
    }

    public function showEnrolledStudents($subjectId)
    {
    $subject = ImportedClasslist::findOrFail($subjectId)->subject;
        $enrolledStudents = EnrolledStudents::where('imported_classlist_id', $subjectId)
            ->with('student')
            ->get();

        return view('admin.teacher_list.enrolled_students', compact('subject', 'enrolledStudents'));
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

        return view('admin.teacher_list.view_scores', compact('student', 'grades', 'subject', 'studentGrades', 'gradingPeriods', 'assessmentTypes'));
    }

        ////////for the instructor list(the one in the side bar)//////////////////////

}