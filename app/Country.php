<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name'];
    protected $table = 'countries';

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

}
