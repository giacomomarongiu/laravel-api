<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('technologies', 'type')->orderByDesc('id')->paginate(4);
        $carosuelProjects = Project::all();
        return response()->json([
            'success' => true,
            'projects' => $projects,
            'carosuelProjects' => $carosuelProjects
        ]);
    }

    public function show($id)
    {
        $project = Project::with(/* 'techologies', */ 'type')->where('id', $id)->first();

        if ($project) {
            // return object
            return response()->json([
                'success' => true,
                'response' => $project,
            ]);
        } else {
            // 404 error
            return response()->json([
                'success' => false,
                'response' => '404 ERROR PAGE NOT FOUND'
            ]);
        }

    }
}
