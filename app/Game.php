<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['country_id', 'sport_id', 'tournament_id', 'gameable_type', 'member_one', 'member_two', 'score_one', 'score_two', 'result', 'date'];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function sport()
    {
        return $this->belongsTo('App\Sport');
    }

    public function Tournament()
    {
        return $this->belongsTo('App\Tournament');
    }
}
