<?php

namespace App\Http\Controllers;

use Aws\S3\S3Client;
use App\Models\Label;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewProjectFormController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'label' => 'required',
            'bucket_name' => 'required',
            'region' => 'required',
            'url_endpoint' => 'required',
            'access_key' => 'required',
            'secret_access_key' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            // Create a new project
            $project = Project::create([
                'title' => $request->title,
                'bucket_name' => $request->bucket_name,
                'region' => $request->region,
                'url_endpoint' => $request->url_endpoint,
                'access_key' => $request->access_key,
                'secret_access_key' => $request->secret_access_key,
            ]);

            // Link the labels to the project
            $labelsInput = $request->input('label');
            if ($labelsInput) {
                $labels = explode(',', $labelsInput);
                foreach ($labels as $labelName) {
                    $label = Label::firstOrCreate(['name' => $labelName, 'project_id' => $project->id]);
                }
            }

            // Check if the S3 bucket is accessible using provided credentials
            $client = new S3Client([
                'credentials' => [
                    'key' => $project->access_key,
                    'secret' => $project->secret_access_key,
                ],
                'region' => $project->region,
                'version' => 'latest',
                'endpoint' => $project->url_endpoint,
            ]);

            // List objects in the bucket to check if it's accessible
            $bucketName = $project->bucket_name;
            $objects = $client->listObjects(['Bucket' => $bucketName]);

            // Handle cases where the S3 bucket is not accessible
            if (!$objects) {
                // Perform necessary actions, e.g., show an error message or redirect back with an error
                return redirect()->back()->with('error', 'Unable to access the S3 bucket. Please check your credentials and bucket name.');
            }

            return redirect('/dashboard')->with('success', 'Project created successfully!');
        } catch (\Exception $e) {
            // Handle any other exceptions that may occur during the creation or S3 access
            return redirect()->back()->with('error', 'An error occurred while creating the project: ' . $e->getMessage());
        }
    }
}
