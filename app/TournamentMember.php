<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TournamentMember extends Model
{
    protected $table = 'tournament_members';
    protected $fillable = ['tournament_id', 'team_id', 'player_id', 'sport_id'];
}
