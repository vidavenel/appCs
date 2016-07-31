<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = ['nom', 'prenom', 'phone'];

    public function groupes()
    {
        return $this->belongsToMany('App\Groupe');
    }
}
