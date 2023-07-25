<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Google\Service\CloudSearch\Id;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\all;

class ViewProjectController extends Controller
{
    public function index($id) {
        
        $project = Project::find($id);
        // dd($project->accesskey);

        $s3storage = Storage::build([
            'driver' => 's3',
            'key' => $project->access_key,
            'secret' => $project->secret_access_key,
            'endpoint' => $project->url_endpoint,
            'region' => 'Jogja',
            'bucket' => 'nabell',
        ]);
        // $s3storage->allFiles();

        // dd($s3storage->allFiles());
        // $files = Storage::allFiles($s3storage);

        $projects = DB::table('projects')->get();
        $labels = DB::table('projects')->get();

        // dd($files);
        return view('view-project', [
            's3storage' =>  $s3storage,
            'projects' => $projects,
            'labels' => $labels,
            // 'files' => $files,
        ]);
    }
}