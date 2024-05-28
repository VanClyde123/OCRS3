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
use App\Models\SubjectDescription;
use App\Models\Section;
use App\Models\SubjectType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
   public function list(Request $request){
    $query = User::getAdminList();

    
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $lowerSearch = mb_strtolower($search);
            $q->where(DB::raw('LOWER(name)'), 'like', "%$lowerSearch%")
              ->orWhere(DB::raw('LOWER(middle_name)'), 'like', "%$lowerSearch%")
              ->orWhere(DB::raw('LOWER(last_name)'), 'like', "%$lowerSearch%")
              ->orWhere(function ($q2) use ($lowerSearch) {
                 
                  $roleNumber = $this->getRoleNumber($lowerSearch);
                  $q2->where('role', $roleNumber);
              });
        });
    }
    $data['header_title'] = "List";
    $role = $request->input('role');
    if ($role) {
      $query->where('role', $role);
    }
    $data['getData'] = $query->simplePaginate(10);
    return view('admin.admin.list', $data);
}

private function getRoleNumber($roleName) {
    
    $roles = [
        'admin' => 1,
        'instructor' => 2,
        'student' => 3,
        'secretary' => 4,
    ];

   
    $lowerRoleName = mb_strtolower($roleName);

   
    if (isset($roles[$lowerRoleName])) {
        return $roles[$lowerRoleName];
    }

    
    return null;
}

    public function add(){
        $data['header_title'] = "Add User";
        return view('admin.admin.add',$data);
    }
    
    public function insert(Request $request)
    {
        $id_number = trim($request->id_number);

        if(User::where('id_number', $id_number)->exists()) {
            return redirect('admin/admin/add')->with('error', 'ID number already exists');
        }
        if(empty($request->password)) {
            return redirect('admin/admin/add')->with('error', 'Auto generated password error, PLEASE SELECT "USER DEFINED"');
        }
        $user = new User;
        $user->name = trim($request->name);
        $user->middle_name = trim($request->middle_name); 
        $user->last_name = trim($request->last_name);    
        $user->id_number = trim($request->id_number);
        $user->role = ($request->role);
        $user->password = ($request->password);
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
    public function update($id, Request $request) {
        $user = User::find($id);

        if(!$user) {
        return redirect()->back()->withErrors(['User not found']);
        }

        $existingUser = User::where('id_number', $request->id_number)->where('id', '!=', $id)->first();

        if($existingUser) {
            return redirect('admin/admin/list')->withErrors(['ID number already exists']); 
          }

        $user->name = trim($request->name);
        $user->middle_name = trim($request->middle_name);
        $user->last_name = trim($request->last_name);
        $user->id_number = trim($request->id_number);
        $user->role = $request->role;
        $user->secondary_role = $request->input('secondary_role');

        if(!empty($request->password)) {
        $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('admin/admin/list')->with('success', 'User updated successfully');
    }
     public function delete($id){
        try {
            $user = User::getSingleList($id);
            if ($user) {
                $user->delete();
                //// return a response
                return redirect('admin/admin/list')->with('success', 'User deleted successfully.');
            }
        } catch (\Exception $e) {
    
            return redirect('admin/admin/list')->with('error', 'Error deleting, Subjects are linked to this user ' . $e->getMessage());
    
        }
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

      return redirect('admin/admin/list')->with('error', 'Incorrect Password');
    
    }


/////////////change password///////////////
    public function showChangePasswordForm()
    {
        return view('admin.change_password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
         ], [
           'new_password.confirmed' => 'The new password and confirmation password do not match.',
        ]);

        $user = Auth::user();

       
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Your old password is incorrect.');
        }

    
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', ' Your password changed successfully.');
    }


