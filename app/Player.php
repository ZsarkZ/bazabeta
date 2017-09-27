<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Player extends Model
{
    protected $fillable = ['country_id', 'sport_id', 'team_id', 'name', 'keywords'];

}
