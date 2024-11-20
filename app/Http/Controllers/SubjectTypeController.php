<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubjectType;
use App\Models\Subject;

class SubjectTypeController extends Controller
{
      public function viewTypes()
    {
        $subjectTypes = SubjectType::all();

        return view('admin.subject_types.viewtypes', compact('subjectTypes'));
    }

    public function create()
    {
        return view('admin.subject_types.createtypes');
    }

    public function store(Request $request)
    {
        $request->validate([
        'subject_type' => 'required|unique:subject_type_percentage',
        'lec_percentage' => 'required|numeric|min:0|max:1',
        'lab_percentage' => 'required|numeric|min:0|max:1',
        ], [
            'subject_type.unique' => 'The class type name must be unique.',
        ]);

       
        $existingType = SubjectType::where('lec_percentage', $request->lec_percentage)
                                    ->where('lab_percentage', $request->lab_percentage)
                                    ->first();

    if ($existingType) {
            return redirect()->back()->withErrors(['The lecture and lab percentages combination already exists.'])->withInput();
        }

    SubjectType::create($request->all());

        return redirect('admin/subject_types/viewtypes')->with('success', 'Subject type added successfully.');
    }

    public function edit($id)
    {
        $subjectType = SubjectType::findOrFail($id);

         $subjectExists = Subject::where('subject_type', $subjectType->subject_type)->exists();

        
            if ($subjectExists) {
                    return redirect('admin/subject_types/viewtypes')->with('error', 'This class type is in use and cannot be edited.');
                }

        return view('admin.subject_types.edittypes', compact('subjectType'));
    }

    public function update(Request $request, $id)
    {
        $subjectType = SubjectType::findOrFail($id);

        $request->validate([
            'subject_type' => 'required|unique:subject_type_percentage,subject_type,' . $id,
            'lec_percentage' => 'required|numeric|min:0|max:1',
            'lab_percentage' => 'required|numeric|min:0|max:1',
        ], [
            'subject_type.unique' => 'The class type name must be unique.',
        ]);

       
        $existingType = SubjectType::where('lec_percentage', $request->lec_percentage)
                                    ->where('lab_percentage', $request->lab_percentage)
                                    ->where('id', '!=', $id) 
                                    ->first();

        if ($existingType) {
            return redirect()->back()->withErrors(['The lecture and lab percentages combination already exists.'])->withInput();
        }

    $subjectType->update($request->all());

         return redirect('admin/subject_types/viewtypes')->with('success', 'Subject type updated successfully.');
    }

    public function destroy($id)
    {
            
        $subjectType = SubjectType::findOrFail($id);
        $subjectExists = Subject::where('subject_type', $subjectType->subject_type)->exists();

        
            if ($subjectExists) {
                    return redirect('admin/subject_types/viewtypes')->with('error', 'This class type is in use and cannot be deleted.');
                }

       
                 $subjectType->delete();


         return redirect('admin/subject_types/viewtypes')->with('success', 'Class type deleted successfully.');
    }

    ///////////seceretay side///////////

      public function viewTypes1()
    {
        $subjectTypes = SubjectType::all();

        return view('secretary.subject_types.viewtypes', compact('subjectTypes'));
    }

    public function create1()
    {
        return view('secretary.subject_types.createtypes');
    }

    public function store1(Request $request)
    {
       $request->validate([
        'subject_type' => 'required|unique:subject_type_percentage',
        'lec_percentage' => 'required|numeric|min:0|max:1',
        'lab_percentage' => 'required|numeric|min:0|max:1',
        ], [
            'subject_type.unique' => 'The class type name must be unique.',
        ]);

       
        $existingType = SubjectType::where('lec_percentage', $request->lec_percentage)
                                    ->where('lab_percentage', $request->lab_percentage)
                                    ->first();

    if ($existingType) {
            return redirect()->back()->withErrors(['The lecture and lab percentages combination already exists.'])->withInput();
        }

    SubjectType::create($request->all());

        return redirect('secretary/subject_types/viewtypes')->with('success', 'Subject type added successfully.');
    }

    public function edit1($id)
    {
        $subjectType = SubjectType::findOrFail($id);

         $subjectExists = Subject::where('subject_type', $subjectType->subject_type)->exists();

        
            if ($subjectExists) {
                    return redirect('secretary/subject_types/viewtypes')->with('error', 'This class type is in use and cannot be edited.');
                }

        return view('secretary.subject_types.edittypes', compact('subjectType'));
    }

    public function update1(Request $request, $id)
    {
        $subjectType = SubjectType::findOrFail($id);

        $request->validate([
            'subject_type' => 'required|unique:subject_type_percentage,subject_type,' . $id,
            'lec_percentage' => 'required|numeric|min:0|max:1',
            'lab_percentage' => 'required|numeric|min:0|max:1',
        ], [
            'subject_type.unique' => 'The class type name must be unique.',
        ]);

       
        $existingType = SubjectType::where('lec_percentage', $request->lec_percentage)
                                    ->where('lab_percentage', $request->lab_percentage)
                                    ->where('id', '!=', $id) 
                                    ->first();

        if ($existingType) {
            return redirect()->back()->withErrors(['The lecture and lab percentages combination already exists.'])->withInput();
        }

    $subjectType->update($request->all());
         return redirect('secretary/subject_types/viewtypes')->with('success', 'Subject type updated successfully.');
    }

    public function destroy1($id)
    {
          $subjectType = SubjectType::findOrFail($id);
            $subjectExists = Subject::where('subject_type', $subjectType->subject_type)->exists();

            
                if ($subjectExists) {
                        return redirect('secretary/subject_types/viewtypes')->with('error', 'This class type is in use and cannot be deleted.');
                    }

           
                     $subjectType->delete();

         return redirect('secretary/subject_types/viewtypes')->with('success', 'Subject type deleted successfully.');
    }
}
