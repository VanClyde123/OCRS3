<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Users;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller{
   
    public function studentsBySubject(Subject $subject)
    {
      $students = $subject->students;
      //$student = Student::find($Id);
       return view('teacher.list.studentlist', compact('students', 'subject'));
    }

    public function showChangePasswordForm3()
    {
        return view('student.change_password');
    }

    public function changePassword3(Request $request)
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


    public function showInitialChangePasswordForm3()
    {
        return view('student.initial_change_password');
    }

    public function initialChangePassword3(Request $request)
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

       return redirect()->route('student.subjectlist', ['studentId' => Auth::user()->id])->with('success', 'Your password changed successfully.');
    }


    public function getname()
    {

        $students = Student::with('user')->get();

        return view('students', compact('students'));
    }

    public function showNotifications()
    {
        $notifications = auth()->user()->unreadNotifications;
    //  dd($notifications);
        return view('student.subjectlist', compact('notifications'));
    }
    public function markNotificationsAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();

        
        Session::flash('notification', 'You have successfully marked the notifications as read.');

        return redirect()->back();
    }




}
