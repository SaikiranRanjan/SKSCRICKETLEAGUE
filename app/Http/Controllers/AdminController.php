<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TeamRequestedUser;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function addTeam()
    {
        return view('admin.add-team');
    }
    public function storeTeam(Request $request)
    {
        $request->validate([
            'match' => 'required|string|max:255',
            'price' => 'required|numeric',
            
        ]);
    
        $teamFile = null;
        if ($request->hasFile('team_file')) {
            $teamFile = $request->file('team_file')->store('team_files', 'public');
        }
        
    
        Team::create([
            'match' => $request->match,
            'price' => $request->price,
            'team_file' => "not required"
        ]);
    
        return redirect()->route('manage.team')->with('success', 'Team added successfully!');
    }
    
    public function updateTeam(Request $request, $id)
    {
        $request->validate([
            'match' => 'required|string|max:255',
            'price' => 'required|numeric',
            'team_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
    
        $team = Team::findOrFail($id);
    
        if ($request->hasFile('team_file')) {
            $teamFile = $request->file('team_file')->store('team_files', 'public');
            $team->update(['team_file' => $teamFile]);
        }
    
        $team->update([
            'match' => $request->match,
            'price' => $request->price
        ]);
    
        return redirect()->route('manage.teams')->with('success', 'Team updated successfully!');
    }
    
    public function manageTeams()
    {
        $teams = Team::all();
        return view('admin.manage-teams', compact('teams'));
    }

    public function editTeam($id)
    {
        $team = Team::findOrFail($id);
        return view('admin.edit-team', compact('team'));
    }

    

    public function deleteTeam($id)
    {
        Team::findOrFail($id)->delete();
        return redirect()->route('manage.teams')->with('success', 'Team deleted successfully!');
    }

    public function teamRequested()
    {
        $teamRequests = TeamRequestedUser::all(); // Fetch all records
        return view('admin.team-requested', compact('teamRequests'));
    }
}
