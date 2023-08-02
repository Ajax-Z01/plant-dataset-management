<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use App\Models\Dataset;
use App\Models\Project;
use Illuminate\Http\Request;
use Aws\Credentials\Credentials;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Auth;
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

        $datasetIds = [];
        $datasetMap = [];

        // Fetch filenames and labels from associated datasets
        $datasets = $project->datasets;
        foreach ($datasets as $dataset) {
            $datasetIds[] = $dataset->id;
            $datasetMap[$dataset->filename] = $dataset->label->name;
        }

        // Get the file URLs and content
        foreach ($filesArray as $file) {
            $fileUrl = $client->getObjectUrl($project->bucket_name, $file['path']);
            $file->url = str_replace('https://bucket.is3.cloudhost.id/', 'https://is3.cloudhost.id/bucket/', $fileUrl);
            $file->filename = basename($file['path']);

            // Check if the file exists in the datasets
            if (in_array($file->filename, array_keys($datasetMap))) {
                $file->label = $datasetMap[$file->filename];
            } else {
                $file->label = 'Unlabeled';
            }
        }

        return view('view-project', [
            'datasetIds' => $datasetIds,
            'datasetMap' => $datasetMap,
            'project' => $project,
            'labels' => $labels,
            'files' => $filesArray,
        ]);
    }

    public function updateDataset(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'label_id' => 'required|integer', // Assuming label_id comes from the frontend or request
        ]);

        // Get the dataset by ID
        $dataset = Dataset::findOrFail($id);

        // Update the dataset
        $dataset->update([
            'label_id' => $request->input('label_id'),
        ]);

        // Redirect back or return a response indicating successful dataset update
        return redirect()->back()->with('success', 'Dataset updated successfully!');
    }
}
