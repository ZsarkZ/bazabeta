<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    protected $fillable = ['name'];

    public function Teams()
    {
        return $this->hasMany('App\Team');
    }

    public function Players()
    {
        return $this->hasMany('App\Player');
    }

    public function Tournaments()
    {
        return $this->hasMany('App\Tournament');
    }

    public function Games()
    {
        return $this->hasMany('App\Game');
    }
}
