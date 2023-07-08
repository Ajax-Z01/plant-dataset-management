<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class NewProjectFormController extends Controller
{
    // Create Contact Form
    public function createForm() {
        return view('create');
    }

    // Store Contact Form data
    public function NewProjectForm(Request $request) {
        // Form validation
        $this->validate($request, [
            'name' => 'required',
            'label' => 'required',
            'collaborator' => 'required',
            'url'=>'required',
            'accesskey' => 'required',
            'secretaccesskey' => 'required'
         ]);
        //  Store data in database
        Project::create([
            'name' => $request->name,
            'label' => $request->label,
            'collaborator' => $request->collaborator,
            'url' => $request->url,
            'accesskey' => $request->accesskey,
            'secretaccesskey' => $request->secretaccesskey,
        ]);
        // 
        return redirect('/dashboard');
    }
}
