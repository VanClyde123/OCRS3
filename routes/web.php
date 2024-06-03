<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
//use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
//use App\Http\Controllers\SubjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CalculateNumberController;
use App\Http\Controllers\ClassRecordController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\StudentSubjectsController;
use App\Http\Controllers\StudentScoreController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectTypeController;
use App\Http\Controllers\AssessmentDescriptionController;
use App\Http\Controllers\SecretaryController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SubjectDescriptionController;
use App\Http\Controllers\SectionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);




//admin side
Route::group(['middleware' => 'admin'], function () {
    
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list'])->name('admin.admin.list');
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);
    Route::get('/admin/admin/list/search', [AdminController::class, 'search']);



     Route::get('/admin/initial-change-password', [AdminController::class, 'showInitialChangePasswordForm'])->name('initial-change-password');
    Route::post('/admin/initial-change-password', [AdminController::class, 'initialChangePassword']);
    
    Route::get('/admin/change-password', [AdminController::class, 'showChangePasswordForm'])->name('change-password');
    Route::post('/admin/change-password', [AdminController::class, 'changePassword']);

  /////password auth for editing role
    Route::get('admin/admin/confirm-password/{id}', [AdminController::class, 'showPasswordConfirmation'])
    ->name('admin.confirm-password')
    ->middleware('auth'); 
    Route::post('admin/admin/confirm-password/{id}', [AdminController::class, 'confirmPassword'])
    ->middleware('auth');
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit'])
    ->name('admin.edit')
    ->middleware('auth'); 

     Route::get('/admin/teacher_list/instructor_list', [AdminController::class, 'showInstructors']);
     Route::get('/admin/teacher_list/search', [AdminController::class, 'showInstructors'])->name('admin.searchInstructors');
    Route::get('/admin/teacher_list/{instructorId}/subjects', [AdminController::class, 'showInstructorSubjects'])
    ->name('admin.teacher_list.subjects');
    Route::get('/admin/teacher_list/show_instructor_subjects/search/{instructorId}', [AdminController::class, 'showInstructorSubjects'])->name('admin.searchInstructorSubjects');
    Route::get('/admin/teacher_list/{instructorId}/past_subjects', [AdminController::class, 'showPastInstructorSubjects'])
    ->name('admin.teacher_list.past_subjects');
    Route::get('/admin/teacher_list/show_past_instructor_subjects/search/{instructorId}', [AdminController::class, 'showPastInstructorSubjects'])->name('admin.searchPastInstructorSubjects');
    Route::get('/admin/teacher_list/{subject}/students', [AdminController::class, 'showEnrolledStudents'])->name('admin.teacher_list.enrolled_students');
    Route::get('admin/view-student-points/{studentId}/{subjectId}', [AdminController::class, 'viewStudentPoints'])->name('admin.view.student.points');


    Route::get('admin/teacher_list/future_subjects/{instructorId}', [AdminController::class, 'futureSubjects'])->name('admin.teacher_list.future_subjects');
    Route::get('admin/teacher_list/assign_subject/{instructorId}', [AdminController::class, 'assignSubjectForm'])->name('admin.teacher_list.assign_subject');
    Route::post('admin/teacher_list/assign_subject', [AdminController::class, 'assignSubject'])->name('admin.teacher_list.store_subject');

   
    Route::get('admin/subject_types/viewtypes', [SubjectTypeController::class, 'viewTypes']);
    Route::get('admin/subject_types/createtypes', [SubjectTypeController::class, 'create'])->name('subject_types.create');
    Route::post('admin/subject_types/createtypes', [SubjectTypeController::class, 'store'])->name('subject_types.store');
    Route::get('admin/subject_types/edittypes/{id}', [SubjectTypeController::class, 'edit'])->name('subject_types.edit');
    Route::put('admin/subject_types/edittypes/{id}', [SubjectTypeController::class, 'update'])->name('subject_types.update');
    Route::delete('admin/subject_types/{id}', [SubjectTypeController::class, 'destroy'])->name('subject_types.destroy');

    /////////routes for subjects descriptions
    Route::get('admin/subject_descriptions', [SubjectDescriptionController::class, 'viewsubdesc'])->name('subject_descriptions.viewsubdesc');
    Route::get('admin/subject_descriptions/create', [SubjectDescriptionController::class, 'create'])->name('subject_descriptions.create');
    Route::post('admin/subject_descriptions', [SubjectDescriptionController::class, 'store'])->name('subject_descriptions.store');
    Route::get('admin/subject_descriptions/{subjectDescription}/edit', [SubjectDescriptionController::class, 'edit'])->name('subject_descriptions.edit');
    Route::put('admin/subject_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'update'])->name('subject_descriptions.update');
    Route::delete('admin/subject_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'destroy'])->name('subject_descriptions.destroy');
    Route::get('admin/assessment_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'show'])->name('assessment_descriptions.view_desc');

  Route::get('/admin/get-sections/{subjectDescriptionId}', [AdminController::class, 'getSections'])->name('admin.get_sections');
  Route::get('/admin/teacher_list/{instructorId}/edit_subject/{subjectId}', [AdminController::class, 'editSubject'])->name('admin.teacher_list.edit_subject');
Route::post('/admin/teacher_list/update_subject', [AdminController::class, 'updateSubject'])->name('admin.teacher_list.update_subject');

Route::get('/sections/{subjectDescription}', [AdminController::class, 'viewSection'])->name('sections.index');
Route::post('/sections/store', [AdminController::class, 'storeSection'])->name('sections.store');
Route::delete('/sections/{section}', [AdminController::class, 'destroySection'])->name('sections.destroy');
     
   ///////routes for assessments descriptions
   Route::get('admin/assessment_description/view_desc/{subjectDescription}', [AssessmentDescriptionController::class, 'viewDesc'])->name('assessment_descriptions.view');
   Route::get('assessment-descriptions/create/{subjectDescId}', [AssessmentDescriptionController::class, 'create'])->name('assessment-descriptions.create');
    Route::post('admin/assessment_description/view_desc', [AssessmentDescriptionController::class, 'store'])->name('assessment-descriptions.store');
    Route::get('assessment-descriptions/{assessment_description}/edit', [AssessmentDescriptionController::class, 'edit'])->name('assessment-descriptions.edit');
    Route::put('assessment-descriptions/{assessment_description}', [AssessmentDescriptionController::class, 'update'])->name('assessment-descriptions.update');
    Route::delete('assessment-descriptions/{assessment_description}', [AssessmentDescriptionController::class, 'destroy'])->name('assessment-descriptions.destroy');
    
    Route::get('admin/set_semester/view_semesters', [SemesterController::class, 'viewSemester'])->name('semesters.view_semesters');  
    Route::get('admin/semesters/create', [SemesterController::class, 'create'])->name('semesters.create');
    Route::post('admin/set_semester/view_semesters', [SemesterController::class, 'store'])->name('semesters.store');
    Route::get('admin/semesters/{id}/edit', [SemesterController::class, 'edit'])->name('semesters.edit');
    Route::put('admin/semesters/{id}', [SemesterController::class, 'update'])->name('semesters.update');
    Route::delete('admin/semesters/{id}', [SemesterController::class, 'destroy'])->name('semesters.destroy');

    Route::get('/admin/getSchoolYears/{term}', [SemesterController::class, 'getSchoolYears']);

    Route::get('admin/set_semester/set_current', [SemesterController::class, 'setupCurrentSemesterView'])->name('semesters.setupCurrentView');
    Route::post('admin/set-current-semester', [SemesterController::class, 'setupCurrentSemester'])->name('semesters.setupCurrent');
       
    Route::get('/admin/student_list/view_students', [AdminController::class, 'viewAllStudents'])->name('admin.viewAllStudents');
    Route::get('/admin/student_list/search', [AdminController::class, 'viewAllStudents'])->name('admin.searchStudents');
    Route::get('/admin/student_list/view-enrolled-subjects/{studentId}', [AdminController::class, 'viewEnrolledSubjects'])->name('admin.viewEnrolledSubjects');
    Route::get('/admin/student_list/view_enrolled_subjects/search/{studentId}', [AdminController::class, 'viewEnrolledSubjects'])->name('admin.searchEnrolledSubjects');
     Route::get('/admin/student_list/view-past-enrolled-subjects/{studentId}', [AdminController::class, 'viewPastEnrolledSubjects'])->name('admin.viewPastEnrolledSubjects');
     Route::get('/admin/student_list/view_past_enrolled_subjects/search/{studentId}', [AdminController::class, 'viewPastEnrolledSubjects'])->name('admin.searchPastEnrolledSubjects');
    Route::get('/admin/student_list/view-grades/{studentId}/{subjectId}', [AdminController::class, 'viewGrades'])->name('admin.viewGrades');


    Route::get('/admin/subject_list/view_subjects',  [AdminController::class, 'viewSubjects'])->name('admin.viewSubjects');
    Route::get('/admin/subject_list/changeInstructor/{importedClassId}',[AdminController::class, 'changeInstructorForm'])->name('admin.changeInstructorForm');
    Route::post('/admin/subject_list/changeInstructor/{importedClassId}', [AdminController::class, 'changeInstructor'])->name('admin.changeInstructor');


   


    });
//teacher side
Route::group(['middleware' => 'instructor'], function () {

    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
 
    Route::get('teacher/list/importexcel', function () {
    return view('teacher.list.importexcel');
 
});


      Route::get('/teacher/initial-change-password', [InstructorController::class, 'showInitialChangePasswordForm2'])->name('initial-change-password2');
    Route::post('/teacher/initial-change-password', [InstructorController::class, 'initialChangePassword2']);

    Route::get('/teacher/change-password', [InstructorController::class, 'showChangePasswordForm2'])->name('change-password2');
    Route::post('/teacher/change-password', [InstructorController::class, 'changePassword2']);
    //Route::get('teacher/list/imported-data', function () {
   // return view('teacher.list.imported-data');
//});
    Route::post('teacher/list/importexcel', [ClassRecordController::class, 'import'])->name('teacher.list.importexcel');
    Route::post('teacher/list/imported-data', [ClassRecordController::class, 'import'])->name('teacher.list.imported-data');
    Route::post('save-data', [ClassRecordController::class, 'savedataexcel'])->name('save-data');
     //Route::post('/import-excel', [ClassRecordController::class, 'import'])->name('import.excel');
  //  Route::get('/imported-data', function () {
  // return view('imported-data');
//});
   // Route::get('teacher/scores/scores', function () {
    //return view('teacher.scores.scores');
//});
    //////for showing the enrolld students 
    Route::get('teacher/list/classlist', [InstructorController::class, 'listSubjects'])->name('teacher.list.classlist');
    Route::get('/teacher/searchSubjects', [InstructorController::class, 'listSubjects'])->name('teacher.searchSubjects');
    Route::get('teacher/list/past_classlist', [InstructorController::class, 'pastlistSubjects'])->name('teacher.list.past_classlist');
    Route::get('/teacher/searchPastSubjects', [InstructorController::class, 'pastlistSubjects'])->name('teacher.searchPastSubjects');
    Route::get('teacher/list/studentlist/{subject}', [InstructorController::class, 'viewEnrolledStudents'])->name('teacher.list.studentlist');
    Route::put('/teacher/list/classlist/{subject}/update-type', [SubjectController::class, 'updateSubjectType'])
    ->name('teacher.update.subject.type');
   // Route::get('teacher/list/classlist/{subject}/studentlist', [StudentController::class, 'studentsBySubject'])->name('teacher.list.studentlist');

    
  ////////saving the set assessment////
  
   Route::post('/assessments', [ScoreController::class, 'saveAssessment'])->name('assessments.store');
   Route::get('/assessments/fetch', [ScoreController::class, 'fetchAssessments'])->name('assessments.fetch');
   Route::put('/assessments/update', [ScoreController::class, 'updateAssessments'])->name('assessments.update');

   Route::get('/assessments/add', [ScoreController::class, 'showAddAssessmentForm'])->name('assessments.add');
    //////for insertinf the scoress(WIP)
   
   Route::get('fetch/assessment/details/{enrolledStudentId}', [ScoreController::class, 'fetchassessmentDetails'])
    ->name('fetch.assessment.details');


    Route::get('/assessments/{subjectId}', [InstructorController::class, 'editAssessments'])->name('instructor.editAssessments');
    Route::get('/assessments/{assessmentId}/edit', [InstructorController::class, 'editSingleAssessment'])->name('instructor.editSingleAssessment');
    Route::put('assessments/{assessmentId}/update', [InstructorController::class, 'updateAssessment'])->name('instructor.updateAssessment');

   Route::post('insert/score/{enrolledStudentId}', [ScoreController::class, 'insertScore'])->name('insert.score');
   Route::post('insert/scores', [ScoreController::class, 'insertScore'])->name('insert.scores');

Route::get('fetch/grades/{subjectId}/{enrolledStudentId}', [InstructorController::class, 'fetchGrades'])->name('fetch.grades');
   
  //Route::get('update/score/{enrolledStudentId}', [ScoreController::class, 'updateScore'])->name('update.score');
   Route::put('update/score/{enrolledStudentId}', [ScoreController::class, 'updateScore'])->name('update.score');

   Route::get('/report/{subjectId}', [ReportController::class, 'index'])->name('report.index');
   Route::get('/studentlistremove/{subjectId}', [InstructorController::class, 'viewStudentsRemove'])->name('teacher.list.studentlistremove');
   Route::get('/remove-student/{enrolledStudentId}', [InstructorController::class, 'removeStudent'])->name('remove.student');

  ////Route::get('/test-transmutation', [TestController::class, 'testTransmutation']);

  ///(WIP)rute for getting the score values based from grading period
   Route::get('get-scores', [ScoreController::class, 'getScores'])->name('get.scores');
 //   Route::get('teacher/scores/scores', [CalculateNumberController::class, 'index'])->name('teacher.scores.scores');
   // Route::post('/calculate', [CalculateNumberController::class, 'calculate'])->name('calculate');
    //for updating the numbers(scores)
   // Route::get('teacher/scores/scores/{id}/edit', [NumberController::class, 'edit'])->name('teacher.scores.scores.edit');
  //  Route::put('teacher/scores/scores/{id}', [NumberController::class, 'update'])->name('teacher.scores.scores.update');
   Route::get('/report/{subjectId}/generate-pdf', [ReportController::class, 'generatePdf'])->name('report.generatePdf');
   Route::get('/report/generateGradesList/{subjectId}', [ReportController::class, 'generateGradesList'])->name('report.generateGradesList');

    Route::get('/generate-excel/{subjectId}', [ReportController::class, 'generateExcelReport'])->name('generateExcelReport');
   Route::get('/export-grades/{subjectId}', [ReportController::class, 'exportGradesList'])
      ->name('export.gradeslist');
   Route::get('/generate-summary-report/{subjectId}', [ReportController::class, 'generateSummaryReport'])->name('export.summary');

   Route::delete('/delete-student/{enrolledStudentId}', [InstructorController::class, 'deleteStudent'])->name('delete.student');
   Route::get('/assessment-descriptions/fetch', [AssessmentDescriptionController::class, 'fetch'])->name('assessment-descriptions.fetch');

   Route::post('/update-publish-status',  [InstructorController::class,'updatePublishStatus'])->name('update.publish.status');
   Route::post('/update-publish-grades-status', [InstructorController::class,'updatePublishGradesStatus'])->name('update.publish.grades.status');

   Route::post('/update-grade-status',  [InstructorController::class,'updateStatus'])->name('update.grade.status');
  
});

//Route::get('/assessment-descriptions/{type}', [AssessmentDescriptionController::class, 'getDescriptionsByType'])
   // ->name('assessment-descriptions.type');
 //Route::get('/assessment-descriptions/{type}', [InstructorController::class, 'getDescriptionsByType'])
   // ->name('assessment-descriptions.type');

//student side
Route::group(['middleware' => 'student'], function () {
    
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
   Route::get('student/subjectlist/{studentId}', [StudentSubjectsController::class, 'studentsubjects'])
    ->name('student.subjectlist');
    Route::get('/student/searchEnrolledSubjects', [StudentSubjectsController::class, 'studentsubjects'])->name('student.searchEnrolledSubjects');
    Route::get('student/past_subjectlist/{studentId}', [StudentSubjectsController::class, 'studentpastsubjects'])
    ->name('student.studentpastsubjects');
    Route::get('/student/searchPastSubjects', [StudentSubjectsController::class, 'studentpastsubjects'])->name('student.searchPastSubjects');
   Route::get('student/scores/showscores/{enrolledStudentId}', [StudentScoreController::class, 'showscores'])->name('student.scores.showscores');
   Route::get('/student/notifications', [StudentScoreController::class, 'showNotifications'])->name('student.notifications');
Route::post('/student/mark-notifications-as-read', [StudentScoreController::class, 'markNotificationsAsRead'])->name('student.markNotificationsAsRead');

//////Route::post('/mark-as-viewed', [StudentScoresController::class, 'markAsViewed'])->name('student.scores.markAsViewed');

 Route::get('/student/initial-change-password', [StudentController::class, 'showInitialChangePasswordForm3'])->name('initial-change-password3');
    Route::post('/student/initial-change-password', [StudentController::class, 'initialChangePassword3']);

   Route::get('/student/change-password', [StudentController::class, 'showChangePasswordForm3'])->name('change-password3');
    Route::post('/student/change-password', [StudentController::class, 'changePassword3']);




});



Route::group(['middleware' => 'secretary'], function () {
    
    Route::get('secretary/dashboard', [DashboardController::class, 'dashboard']);
   Route::get('/secretary/teacher_list/instructor_list', [SecretaryController::class, 'showInstructors']);
     Route::get('/secretary/teacher_list/search', [SecretaryController::class, 'showInstructors'])->name('secretary.searchInstructors');
    Route::get('/secretary/teacher_list/{instructorId}/subjects', [SecretaryController::class, 'showInstructorSubjects'])
    ->name('secretary.teacher_list.subjects');
     Route::get('/secretary/teacher_list/show_instructor_subjects/search/{instructorId}', [SecretaryController::class, 'showInstructorSubjects'])->name('secretary.searchInstructorSubjects');
    Route::get('/secretary/teacher_list/{instructorId}/past_subjects', [SecretaryController::class, 'showPastInstructorSubjects'])
    ->name('secretary.teacher_list.past_subjects');
    Route::get('/secretary/teacher_list/show_past_instructor_subjects/search/{instructorId}', [SecretaryController::class, 'showPastInstructorSubjects'])->name('secretary.searchPastInstructorSubjects');
    Route::get('/secretary/teacher_list/{subject}/students', [SecretaryController::class, 'showEnrolledStudents'])->name('secretary.teacher_list.enrolled_students');
    Route::get('/view-student-points/{studentId}/{subjectId}', [SecretaryController::class, 'viewStudentPoints'])->name('view.student.points');

     Route::get('/secretary/student_list/view_students', [SecretaryController::class, 'viewAllStudents1'])->name('secretary.viewAllStudents1');
    Route::get('/secretary/student_list/search', [SecretaryController::class, 'viewAllStudents1'])->name('secretary.searchStudents1');
    Route::get('/secretary/student_list/view-enrolled-subjects/{studentId}', [SecretaryController::class, 'viewEnrolledSubjects1'])->name('secretary.viewEnrolledSubjects1');
    Route::get('/secretary/student_list/view_enrolled_subjects/search/{studentId}', [SecretaryController::class, 'viewEnrolledSubjects1'])->name('secretary.searchEnrolledSubjects1');
     Route::get('/secretary/student_list/view-past-enrolled-subjects/{studentId}', [SecretaryController::class, 'viewPastEnrolledSubjects1'])->name('secretary.viewPastEnrolledSubjects1');
     Route::get('/secretary/student_list/view_past_enrolled_subjects/search/{studentId}', [SecretaryController::class, 'viewPastEnrolledSubjects1'])->name('secretary.searchPastEnrolledSubjects1');
    Route::get('/secretary/student_list/view-grades/{studentId}/{subjectId}', [SecretaryController::class, 'viewGrades1'])->name('secretary.viewGrades1');

      Route::get('secretary/subject_types/viewtypes', [SubjectTypeController::class, 'viewTypes1']);
    Route::get('secretary/subject_types/createtypes', [SubjectTypeController::class, 'create1'])->name('subject_types.create1');
    Route::post('secretary/subject_types/createtypes', [SubjectTypeController::class, 'store1'])->name('subject_types.store1');
    Route::get('secretary/subject_types/edittypes/{id}', [SubjectTypeController::class, 'edit1'])->name('subject_types.edit1');
    Route::put('secretary/subject_types/edittypes/{id}', [SubjectTypeController::class, 'update1'])->name('subject_types.update1');
    Route::delete('secretary/subject_types/{id}', [SubjectTypeController::class, 'destroy1'])->name('subject_types.destroy1');


    Route::get('secretary/set_semester/view_semesters', [SemesterController::class, 'viewSemester1'])->name('semesters.view_semesters');  
    Route::get('/semesters/create', [SemesterController::class, 'create1'])->name('semesters.create1');
    Route::post('secretary/set_semester/view_semesters', [SemesterController::class, 'store1'])->name('semesters.store1');
    Route::get('/semesters/{id}/edit', [SemesterController::class, 'edit1'])->name('semesters.edit1');
    Route::put('/semesters/{id}', [SemesterController::class, 'update1'])->name('semesters.update1');
    Route::delete('/semesters/{id}', [SemesterController::class, 'destroy1'])->name('semesters.destroy1');

    Route::get('secretary/set_semester/set_current', [SemesterController::class, 'setupCurrentSemesterView1'])->name('semesters.setupCurrentView');
    Route::post('/set-current-semester', [SemesterController::class, 'setupCurrentSemester1'])->name('semesters.setupCurrent1');

     Route::get('/secretary/getSchoolYears/{term}', [SemesterController::class, 'getSchoolYears']);

     
       /////////routes for subjects descriptions
    Route::get('secretary/subject_descriptions', [SubjectDescriptionController::class, 'viewsubdesc1'])->name('subject_descriptions.viewsubdesc1');
    Route::get('secretary/subject_descriptions/create', [SubjectDescriptionController::class, 'create1'])->name('subject_descriptions.create1');
    Route::post('secretary/subject_descriptions', [SubjectDescriptionController::class, 'store1'])->name('subject_descriptions.store1');
    Route::get('secretary/subject_descriptions/{subjectDescription}/edit', [SubjectDescriptionController::class, 'edit1'])->name('subject_descriptions.edit1');
    Route::put('secretary/subject_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'update1'])->name('subject_descriptions.update1');
    Route::delete('secretary/subject_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'destroy1'])->name('subject_descriptions.destroy1');
    Route::get('secretary/assessment_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'show1'])->name('assessment_descriptions.view_desc1');




    Route::get('secretary/teacher_list/future_subjects/{instructorId}', [SecretaryController::class, 'futureSubjects1'])->name('secretary.teacher_list.future_subjects1');
    Route::get('secretary/teacher_list/assign_subject/{instructorId}', [SecretaryController::class, 'assignSubjectForm1'])->name('secretary.teacher_list.assign_subject1');
    Route::post('secretary/teacher_list/assign_subject', [SecretaryController::class, 'assignSubject1'])->name('secretary.teacher_list.store_subject1');



    Route::get('/secretary/get-sections/{subjectDescriptionId}', [SecretaryController::class, 'getSections1'])->name('secretary.get_sections1');
    Route::get('/secretary/teacher_list/{instructorId}/edit_subject/{subjectId}', [SecretaryController::class, 'editSubject1'])->name('secretary.teacher_list.edit_subject1');
    Route::post('/secretary/teacher_list/update_subject', [SecretaryController::class, 'updateSubject1'])->name('secretary.teacher_list.update_subject1');

    Route::get('/secretary/sections/{subjectDescription}', [SecretaryController::class, 'viewSection1'])->name('sections.index1');
    Route::post('/secretary/sections/store', [SecretaryController::class, 'storeSection1'])->name('sections.store1');
    Route::delete('/secretary/sections/{section}', [SecretaryController::class, 'destroySection1'])->name('sections.destroy1');



      Route::get('/secretary/initial-change-password', [SecretaryController::class, 'showInitialChangePasswordForm1'])->name('initial-change-password1');
    Route::post('/secretary/initial-change-password', [SecretaryController::class, 'initialChangePassword1']);


    Route::get('/secretary/change-password', [SecretaryController::class, 'showChangePasswordForm1'])->name('change-password1');
    Route::post('/secretary/change-password', [SecretaryController::class, 'changePassword1']);


     
       Route::get('secretary/assessment_description/view_desc/{subjectDescription}', [AssessmentDescriptionController::class, 'viewDesc1'])->name('assessment_descriptions.view1');
    Route::get('secretary/assessment-descriptions/create/{subjectDescId}', [AssessmentDescriptionController::class, 'create1'])->name('assessment-descriptions.create1');
    Route::post('secretary/assessment_description/view_desc', [AssessmentDescriptionController::class, 'store1'])->name('assessment-descriptions.store1');
    Route::get('secretary/assessment-descriptions/{assessment_description}/edit', [AssessmentDescriptionController::class, 'edit1'])->name('assessment-descriptions.edit1');
    Route::put('secretary/assessment-descriptions/{assessment_description}', [AssessmentDescriptionController::class, 'update1'])->name('assessment-descriptions.update1');
    Route::delete('secretary/assessment-descriptions/{assessment_description}', [AssessmentDescriptionController::class, 'destroy1'])->name('assessment-descriptions.destroy1');


Route::get('/secretary/subject_list/view_subjects',  [SecretaryController::class, 'viewSubjects1'])->name('secretary.viewSubjects1');
    Route::get('/secretary/subject_list/changeInstructor/{importedClassId}',[SecretaryController::class, 'changeInstructorForm1'])->name('secretary.changeInstructorForm1');
    Route::post('/secretary/subject_list/changeInstructor/{importedClassId}', [SecretaryController::class, 'changeInstructor1'])->name('secretary.changeInstructor1');


    });




Route::group(['middleware' => 'multiRole:admin|instructor'], function () {

    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list'])->name('admin.admin.list');
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);
    Route::get('/admin/admin/list/search', [AdminController::class, 'search']);



     Route::get('/admin/initial-change-password', [AdminController::class, 'showInitialChangePasswordForm'])->name('initial-change-password');
    Route::post('/admin/initial-change-password', [AdminController::class, 'initialChangePassword']);
    
    Route::get('/admin/change-password', [AdminController::class, 'showChangePasswordForm'])->name('change-password');
    Route::post('/admin/change-password', [AdminController::class, 'changePassword']);

  /////password auth for editing role
    Route::get('admin/admin/confirm-password/{id}', [AdminController::class, 'showPasswordConfirmation'])
    ->name('admin.confirm-password')
    ->middleware('auth'); 
    Route::post('admin/admin/confirm-password/{id}', [AdminController::class, 'confirmPassword'])
    ->middleware('auth');
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit'])
    ->name('admin.edit')
    ->middleware('auth'); 

     Route::get('/admin/teacher_list/instructor_list', [AdminController::class, 'showInstructors']);
     Route::get('/admin/teacher_list/search', [AdminController::class, 'showInstructors'])->name('admin.searchInstructors');
    Route::get('/admin/teacher_list/{instructorId}/subjects', [AdminController::class, 'showInstructorSubjects'])
    ->name('admin.teacher_list.subjects');
    Route::get('/admin/teacher_list/show_instructor_subjects/search/{instructorId}', [AdminController::class, 'showInstructorSubjects'])->name('admin.searchInstructorSubjects');
    Route::get('/admin/teacher_list/{instructorId}/past_subjects', [AdminController::class, 'showPastInstructorSubjects'])
    ->name('admin.teacher_list.past_subjects');
    Route::get('/admin/teacher_list/show_past_instructor_subjects/search/{instructorId}', [AdminController::class, 'showPastInstructorSubjects'])->name('admin.searchPastInstructorSubjects');
    Route::get('/admin/teacher_list/{subject}/students', [AdminController::class, 'showEnrolledStudents'])->name('admin.teacher_list.enrolled_students');
    Route::get('admin/view-student-points/{studentId}/{subjectId}', [AdminController::class, 'viewStudentPoints'])->name('admin.view.student.points');



     Route::get('admin/teacher_list/future_subjects/{instructorId}', [AdminController::class, 'futureSubjects'])->name('admin.teacher_list.future_subjects');
    Route::get('admin/teacher_list/assign_subject/{instructorId}', [AdminController::class, 'assignSubjectForm'])->name('admin.teacher_list.assign_subject');
    Route::post('admin/teacher_list/assign_subject', [AdminController::class, 'assignSubject'])->name('admin.teacher_list.store_subject');



   
    Route::get('admin/subject_types/viewtypes', [SubjectTypeController::class, 'viewTypes']);
    Route::get('admin/subject_types/createtypes', [SubjectTypeController::class, 'create'])->name('subject_types.create');
    Route::post('admin/subject_types/createtypes', [SubjectTypeController::class, 'store'])->name('subject_types.store');
    Route::get('admin/subject_types/edittypes/{id}', [SubjectTypeController::class, 'edit'])->name('subject_types.edit');
    Route::put('admin/subject_types/edittypes/{id}', [SubjectTypeController::class, 'update'])->name('subject_types.update');
    Route::delete('admin/subject_types/{id}', [SubjectTypeController::class, 'destroy'])->name('subject_types.destroy');

    /////////routes for subjects descriptions
    Route::get('admin/subject_descriptions', [SubjectDescriptionController::class, 'viewsubdesc'])->name('subject_descriptions.viewsubdesc');
    Route::get('admin/subject_descriptions/create', [SubjectDescriptionController::class, 'create'])->name('subject_descriptions.create');
    Route::post('admin/subject_descriptions', [SubjectDescriptionController::class, 'store'])->name('subject_descriptions.store');
    Route::get('admin/subject_descriptions/{subjectDescription}/edit', [SubjectDescriptionController::class, 'edit'])->name('subject_descriptions.edit');
    Route::put('admin/subject_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'update'])->name('subject_descriptions.update');
    Route::delete('admin/subject_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'destroy'])->name('subject_descriptions.destroy');
    Route::get('admin/assessment_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'show'])->name('assessment_descriptions.view_desc');

 Route::get('/admin/get-sections/{subjectDescriptionId}', [AdminController::class, 'getSections'])->name('admin.get_sections');

  Route::get('/admin/teacher_list/{instructorId}/edit_subject/{subjectId}', [AdminController::class, 'editSubject'])->name('admin.teacher_list.edit_subject');
Route::post('/admin/teacher_list/update_subject', [AdminController::class, 'updateSubject'])->name('admin.teacher_list.update_subject');

Route::get('/sections/{subjectDescription}', [AdminController::class, 'viewSection'])->name('sections.index');
Route::post('/sections/store', [AdminController::class, 'storeSection'])->name('sections.store');
Route::delete('/sections/{section}', [AdminController::class, 'destroySection'])->name('sections.destroy');
     
   ///////routes for assessments descriptions
  Route::get('admin/assessment_description/view_desc/{subjectDescription}', [AssessmentDescriptionController::class, 'viewDesc'])->name('assessment_descriptions.view');
   Route::get('assessment-descriptions/create/{subjectDescId}', [AssessmentDescriptionController::class, 'create'])->name('assessment-descriptions.create');
    Route::post('admin/assessment_description/view_desc', [AssessmentDescriptionController::class, 'store'])->name('assessment-descriptions.store');
    Route::get('assessment-descriptions/{assessment_description}/edit', [AssessmentDescriptionController::class, 'edit'])->name('assessment-descriptions.edit');
    Route::put('assessment-descriptions/{assessment_description}', [AssessmentDescriptionController::class, 'update'])->name('assessment-descriptions.update');
    Route::delete('assessment-descriptions/{assessment_description}', [AssessmentDescriptionController::class, 'destroy'])->name('assessment-descriptions.destroy');
    
    Route::get('admin/set_semester/view_semesters', [SemesterController::class, 'viewSemester'])->name('semesters.view_semesters');  
    Route::get('admin/semesters/create', [SemesterController::class, 'create'])->name('semesters.create');
    Route::post('admin/set_semester/view_semesters', [SemesterController::class, 'store'])->name('semesters.store');
    Route::get('admin/semesters/{id}/edit', [SemesterController::class, 'edit'])->name('semesters.edit');
    Route::put('admin/semesters/{id}', [SemesterController::class, 'update'])->name('semesters.update');
    Route::delete('admin/semesters/{id}', [SemesterController::class, 'destroy'])->name('semesters.destroy');

    Route::get('admin/set_semester/set_current', [SemesterController::class, 'setupCurrentSemesterView'])->name('semesters.setupCurrentView');
    Route::post('admin/set-current-semester', [SemesterController::class, 'setupCurrentSemester'])->name('semesters.setupCurrent');

    Route::get('/admin/getSchoolYears/{term}', [SemesterController::class, 'getSchoolYears']);
       
    Route::get('/admin/student_list/view_students', [AdminController::class, 'viewAllStudents'])->name('admin.viewAllStudents');
    Route::get('/admin/student_list/search', [AdminController::class, 'viewAllStudents'])->name('admin.searchStudents');
    Route::get('/admin/student_list/view-enrolled-subjects/{studentId}', [AdminController::class, 'viewEnrolledSubjects'])->name('admin.viewEnrolledSubjects');
    Route::get('/admin/student_list/view_enrolled_subjects/search/{studentId}', [AdminController::class, 'viewEnrolledSubjects'])->name('admin.searchEnrolledSubjects');
     Route::get('/admin/student_list/view-past-enrolled-subjects/{studentId}', [AdminController::class, 'viewPastEnrolledSubjects'])->name('admin.viewPastEnrolledSubjects');
     Route::get('/admin/student_list/view_past_enrolled_subjects/search/{studentId}', [AdminController::class, 'viewPastEnrolledSubjects'])->name('admin.searchPastEnrolledSubjects');
    Route::get('/admin/student_list/view-grades/{studentId}/{subjectId}', [AdminController::class, 'viewGrades'])->name('admin.viewGrades');


    Route::get('/admin/subject_list/view_subjects',  [AdminController::class, 'viewSubjects'])->name('admin.viewSubjects');
    Route::get('/admin/subject_list/changeInstructor/{importedClassId}',[AdminController::class, 'changeInstructorForm'])->name('admin.changeInstructorForm');
    Route::post('/admin/subject_list/changeInstructor/{importedClassId}', [AdminController::class, 'changeInstructor'])->name('admin.changeInstructor');


    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
 
    Route::get('teacher/list/importexcel', function () {
    return view('teacher.list.importexcel');
 
         });


      Route::get('/teacher/initial-change-password', [InstructorController::class, 'showInitialChangePasswordForm2'])->name('initial-change-password2');
    Route::post('/teacher/initial-change-password', [InstructorController::class, 'initialChangePassword2']);

    Route::get('/teacher/change-password', [InstructorController::class, 'showChangePasswordForm2'])->name('change-password2');
    Route::post('/teacher/change-password', [InstructorController::class, 'changePassword2']);
    //Route::get('teacher/list/imported-data', function () {
   // return view('teacher.list.imported-data');
//});
    Route::post('teacher/list/importexcel', [ClassRecordController::class, 'import'])->name('teacher.list.importexcel');
    Route::post('teacher/list/imported-data', [ClassRecordController::class, 'import'])->name('teacher.list.imported-data');
    Route::post('save-data', [ClassRecordController::class, 'savedataexcel'])->name('save-data');
     //Route::post('/import-excel', [ClassRecordController::class, 'import'])->name('import.excel');
  //  Route::get('/imported-data', function () {
  // return view('imported-data');
//});
   // Route::get('teacher/scores/scores', function () {
    //return view('teacher.scores.scores');
//});
    //////for showing the enrolld students 
    Route::get('teacher/list/classlist', [InstructorController::class, 'listSubjects'])->name('teacher.list.classlist');
    Route::get('/teacher/searchSubjects', [InstructorController::class, 'listSubjects'])->name('teacher.searchSubjects');
    Route::get('teacher/list/past_classlist', [InstructorController::class, 'pastlistSubjects'])->name('teacher.list.past_classlist');
    Route::get('/teacher/searchPastSubjects', [InstructorController::class, 'pastlistSubjects'])->name('teacher.searchPastSubjects');
    Route::get('teacher/list/studentlist/{subject}', [InstructorController::class, 'viewEnrolledStudents'])->name('teacher.list.studentlist');
    Route::put('/teacher/list/classlist/{subject}/update-type', [SubjectController::class, 'updateSubjectType'])
    ->name('teacher.update.subject.type');
   // Route::get('teacher/list/classlist/{subject}/studentlist', [StudentController::class, 'studentsBySubject'])->name('teacher.list.studentlist');

    
  ////////saving the set assessment////
  
   Route::post('/assessments', [ScoreController::class, 'saveAssessment'])->name('assessments.store');
   Route::get('/assessments/fetch', [ScoreController::class, 'fetchAssessments'])->name('assessments.fetch');
   Route::put('/assessments/update', [ScoreController::class, 'updateAssessments'])->name('assessments.update');

   Route::get('/assessments/add', [ScoreController::class, 'showAddAssessmentForm'])->name('assessments.add');
    //////for insertinf the scoress(WIP)
   
   Route::get('fetch/assessment/details/{enrolledStudentId}', [ScoreController::class, 'fetchassessmentDetails'])
    ->name('fetch.assessment.details');


    Route::get('/assessments/{subjectId}', [InstructorController::class, 'editAssessments'])->name('instructor.editAssessments');
    Route::get('/assessments/{assessmentId}/edit', [InstructorController::class, 'editSingleAssessment'])->name('instructor.editSingleAssessment');
    Route::put('assessments/{assessmentId}/update', [InstructorController::class, 'updateAssessment'])->name('instructor.updateAssessment');

   Route::post('insert/score/{enrolledStudentId}', [ScoreController::class, 'insertScore'])->name('insert.score');
   Route::post('insert/scores', [ScoreController::class, 'insertScore'])->name('insert.scores');

Route::get('fetch/grades/{subjectId}/{enrolledStudentId}', [InstructorController::class, 'fetchGrades'])->name('fetch.grades');
   
  //Route::get('update/score/{enrolledStudentId}', [ScoreController::class, 'updateScore'])->name('update.score');
   Route::put('update/score/{enrolledStudentId}', [ScoreController::class, 'updateScore'])->name('update.score');

   Route::get('/report/{subjectId}', [ReportController::class, 'index'])->name('report.index');
   Route::get('/studentlistremove/{subjectId}', [InstructorController::class, 'viewStudentsRemove'])->name('teacher.list.studentlistremove');
   Route::get('/remove-student/{enrolledStudentId}', [InstructorController::class, 'removeStudent'])->name('remove.student');

  ////Route::get('/test-transmutation', [TestController::class, 'testTransmutation']);

  ///(WIP)rute for getting the score values based from grading period
   Route::get('get-scores', [ScoreController::class, 'getScores'])->name('get.scores');
 //   Route::get('teacher/scores/scores', [CalculateNumberController::class, 'index'])->name('teacher.scores.scores');
   // Route::post('/calculate', [CalculateNumberController::class, 'calculate'])->name('calculate');
    //for updating the numbers(scores)
   // Route::get('teacher/scores/scores/{id}/edit', [NumberController::class, 'edit'])->name('teacher.scores.scores.edit');
  //  Route::put('teacher/scores/scores/{id}', [NumberController::class, 'update'])->name('teacher.scores.scores.update');
   Route::get('/report/{subjectId}/generate-pdf', [ReportController::class, 'generatePdf'])->name('report.generatePdf');
   Route::get('/report/generateGradesList/{subjectId}', [ReportController::class, 'generateGradesList'])->name('report.generateGradesList');

    Route::get('/generate-excel/{subjectId}', [ReportController::class, 'generateExcelReport'])->name('generateExcelReport');
   Route::get('/export-grades/{subjectId}', [ReportController::class, 'exportGradesList'])
      ->name('export.gradeslist');
   Route::get('/generate-summary-report/{subjectId}', [ReportController::class, 'generateSummaryReport'])->name('export.summary');

   Route::delete('/delete-student/{enrolledStudentId}', [InstructorController::class, 'deleteStudent'])->name('delete.student');
   Route::get('/assessment-descriptions/fetch', [AssessmentDescriptionController::class, 'fetch'])->name('assessment-descriptions.fetch');

   Route::post('/update-publish-status',  [InstructorController::class,'updatePublishStatus'])->name('update.publish.status');
   Route::post('/update-publish-grades-status', [InstructorController::class,'updatePublishGradesStatus'])->name('update.publish.grades.status');

   Route::post('/update-grade-status',  [InstructorController::class,'updateStatus'])->name('update.grade.status');


});

Route::group(['middleware' => 'multiRole:secretary|admin'], function () {

Route::get('secretary/dashboard', [DashboardController::class, 'dashboard']);
   Route::get('/secretary/teacher_list/instructor_list', [SecretaryController::class, 'showInstructors']);
     Route::get('/secretary/teacher_list/search', [SecretaryController::class, 'showInstructors'])->name('secretary.searchInstructors');
    Route::get('/secretary/teacher_list/{instructorId}/subjects', [SecretaryController::class, 'showInstructorSubjects'])
    ->name('secretary.teacher_list.subjects');
     Route::get('/secretary/teacher_list/show_instructor_subjects/search/{instructorId}', [SecretaryController::class, 'showInstructorSubjects'])->name('secretary.searchInstructorSubjects');
    Route::get('/secretary/teacher_list/{instructorId}/past_subjects', [SecretaryController::class, 'showPastInstructorSubjects'])
    ->name('secretary.teacher_list.past_subjects');
    Route::get('/secretary/teacher_list/show_past_instructor_subjects/search/{instructorId}', [SecretaryController::class, 'showPastInstructorSubjects'])->name('secretary.searchPastInstructorSubjects');
    Route::get('/secretary/teacher_list/{subject}/students', [SecretaryController::class, 'showEnrolledStudents'])->name('secretary.teacher_list.enrolled_students');
    Route::get('/view-student-points/{studentId}/{subjectId}', [SecretaryController::class, 'viewStudentPoints'])->name('view.student.points');

     Route::get('/secretary/student_list/view_students', [SecretaryController::class, 'viewAllStudents1'])->name('secretary.viewAllStudents1');
    Route::get('/secretary/student_list/search', [SecretaryController::class, 'viewAllStudents1'])->name('secretary.searchStudents1');
    Route::get('/secretary/student_list/view-enrolled-subjects/{studentId}', [SecretaryController::class, 'viewEnrolledSubjects1'])->name('secretary.viewEnrolledSubjects1');
    Route::get('/secretary/student_list/view_enrolled_subjects/search/{studentId}', [SecretaryController::class, 'viewEnrolledSubjects1'])->name('secretary.searchEnrolledSubjects1');
     Route::get('/secretary/student_list/view-past-enrolled-subjects/{studentId}', [SecretaryController::class, 'viewPastEnrolledSubjects1'])->name('secretary.viewPastEnrolledSubjects1');
     Route::get('/secretary/student_list/view_past_enrolled_subjects/search/{studentId}', [SecretaryController::class, 'viewPastEnrolledSubjects1'])->name('secretary.searchPastEnrolledSubjects1');
    Route::get('/secretary/student_list/view-grades/{studentId}/{subjectId}', [SecretaryController::class, 'viewGrades1'])->name('secretary.viewGrades1');

      Route::get('secretary/subject_types/viewtypes', [SubjectTypeController::class, 'viewTypes1']);
    Route::get('secretary/subject_types/createtypes', [SubjectTypeController::class, 'create1'])->name('subject_types.create1');
    Route::post('secretary/subject_types/createtypes', [SubjectTypeController::class, 'store1'])->name('subject_types.store1');
    Route::get('secretary/subject_types/edittypes/{id}', [SubjectTypeController::class, 'edit1'])->name('subject_types.edit1');
    Route::put('secretary/subject_types/edittypes/{id}', [SubjectTypeController::class, 'update1'])->name('subject_types.update1');
    Route::delete('secretary/subject_types/{id}', [SubjectTypeController::class, 'destroy1'])->name('subject_types.destroy1');


    Route::get('secretary/set_semester/view_semesters', [SemesterController::class, 'viewSemester1'])->name('semesters.view_semesters');  
    Route::get('/semesters/create', [SemesterController::class, 'create1'])->name('semesters.create1');
    Route::post('secretary/set_semester/view_semesters', [SemesterController::class, 'store1'])->name('semesters.store1');
    Route::get('/semesters/{id}/edit', [SemesterController::class, 'edit1'])->name('semesters.edit1');
    Route::put('/semesters/{id}', [SemesterController::class, 'update1'])->name('semesters.update1');
    Route::delete('/semesters/{id}', [SemesterController::class, 'destroy1'])->name('semesters.destroy1');

    Route::get('secretary/set_semester/set_current', [SemesterController::class, 'setupCurrentSemesterView1'])->name('semesters.setupCurrentView');
    Route::post('/set-current-semester', [SemesterController::class, 'setupCurrentSemester1'])->name('semesters.setupCurrent1');

     Route::get('/secretary/getSchoolYears/{term}', [SemesterController::class, 'getSchoolYears']);

     
       /////////routes for subjects descriptions
    Route::get('secretary/subject_descriptions', [SubjectDescriptionController::class, 'viewsubdesc1'])->name('subject_descriptions.viewsubdesc1');
    Route::get('secretary/subject_descriptions/create', [SubjectDescriptionController::class, 'create1'])->name('subject_descriptions.create1');
    Route::post('secretary/subject_descriptions', [SubjectDescriptionController::class, 'store1'])->name('subject_descriptions.store1');
    Route::get('secretary/subject_descriptions/{subjectDescription}/edit', [SubjectDescriptionController::class, 'edit1'])->name('subject_descriptions.edit1');
    Route::put('secretary/subject_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'update1'])->name('subject_descriptions.update1');
    Route::delete('secretary/subject_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'destroy1'])->name('subject_descriptions.destroy1');
    Route::get('secretary/assessment_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'show1'])->name('assessment_descriptions.view_desc1');



      Route::get('/secretary/initial-change-password', [SecretaryController::class, 'showInitialChangePasswordForm1'])->name('initial-change-password1');
    Route::post('/secretary/initial-change-password', [SecretaryController::class, 'initialChangePassword1']);


    Route::get('/secretary/change-password', [SecretaryController::class, 'showChangePasswordForm1'])->name('change-password1');
    Route::post('/secretary/change-password', [SecretaryController::class, 'changePassword1']);


     
       Route::get('secretary/assessment_description/view_desc/{subjectDescription}', [AssessmentDescriptionController::class, 'viewDesc1'])->name('assessment_descriptions.view1');
    Route::get('secretary/assessment-descriptions/create/{subjectDescId}', [AssessmentDescriptionController::class, 'create1'])->name('assessment-descriptions.create1');
    Route::post('secretary/assessment_description/view_desc', [AssessmentDescriptionController::class, 'store1'])->name('assessment-descriptions.store1');
    Route::get('secretary/assessment-descriptions/{assessment_description}/edit', [AssessmentDescriptionController::class, 'edit1'])->name('assessment-descriptions.edit1');
    Route::put('secretary/assessment-descriptions/{assessment_description}', [AssessmentDescriptionController::class, 'update1'])->name('assessment-descriptions.update1');
    Route::delete('secretary/assessment-descriptions/{assessment_description}', [AssessmentDescriptionController::class, 'destroy1'])->name('assessment-descriptions.destroy1');


Route::get('/secretary/subject_list/view_subjects',  [SecretaryController::class, 'viewSubjects1'])->name('secretary.viewSubjects1');
    Route::get('/secretary/subject_list/changeInstructor/{importedClassId}',[SecretaryController::class, 'changeInstructorForm1'])->name('secretary.changeInstructorForm1');
    Route::post('/secretary/subject_list/changeInstructor/{importedClassId}', [SecretaryController::class, 'changeInstructor1'])->name('secretary.changeInstructor1');

   Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list'])->name('admin.admin.list');
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);
    Route::get('/admin/admin/list/search', [AdminController::class, 'search']);



     Route::get('/admin/initial-change-password', [AdminController::class, 'showInitialChangePasswordForm'])->name('initial-change-password');
    Route::post('/admin/initial-change-password', [AdminController::class, 'initialChangePassword']);
    
    Route::get('/admin/change-password', [AdminController::class, 'showChangePasswordForm'])->name('change-password');
    Route::post('/admin/change-password', [AdminController::class, 'changePassword']);

  /////password auth for editing role
    Route::get('admin/admin/confirm-password/{id}', [AdminController::class, 'showPasswordConfirmation'])
    ->name('admin.confirm-password')
    ->middleware('auth'); 
    Route::post('admin/admin/confirm-password/{id}', [AdminController::class, 'confirmPassword'])
    ->middleware('auth');
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit'])
    ->name('admin.edit')
    ->middleware('auth'); 

     Route::get('/admin/teacher_list/instructor_list', [AdminController::class, 'showInstructors']);
     Route::get('/admin/teacher_list/search', [AdminController::class, 'showInstructors'])->name('admin.searchInstructors');
    Route::get('/admin/teacher_list/{instructorId}/subjects', [AdminController::class, 'showInstructorSubjects'])
    ->name('admin.teacher_list.subjects');
    Route::get('/admin/teacher_list/show_instructor_subjects/search/{instructorId}', [AdminController::class, 'showInstructorSubjects'])->name('admin.searchInstructorSubjects');
    Route::get('/admin/teacher_list/{instructorId}/past_subjects', [AdminController::class, 'showPastInstructorSubjects'])
    ->name('admin.teacher_list.past_subjects');
    Route::get('/admin/teacher_list/show_past_instructor_subjects/search/{instructorId}', [AdminController::class, 'showPastInstructorSubjects'])->name('admin.searchPastInstructorSubjects');
    Route::get('/admin/teacher_list/{subject}/students', [AdminController::class, 'showEnrolledStudents'])->name('admin.teacher_list.enrolled_students');
    Route::get('admin/view-student-points/{studentId}/{subjectId}', [AdminController::class, 'viewStudentPoints'])->name('admin.view.student.points');


     Route::get('admin/teacher_list/future_subjects/{instructorId}', [AdminController::class, 'futureSubjects'])->name('admin.teacher_list.future_subjects');
    Route::get('admin/teacher_list/assign_subject/{instructorId}', [AdminController::class, 'assignSubjectForm'])->name('admin.teacher_list.assign_subject');
    Route::post('admin/teacher_list/assign_subject', [AdminController::class, 'assignSubject'])->name('admin.teacher_list.store_subject');



   
    Route::get('admin/subject_types/viewtypes', [SubjectTypeController::class, 'viewTypes']);
    Route::get('admin/subject_types/createtypes', [SubjectTypeController::class, 'create'])->name('subject_types.create');
    Route::post('admin/subject_types/createtypes', [SubjectTypeController::class, 'store'])->name('subject_types.store');
    Route::get('admin/subject_types/edittypes/{id}', [SubjectTypeController::class, 'edit'])->name('subject_types.edit');
    Route::put('admin/subject_types/edittypes/{id}', [SubjectTypeController::class, 'update'])->name('subject_types.update');
    Route::delete('admin/subject_types/{id}', [SubjectTypeController::class, 'destroy'])->name('subject_types.destroy');

    /////////routes for subjects descriptions
    Route::get('admin/subject_descriptions', [SubjectDescriptionController::class, 'viewsubdesc'])->name('subject_descriptions.viewsubdesc');
    Route::get('admin/subject_descriptions/create', [SubjectDescriptionController::class, 'create'])->name('subject_descriptions.create');
    Route::post('admin/subject_descriptions', [SubjectDescriptionController::class, 'store'])->name('subject_descriptions.store');
    Route::get('admin/subject_descriptions/{subjectDescription}/edit', [SubjectDescriptionController::class, 'edit'])->name('subject_descriptions.edit');
    Route::put('admin/subject_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'update'])->name('subject_descriptions.update');
    Route::delete('admin/subject_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'destroy'])->name('subject_descriptions.destroy');
    Route::get('admin/assessment_descriptions/{subjectDescription}', [SubjectDescriptionController::class, 'show'])->name('assessment_descriptions.view_desc');


  Route::get('/admin/get-sections/{subjectDescriptionId}', [AdminController::class, 'getSections'])->name('admin.get_sections');

  Route::get('/admin/teacher_list/{instructorId}/edit_subject/{subjectId}', [AdminController::class, 'editSubject'])->name('admin.teacher_list.edit_subject');
Route::post('/admin/teacher_list/update_subject', [AdminController::class, 'updateSubject'])->name('admin.teacher_list.update_subject');

Route::get('/sections/{subjectDescription}', [AdminController::class, 'viewSection'])->name('sections.index');
Route::post('/sections/store', [AdminController::class, 'storeSection'])->name('sections.store');
Route::delete('/sections/{section}', [AdminController::class, 'destroySection'])->name('sections.destroy');
     
   ///////routes for assessments descriptions
  Route::get('admin/assessment_description/view_desc/{subjectDescription}', [AssessmentDescriptionController::class, 'viewDesc'])->name('assessment_descriptions.view');
   Route::get('assessment-descriptions/create/{subjectDescId}', [AssessmentDescriptionController::class, 'create'])->name('assessment-descriptions.create');
    Route::post('admin/assessment_description/view_desc', [AssessmentDescriptionController::class, 'store'])->name('assessment-descriptions.store');
    Route::get('assessment-descriptions/{assessment_description}/edit', [AssessmentDescriptionController::class, 'edit'])->name('assessment-descriptions.edit');
    Route::put('assessment-descriptions/{assessment_description}', [AssessmentDescriptionController::class, 'update'])->name('assessment-descriptions.update');
    Route::delete('assessment-descriptions/{assessment_description}', [AssessmentDescriptionController::class, 'destroy'])->name('assessment-descriptions.destroy');
    
    Route::get('admin/set_semester/view_semesters', [SemesterController::class, 'viewSemester'])->name('semesters.view_semesters');  
    Route::get('admin/semesters/create', [SemesterController::class, 'create'])->name('semesters.create');
    Route::post('admin/set_semester/view_semesters', [SemesterController::class, 'store'])->name('semesters.store');
    Route::get('admin/semesters/{id}/edit', [SemesterController::class, 'edit'])->name('semesters.edit');
    Route::put('admin/semesters/{id}', [SemesterController::class, 'update'])->name('semesters.update');
    Route::delete('admin/semesters/{id}', [SemesterController::class, 'destroy'])->name('semesters.destroy');

    Route::get('admin/set_semester/set_current', [SemesterController::class, 'setupCurrentSemesterView'])->name('semesters.setupCurrentView');
    Route::post('admin/set-current-semester', [SemesterController::class, 'setupCurrentSemester'])->name('semesters.setupCurrent');

    Route::get('/admin/getSchoolYears/{term}', [SemesterController::class, 'getSchoolYears']);
       
    Route::get('/admin/student_list/view_students', [AdminController::class, 'viewAllStudents'])->name('admin.viewAllStudents');
    Route::get('/admin/student_list/search', [AdminController::class, 'viewAllStudents'])->name('admin.searchStudents');
    Route::get('/admin/student_list/view-enrolled-subjects/{studentId}', [AdminController::class, 'viewEnrolledSubjects'])->name('admin.viewEnrolledSubjects');
    Route::get('/admin/student_list/view_enrolled_subjects/search/{studentId}', [AdminController::class, 'viewEnrolledSubjects'])->name('admin.searchEnrolledSubjects');
     Route::get('/admin/student_list/view-past-enrolled-subjects/{studentId}', [AdminController::class, 'viewPastEnrolledSubjects'])->name('admin.viewPastEnrolledSubjects');
     Route::get('/admin/student_list/view_past_enrolled_subjects/search/{studentId}', [AdminController::class, 'viewPastEnrolledSubjects'])->name('admin.searchPastEnrolledSubjects');
    Route::get('/admin/student_list/view-grades/{studentId}/{subjectId}', [AdminController::class, 'viewGrades'])->name('admin.viewGrades');


    Route::get('/admin/subject_list/view_subjects',  [AdminController::class, 'viewSubjects'])->name('admin.viewSubjects');
    Route::get('/admin/subject_list/changeInstructor/{importedClassId}',[AdminController::class, 'changeInstructorForm'])->name('admin.changeInstructorForm');
    Route::post('/admin/subject_list/changeInstructor/{importedClassId}', [AdminController::class, 'changeInstructor'])->name('admin.changeInstructor');

    

});


/// Route::get('/file-import',[UserController::class,
       ///     'importView'])->name('import-view');
 ///Route::post('/import',[UserController::class,
        //    'import'])->name('import');
/// Route::get('/export',[UserController::class,
      ///      'export'])->name('export');