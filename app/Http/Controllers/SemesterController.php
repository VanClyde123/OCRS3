<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Semester;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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
        'school_year' => 'required|regex:/^\d{4} - \d{4}$/|unique:semesters,school_year,NULL,id,semester_name,' . $request->semester_name,
    ], [
        'school_year.unique' => 'The semester already exists.',
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
        'school_year' => 'required|regex:/^\d{4} - \d{4}$/|unique:semesters,school_year,NULL,id,semester_name,' . $request->semester_name,
    ], [
        'school_year.unique' => 'The semester already exists.',
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
    $currentYear = Carbon::now()->year;
    $baseYear = 2023;

    ////for generating school years strating from 2023 to ccurrent year + next year
    $schoolYears = [];
    for ($year = $baseYear; $year <= $currentYear + 1; $year++) {
                $schoolYears[] = "$year - " . ($year + 1);
            }

   
    return view('admin.set_semester.set_current', compact('semesters', 'currentSemester', 'schoolYears'));
}

public function setupCurrentSemester(Request $request)
{
    
    $request->validate([
        'semester_name' => 'required',
        'school_year' => 'required',
    ]);

    //////update is current value
    Semester::query()->update(['is_current' => false]);

    ////////update or create selected semester + school year and set as current 
    Semester::updateOrCreate(
        [
            'semester_name' => $request->semester_name,
            'school_year' => $request->school_year,
        ],
        ['is_current' => true]
    );

    return redirect('admin/set_semester/set_current')
        ->with('success', 'Current semester updated successfully');
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
        'school_year' => 'required|regex:/^\d{4} - \d{4}$/|unique:semesters,school_year,NULL,id,semester_name,' . $request->semester_name,
    ], [
        'school_year.unique' => 'The semester already exists.',
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
        'school_year' => 'required|regex:/^\d{4} - \d{4}$/|unique:semesters,school_year,NULL,id,semester_name,' . $request->semester_name,
    ], [
        'school_year.unique' => 'The semester already exists.',
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
    $currentYear = Carbon::now()->year;
    $baseYear = 2023;

    ////for generating school years strating from 2023 to ccurrent year + next year
    $schoolYears = [];
    for ($year = $baseYear; $year <= $currentYear + 1; $year++) {
                $schoolYears[] = "$year - " . ($year + 1);
            }

   
    return view('secretary.set_semester.set_current', compact('semesters', 'currentSemester', 'schoolYears'));
}

public function setupCurrentSemester1(Request $request)
{
    
     $request->validate([
        'semester_name' => 'required',
        'school_year' => 'required',
    ]);

    //////update is current value
    Semester::query()->update(['is_current' => false]);

    ////////update or create selected semester + school year and set as current 
    Semester::updateOrCreate(
        [
            'semester_name' => $request->semester_name,
            'school_year' => $request->school_year,
        ],
        ['is_current' => true]
    );


    return redirect('secretary/set_semester/set_current')->with('success', 'Current semester updated successfully');
}
}
