<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamRequestedUser;

class TeamRequestController extends Controller {
    public function store(Request $request) {
        $request->validate([
            'requested_team_id' => 'required|exists:teams,id',
            'users_whatsapp_number' => 'required|string|max:15',
        ]);

        TeamRequestedUser::create([
            'requested_team_id' => $request->requested_team_id,
            'users_whatsapp_number' => $request->users_whatsapp_number,
            'payment_received' => 'no',
            'team_shared' => 'no',
        ]);

        return redirect()->back()->with('success', 'Your request has been submitted successfully!');
    }
}
