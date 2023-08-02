<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ResultProjectController extends Controller
{
    public function index($id){

        $project = Project::find($id);

        if (!$project) {
            abort(404); // Display a 404 error page or handle it as needed
        }

        return view('result-project', ['project' => $project]);
    }

    public function executePythonScript(Request $request)
    {
        $selectedArchitecture = $request->input('architecture');
        $epoch = $request->input('epoch');
    
        switch ($selectedArchitecture) {
            case 'inceptionv3':
                $scriptPath = 'Scripts\inceptionv3-1.py';
                break;
            case 'alexnet':
                $scriptPath = 'Scripts\alexnet-1.py';
                break;
            case 'densenet121':
                $scriptPath = 'Scripts\densenet121-1.py';
                break;
            case 'vgg16':
                $scriptPath = 'Scripts\vgg16-1.py';
                break;
            default:
                return response("Unknown architecture.", 400);
        }
        
        $pythonPath = 'C:\Program Files\Python311\python.exe'; // Path to your Python interpreter
        $command = "\"{$pythonPath}\" \"{$scriptPath}";
        $output = shell_exec($command);
    
        return view('python_output', ['output' => $output]);
    }    
}
