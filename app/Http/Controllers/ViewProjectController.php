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
            $file->filename = basename($file['path']);
        }
        
        return view('view-project', [
            'project' => $project,
            'labels' => $labels,
            'files' => $filesArray,
        ]);
    }

    public function storeDataset(Request $request, $projectId)
    {
        // Validate the incoming request data
        $request->validate([
            'filename' => 'required|string|max:255',
            'label_id' => 'required|integer', // Assuming label_id comes from the frontend or request
        ]);

        // Assuming you have authentication set up, you can retrieve the user_id from the authenticated user
        $user_id = auth()->user()->id;

        // Create a new dataset record
        Dataset::create([
            'filename' => $request->input('filename'),
            'user_id' => $user_id,
            'project_id' => $projectId,
            'label_id' => $request->input('label_id'),
        ]);

        // Redirect back or return a response indicating successful dataset creation
        return redirect()->back()->with('success', 'Dataset saved successfully!');
    
    }
}