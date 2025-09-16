<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Tasks;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Projects::where('end_date', '<', Carbon::now())->delete();

        if (Auth::user()->role === 'admin') {
            $projects = Projects::all();
        } else {
            $userId = Auth::id();
            $teamIds = Team::where('manager_id', $userId)
                            ->orWhere('user1_id', $userId)
                            ->orWhere('user2_id', $userId)
                            ->orWhere('user3_id', $userId)
                            ->pluck('id');

            $projects = Projects::whereIn('team_id', $teamIds)->get();
        }

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('projects.index')->with('error', 'You are not authorized to perform this action.');
        }
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('projects.index')->with('error', 'You are not authorized to perform this action.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);


        Projects::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
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
   public function edit(Projects $project)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('projects.index')->with('error', 'You are not authorized to perform this action.');
        }
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projects $project)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('projects.index')->with('error', 'You are not authorized to perform this action.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'end_date' => 'required|date',
            'status' => 'required|in:todo,doing,done',
        ]);


         // Jika user mencoba mengubah status menjadi 'selesai'
    if ($request->status == 'done') {
        $totalTasks = $project->tasks()->count();
        $completedTasks = $project->tasks()->where('status', 'yes')->count();

        if ($totalTasks === 0 || $totalTasks !== $completedTasks) {
            return back()->with('error', 'Tidak bisa menyelesaikan project, masih ada task yang belum selesai.');
        }

    }

            $project->update($request->all());
            return redirect()->route('projects.index')
                ->with('success', 'Project updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projects $project)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('projects.index')->with('error', 'You are not authorized to perform this action.');
        }
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');

    }
}
