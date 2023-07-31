<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use App\Models\Project;
use Aws\Credentials\Credentials;
use League\Flysystem\Filesystem;
use League\Flysystem\FileAttributes;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;

class ViewProjectController extends Controller
{
    public function index($id)
    {
        $project = Project::find($id);

        $labels = $project->labels;

        // Access S3 storage using custom configuration
        $s3config = [
            'credentials' => new Credentials(
                $project->access_key,
                $project->secret_access_key
            ),
            'region' => $project->region, // Replace this with your valid AWS region
            'version' => 'latest',
            'endpoint' => $project->url_endpoint, // Provide the complete endpoint URL here
        ];

        $client = new S3Client($s3config);
        $adapter = new AwsS3V3Adapter($client, $project->bucket_name); // Replace 'bucket_name' with the actual name of your S3 bucket
        $filesystem = new Filesystem($adapter);

        // Get all the files in the bucket as an array
        $files = $filesystem->listContents('', true);
        $filesArray = iterator_to_array($files);

        // Get the file URLs and content
        foreach ($filesArray as $file) {
            $fileUrl = $client->getObjectUrl($project->bucket_name, $file['path']);
            $file->url = str_replace('https://bucket.is3.cloudhost.id/', 'https://is3.cloudhost.id/bucket/', $fileUrl);
        }

        return view('view-project', [
            'project' => $project,
            'labels' => $labels,
            'files' => $filesArray,
        ]);
    }
}




    // public function index($id)
    // {
    //     $project = Project::find($id);

    //     $labels = $project->labels;

    //     // Access S3 storage using the 's3' disk driver
    //     $s3storage = Storage::disk('s3');

    //     // Retrieve the list of files from the S3 bucket
    //     $files = $s3storage->allFiles();

    //     return view('view-project', [
    //         's3storage' =>  $s3storage,
    //         'project' => $project,
    //         'labels' => $labels,
    //         'files' => $files,
    //     ]);
    // }