<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $fillable = ['name', 'description'];

    public function agents()
    {
        return $this->belongsToMany('App\Agent');
    }
}
