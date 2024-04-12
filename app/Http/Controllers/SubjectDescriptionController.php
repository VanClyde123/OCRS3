<?php

namespace App\Http\Controllers;

use App\Models\SubjectDescription;
use Illuminate\Http\Request;

class SubjectDescriptionController extends Controller
{
    public function viewsubdesc()
    {
        $subjectDescriptions = SubjectDescription::all();
        return view('admin.assessment_description.view_subject_desc', compact('subjectDescriptions'));
    }

    public function create()
    {
        return view('admin.assessment_description.create_subject_desc');
    }

    public function store(Request $request)
    {
       $request->validate([
        'subject_code' => 'required|string|unique:subject_descriptions,subject_code',
        'subject_name' => 'required|string',
    ], [
        'subject_code.unique' => 'Subject code already exists.',
    ]);

    SubjectDescription::create([
        'subject_code' => $request->subject_code,
        'subject_name' => $request->subject_name,
    ]);

    return redirect()->route('subject_descriptions.viewsubdesc')->with('success', 'Subject description created successfully.');
}

    public function edit(SubjectDescription $subjectDescription)
    {
        return view('admin.assessment_description.edit_subject_desc', compact('subjectDescription'));
    }

    public function update(Request $request, SubjectDescription $subjectDescription)
    {
        $request->validate([
            'subject_code' => 'required|string',
            'subject_name' => 'required|string',
        ]);

        $subjectDescription->update([
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
        ]);

        return redirect()->route('subject_descriptions.viewsubdesc')->with('success', 'Subject description updated successfully.');
    }

    public function destroy(SubjectDescription $subjectDescription)
    {
        $subjectDescription->delete();
        return redirect()->route('subject_descriptions.viewsubdesc')->with('success', 'Subject description deleted successfully.');
    }

    public function show(SubjectDescription $subjectDescription)
    {
        
        $assessmentDescriptions = $subjectDescription->assessmentDescriptions;

         return redirect()->route('assessment_descriptions.view', $subjectDescription->id);
    }

    //////////////secretary side/////////////////////


      public function viewsubdesc1()
    {
        $subjectDescriptions = SubjectDescription::all();
        return view('secretary.assessment_description.view_subject_desc', compact('subjectDescriptions'));
    }

    public function create1()
    {
        return view('secretary.assessment_description.create_subject_desc');
    }

    public function store1(Request $request)
    {
       $request->validate([
        'subject_code' => 'required|string|unique:subject_descriptions,subject_code',
        'subject_name' => 'required|string',
    ], [
        'subject_code.unique' => 'Subject code already exists.',
    ]);

    SubjectDescription::create([
        'subject_code' => $request->subject_code,
        'subject_name' => $request->subject_name,
    ]);

    return redirect()->route('subject_descriptions.viewsubdesc1')->with('success', 'Subject description created successfully.');
}

    public function edit1(SubjectDescription $subjectDescription)
    {
        return view('secretary.assessment_description.edit_subject_desc', compact('subjectDescription'));
    }

    public function update1(Request $request, SubjectDescription $subjectDescription)
    {
        $request->validate([
            'subject_code' => 'required|string',
            'subject_name' => 'required|string',
        ]);

        $subjectDescription->update([
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
        ]);

        return redirect()->route('subject_descriptions.viewsubdesc1')->with('success', 'Subject description updated successfully.');
    }

    public function destroy1(SubjectDescription $subjectDescription)
    {
        $subjectDescription->delete();
        return redirect()->route('subject_descriptions.viewsubdesc1')->with('success', 'Subject description deleted successfully.');
    }

    public function show1(SubjectDescription $subjectDescription)
    {
        // Fetch assessment descriptions associated with the selected subject
        $assessmentDescriptions = $subjectDescription->assessmentDescriptions;

         return redirect()->route('assessment_descriptions.view', $subjectDescription->id);
    }
}
