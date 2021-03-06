<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Network extends Model
{
    protected $table = 'networks';
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
