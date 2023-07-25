<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\all;

class ViewProjectController extends Controller
{
    public function index(Request $request) {
        
        // local
        // $files = Storage::allFiles('public/datasets');
        // $countFiles = 0;

        // if ($files !== false) {
        //     $countFiles = count($files);
        // }

        // S3
        // $path = $request->file('filename')->store('images');
        $files = Storage::putFile('images', $request->file('filename'));
        // $files = Storage::putFile('filename', $path);
        $url = Storage::url($files);
        Storage::setVisibility($files, 'public');

        $projects = DB::table('projects')->get();
        $labels = DB::table('projects')->get();
        $collaborators = DB::table('projects')->get();

        // dd($files);
        return view('view-project', [
            'files' =>  $files,
            'projects' => $projects,
            'labels' => $labels,
            'collaborators' => $collaborators,
            'url' => $url,
            // 'countFiles' => $countFiles,
        ]);

    }
}