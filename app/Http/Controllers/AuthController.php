<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
//hashing passwords
use Hash;
//for authentication
use Auth;

class AuthController extends Controller
{
    public function login()
    {    
        //use Hash for pass
      //dd(Hash::make(12345));


        if(!empty(Auth::check()))
        {
            if(Auth::user()->role == 1)
            {
              return redirect('admin/admin/list');
            }
            else if(Auth::user()->role == 2)
            {
              return redirect('teacher/list/classlist');
            }
            else if(Auth::user()->role == 3)
            {
                
               return redirect()->route('student.subjectlist', ['studentId' => Auth::user()->id]);
            }
            else if(Auth::user()->role == 4)
            {
              return redirect('secretary/teacher_list/instructor_list');
            }
        }

        return view('auth.login');
    }

     public function AuthLogin(Request $request)
    {
      //dd($request->all());

        if(Auth::attempt(['id_number' => $request->id_number, 'password' => $request->password], true))
        {
            if (!Auth::user()->password_changed) {
            ////// redirect users to change password page based on their role number
            switch (Auth::user()->role) {
                case 1:
                    return redirect()->route('initial-change-password');
                    break;
                case 2:
                    return redirect()->route('initial-change-password2');
                    break;
                case 3:
                    return redirect()->route('initial-change-password3');
                    break;
                case 4:
                    return redirect()->route('initial-change-password1');
                    break;
                default:
                
                    break;
            }
        }
        
        ////// redirect users to thier default page based on their role number
        switch (Auth::user()->role) {
            case 1:
                return redirect('admin/admin/list');
                break;
            case 2:
                return redirect('teacher/list/classlist');
                break;
            case 3:
                return redirect()->route('student.subjectlist', ['studentId' => Auth::user()->id]);
                break;
            case 4:
                return redirect('secretary/teacher_list/instructor_list');
                break;
            default:
                // Add default redirection logic if necessary
                break;
        }
    }
        else
        {
            return redirect()->back()->with('error', 'Enter correct ID number and password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url(''));
    }
}





 