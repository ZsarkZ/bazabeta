<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tournament extends Model
{
    protected $fillable = ['sport_id', 'name', 'keywords'];

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function sport()
    {
        return $this->belongsTo('App\Sport');
    }

    public function Players()
    {
        return $this->hasMany('App\Player');
    }

    public function Teams()
    {
        return $this->hasMany('App\Team');
    }

    public function Games()
    {
        return $this->hasMany('App\Game');
    }

}
