<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ResultProjectController extends Controller
{
    public function index($id)
    {
        $project = Project::find($id);
        if (!$project) {
            abort(404); // Display a 404 error page or handle it as needed
        }
        return view('result-project', ['project' => $project]);
    }

    public function executePythonScript(Request $request)
    {
        $selectedArchitecture = $request->input('architecture');
        $epochs = $request->input('epoch');

        switch ($selectedArchitecture) {
            case 'inceptionv3':
                $scriptPath = 'G:\TA 2023\plant-dataset-management\public\python\inception.py';
                break;
            case 'alexnet':
                $scriptPath = 'G:\TA 2023\plant-dataset-management\public\python\alexnet.py';
                break;
            case 'densenet121':
                $scriptPath = 'G:\TA 2023\plant-dataset-management\public\python\densenet121.py';
                break;
            case 'vgg16':
                $scriptPath = 'G:\TA 2023\plant-dataset-management\public\python\vgg16.py';
                break;
            default:
                return response("Unknown architecture.", 400);
        }
        
        $data = array(
            'epochs' => $epochs
        );
        
        // untuk mengubah data dalam bentuk array menjadi format JSON
        $payload = json_encode($data); 

        $pythonPath = 'C:/Users/FastNeutron/.conda/envs/tf_gpu/python.exe'; // Path to your Python interpreter
        $command = "\"{$pythonPath}\" \"{$scriptPath}\" --epochs={$epochs}"; // Added the missing closing double quote
        $output = shell_exec($command);

        return view('python_output', ['output' => $output]);
    }

    function saveResult(Request $request) 
    {
        $url = $request->input('url'); // Ambil URL dari input form atau request Anda

        $pdf = Browsershot::url($url)
            ->format('A4')
            ->pdf();

        $filename = 'website.pdf';
        $pdf->save(public_path($filename));

        return response()->json(['message' => 'Website saved as PDF', 'pdf_url' => asset($filename)]);
    }
}
