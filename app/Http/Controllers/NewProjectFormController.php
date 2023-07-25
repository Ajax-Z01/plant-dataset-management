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
            'title' => 'required',
            'label' => 'required',
            'url_endpoint'=>'required',
            'access_key' => 'required',
            'secret_access_key' => 'required',
        ]);
        
        Project::create([
            'title' => $request->title,
            'label' => $request->label,
            'url_endpoint' => $request->url_endpoint,
            'access_key' => $request->access_key,
            'secret_access_key' => $request->secret_access_key,
        ]);
        
        return redirect('/dashboard');
    }
}
