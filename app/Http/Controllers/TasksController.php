<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\Projects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
        public function create( $projectId)
        {
            if (Auth::user()->role !== 'admin') {
                return redirect()->route('projects.show', $projectId)->with('error', 'You are not authorized to perform this action.');
            }
            $project = $projectId;

            return view('tasks.create', compact('project'));
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('projects.show', $request->project_id)->with('error', 'You are not authorized to perform this action.');
        }
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
        if (Auth::user()->role === 'admin') {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'status' => 'required|in:no,yes',
            ]);
            $task->update($request->all());
        } else {
            $request->validate([
                'description' => 'nullable|string',
                'status' => 'required|in:no,yes',
            ]);
            $task->update($request->only('description', 'status'));
        }

        return redirect()->route('projects.show', $project->id)
        ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projects $project, Tasks $task)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('projects.show', $project->id)->with('error', 'You are not authorized to perform this action.');
        }
        $task->delete();

        return redirect()->route('projects.show', $project->id)
        ->with('success', 'Task deleted successfully.');
    }
}
