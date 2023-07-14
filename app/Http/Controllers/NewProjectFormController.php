<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class NewProjectFormController extends Controller
{
    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        
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
        
        return redirect('/dashboard');
    }
}
