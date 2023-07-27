<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function home()
    {
        $projects = DB::table('projects')->get();
        $labels = DB::table('label_project')->get();
        $allLabels = DB::table('labels')->get();

        // Initialize variables to store AWS access credentials
        $awsAccessKeyId = null;
        $awsSecretAccessKey = null;

        foreach ($projects as $project) {
            // Extract AWS access credentials from the first project
            // Assuming all projects have the same AWS access credentials
            if (!$awsAccessKeyId && !$awsSecretAccessKey) {
                $awsAccessKeyId = $project->access_key;
                $awsSecretAccessKey = $project->secret_access_key;

                // Set AWS access credentials as environment variables
                putenv("AWS_ACCESS_KEY_ID={$awsAccessKeyId}");
                putenv("AWS_SECRET_ACCESS_KEY={$awsSecretAccessKey}");
            }
        }

        // Create an associative array to store label counts based on project_id
        $labelCountsByProjectId = [];
        foreach ($labels as $label) {
            $project_id = $label->project_id;

            // If the project_id exists in the array, increment the count, otherwise initialize it to 1
            if (isset($labelCountsByProjectId[$project_id])) {
                $labelCountsByProjectId[$project_id]++;
            } else {
                $labelCountsByProjectId[$project_id] = 1;
            }
        }

        $s3storage = Storage::disk('s3');

        // Retrieve the list of files from the S3 bucket
        $fileCountsByProjectId = [];
        foreach ($projects as $project) {
            $files = $s3storage->files($project->id);
            $fileCountsByProjectId[$project->id] = count($files);
        }

        return view('dashboard',[
            'projects' => $projects,
            'labels' => $labels,
            'allLabels' => $allLabels,
            'labelCountsByProjectId' => $labelCountsByProjectId,
            'fileCountsByProjectId' => $fileCountsByProjectId,
        ]);
    }
}