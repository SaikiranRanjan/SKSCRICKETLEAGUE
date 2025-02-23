<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamRequestedUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'requested_team_id',
        'users_whatsapp_number',
        'payment_received',
        'team_shared',
    ];

    // Define relationship with Team Model (Assuming Team model exists)
    public function team()
    {
        return $this->belongsTo(Team::class, 'requested_team_id');
    }
}
