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

        // Create an associative array to store file counts based on project_id
        $fileCountsByProjectId = [];
        foreach ($projects as $project) {
            $project_id = $project->id;

            // Access S3 storage using custom configuration
            $s3config = [
                'credentials' => [
                    'key' => $project->access_key,
                    'secret' => $project->secret_access_key,
                ],
                'region' => $project->region, // Replace this with your valid AWS region
                'version' => 'latest',
                'endpoint' => $project->url_endpoint, // Provide the complete endpoint URL here
            ];

            $client = new \Aws\S3\S3Client($s3config);
            $adapter = new \League\Flysystem\AwsS3V3\AwsS3V3Adapter($client, $project->bucket_name); // Replace 'bucket_name' with the actual name of your S3 bucket
            $filesystem = new \League\Flysystem\Filesystem($adapter);

            // Get all the files in the bucket as an array
            $files = $filesystem->listContents('', true);
            $filesArray = iterator_to_array($files);

            // Get the file URLs and content
            foreach ($filesArray as $file) {
                $fileUrl = $client->getObjectUrl($project->bucket_name, $file['path']);
                $file->url = str_replace('https://bucket.is3.cloudhost.id/', 'https://is3.cloudhost.id/bucket/', $fileUrl);
            }

            $fileCountsByProjectId[$project_id] = count($filesArray);
        }

        return view('dashboard', [
            'projects' => $projects,
            'labels' => $labels,
            'allLabels' => $allLabels,
            'labelCountsByProjectId' => $labelCountsByProjectId,
            'fileCountsByProjectId' => $fileCountsByProjectId,
        ]);
    }
}