//////////change password - newly logged in///////////////////


    public function showInitialChangePasswordForm()
        {
            return view('admin.initial_change_password');
        }

    public function initialChangePassword(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
         ], [
           'new_password.confirmed' => 'The new password and confirmation password do not match.',
        ]);

        $user = Auth::user();    
        $user->password = Hash::make($request->new_password);
        $user->password_changed = true;
        $user->save();

        return redirect('admin/admin/list')->with('success', 'Your password changed successfully.');
    }


    ////////////////for view student list//////////////////

    public function viewAllStudents(Request $request)
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

    return view('admin.student_list.view_students', compact('students'));
}
    
        public function viewEnrolledSubjects(Request $request, $studentId)
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


        return view('admin.student_list.enrolled_subjects', compact('student', 'enrolledSubjects'));
    }

   public function viewPastEnrolledSubjects(Request $request, $studentId)
{
       $student = User::find($studentId);
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

           
            $query = $student->enrolledSubjects()->whereIn('term', $previousTerms);

            
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
                $query->where('term', 'like', "%$term%");
            }

            $pastEnrolledSubjects = $query->get();

        } else {
            $pastEnrolledSubjects = [];
        }

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

    ///////for changeing instructor in a subject/////

    public function viewSubjects()
    {
      
      $currentSemester = Semester::where('is_current', true)->first();

   if ($currentSemester) {  

    $importedClasses = ImportedClasslist::with(['subject', 'instructor'])
        ->whereHas('subject', function ($query) use ($currentSemester) {
            
            $query->where('term', $currentSemester->semester_name . ', ' . $currentSemester->school_year);
        })
        ->get();

        } else {
        $importedClasses = [];
    }



    return view('admin.subject_list.view_subjects', compact('importedClasses'));
       
    }


    public function changeInstructorForm($importedClassId)
    {
       
        $importedClass = ImportedClasslist::findOrFail($importedClassId);

        
        $instructors = User::where('role', 2)
                       ->orWhere('secondary_role', 2)
                       ->get();

            return view('admin.subject_list.change_instructor', compact('importedClass', 'instructors'));
        }

    public function changeInstructor($importedClassId, Request $request)
    {
          //// fetch the selected imported class
        $importedClass = ImportedClasslist::findOrFail($importedClassId);

        ///// update the instructor_id in the imported class
        $importedClass->instructor_id = $request->input('newInstructor');
        $importedClass->save();


        return redirect()->route('admin.viewSubjects')->with('success', 'Instructor changed successfully');
    }

    ////////for the instructor list(the one in the side bar)//////////////////////

     public function showInstructors(Request $request)
{
   $query = User::where('role', 2)
             ->orWhere('secondary_role', 2);

   
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('middle_name', 'like', "%$search%")
              ->orWhere('last_name', 'like', "%$search%");
        });
    }

    $instructors = $query->get();

    return view('admin.teacher_list.instructor_list', compact('instructors'));
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

    return view('admin.teacher_list.subjects', compact('instructor', 'subjects'));
}

public function showPastInstructorSubjects(Request $request, $instructorId)
{
    $instructor = User::findOrFail($instructorId);
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


        $query = $instructor->taughtSubjects()->whereHas('subject', function ($q) use ($previousTerms) {
            $q->whereIn('term', $previousTerms);
        });

    
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->whereHas('subject', function ($sq) use ($search) {
                $sq->where('description', 'like', "%$search%")
                   ->orWhere('subject_code', 'like', "%$search%")
                   ->orWhere('section', 'like', "%$search%");
            });
        }

        
        if ($request->has('term')) {
            $term = $request->input('term');
            $query->whereHas('subject', function ($sq) use ($term) {
                $sq->where('term', 'like', "%$term%");
            });
        }

        $pastSubjects = $query->get();
    } else {
        $pastSubjects = [];
    }

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


public function futureSubjects($instructorId)
{

    $instructor = User::findOrFail($instructorId);


    $currentSemester = Semester::where('is_current', 1)->first();
    
    if (!$currentSemester) {
        return redirect()->back()->with('error', 'Current semester not found');
    }

 
    $currentTerm = $currentSemester->semester_name;
    $currentYear = $currentSemester->school_year;

    
    $nextTerm = $currentTerm;
    $nextYear = $currentYear;

    
    switch ($currentTerm) {
        case 'First Semester':
            $nextTerm = 'Second Semester';
            break;
        case 'Second Semester':
            $nextTerm = 'Short Term';
            break;
           case 'Short Term':
            $nextTerm = 'First Semester';


            $years = explode(' - ', $currentYear);
            if (count($years) == 2) {
                $nextYear = ($years[0] + 1) . ' - ' . ($years[1] + 1);
            }
            break;
    }

  
    $futureSubjects = ImportedClasslist::where('instructor_id', $instructorId)
        ->whereHas('subject', function ($query) use ($nextTerm, $nextYear) {
            $query->where('term', $nextTerm . ', ' . $nextYear);
        })
        ->get();

    return view('admin.teacher_list.future_subjects', compact('instructor', 'futureSubjects'));
}

