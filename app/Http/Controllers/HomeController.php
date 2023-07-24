<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function home()
    {
        $projects = DB::table('projects')->get();

        return view('dashboard',['projects' => $projects]);
    }
}