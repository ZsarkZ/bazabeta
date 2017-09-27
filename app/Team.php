<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Team extends Model
{
    protected $fillable = ['sport_id', 'country_id', 'name', 'trainer', 'foundation', 'website', 'stadium', 'keywords'];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function sport()
    {
        return $this->belongsTo('App\Sport');
    }

    public function players()
    {
        return $this->hasMany('App\Player');
    }

}
