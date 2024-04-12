<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssessmentDescription;
use App\Models\SubjectDescription;

class AssessmentDescriptionController extends Controller
{
     public function viewDesc(SubjectDescription $subjectDescription)
{
    $subjectDescId = $subjectDescription->id;
    $assessmentDescriptions = $subjectDescription->assessmentDescriptions;

    return view('admin.assessment_description.view_desc', compact('assessmentDescriptions', 'subjectDescId', 'subjectDescription'));
}

   public function create($subjectDescId)
{
    return view('admin.assessment_description.create_desc', compact('subjectDescId'));
}

    public function store(Request $request)
    {
       $request->validate([
        'grading_period' => 'required|string',
        'type' => 'required|string',
        'description' => 'required|string',
        'subject_desc_id' => 'required|exists:subject_descriptions,id',
    ]);

    $assessmentDescription = AssessmentDescription::create([
        'grading_period' => $request->grading_period,
        'type' => $request->type,
        'description' => $request->description,
        'subject_desc_id' => $request->subject_desc_id,
    ]);

    return redirect()->route('assessment_descriptions.view', ['subjectDescription' => $assessmentDescription->subject_desc_id])
        ->with('success', 'Assessment description created successfully');
    }

    public function edit(AssessmentDescription $assessmentDescription)
    {
        return view('admin.assessment_description.edit_desc', compact('assessmentDescription'));
    }

    public function update(Request $request, AssessmentDescription $assessmentDescription)
    {
        $request->validate([
            'grading_period' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
        ]);

        $assessmentDescription->update($request->all());

      return redirect()->route('assessment_descriptions.view', ['subjectDescription' => $assessmentDescription->subject_desc_id])
            ->with('success', 'Assessment description updated successfully');
    }

    public function destroy(AssessmentDescription $assessmentDescription)
    {
        $assessmentDescription->delete();

         return redirect()->route('assessment_descriptions.view', ['subjectDescription' => $assessmentDescription->subject_desc_id])
            ->with('success', 'Assessment description deleted successfully');
    }

   public function fetch(Request $request)
{
    $type = $request->input('type');
    $gradingPeriod = $request->input('grading_period');
    $subjectCode = $request->input('subject_code');

    ////////Get the subject code in the record from subject_description table that matches the subject code from the subject table
    $subjectDescription = SubjectDescription::where('subject_code', $subjectCode)->first();

    if (!$subjectDescription) {
        return response()->json(['descriptions' => []]);
    }

    //////// get the  assessment descriptions associated with the matched subject code
    $descriptions = $subjectDescription->assessmentDescriptions()
        ->where('type', $type)
        ->where('grading_period', $gradingPeriod)
        ->get();



    return response()->json(['descriptions' => $descriptions]);
}


////////secretary side///////////////

 public function viewDesc1(SubjectDescription $subjectDescription)
{
    $subjectDescId = $subjectDescription->id;
    $assessmentDescriptions = $subjectDescription->assessmentDescriptions;

    return view('secretary.assessment_description.view_desc', compact('assessmentDescriptions', 'subjectDescId', 'subjectDescription'));
}

   public function create1($subjectDescId)
{
    return view('secretary.assessment_description.create_desc', compact('subjectDescId'));
}

    public function store1(Request $request)
    {
       $request->validate([
        'grading_period' => 'required|string',
        'type' => 'required|string',
        'description' => 'required|string',
        'subject_desc_id' => 'required|exists:subject_descriptions,id',
    ]);

    $assessmentDescription = AssessmentDescription::create([
        'grading_period' => $request->grading_period,
        'type' => $request->type,
        'description' => $request->description,
        'subject_desc_id' => $request->subject_desc_id,
    ]);

    return redirect()->route('assessment_descriptions.view1', ['subjectDescription' => $assessmentDescription->subject_desc_id])
        ->with('success', 'Assessment description created successfully');
    }

    public function edit1(AssessmentDescription $assessmentDescription)
    {
        return view('secretary.assessment_description.edit_desc', compact('assessmentDescription'));
    }

    public function update1(Request $request, AssessmentDescription $assessmentDescription)
    {
        $request->validate([
            'grading_period' => 'required|string',
            'type' => 'required|string',
            'description' => 'required|string',
        ]);

        $assessmentDescription->update($request->all());

      return redirect()->route('assessment_descriptions.view1', ['subjectDescription' => $assessmentDescription->subject_desc_id])
            ->with('success', 'Assessment description updated successfully');
    }

    public function destroy1(AssessmentDescription $assessmentDescription)
    {
        $assessmentDescription->delete();

         return redirect()->route('assessment_descriptions.view1', ['subjectDescription' => $assessmentDescription->subject_desc_id])
            ->with('success', 'Assessment description deleted successfully');
    }

   public function fetch1(Request $request)
{
    $type = $request->input('type');
    $gradingPeriod = $request->input('grading_period');
    $subjectCode = $request->input('subject_code');

   ////////Get the subject code in the record from subject_description table that matches the subject code from the subject table
    $subjectDescription = SubjectDescription::where('subject_code', $subjectCode)->first();

    if (!$subjectDescription) {
        return response()->json(['descriptions' => []]);
    }

       //////// get the  assessment descriptions associated with the matched subject code
    $descriptions = $subjectDescription->assessmentDescriptions()
        ->where('type', $type)
        ->where('grading_period', $gradingPeriod)
        ->get();



    return response()->json(['descriptions' => $descriptions]);
}

}