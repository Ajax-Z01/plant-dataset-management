<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\all;

class ViewProjectController extends Controller
{
    public function index() {
        
        // $directory = 'public/datasets';
        $files = Storage::allFiles('public/datasets');
        $countFiles = 0;

        if ($files !== false) {
            $countFiles = count($files);
        }

        $projects = DB::table('projects')->get();
        $labels = DB::table('projects')->get();
        $collaborators = DB::table('projects')->get();

        // dd($files);
        return view('view-project', [
            'files' =>  $files,
            'projects' => $projects,
            'labels' => $labels,
            'collaborators' => $collaborators,
            'countFiles' => $countFiles,
        ]);

    }
}