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
    public function index($id) 
    {
        $project = Project::find($id);
        
        $labels = $project->labels;

        // Access S3 storage using the 's3' disk driver
        $s3storage = Storage::disk('s3');

        // Retrieve the list of files from the S3 bucket
        $files = $s3storage->allFiles();
        
        // $s3storage = Storage::build([
        //     'driver' => 's3',
        //     'key' => $project->access_key,
        //     'secret' => $project->secret_access_key,
        //     'endpoint' => $project->url_endpoint,
        //     'region' => 'Jogja',
        //     'bucket' => 'nabell',
        // ]);
        // $s3storage->allFiles();

        // dd($s3storage->allFiles());
        // $files = Storage::allFiles($s3storage);


        // dd($files);
        return view('view-project', [
            's3storage' =>  $s3storage,
            'project' => $project,
            'labels' => $labels,
            'files' => $files,
        ]);
    }
}