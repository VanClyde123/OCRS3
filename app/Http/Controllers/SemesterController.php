<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;
use Illuminate\Support\Facades\DB;

class SemesterController extends Controller
{
   public function viewSemester()
    {
        $semesters = Semester::all();
        return view('admin.set_semester.view_semesters', compact('semesters'));
    }

     public function create()
    {
        return view('admin.set_semester.create_semester');
    }

    public function store(Request $request)
    {
         $request->validate([
        'semester_name' => 'required',
        'school_year' => 'required|regex:/^\d{4} - \d{4}$/|unique:semesters,school_year,NULL,id,semester_name,'.$request->semester_name,
    ]);

        Semester::create($request->all());

          return redirect('admin/set_semester/view_semesters')->with('success', 'Semester created successfully');
    }

    public function edit($id)
    {
        $semester = Semester::findOrFail($id);
        return view('admin.set_semester.edit_semester', compact('semester'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
        'semester_name' => 'required',
        'school_year' => 'required|regex:/^\d{4} - \d{4}$/|unique:semesters,school_year,NULL,id,semester_name,'.$request->semester_name,
    ]);

        $semester = Semester::findOrFail($id);
        $semester->update($request->all());

        return redirect('admin/set_semester/view_semesters')->with('success', 'Semester updated successfully');
    }

    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return redirect('admin/set_semester/view_semesters')->with('success', 'Semester deleted successfully');
    }


   public function setupCurrentSemesterView()
{
    $semesters = Semester::all();
    $currentSemester = Semester::where('is_current', true)->first();
    $schoolYears = $currentSemester ? Semester::where('semester_name', $currentSemester->semester_name)->pluck('school_year') : collect();

    return view('admin.set_semester.set_current', compact('semesters', 'currentSemester', 'schoolYears'));
}


public function setupCurrentSemester(Request $request)
{
    
    $request->validate([
        'semester_name' => 'required',
        'school_year' => 'required',
    ]);

    
    DB::table('semesters')->update(['is_current' => false]);

   
    Semester::where('semester_name', $request->semester_name)
        ->where('school_year', $request->school_year)
        ->update(['is_current' => true]);

    return redirect('admin/set_semester/set_current')->with('success', 'Current semester updated successfully');
}


public function getSchoolYears($term)
{
    
    $schoolYears = Semester::where('semester_name', $term)->pluck('school_year');

   
    return response()->json([
        'schoolYears' => $schoolYears
    ]);
}

///////secretary side///

public function viewSemester1()
    {
        $semesters = Semester::all();
        return view('secretary.set_semester.view_semesters', compact('semesters'));
    }

     public function create1()
    {
        return view('secretary.set_semester.create_semester');
    }

    public function store1(Request $request)
    {
        $request->validate([
            'semester_name' => 'required',
            'school_year' => 'required',
        ]);

        Semester::create($request->all());

          return redirect('secretary/set_semester/view_semesters')->with('success', 'Semester created successfully');
    }

    public function edit1($id)
    {
        $semester = Semester::findOrFail($id);
        return view('secretary.set_semester.edit_semester', compact('semester'));
    }

    public function update1(Request $request, $id)
    {
        $request->validate([
            'semester_name' => 'required',
            'school_year' => 'required',
        ]);

        $semester = Semester::findOrFail($id);
        $semester->update($request->all());

        return redirect('secretary/set_semester/view_semesters')->with('success', 'Semester updated successfully');
    }

    public function destroy1($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return redirect('secretary/set_semester/view_semesters')->with('success', 'Semester deleted successfully');
    }


    public function setupCurrentSemesterView1()
{
   $semesters = Semester::all();
    $currentSemester = Semester::where('is_current', true)->first();
    $schoolYears = $currentSemester ? Semester::where('semester_name', $currentSemester->semester_name)->pluck('school_year') : collect();

   
    return view('secretary.set_semester.set_current', compact('semesters', 'currentSemester', 'schoolYears'));
}

public function setupCurrentSemester1(Request $request)
{
    
    $request->validate([
        'semester_name' => 'required',
        'school_year' => 'required',
    ]);

    
    DB::table('semesters')->update(['is_current' => false]);

   
    Semester::where('semester_name', $request->semester_name)
        ->where('school_year', $request->school_year)
        ->update(['is_current' => true]);


    return redirect('secretary/set_semester/set_current')->with('success', 'Current semester updated successfully');
}
}
