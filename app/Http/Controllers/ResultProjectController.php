<?php

namespace App\Http\Controllers;

use App\Models\Project;

class ResultProjectController extends Controller
{
    public function index($id){

        $project = Project::find($id);

        if (!$project) {
            abort(404); // Display a 404 error page or handle it as needed
        }

        return view('result-project', ['project' => $project]);
    }
}
