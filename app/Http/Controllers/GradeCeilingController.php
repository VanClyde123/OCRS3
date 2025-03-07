<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradeCeilingSetting;

class GradeCeilingController extends Controller
{
     public function edit()
    {
          
        $gradeSetting = GradeCeilingSetting::where('identifier', 'default')->first();

        if (!$gradeSetting) {
           
            $gradeSetting = GradeCeilingSetting::create([
                'identifier' => 'default',
                'grade_above' => 80,
                'grade_lower' => 75,
                'grade_upper' => 79
            ]);
        }

        return view('admin.grade_ceiling_setting.grade_settings', compact('gradeSetting'));
    }

        public function update(Request $request)
        {
            $request->validate([
                'grade_above' => 'required|integer|min:70|max:100',
                'grade_lower' => 'required|integer|min:70|max:100',
                'grade_upper' => 'required|integer|min:70|max:100',
            ]);

            $gradeSetting = GradeCeilingSetting::where('identifier', 'default')->first();
            $gradeSetting->update([
                'grade_above' => $request->grade_above,
                'grade_lower' => $request->grade_lower,
                'grade_upper' => $request->grade_upper,
            ]);

            return redirect()->route('grade-ceiling.edit')->with('success', 'Grade ceilings updated.');
        }
}
