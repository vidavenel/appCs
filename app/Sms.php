<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $fillable = ['body'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function agents()
    {
        return $this->belongsToMany('App\Agent');
    }
}