public function assignSubjectForm($instructorId)
{
    $instructor = User::findOrFail($instructorId);
    $subjectDescriptions = SubjectDescription::all();
    $currentSemester = Semester::where('is_current', true)->first();
     $subjectTypes = SubjectType::all();

    return view('admin.teacher_list.assign_subject', compact('instructor', 'currentSemester', 'subjectDescriptions', 'subjectTypes'));
}

public function getSections($subjectDescriptionId)
{
       $sections = Section::where('subject_description_id', $subjectDescriptionId)->get();
        
       
        return response()->json($sections);
}

public function assignSubject(Request $request)
{
    $request->validate([
        'subject_code' => 'required',
        'description' => 'required',
        'section' => 'required',
        'term' => 'required',
        'subject_type' => 'required',
        'days' => 'required',
        'time' => 'required',
        'room' => 'required',
    ]);

    $subject = Subject::create([
        'subject_code' => $request->subject_code,
        'description' => $request->description,
        'section' => $request->section,
        'term' => $request->term,
        'subject_type' => $request->subject_type,
    ]);

    $importedClass = ImportedClasslist::create([
        'subjects_id' => $subject->id,
        'instructor_id' => $request->instructor_id,
        'days' => $request->days,
        'time' => $request->time,
        'room' => $request->room,
    ]);

   
    return redirect()->route('admin.teacher_list.future_subjects', ['instructorId' => $request->instructor_id])->with('success', 'Future subject assigned successfully');
}

public function editSubject($instructorId, $subjectId)
{
    $instructor = User::findOrFail($instructorId);
    $subject = Subject::findOrFail($subjectId);
    $importedClass = ImportedClasslist::where('subjects_id', $subjectId)->first();
    $currentSemester = Semester::where('is_current', true)->first();
    $subjectDescriptions = SubjectDescription::all();
     $subjectTypes = SubjectType::all();

    return view('admin.teacher_list.edit_subject', compact('instructor',  'currentSemester', 'subject', 'importedClass', 'subjectDescriptions', 'subjectTypes'));
}

public function updateSubject(Request $request)
{
    $request->validate([
        'subject_code' => 'required',
        'description' => 'required',
        'section' => 'required',
        'term' => 'required',
        'subject_type' => 'required',
        'days' => 'required',
        'time' => 'required',
        'room' => 'required',
    ]);

    $subject = Subject::findOrFail($request->subject_id);
    $subject->update([
        'subject_code' => $request->subject_code,
        'description' => $request->description,
        'section' => $request->section,
        'term' => $request->term,
        'subject_type' => $request->subject_type,
    ]);

    $importedClass = ImportedClasslist::where('subjects_id', $subject->id)->first();
    $importedClass->update([
        'days' => $request->days,
        'time' => $request->time,
        'room' => $request->room,
    ]);

    return redirect()->route('admin.teacher_list.future_subjects', ['instructorId' => $request->instructor_id])->with('success', 'Subject updated successfully');
}

   public function viewSection(SubjectDescription $subjectDescription)
    {
        $sections = $subjectDescription->sections;
        return view('admin.assessment_description.view_section', compact('sections', 'subjectDescription'));
    }

    public function storeSection(Request $request)
    {
       
        $request->validate([
            'subject_description_id' => 'required|exists:subject_descriptions,id',
            'section_name' => 'required|string|max:255',
            
        ]);

       
        $section = new Section();
        $section->subject_description_id = $request->subject_description_id;
         $section->section_name = $request->section_name;
        $section->save();

       
        return redirect()->back()->with('success', 'Section created successfully');
    }

    public function destroySection($id)
{
    
    $section = Section::findOrFail($id);
    $section->delete();

    
    return redirect()->back()->with('success', 'Section deleted successfully');
}

}
