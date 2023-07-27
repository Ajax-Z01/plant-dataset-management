<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Project;
use Illuminate\Http\Request;

class NewProjectFormController extends Controller
{
    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        
        $this->validate($request, [
            'title' => 'required',
            'label' => 'required',
            'url_endpoint'=>'required',
            'access_key' => 'required',
            'secret_access_key' => 'required',
        ]);
        
        $project = Project::create([
            'title' => $request->title,
            // 'label' => $request->label,
            'url_endpoint' => $request->url_endpoint,
            'access_key' => $request->access_key,
            'secret_access_key' => $request->secret_access_key,
        ]);

        // the labels and link them to the project
        $labelsInput = $request->input('label');
        if ($labelsInput) {
            $labels = explode(',', $labelsInput);
            foreach ($labels as $labelName) {
                $label = Label::firstOrCreate(['name' => $labelName]);
                $project->labels()->attach($label->id);
            }
        }
        
        return redirect('/dashboard');
        // return redirect()->back()->with('success', 'Project created successfully!');
    }
}
