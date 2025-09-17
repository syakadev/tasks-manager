<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Projects;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Projects $project)
    {
        // Eager load the team and its user relationships to prevent N+1 queries
        $team = $project->team()->with(['manager', 'user1', 'user2', 'user3'])->first();

        $manager = null;
        $members = collect(); // Initialize an empty collection

        if ($team) {
            $manager = $team->manager; // Get the manager object

            // Collect member objects and filter out any null values (if a user slot is empty)
            $members = collect([$team->user1, $team->user2, $team->user3])->filter();
        }

        return view('teams.index', compact('project', 'manager', 'members'));
    }



    /**
     * Remove a specific member from the team.
     */
    public function removeMember(Projects $project, User $member)
    {
        $team = $project->team;

        if ($team) {
            // Check which user slot holds the member and set it to null
            if ($team->user1_id == $member->id) {
                $team->user1_id = null;
            } elseif ($team->user2_id == $member->id) {
                $team->user2_id = null;
            } elseif ($team->user3_id == $member->id) {
                $team->user3_id = null;
            }

            $team->save();

            return redirect()->route('projects.teams.index', $project)->with('success', 'Member removed successfully.');
        }

        return redirect()->route('projects.teams.index', $project)->with('error', 'Team not found.');
    }

    /**
     * Show the form for adding a new member to the team.
     */
    public function addMemberForm(Projects $project)
    {
        $team = $project->team;

        if (!$team) {
            return redirect()->route('projects.show', $project)->with('error', 'Project does not have a team assigned.');
        }

        // Get IDs of users already in the team
        $existingUserIds = collect([$team->manager_id, $team->user1_id, $team->user2_id, $team->user3_id])->filter()->all();

        // Get all users who are not already in the team
        $availableUsers = User::whereNotIn('id', $existingUserIds)->get();

        return view('teams.add-member', compact('project', 'availableUsers'));
    }

    /**
     * Store a newly added member in storage.
     */
    public function storeMember(Request $request, Projects $project)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $team = $project->team;

        if (!$team) {
            return redirect()->route('projects.show', $project)->with('error', 'Project does not have a team assigned.');
        }

        // Find the first empty slot and add the user
        if (is_null($team->user1_id)) {
            $team->user1_id = $request->user_id;
        } elseif (is_null($team->user2_id)) {
            $team->user2_id = $request->user_id;
        } elseif (is_null($team->user3_id)) {
            $team->user3_id = $request->user_id;
        } else {
            return redirect()->route('projects.teams.index', $project)->with('error', 'Team is already full.');
        }

        $team->save();

        return redirect()->route('projects.teams.index', $project)->with('success', 'Member added successfully.');
    }
}
