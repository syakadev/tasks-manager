<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\Projects;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
        public function create( $projectId)
        {
            $project = $projectId;

            return view('tasks.create', compact('project'));
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
        ]);

        Tasks::create($request->all());
        $idProject = $request->project_id;


        return redirect()->route('projects.show', $idProject)
            ->with('success', 'Task created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show( $idProject)
    {
        $project = Projects::findOrFail($idProject);
        $tasks = Tasks::where('project_id', $idProject)->get();

        return view('tasks.index', compact('tasks', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projects $project, Tasks $task)
    {
        return view('tasks.edit', compact('project', 'task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projects $project, Tasks $task)
    {
        $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:no,yes',
        ]);

        $task->update($request->all());

        return redirect()->route('projects.show', $project->id)
        ->with('success', 'Task updated successfully.');
            }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projects $project, Tasks $task)
    {
        $task->delete();

        return redirect()->route('projects.show', $project->id)
        ->with('success', 'Task deleted successfully.');
    }
}
