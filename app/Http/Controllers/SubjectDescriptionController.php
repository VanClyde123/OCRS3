<?php

namespace App\Http\Controllers;

use App\Models\SubjectDescription;
use App\Models\Subject;
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
         $subjects = Subject::select('subject_code', 'description')->distinct()->get();
        return view('admin.assessment_description.create_subject_desc', compact('subjects'));
    }

    public function store(Request $request)
    {
       $request->validate([
        'year_level' => 'required|integer',
        'subject_code' => 'required|string|unique:subject_descriptions,subject_code',
        'subject_name' => 'required|string',
    ], [
        'subject_code.unique' => 'Subject code already exists.',
    ]);

    SubjectDescription::create([
        'year_level' => $request->year_level,
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
            'year_level' => 'required|integer',
            'subject_code' => 'required|string|unique:subject_descriptions,subject_code,' . $subjectDescription->id,
            'subject_name' => 'required|string',
        ], [
            'subject_code.unique' => 'Subject code already exists.',
        ]);

        $subjectDescription->update([
            'year_level' => $request->year_level,
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
        ]);

        return redirect()->route('subject_descriptions.viewsubdesc')->with('success', 'Subject description updated successfully.');
    }

    public function destroy(SubjectDescription $subjectDescription)
{
    try {
       
        $subjectDescription->sections()->delete();
        $subjectDescription->delete();
        
        return redirect()
            ->route('subject_descriptions.viewsubdesc')
            ->with('success', 'Subject Description and the related sections deleted successfully.');

    } catch (\Exception $e) {
        return redirect()
            ->route('subject_descriptions.viewsubdesc')
            ->with('error', 'Error deleting subject description: ' . $e->getMessage());
    }
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
        $subjects = Subject::select('subject_code', 'description')->distinct()->get();
        return view('secretary.assessment_description.create_subject_desc', compact('subjects'));
    }

    public function store1(Request $request)
    {
       $request->validate([
        'year_level' => 'required|integer',
        'subject_code' => 'required|string|unique:subject_descriptions,subject_code',
        'subject_name' => 'required|string',
    ], [
        'subject_code.unique' => 'Subject code already exists.',
    ]);

    SubjectDescription::create([
        'year_level' => $request->year_level,
        'subject_code' => $request->subject_code,
        'subject_name' => $request->subject_name,
    ]);

    return redirect()->route('subject_descriptions.viewsubdesc1')->with('success', 'Subject description created successfully.');
}

    public function edit1(SubjectDescription $subjectDescription)
    {
        return view('secretary.assessment_description.edit_subject_desc', compact('subjectDescription'));
    }

    public function update1(Request $request, SubjectDescription $subjectDescription){
        $request->validate([
            'year_level' => 'required|integer',
           'subject_code' => 'required|string|unique:subject_descriptions,subject_code,' . $subjectDescription->id,
            'subject_name' => 'required|string',
         ], [
                'subject_code.unique' => 'Subject code already exists.',
            ]);
        $subjectDescription->update([
            'year_level' => $request->year_level,
            'subject_code' => $request->subject_code,
            'subject_name' => $request->subject_name,
        ]);

        return redirect()->route('subject_descriptions.viewsubdesc1')->with('success', 'Subject description updated successfully.');
    }
    public function destroy1(SubjectDescription $subjectDescription){
       try {
       
        $subjectDescription->sections()->delete();
        $subjectDescription->delete();
        
        return redirect()
            ->route('subject_descriptions.viewsubdesc1')
            ->with('success', 'Subject Description and the related sections deleted successfully.');

        } catch (\Exception $e) {
            return redirect()
                ->route('subject_descriptions.viewsubdesc1')
                ->with('error', 'Error deleting subject description: ' . $e->getMessage());
        }
    }
    public function show1(SubjectDescription $subjectDescription)
    {
        //// fetch assessment descriptions associated with the selected subject
        $assessmentDescriptions = $subjectDescription->assessmentDescriptions;

         return redirect()->route('assessment_descriptions.view', $subjectDescription->id);
    }
}
