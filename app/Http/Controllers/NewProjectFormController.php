<?php

namespace App\Http\Controllers;

use App\Models\User;
use Aws\S3\S3Client;
use App\Models\Label;
use App\Models\Dataset;
use App\Models\Project;
use Illuminate\Http\Request;
use Aws\Credentials\Credentials;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\AwsS3V3\AwsS3V3Adapter;

class NewProjectFormController extends Controller
{
    public function create()
    {
        // Fetch user data from the User model
        $users = User::select('id', 'name', 'email')->get();
        return view('create', compact('users'));
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
            // List objects in the bucket to check if it's accessible
            $objects = $client->listObjects(['Bucket' => $project->bucket_name]);
            $adapter = new AwsS3V3Adapter($client, $project->bucket_name); // Replace 'bucket_name' with the actual name of your S3 bucket
            $filesystem = new Filesystem($adapter);

            // Get all the files in the bucket as an array
            $files = $filesystem->listContents('', true);
            $filesArray = iterator_to_array($files);
            // Link the datasets to the project
            foreach ($filesArray as $file) {
                $file->filename = basename($file['path']);

                // Assuming you have the authenticated user available, you can get the user_id
                $user_id = Auth::user()->id;

                // Create a new dataset for each file with default label_id 1 ('Unlabeled')
                Dataset::create([
                    'filename' => $file->filename,
                    'label_id' => $label->id,
                    'project_id' => $project->id,
                    'user_id' => $user_id,
                ]);
            }

            // Handle cases where the S3 bucket is not accessible
            if (!$objects) {
                // Perform necessary actions, e.g., show an error message or redirect back with an error
                return redirect()->back()->with('error', 'Unable to access the S3 bucket. Please check your credentials and bucket name.');
            }

            // Fetch user data from the User model
            $users = User::select('id', 'name', 'email')->get();
            // dd($users);

            // Save collaborators to project_user pivot table
            $selectedCollaborators = $request->input('selected_collaborators', []);
            // dd($selectedCollaborators);
            $project->collaborators()->sync($selectedCollaborators);

            // Redirect to /dashboard with success message
            return redirect('/dashboard')->with([
                'success' => 'Project created successfully!',
                'users' => $users, // Pass the $users data to the dashboard view
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error fetching users'], 500);
            // Handle any other exceptions that may occur during the creation or S3 access
            return redirect()->back()->with('error', 'An error occurred while creating the project: ' . $e->getMessage());
        }
    }

}
