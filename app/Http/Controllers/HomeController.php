<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function getProjectsByUserId($user_id)
    {
        $projects = Project::whereHas('users', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        })->get();

        return $projects;
    }

    public function home()
    {
        $user_id = Auth::id();
        $projects = $this->getProjectsByUserId($user_id);

        $labels = DB::table('labels')->get();

        $fileCountsByProjectId = [];
        foreach ($projects as $project) {
            $datasetCount = $project->datasets()->count(); // Menghitung jumlah file pada tabel datasets untuk proyek tertentu
            $fileCountsByProjectId[$project->id] = $datasetCount;
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

        return view('dashboard', [
            'projects' => $projects,
            'labels' => $labels,
            'labelCountsByProjectId' => $labelCountsByProjectId,
            'fileCountsByProjectId' => $fileCountsByProjectId,
        ]);
    }
}
