<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $fillable = ['specializations'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
